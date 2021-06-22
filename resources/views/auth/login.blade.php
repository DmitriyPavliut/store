@extends('layouts.auth_layout')

@section('title', Lang::get('titles.loginTitle'))

@section('auth_form')
                <h2>{{ Lang::get('titles.loginTitle') }}</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input_block">
                        <input id="email" type="email" class=" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                    @error('email')
                    <span class="invalid_alert" role="alert">
                                        {{ $message }}
                                    </span>
                    @enderror
                </div>

                <div class="input_block">
                        <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Пароль">
                    @error('password')
                    <span class="invalid_alert" role="alert">
                                        {{ $message }}
                                    </span>
                    @enderror
                </div>

                <div class="checkbox_block">

                            <label class="remember_checkbox">
                                <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span></span>
                                Оставаться в системе
                            </label>
                </div>

                <div class="buttons_auth">
                        <button type="submit" class="button button_auth">
                            Войти
                        </button>

                        @if (Route::has('password.request'))
                            <a class="request_pass" href="{{ route('password.request') }}">
                               Забыли пароль?
                            </a>
                        @endif
                </div>
                <div class="link_reg_form">
                    <p>Нет учетной записи? <a href="{{ route('register') }}">Зарегистрироваться</a></p>
                </div>
            </form>
@endsection
