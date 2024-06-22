@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/date.css') }}" />
@endsection

@section('link')
<nav class="header-nav">
    <ul class="header-nav__list">
        <li class="header-nav__item"><a href="/">ホーム</a></li>
        <li class="header-nav__item"><a href="/attendance">日付一覧</a></li>
    </ul>
    <form action="/logout" method="post" class="logout">
        @csrf
        <input type="submit" value="ログアウト" class="logout-btn">
    </form>
</nav>
@endsection

@section('content')
<div class="date__content">
    <div class="date">
        <form action="/attendance" method="get" class="date__form">
            @csrf
            <button class="before" name="date" value="{{ $yesterday->format('Y-m-d')}}"> &lt;</button>
        </form>
        <p class="date__today">
            {{ $today->format('Y-m-d') }}
        </p>
        <form action="/attendance" method="get" class="date__form">
            @csrf
            <button class="after" name="date" type="date" value="{{ $tomorrow->format('Y-m-d') }}"> &gt;</button>
        </form>
    </div>
    
    <div class="date__content-table">
        <table class="date__table">
            <tr class="date__row">
                <th class="date__label">名前</th>
                <th class="date__label">勤務開始</th>
                <th class="date__label">勤務終了</th>
                <th class="date__label">休憩時間</th>
                <th class="date__label">勤務時間</th>
            </tr>

             @if (!empty($resultArray))
            @foreach ($resultArray as $work)
            <tr>
                <td>{{ $work['user_name'] }}</td>
                <td>{{ $work['start'] }}</td>
                <td>{{ $work['end'] }}</td>
                <td>{{ $work['total_rest'] }}</td>
                <td>{{ $work['total_work'] }}</td>
            </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5">勤務情報がありません</td>
            </tr>
        @endif
        </table>
    </div>

    
</div>
@endsection