@extends('layouts.auth_layout')

@section('title',Lang::get('titles.resetPassTitle'))

@section('auth_form')
    <h2>{{ Lang::get('titles.resetPassTitle') }}</h2>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="input_block">
            <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Введите Ваш email">

            @error('email')
            <span class="invalid_alert" role="alert">
                {{ $message }}
            </span>
            @enderror
        </div>

        <div class="buttons_auth">
            <button type="submit" class="button button_auth">
                Отправить ссылку на сброс пароля
            </button>
        </div>
        <div class="link_reg_form">
            <p>Нет учетной записи? <a href="{{ route('register') }}">Зарегистрироваться</a></p>
        </div>
    </form>
@endsection

