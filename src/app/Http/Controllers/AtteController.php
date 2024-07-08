<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Work;
use App\Models\Rest;
use Illuminate\Http\Request;


class AtteController extends Controller
{
    public function index()
    {
        $now_date = Carbon::now()->format('Y-m-d');
        $user_id = Auth::user()->id;
        return view('stamp');
    }

    public function startWork()
    {
        $user = Auth::user();

        $oldWork = Work::where('user_id', $user->id)->latest()->first();

        $oldWorkDay = null;
        if($oldWork) {
            $oldWorkStart = new Carbon($oldWork->start);
            $oldWorkDay = $oldWorkStart->startOfDay();
        }

        $newWorkDay = Carbon::today();

        if(($oldWorkDay == $newWorkDay) && (empty($oldWork->end))){
            return redirect('/')->with('error', 'すでに出勤打刻されています');
        }

        $work = Work::create([
            'user_id' => $user->id,
            'start' => Carbon::now(),
            'date' => Carbon::today(),
        ]);

        return redirect('/')->with('message', '出勤打刻が完了しました');
    }

    public function endWork()
    {
        $user = Auth::user();
        $work = Work::where('user_id', $user->id)->latest()->first();

        if( !empty($work->end)) {
            return redirect('/')->with('error', 'すでに退勤打刻済みか、出勤打刻がされていません');
        }
        $work->update([
            'end' => Carbon::now()
        ]);

        return redirect('/')->with('message', '退勤打刻が完了しました');
    }

    public function startRest()
    {
        $user = Auth::user();
        $work = Work::where('user_id', $user->id)->latest()->first();
        if( !empty($work->end)) {
            return redirect('/')->with('error', 'すでに退勤打刻済みか、出勤打刻がされていません');
        }

        $startRest = Rest::where('work_id', $work->id)->whereNull('end')->first();

        if ($startRest) {
            return redirect('/')->with('error', 'すでに休憩中です');
        }

        Rest::create([
            'work_id' => $work->id,
            'start' => Carbon::now(),
        ]);

        return redirect('/')->with('message', '休憩開始しました');

    }

    public function endRest()
    {
        $user = Auth::user();
        $work = Work::where('user_id', $user->id)->latest()->first();

        if (!$work || !empty($work->end)) {
            return redirect('/')->with('error', '出勤打刻がされていないか、既に退勤打刻されています');
        }

        $rest = Rest::where('work_id', $work->id)->whereNull('end')->latest()->first();
        if(!$rest) {
            return redirect('/')->with('error', 'すでに休憩を終了したか、休憩が開始されていません');
        }

        $rest->update([
            'end' => Carbon::now(),
        ]);

        return redirect('/')->with('message', '休憩終了しました');
    }

    


    public function getWorks(Request $request)
    {
        // 日付パラメータを処理
        if (is_null($request->date)) {
            $yesterday = Carbon::yesterday();
            $today = Carbon::today();
            $tomorrow = Carbon::tomorrow();
        } else {
            $today = new Carbon($request->date);
            $yesterday = (new Carbon($request->date))->subDay();
            $tomorrow = (new Carbon($request->date))->addDay();
        }
        // $prevOrNext = $request->changeDay;

        $resultArray[] = array();
        $i = 0;

        $workTodayAll = Work::where('date', $today->format('Y-m-d'))->get();

        // 今日の勤務データを取得
        $works = Work::with(['user', 'rests'])
        ->where('date', $today->format('Y-m-d'))
        ->paginate(5);

        $resultArray = [];

        foreach ($works as $work) {
            // 勤務開始時間と終了時間を Carbon オブジェクトに変換
            $workStart = Carbon::parse($work->start);
            $workEnd = $work->end ? Carbon::parse($work->end) : null;

            // 休憩時間の計算
            $totalRestSeconds = $work->rests->reduce(function ($carry, $rest) {
                if ($rest->start && $rest->end) {
                    $carry += Carbon::parse($rest->end)->diffInSeconds(Carbon::parse($rest->start));
                }
                return $carry;
            }, 0);

            // 秒から時間フォーマットに変換
            $totalRestTime = gmdate('H:i:s', $totalRestSeconds); 

            // 勤務時間の計算
            $totalWorkSeconds = $workEnd ? $workEnd->diffInSeconds($workStart) : 0;
            $totalWorkSecondsWithoutRest = $totalWorkSeconds - $totalRestSeconds;
            $totalWorkTime = gmdate('H:i:s', $totalWorkSecondsWithoutRest);

            // 結果配列に追加
            $resultArray[] = [
                'user_name' => $work->user->name ?? '不明',
                'start' => $workStart->format('H:i:s'),
                'end' => $workEnd ? $workEnd->format('H:i:s') : '未設定',
                'total_rest' => $totalRestTime,
                'total_work' => $totalWorkTime,
            ];
        }
        


        return view('date')->with([
            'today' => $today,
            'yesterday' => $yesterday,
            'tomorrow' => $tomorrow,
            'resultArray' => $resultArray,
            'works' => $works,
            
        ]);
    
    }

    public function getUsers()
    {
        $users = User::paginate(5);

        return view('user-list', compact('users'));
    }

    public function userWorks (Request $request)
    {
        // ユーザーIDをクエリパラメータから取得
        $userId = $request->query('id');
        $user = User::findOrFail($userId);

        // 勤怠情報を取得
        $works = Work::with(['user', 'rests'])
            ->where('user_id', $userId)
            ->orderBy('date', 'desc') // 最新のものから表示するために日付で降順にソート 
            ->paginate(5); // 5件ずつページネーションする

        $resultArray = [];

        foreach ($works as $work) {
            // 勤務開始時間と終了時間を Carbon オブジェクトに変換
            $workStart = Carbon::parse($work->start);
            $workEnd = $work->end ? Carbon::parse($work->end) : null;

            // 休憩時間の計算
            $totalRestSeconds = $work->rests->reduce(function ($carry, $rest) {
                if ($rest->start && $rest->end) {
                    $carry += Carbon::parse($rest->end)->diffInSeconds(Carbon::parse($rest->start));
                }
                return $carry;
            }, 0);

            // 秒から時間フォーマットに変換
            $totalRestTime = gmdate('H:i:s', $totalRestSeconds); 

            // 勤務時間の計算
            $totalWorkSeconds = $workEnd ? $workEnd->diffInSeconds($workStart) : 0;
            $totalWorkSecondsWithoutRest = $totalWorkSeconds - $totalRestSeconds;
            $totalWorkTime = gmdate('H:i:s', $totalWorkSecondsWithoutRest);

            // 結果配列に追加
            $resultArray[] = [
                'date' => $work->date,
                'start' => $workStart->format('H:i:s'),
                'end' => $workEnd ? $workEnd->format('H:i:s') : '未設定',
                'total_rest' => $totalRestTime,
                'total_work' => $totalWorkTime,
            ];
        }

        return view('user-page')->with([
            'user' => $user,
            'resultArray' => $resultArray,
            'works' => $works,
        ]);
    }
  
    
}