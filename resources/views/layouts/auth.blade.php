<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Login') - {{ config('app.name', 'WP-CRM') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}">
</head>
<body class="auth-page">
    <div class="loader"></div>
    <div id="app">
        <div class="auth-wrapper">
            <div class="auth-logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('front/images/logo.png') }}" alt="{{ config('app.name', 'WP-CRM') }}">
                </a>
            </div>
            @yield('content')
            <p class="auth-tagline">
                WhatsApp CRM for Real Estate & Sales · <a href="{{ url('/') }}">Back to Home</a>
            </p>
        </div>
    </div>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>
