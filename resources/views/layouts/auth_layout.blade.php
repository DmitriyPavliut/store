@extends('layouts.layout')

@section('content')
    <section id="login_form">
        <div class="container login_form_section">
            <div class="login_form">
                @yield('auth_form')
            </div>
            <div class="login_img">
                <img src="/img/loginImg.png" alt="about">
            </div>
        </div>
    </section>
@endsection
