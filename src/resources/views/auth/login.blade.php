@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}" />
@endsection

@section('content')
<div class="login__content">
    <div class="login__content-heading">
        <h2>ログイン</h2>
    </div>
    <div class="login__content-form">
        <form action="/login" method="post" class="form">
            @csrf
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="メールアドレス" />
                </div>
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="password" name="password" placeholder="パスワード" />
                </div>
                <div class="form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="form__button">
                <button class="form__button-submit" type="submit">ログイン</button>
            </div>

        </form>

        <p class="message">アカウントをお持ちでない方はこちらから
        <br>
        <a href="/register" class="message__link">会員登録</a>
        </br>
        </p>
    </div>
</div>
@endsection