@extends('layouts.auth_layout')

@section('title',Lang::get('titles.confirmPassTitle'))

@section('auth_form')
    <h2>{{ Lang::get('titles.confirmPassTitle') }}</h2>
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <div class="input_block">
            <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" autocomplete="email" placeholder="{{ Lang::get('formsFields.password') }}">

            @error('password')
            <span class="invalid_alert" role="alert">
                {{ $message }}
            </span>
            @enderror

        </div>

        <div class="buttons_auth">
            <button type="submit" class="button button_auth">
                {{ Lang::get('formsFields.confirm_pass') }}
            </button>

            @if (Route::has('password.request'))
                <a class="request_pass" href="{{ route('password.request') }}">
                    {{ Lang::get('formsFields.password_request') }}
                </a>
            @endif
        </div>
    </form>
@endsection
