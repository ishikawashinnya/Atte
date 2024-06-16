@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/date.css') }}" />
@endsection

@section('link')
<nav class="header-nav">
    <ul class="header-nav__list">
        <li class="header-nav__item"><a href="">ホーム</a></li>
        <li class="header-nav__item"><a href="">日付一覧</a></li>
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

    </div>
    <div class="date-table">
        <table class="date-table__inner">
            <tr class="date-table__row">
                <th class="date-table__header">
                    <span class="date-table__header-span">名前</span>
                    <span class="date-table__header-span">勤務開始</span>
                    <span class="date-table__header-span">勤務終了</span>
                    <span class="date-table__header-span">休憩時間</span>
                    <span class="date-table__header-span">勤務時間</span>
                </th>
            </tr>
        </table>
    </div>
</div>
@endsection