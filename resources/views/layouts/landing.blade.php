<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @php
        $defaultTitle = 'WhatsApp CRM for Real Estate & Sales | WhatsAppLeadCRM';
        $defaultDescription = 'WhatsApp CRM for real estate and sales teams. Manage WhatsApp leads, pipeline, and follow-ups in one simple WhatsApp sales CRM built for faster conversions.';
        $pageTitle = trim($__env->yieldContent('meta_title')) ?: $defaultTitle;
        $pageDescription = trim($__env->yieldContent('meta_description')) ?: $defaultDescription;
        $canonicalUrl = url()->current();
        $socialImage = asset('front/images/landify/illustration/illustration-15.webp');
    @endphp

    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="{{ $canonicalUrl }}">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:image" content="{{ $socialImage }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    <meta name="twitter:image" content="{{ $socialImage }}">

    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@graph": [
        {
          "@@type": "Organization",
          "name": "WhatsAppLeadCRM",
          "url": "{{ url('/') }}",
          "logo": "{{ asset('front/images/logo.png') }}",
          "description": "{{ $pageDescription }}"
        },
        {
          "@@type": "SoftwareApplication",
          "name": "WhatsAppLeadCRM",
          "url": "{{ url('/') }}",
          "applicationCategory": "CRM Application",
          "operatingSystem": "Web",
          "description": "{{ $pageDescription }}",
          "offers": {
            "@@type": "Offer",
            "price": "299",
            "priceCurrency": "INR"
          }
        },
        {
          "@@type": "Product",
          "@@id": "{{ url('/') }}#saas",
          "name": "WhatsApp CRM for Real Estate & Sales",
          "url": "{{ url('/') }}",
          "description": "{{ $pageDescription }}",
          "category": "SaaSProduct",
          "offers": {
            "@@type": "Offer",
            "priceCurrency": "INR",
            "price": "299",
            "priceValidUntil": "{{ now()->addYear()->toDateString() }}",
            "availability": "https://schema.org/InStock"
          }
        }
      ]
    }
    </script>

    <!-- Fonts (Landify) -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/css/glightbox.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet" crossorigin="anonymous">

    <!-- Landify theme CSS -->
    <link href="{{ asset('front/css/landify-theme.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto me-xl-0" style="max-width: 240px;">
                <img src="{{ asset('front/images/logo.png') }}" alt="{{ config('app.name', 'WP-CRM') }}" style="width: auto; height: 52px; max-height: 56px; object-fit: contain;">
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ request()->is('/') ? '#hero' : url('/').'#hero' }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ request()->is('/') ? '#about' : url('/').'#about' }}">About</a></li>
                    <li><a href="{{ request()->is('/') ? '#features' : url('/').'#features' }}">Features</a></li>
                    <li><a href="{{ request()->is('/') ? '#pricing' : url('/').'#pricing' }}">Pricing</a></li>
                    <li><a href="{{ url('/blog') }}" class="{{ request()->is('blog*') ? 'active' : '' }}">Blog</a></li>
                    <li><a href="{{ request()->is('/') ? '#contact' : url('/').'#contact' }}">FAQ</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            @if(auth()->check())
                <a class="btn-getstarted" href="{{ route('dashboard') }}">Dashboard</a>
            @else
                <a class="btn-getstarted" href="{{ route('login') }}">Log in</a>
            @endif
        </div>
    </header>

    <main class="main">
        @yield('content')
    </main>

    <footer id="footer" class="footer position-relative dark-background">
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-about">
                    <a href="{{ url('/') }}" class="logo d-flex align-items-center" style="max-width: 260px;">
                        <img src="{{ asset('front/images/logo.png') }}" alt="{{ config('app.name', 'WP-CRM') }}" style="width: auto; height: 64px; max-height: 72px; object-fit: contain;">
                    </a>
                    <p>WhatsApp CRM for Real Estate & Sales. Manage leads, pipelines, and follow-ups in one place.</p>
                    <div class="social-links d-flex mt-4">
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-6 footer-links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('/') }}#about">About</a></li>
                        <li><a href="{{ url('/') }}#features">Features</a></li>
                        <li><a href="{{ url('/blog') }}">Blog</a></li>
                        <li><a href="{{ url('/') }}#contact">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6 footer-links">
                    <h4>Account</h4>
                    <ul>
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4>Contact</h4>
                    <p>📧 support@example.com</p>
                </div>
            </div>
        </div>
        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <span>All Rights Reserved</span></p>
        </div>
    </footer>

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous" defer></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/js/glightbox.min.js" crossorigin="anonymous" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" crossorigin="anonymous" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs@1.5.0/dist/purecounter.js" crossorigin="anonymous" defer></script>

    <!-- Landify theme JS -->
    <script src="{{ asset('front/js/landify.js') }}" defer></script>

    @stack('scripts')
</body>
</html>
