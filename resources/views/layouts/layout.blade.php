<!DOCTYPE html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="author" content="Pavljut Dmitriy">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="/img/small-store-icon.jpg">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/main.css">
    <script defer src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
    <script defer src="/js/jquery-3.6.0.min.js"></script>
    <script defer src="/js/main.js"></script>
</head>
<body>
<div class="content">
    @include('layouts.header')

    @yield('content')
</div>
@include('layouts.footer')

</body>
</html>
