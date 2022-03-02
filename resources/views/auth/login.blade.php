@extends('layouts.default')

@section('main')
    <div class="content-wrap">
        <div class="login-wrap">
            <!-- Session Status -->
            <x-auth-session-status class="" :status="session('status')" />
            <!-- Validation Errors -->
            <x-auth-validation-errors class="" :errors="$errors" />

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="title-wrap">
                    <h2 class="title">ログイン</h2>
                </div>
                <!-- Email Address -->
                <div　class="login-input-wrap">
                    <x-input id="email" class="login-input" type="email" name="email" :value="old('email')" required autofocus placeholder="メールアドレス" />
                </div>
                <!-- Password -->
                <div class="login-input-wrap">
                    <x-input id="password" class="login-input" type="password" name="password" required autocomplete="current-password" placeholder="パスワード" />
                </div>
                <div class="btn-wrap">
                    <x-button class="login-btn">
                        ログイン
                    </x-button>
                </div>
            </form>
            <div class="login-link-wrap">
                <p>アカウントをお持ちで無い方はこちら</p>
                <a href="/register" class="login-link">会員登録</a>
            </div>
        </div>
    </div>
@endsection