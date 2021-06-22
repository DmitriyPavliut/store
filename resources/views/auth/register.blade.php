@extends('layouts.auth_layout')

@section('title',Lang::get('titles.regTitle'))

@section('auth_form')
    <h2>{{ Lang::get('titles.regTitle') }}</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="input_block">
            <input id="name" type="text" class=" @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus placeholder="Имя Фамилия">
            @error('name')
            <span class="invalid_alert" role="alert">
                                        {{ $message }}
                                    </span>
            @enderror
        </div>
        <div class="input_block">
            <input id="email" type="email" class=" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus placeholder="Email">
            @error('email')
            <span class="invalid_alert" role="alert">
                                         {{ $message }}
                                    </span>
            @enderror
        </div>

        <div class="input_block">
            <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="Пароль">
            @error('password')
            <span class="invalid_alert" role="alert">
                                        {{ $message }}
                                    </span>
            @enderror
        </div>
        <div class="input_block">
            <input id="password-confirm" type="password" class=" @error('password') is-invalid @enderror" name="password_confirmation"  autocomplete="new-password" placeholder="Подтверждение пароля">
        </div>

        <div class="checkbox_block">

            <label class="remember_checkbox">
                <input class="" type="checkbox" name="accepted" id="accepted">
                <span></span>
                Принимаю условия пользования
            </label>
            @error('accepted')
            <span class="invalid_alert" role="alert">
                                         {{ $message }}
                                    </span>
            @enderror
        </div>

        <div class="buttons_auth">
            <button type="submit" class="button button_reg">
                Зарегистрироваться
            </button>
        </div>
        <div class="link_reg_form">
            <p>Уже есть учетная запись? <a href="{{ route('login') }}">Войти</a></p>
        </div>
    </form>
@endsection
