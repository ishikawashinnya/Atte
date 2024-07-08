@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/user-page.css') }}" />
@endsection

@section('content')
<div class="user-page__content">
    <div class="user-page__ttl">
        <p>{{ $user->name }}さんの勤怠記録</p>
    </div>

    <div class="user-page__list">
        <table class="user__table">
            <tr class="title__row">
                <th class="table__label">日付</th>
                <th class="table__label">勤務開始</th>
                <th class="table__label">勤務終了</th>
                <th class="table__label">休憩時間</th>
                <th class="table__label">勤務時間</th>
            </tr>

            @foreach ($resultArray as $work)
                <tr class="value__row">
                    <td class="value__list">{{ $work['date'] }}</td>
                    <td class="value__list">{{ $work['start'] }}</td>
                    <td class="value__list">{{ $work['end'] }}</td>
                    <td class="value__list">{{ $work['total_rest'] }}</td>
                    <td class="value__list">{{ $work['total_work'] }}</td>
                </tr>
            @endforeach


            
        </table>
    </div>

    <div class="pagination">
        {{ $works->appends(request()->query())->links('vendor/pagination/custom') }}
    </div>
</div>
@endsection