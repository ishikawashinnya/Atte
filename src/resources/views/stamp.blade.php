@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stamp.css') }}" />
@endsection

@section('content')
<div class="stamp__content">
    <div class="stamp__content-ttl">
        @if(Auth::check())
        <p class="message">{{ \Auth::user()->name }}さんお疲れ様です！</p>
        @endif
    </div>
    <!-- <div class="form__alert">
        @if(session('message'))
        <div class="alert__success">
           <p class="alert__message">{{ session('message')}}</p> 
        </div>
        @endif
    </div>
    <div class="form__alert">
        @if(session('error'))
        <div class="alert__danger">
            <p class="alert__message">{{ session('error') }}</p>
        </div>
        @endif
    </div> -->
    
    <div class="work__form">
        <div class="work__form-start">    
                <form action="/startwork" method="post" class="stamp-form"> 
                    @csrf
                    <button type="submit" class="stamp__btn">勤務開始</button>
                </form> 
        </div>
        <div class="work__form-end">
            <form action="/endwork" method="post" class="stamp-form">
                @csrf
                <button type="submit" class="stamp__btn">勤務終了</button>
            </form>
        </div>
    </div>
    <div class="rest__form">
        <div class="rest__form-start">
            <form action="/startrest" method="post" class="stamp-form">
                @csrf
                <button type="submit" class="stamp__btn">休憩開始</button>
            </form>
        </div>
        <div class="rest__form-end">
            <form action="/endrest" method="post" class="stamp-form">
                @csrf
                <button type="submit" class="stamp__btn">休憩終了</button>
            </form>
        </div>
    </div>
    
        
    
    
</div>

@endsection