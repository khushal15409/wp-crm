<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- SEO --}}
    <title>@yield('meta_title', 'WP-CRM – Never Miss a WhatsApp Lead Again | WhatsApp CRM for Real Estate & Sales')</title>
    <meta name="description" content="@yield('meta_description', 'WhatsApp CRM built for Real Estate & Sales Teams. Auto lead capture, pipeline, follow-ups & broadcast. Start free trial.')">
    <meta name="keywords" content="@yield('meta_keywords', 'WhatsApp CRM, real estate CRM, lead management, WhatsApp business, sales pipeline, follow-up reminders, broadcast messaging')">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('meta_title', 'WP-CRM – WhatsApp CRM for Real Estate & Sales')">
    <meta property="og:description" content="@yield('meta_description', 'WhatsApp CRM built for Real Estate & Sales Teams. Auto lead capture, pipeline & follow-ups.')">
    <meta property="og:image" content="@yield('og_image', asset('front/images/og-wp-crm.png'))">
    <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">

    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}">

    {{-- Fonts (SaaS-style) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{-- AOS (Animate on Scroll) --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- Theme + Landing CSS (matches admin palette) --}}
    <link rel="stylesheet" href="{{ asset('front/css/landing.css') }}">
    @stack('styles')
</head>
<body class="landing-page">
    @yield('content')

    {{-- Bootstrap 5 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    {{-- AOS --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('front/js/landing.js') }}"></script>
    @stack('scripts')
</body>
</html>
