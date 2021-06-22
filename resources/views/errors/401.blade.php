@extends('layouts.layout')
@section('title',Lang::get('titles.401Title'))
@section('content')
    <section id="block404">
        <div class="container block404">
            <h1>Упс! Вы куда-то не туда попали!</h1>
            <p>Давайте начнем <a href="{{ route('main') }}">с самого начала</a></p>
            <img src="/img/404.gif" alt="404">
        </div>
    </section>
@endsection
