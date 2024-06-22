@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/stamp.css') }}" />
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
<div class="stamp__content">
    <p class="message">{{ \Auth::user()->name }}さんお疲れ様です！</p>
    <div class="form__alert">
        @if(session('message'))
        <div class="alert__success">
            {{ session('message')}}
        </div>
        @endif
    </div>
    <div class="form__alert">
        @if(session('error'))
        <div class="alert__danger">
            {{ session('error') }}
        </div>
        @endif
    </div>
    <div class="work__form">
        <div class="work__form-start">
            <form action="/startwork" method="post" class="work-form"> 
                @csrf
                <button type="submit" class="work-start__btn">勤務開始</button>
            </form>  
        </div>
        <div class="work__form-end">
            <form action="/endwork" method="post" class="work-form">
                @csrf
                <button type="submit" class="work-end__btn">勤務終了</button>
            </form>
        </div>
    </div>
    <dev class="rest__form">
        <div class="rest__form-start">
            <form action="/startrest" method="post" class="rest-form">
                @csrf
                <button type="submit" class="rest-start__btn">休憩開始</button>
            </form>
        </div>
        <div class="rest__form-end">
            <form action="/endrest" method="post" class="rest-form">
                @csrf
                <button type="submit" class="rest-end__btn">休憩終了</button>
            </form>
        </div>
    </dev>
    
        
    
    
</div>
@endsection