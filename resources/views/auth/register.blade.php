@extends('layouts.default')

@section('main')
    <div class="content-wrap">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="" :errors="$errors" />
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="title-wrap">
                <h2 class="title">会員登録</h2>
            </div>
            <!-- Name -->
            <div class="register-input-wrap">
                <x-input id="name" class="register-input" type="text" name="name" :value="old('name')" required autofocus placeholder="お名前" />
            </div>
            <!-- Email Address -->
            <div class="register-input-wrap">
                <x-input id="email" class="register-input" type="email" name="email" :value="old('email')" required placeholder="メールアドレス" />
            </div>
            <!-- Password -->
            <div class="register-input-wrap">
                <x-input id="password" class="register-input" type="password" name="password" required autocomplete="new-password" placeholder="パスワード" />
            </div>
            <!-- Confirm Password -->
            <div class="register-input-wrap">
                <x-input id="password_confirmation" class="register-input" type="password" name="password_confirmation" required placeholder="確認用パスワード" />
            </div>
            <div class="link-wrap">
                <x-button class="register-btn">
                    会員登録
                </x-button>
                <div class="register-link-wrap">
                    <p>アカウントをお持ちの方はこちら</p>
                    <a class="register-link" href="/login">ログイン</a>
                </div>
            </div>
        </form>
    </div>
@endsection