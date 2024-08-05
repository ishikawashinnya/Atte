@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stamp.css') }}" />
@endsection

@section('content')
<div class="stamp__content">
    <!-- ログイン中のユーザー名表示 -->
    <div class="stamp__content-ttl">
        @if(Auth::check())
        <p class="message">{{ \Auth::user()->name }}さんお疲れ様です！</p>
        @endif
    </div>
    <!-- 操作成功時のメッセージ -->
    <!-- <div class="form__alert">
        @if(session('message'))
        <div class="alert__success">
           <p class="alert__message">{{ session('message')}}</p> 
        </div>
        @endif
    </div>　-->
    <!-- 操作失敗時のメッセージ -->
    <!-- <div class="form__alert">
        @if(session('error'))
        <div class="alert__danger">
            <p class="alert__message">{{ session('error') }}</p>
        </div>
        @endif
    </div> -->
    
    <div class="work__form">
        <!-- 勤務開始 -->
        <div class="work__form-start">
            @if($isWorkStarted)
            <form action="/startwork" method="POST" class="stamp-form">
                @csrf
                <button disabled style="color:gray">勤務開始</button>
            </form>
            @else
            <form action="/startwork" method="post" class="stamp-form"> 
                @csrf
                <button type="submit" class="stamp__btn">勤務開始</button>
            </form> 
            @endif
        </div>
        <!-- 勤務終了 -->
        <div class="work__form-end">
            @if($isWorkStarted)
            <form action="/endwork" method="post" class="stamp-form">
                @csrf
                <button type="submit" class="stamp__btn">勤務終了</button>
            </form>
            @elseif($isRestStarted)
            <form action="/endwork" method="post" class="stamp-form">
                @csrf
                <button disabled style="color:gray">勤務終了</button>
            </form>
            @else
             <form action="/endwork" method="post" class="stamp-form">
                @csrf
                <button disabled style="color:gray">勤務終了</button>
            </form>
            @endif
        </div>
    </div>
    <div class="rest__form">
        <!-- 休憩開始 -->
        <div class="rest__form-start">
            @if($isWorkStarted && $isRestStarted)
            <form action="/startrest" method="post" class="stamp-form">
                @csrf
                <button disabled style="color:gray">休憩開始</button>
            </form>
            @elseif($isWorkStarted)
            <form action="/startrest" method="post" class="stamp-form">
                @csrf
                <button type="submit" class="stamp__btn">休憩開始</button>
            </form>
            @else
            <form action="/startrest" method="post" class="stamp-form">
                @csrf
                <button disabled style="color:gray">休憩開始</button>
            </form>
            @endif
        </div>
        <!-- 休憩終了 -->
        <div class="rest__form-end">
            @if(($isWorkStarted) && ($isRestStarted))
            <form action="/endrest" method="post" class="stamp-form">
                @csrf
                <button type="submit" class="stamp__btn">休憩終了</button>
            </form>
            @else
            <form action="/endrest" method="post" class="stamp-form">
                @csrf
                <button disabled style="color:gray">休憩終了</button>
            </form>
            @endif
        </div>
    </div>

</div>

@endsection