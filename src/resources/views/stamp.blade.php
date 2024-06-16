@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/stamp.css') }}" />
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
<div class="stamp__content">
    <p class="message">～さんお疲れ様です！</p>
    <form action="" method="" class="work-form"> 
        @csrf
        <input type="submit" value="勤務開始" class="work-start__btn">
        <input type="submit" value="勤務終了" class="work-end__btn">
    </form>
    <form action="" method="" class="rest-form">
        @csrf
        <input type="submit" value="休憩開始" class="rest-start__btn">
        <input type="submit" value="休憩終了" class="rest-end__btn">
    </form>
</div>
@endsection