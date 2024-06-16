<?php

namespace App\Http\Controllers;

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
}
