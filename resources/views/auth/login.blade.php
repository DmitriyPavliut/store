@extends('layouts.auth_layout')

@section('title', Lang::get('titles.loginTitle'))

@section('auth_form')
                <h2>{{ Lang::get('titles.loginTitle') }}</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input_block">
                        <input id="email" type="email" class=" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ Lang::get('formsFields.email') }}">
                    @error('email')
                    <span class="invalid_alert" role="alert">
                                        {{ $message }}
                                    </span>
                    @enderror
                </div>

                <div class="input_block">
                        <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ Lang::get('formsFields.password') }}">
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
                                {{ Lang::get('formsFields.remember') }}
                            </label>
                </div>

                <div class="buttons_auth">
                        <button type="submit" class="button button_auth">
                            {{ Lang::get('formsFields.button_auth') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="request_pass" href="{{ route('password.request') }}">
                                {{ Lang::get('formsFields.password_request') }}
                            </a>
                        @endif
                </div>
                <div class="link_reg_form">
                    <p>{{ Lang::get('formsFields.have_account_auth') }} <a href="{{ route('register') }}">{{ Lang::get('formsFields.register') }} </a></p>
                </div>
            </form>
@endsection
