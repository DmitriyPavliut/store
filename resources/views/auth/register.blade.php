@extends('layouts.auth_layout')

@section('title',Lang::get('titles.regTitle'))

@section('auth_form')
    <h2>{{ Lang::get('titles.regTitle') }}</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="input_block">
            <input id="name" type="text" class=" @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus placeholder="{{ Lang::get('formsFields.name') }}">
            @error('name')
            <span class="invalid_alert" role="alert">
                                        {{ $message }}
                                    </span>
            @enderror
        </div>
        <div class="input_block">
            <input id="email" type="email" class=" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus placeholder="{{ Lang::get('formsFields.email') }}">
            @error('email')
            <span class="invalid_alert" role="alert">
                                         {{ $message }}
                                    </span>
            @enderror
        </div>

        <div class="input_block">
            <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="{{ Lang::get('formsFields.password') }}">
            @error('password')
            <span class="invalid_alert" role="alert">
                                        {{ $message }}
                                    </span>
            @enderror
        </div>
        <div class="input_block">
            <input id="password-confirm" type="password" class=" @error('password') is-invalid @enderror" name="password_confirmation"  autocomplete="new-password" placeholder="{{ Lang::get('formsFields.password_confirm') }}">
        </div>

        <div class="checkbox_block">

            <label class="remember_checkbox">
                <input class="" type="checkbox" name="accepted" id="accepted">
                <span></span>
                {{ Lang::get('formsFields.accepted_reg') }}
            </label>
            @error('accepted')
            <span class="invalid_alert" role="alert">
                                         {{ $message }}
                                    </span>
            @enderror
        </div>

        <div class="buttons_auth">
            <button type="submit" class="button button_reg">
                {{ Lang::get('formsFields.register') }}
            </button>
        </div>
        <div class="link_reg_form">
            <p>{{ Lang::get('formsFields.have_account_reg') }} <a href="{{ route('login') }}">{{ Lang::get('formsFields.login') }}</a></p>
        </div>
    </form>
@endsection
