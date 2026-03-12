@extends('layouts.landing')

@section('meta_title', 'WhatsApp CRM for Sales Teams | Features & Pricing')
@section('meta_description', 'WhatsApp CRM for sales teams to capture leads, manage follow-ups, and track deals. See features, pricing, and how WP-CRM helps you close more deals.')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-center">
                <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-right" data-aos-delay="200">
                    <div class="hero-content">
                        <h1 class="hero-title">WhatsApp CRM for Sales Teams</h1>
                        <p class="hero-description">Capture leads automatically, manage follow-ups, and track your sales
                            pipeline in one simple WhatsApp CRM.</p>
                        <div class="hero-actions">
                            <a href="{{ route('register') }}" class="btn-primary">Start 7-Day Free Trial</a>
                            <a href="#features" class="btn-secondary ms-3">View Features</a>
                            <!-- <a href="#about" class="btn-secondary">
                                                <i class="bi bi-play-circle"></i>
                                                <span>Watch Demo</span>
                                            </a> -->
                        </div>
                        <!-- <div class="hero-stats">
                                            <div class="stat-item">
                                                <span class="stat-number">500+</span>
                                                <span class="stat-label">Leads Successfully Managed</span>
                                            </div>
                                            <div class="stat-item">
                                                <span class="stat-number">98%</span>
                                                <span class="stat-label">Customer Satisfaction</span>
                                            </div>
                                            <div class="stat-item">
                                                <span class="stat-number">24/7</span>
                                                <span class="stat-label">Expert Support</span>
                                            </div>
                                        </div> -->
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="300">
                    <div class="hero-visual">
                        <div class="hero-image-wrapper">
                            <img src="{{ asset('front/images/landify/illustration/illustration-15.webp') }}"
                                class="img-fluid hero-image" alt="WP-CRM Dashboard" loading="lazy">
                            <div class="floating-elements">
                                <div class="floating-card card-1">
                                    <i class="bi bi-lightbulb"></i>
                                    <span>Smart Leads</span>
                                </div>
                                <div class="floating-card card-2">
                                    <i class="bi bi-award"></i>
                                    <span>Pipeline</span>
                                </div>
                                <div class="floating-card card-3">
                                    <i class="bi bi-people"></i>
                                    <span>Team</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Demo Section -->
    <section id="demo" class="section">
        <div class="container section-title" data-aos="fade-up">
            <span class="description-title">Product Demo</span>
            <h2>See How WP-CRM Works</h2>
        </div>
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-center gy-4">
                <div class="col-lg-6">
                    <div class="ratio ratio-16x9 rounded overflow-hidden shadow-sm">
                        <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ"
                            title="WP-CRM Product Demo" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen loading="lazy"></iframe>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="content-wrapper">
                        <p class="lead-text mb-3">Watch a quick walkthrough to see how WP-CRM captures, organizes, and
                            converts WhatsApp leads.</p>
                        <ul class="feature-list list-unstyled mb-4">
                            <li><i class="bi bi-check-circle"></i> Capture WhatsApp leads automatically</li>
                            <li><i class="bi bi-check-circle"></i> Track deals in a visual pipeline</li>
                            <li><i class="bi bi-check-circle"></i> Never miss a follow-up</li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn btn-cta">Start Your Free Trial</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Problem Section -->
    <section id="problems" class="section light-background">
        <div class="container section-title" data-aos="fade-up">
            <span class="description-title">Problems</span>
            <h2>Why Sales Teams Lose WhatsApp Leads</h2>
        </div>
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                <div class="col-md-6 col-lg-3">
                    <div class="feature-box h-100">
                        <div class="feature-icon">
                            <i class="bi bi-chat-dots"></i>
                        </div>
                        <h5>Messages get buried</h5>
                        <p>Leads disappear inside busy WhatsApp chats with no visibility.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-box h-100">
                        <div class="feature-icon">
                            <i class="bi bi-alarm"></i>
                        </div>
                        <h5>Missed follow-ups</h5>
                        <p>No reminders means hot leads go cold before a reply.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-box h-100">
                        <div class="feature-icon">
                            <i class="bi bi-journal-text"></i>
                        </div>
                        <h5>No organized tracking</h5>
                        <p>Spreadsheets and notes make it hard to see deal status.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-box h-100">
                        <div class="feature-icon">
                            <i class="bi bi-graph-down"></i>
                        </div>
                        <h5>Lost opportunities</h5>
                        <p>Without a pipeline, teams can’t prioritize or close on time.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="section">
        <div class="container section-title" data-aos="fade-up">
            <span class="description-title">How It Works</span>
            <h2>How It Works</h2>
        </div>
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                <div class="col-md-6 col-lg-4">
                    <div class="feature-box h-100">
                        <div class="feature-icon">
                            <i class="bi bi-link-45deg"></i>
                        </div>
                        <h5>1. Connect your WhatsApp</h5>
                        <p>Link your WhatsApp Business number in minutes and sync conversations.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-box h-100">
                        <div class="feature-icon">
                            <i class="bi bi-inbox"></i>
                        </div>
                        <h5>2. Capture and organize leads automatically</h5>
                        <p>Every enquiry becomes a lead with notes, owner, and full history.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-box h-100">
                        <div class="feature-icon">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <h5>3. Track deals and close faster</h5>
                        <p>Move leads through stages, set reminders, and win more deals.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-5">
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                    <div class="content-wrapper">
                        <div class="section-header">
                            <span class="section-badge">ABOUT WP-CRM</span>
                            <h2>Built for Sales Teams & Growing Businesses</h2>
                        </div>
                        <p class="lead-text">WP-CRM works for any business that receives leads on WhatsApp. Get structured
                            follow-ups, clear pipelines, and team collaboration in one place. No more missed enquiries, lost
                            chats, or messy spreadsheets.</p>
                        <p class="description-text">From first message to deal closure, everything stays tracked, organized,
                            and under control.</p>
                        <div class="stats-grid">
                            <div class="stat-item">
                                <div class="stat-number">500+</div>
                                <div class="stat-label">Leads Managed</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">98%</div>
                                <div class="stat-label">Satisfaction</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">24/7</div>
                                <div class="stat-label">Support</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">12+</div>
                                <div class="stat-label">Integrations</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                    <div class="visual-section">
                        <div class="main-image-container">
                            <img src="{{ asset('front/images/landify/about/about-8.webp') }}" alt="Leads and Pipeline"
                                class="img-fluid main-visual" loading="lazy">
                            <div class="overlay-card">
                                <div class="card-content">
                                    <h4>Quality First. Results Always.</h4>
                                    <p>Every lead tracked.<br>Every follow-up on time.<br>Every deal under control.</p>
                                    <div class="card-icon">
                                        <i class="bi bi-award-fill"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="secondary-images">
                            <div class="row g-3">
                                <div class="col-6">
                                    <img src="{{ asset('front/images/landify/about/about-11.webp') }}" alt="Pipeline"
                                        class="img-fluid secondary-img" loading="lazy">
                                </div>
                                <div class="col-6">
                                    <img src="{{ asset('front/images/landify/about/about-5.webp') }}" alt="Reports"
                                        class="img-fluid secondary-img" loading="lazy">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Trust & Performance -->
            <div class="row mt-5">
                <div class="col-12" data-aos="fade-up" data-aos-delay="400">
                    <div class="features-section">
                        <div class="row gy-4">
                            <div class="col-md-6 col-lg-3">
                                <div class="feature-box">
                                    <div class="feature-icon">
                                        <i class="bi bi-kanban"></i>
                                    </div>
                                    <h5>Pipeline & Reports</h5>
                                    <p>Never miss a WhatsApp lead. Clear pipelines and real-time reports. Track performance
                                        across teams and campaigns.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="feature-box">
                                    <div class="feature-icon">
                                        <i class="bi bi-shield-check"></i>
                                    </div>
                                    <h5>Secure & Reliable</h5>
                                    <p>Your data is protected with enterprise-grade security, encrypted storage, and regular
                                        backups.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="feature-box">
                                    <div class="feature-icon">
                                        <i class="bi bi-lightning-charge"></i>
                                    </div>
                                    <h5>Fast & Simple</h5>
                                    <p>Faster follow-ups and team accountability. Start in minutes, no technical knowledge
                                        required.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="feature-box">
                                    <div class="feature-icon">
                                        <i class="bi bi-headset"></i>
                                    </div>
                                    <h5>Expert Support</h5>
                                    <p>Higher conversion rates with less chaos. Our support team is always ready to guide
                                        you.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature Highlights Section -->
    <section id="feature-highlights" class="section light-background">
        <div class="container section-title" data-aos="fade-up">
            <span class="description-title">Highlights</span>
            <h2>Features</h2>
        </div>
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                <div class="col-md-6 col-lg-4">
                    <div class="feature-box h-100">
                        <div class="feature-icon"><i class="bi bi-inbox"></i></div>
                        <h5>WhatsApp Lead Inbox</h5>
                        <p>Centralize every WhatsApp enquiry in one organized inbox.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-box h-100">
                        <div class="feature-icon"><i class="bi bi-kanban"></i></div>
                        <h5>Sales Pipeline</h5>
                        <p>Visual stages make it easy to see what’s next for each lead.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-box h-100">
                        <div class="feature-icon"><i class="bi bi-bell"></i></div>
                        <h5>Follow-up Reminders</h5>
                        <p>Automatic reminders ensure no lead is forgotten or delayed.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-box h-100">
                        <div class="feature-icon"><i class="bi bi-broadcast"></i></div>
                        <h5>Broadcast Messaging</h5>
                        <p>Reach many leads at once with targeted WhatsApp campaigns.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-box h-100">
                        <div class="feature-icon"><i class="bi bi-people"></i></div>
                        <h5>Team Collaboration</h5>
                        <p>Assign leads, add notes, and keep everyone accountable.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-box h-100">
                        <div class="feature-icon"><i class="bi bi-graph-up"></i></div>
                        <h5>CRM Analytics</h5>
                        <p>Track conversions, team performance, and pipeline health.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features section">
        <div class="container section-title" data-aos="fade-up">
            <span class="description-title">Features</span>
            <h2>Features</h2>
        </div>
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="tabs-wrapper">
                <ul class="nav nav-tabs" data-aos="fade-up" data-aos-delay="100">
                    <li class="nav-item">
                        <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1">
                            <div class="tab-icon"><i class="bi bi-people"></i></div>
                            <div class="tab-content">
                                <h5>Lead Management</h5>
                                <span>Capture & nurture</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
                            <div class="tab-icon"><i class="bi bi-kanban"></i></div>
                            <div class="tab-content">
                                <h5>Pipeline</h5>
                                <span>Visual stages</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3">
                            <div class="tab-icon"><i class="bi bi-broadcast"></i></div>
                            <div class="tab-content">
                                <h5>Broadcast</h5>
                                <span>Bulk messaging</span>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
                    <div class="tab-pane fade active show" id="features-tab-1">
                        <div class="row align-items-center">
                            <div class="col-lg-5">
                                <div class="content-wrapper">
                                    <div class="icon-badge"><i class="bi bi-people"></i></div>
                                    <h3>Lead Management</h3>
                                    <p>Turn WhatsApp enquiries into structured leads. Capture, qualify, and nurture without
                                        missing a single opportunity.</p>
                                    <div class="feature-grid">
                                        <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>Auto capture
                                                WhatsApp leads</span></div>
                                        <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>Assign owners
                                                & add notes</span></div>
                                        <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>Complete
                                                activity history</span></div>
                                        <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>Smart filters
                                                & quick search</span></div>
                                    </div>
                                    <a href="{{ route('register') }}" class="btn-primary">Get Started <i
                                            class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="visual-content">
                                    <div class="main-image">
                                        <img src="{{ asset('front/images/landify/features/features-4.png') }}" alt="Leads"
                                            class="img-fluid" loading="lazy">
                                        <div class="floating-card">
                                            <i class="bi bi-graph-up-arrow"></i>
                                            <div class="card-content">
                                                <span>Conversion</span>
                                                <strong>+40% Lead Conversion Improvement</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="features-tab-2">
                        <div class="row align-items-center">
                            <div class="col-lg-5">
                                <div class="content-wrapper">
                                    <div class="icon-badge"><i class="bi bi-kanban"></i></div>
                                    <h3>Pipeline Management</h3>
                                    <p>Visual stages for any sales process. See where every lead stands and what to do next.
                                    </p>
                                    <div class="feature-grid">
                                        <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>Custom sales
                                                stages</span></div>
                                        <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>Drag & drop
                                                leads</span></div>
                                        <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>Conversion
                                                tracking</span></div>
                                        <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>Deal status
                                                clarity</span></div>
                                    </div>
                                    <a href="{{ route('register') }}" class="btn-primary">Try Pipeline <i
                                            class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="visual-content">
                                    <div class="main-image">
                                        <img src="{{ asset('front/images/landify/features/features-2.webp') }}"
                                            alt="Pipeline" class="img-fluid" loading="lazy">
                                        <div class="floating-card">
                                            <i class="bi bi-kanban"></i>
                                            <div class="card-content">
                                                <span>Stages</span>
                                                <strong>Fully Customizable</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="features-tab-3">
                        <div class="row align-items-center">
                            <div class="col-lg-5">
                                <div class="content-wrapper">
                                    <div class="icon-badge"><i class="bi bi-broadcast"></i></div>
                                    <h3>Broadcast Messaging</h3>
                                    <p>Send offers, updates, and follow-ups to many leads at once. Reach the right people at
                                        the right time.</p>
                                    <div class="feature-grid">
                                        <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>Send bulk
                                                WhatsApp messages</span></div>
                                        <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>Campaign
                                                scheduling</span></div>
                                        <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>Delivery
                                                tracking</span></div>
                                        <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>Plan-based
                                                access</span></div>
                                    </div>
                                    <a href="{{ route('register') }}" class="btn-primary">Start Broadcasting <i
                                            class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="visual-content">
                                    <div class="main-image">
                                        <img src="{{ asset('front/images/landify/features/features-6.webp') }}"
                                            alt="Broadcasts" class="img-fluid" loading="lazy">
                                        <div class="floating-card">
                                            <i class="bi bi-broadcast"></i>
                                            <div class="card-content">
                                                <span>Reach</span>
                                                <strong>Thousands at Once</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Conversion Highlight (inline in features tab 1) - also as standalone if needed -->
    <section id="conversion" class="section light-background py-4">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <p class="mb-0 lead">Sales teams and growing businesses using WP-CRM close more deals because they never
                        miss a follow-up and always know the next action.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section dark-background">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-lg-center">
                <div class="col-lg-6 offset-lg-1 order-lg-1" data-aos="fade-right" data-aos-delay="100">
                    <div class="content-area">
                        <h2>Ready to Close More Deals on WhatsApp?</h2>
                        <p>Whether you manage sales, clients, or enquiries — WP-CRM helps you close more deals on WhatsApp.
                        </p>
                        <ul class="feature-list">
                            <li><i class="bi bi-check"></i><span>Free trial included</span></li>
                            <li><i class="bi bi-check"></i><span>Setup in minutes</span></li>
                            <li><i class="bi bi-check"></i><span>Cancel anytime</span></li>
                        </ul>
                        <div class="cta-wrapper">
                            <a href="{{ route('register') }}" class="btn btn-cta">Get Started Free</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 order-lg-2" data-aos="fade-left" data-aos-delay="200">
                    <div class="image-wrapper position-relative">
                        <img src="{{ asset('front/images/landify/misc/misc-6.webp') }}" alt="Get Started"
                            class="img-fluid main-image" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust & Credibility Section -->
    <section id="trust" class="section light-background">
        <div class="container section-title" data-aos="fade-up">
            <span class="description-title">Trust</span>
            <h2>Trusted by Sales Professionals</h2>
        </div>
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                <div class="col-md-6 col-lg-4">
                    <div class="feature-box h-100">
                        <div class="feature-icon"><i class="bi bi-cloud-check"></i></div>
                        <h5>Secure cloud infrastructure</h5>
                        <p>Reliable hosting with enterprise-grade safeguards.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-box h-100">
                        <div class="feature-icon"><i class="bi bi-whatsapp"></i></div>
                        <h5>WhatsApp Cloud API integration</h5>
                        <p>Official WhatsApp connectivity for consistent delivery.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-box h-100">
                        <div class="feature-icon"><i class="bi bi-shield-lock"></i></div>
                        <h5>Data encryption</h5>
                        <p>Protects sensitive customer and sales information.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-box h-100">
                        <div class="feature-icon"><i class="bi bi-arrow-repeat"></i></div>
                        <h5>Regular backups</h5>
                        <p>Recovery-ready data protection to prevent loss.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-box h-100">
                        <div class="feature-icon"><i class="bi bi-activity"></i></div>
                        <h5>99.9% uptime</h5>
                        <p>Always-on access so teams can respond fast.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Section (Stats) -->
    <section id="stats" class="stats section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center mb-5" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="main-headline">Trusted by Sales Teams & Growing Businesses</h3>
                    <p class="main-description">WP-CRM helps teams stay organized, respond faster, and convert more leads
                        from WhatsApp.</p>
                </div>
            </div>
            <div class="stats-grid">
                <div class="row g-4">
                    <div class="col-xl-3 col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="stat-item">
                            <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
                            <div class="stat-content">
                                <div class="stat-number"><span data-purecounter-start="0" data-purecounter-end="500"
                                        data-purecounter-duration="2" class="purecounter"></span>+</div>
                                <div class="stat-label">Leads Managed</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="stat-item featured">
                            <div class="stat-icon"><i class="bi bi-graph-up-arrow"></i></div>
                            <div class="stat-content">
                                <div class="stat-number"><span data-purecounter-start="0" data-purecounter-end="98"
                                        data-purecounter-duration="2" class="purecounter"></span>%</div>
                                <div class="stat-label">Customer Satisfaction</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="stat-item">
                            <div class="stat-icon"><i class="bi bi-whatsapp"></i></div>
                            <div class="stat-content">
                                <div class="stat-number">24/7</div>
                                <div class="stat-label">WhatsApp-Ready</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="stat-item">
                            <div class="stat-icon"><i class="bi bi-shield-check"></i></div>
                            <div class="stat-content">
                                <div class="stat-number">100%</div>
                                <div class="stat-label">Secure Platform</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section (dynamic from Plan Management) -->
    <section id="pricing" class="pricing section">
        <div class="container section-title" data-aos="fade-up">
            <span class="description-title">Pricing</span>
            <h2>Pricing</h2>
        </div>
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <!-- Free Trial Banner (single card; trial days from plans) -->
            <div class="row gy-4 justify-content-center mb-0">
                <div class="col-12" data-aos="fade-up" data-aos-delay="150">
                    <article class="price-card price-card-free-trial">
                        <div class="card-head">
                            <h3 class="title">Start Free for {{ $trialDays }} Days</h3>
                            <p class="subtitle">Try the full WhatsApp CRM with no credit card required.</p>
                        </div>
                        <div class="free-trial-under">
                            <ul class="feature-list list-unstyled">
                                <li><i class="bi bi-check-circle"></i> Full CRM access</li>
                                <li><i class="bi bi-check-circle"></i> Leads, pipeline &amp; follow-ups</li>
                                <li><i class="bi bi-check-circle"></i> No credit card required</li>
                                <li><i class="bi bi-check-circle"></i> Cancel anytime</li>
                            </ul>
                            <div class="cta">
                                <a href="{{ route('register') }}" class="btn btn-choose">Start Free Trial</a>
                                <p class="free-trial-note">Choose a plan after your free trial ends.</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <!-- Paid Plans (from database; only active) -->
            @if(isset($activePlans) && $activePlans->isNotEmpty())
                <div class="row gy-4 justify-content-center mt-4 paid-plans-row">
                    @foreach($activePlans as $index => $plan)
                        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="{{ 200 + ($index * 50) }}">
                            <article
                                class="price-card price-card-paid {{ $plan->is_popular ? 'featured' : '' }} h-100 position-relative">
                                @if($plan->is_popular)
                                    <div class="ribbon"><i class="bi bi-star-fill"></i> Most Popular</div>
                                @endif
                                <div class="card-head">
                                    <span class="badge-title">{{ $plan->name }}</span>
                                    <div class="price-wrap price-wrap-paid">
                                        <span class="price price-monthly"><span class="price-currency">₹</span><span
                                                class="price-value">{{ $plan->getPriceMonthlyInr() }}</span><span
                                                class="period">/month</span></span>
                                    </div>
                                    <h3 class="title">{{ $plan->description ?? '—' }}</h3>
                                    <p class="subtitle">{{ $plan->description ? Str::limit($plan->description, 60) : '—' }}</p>
                                </div>
                                @if(is_array($plan->features) && count($plan->features) > 0)
                                    <ul class="feature-list list-unstyled mb-4">
                                        @foreach($plan->features as $feature)
                                            <li><i class="bi bi-check-circle"></i> {{ $feature }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <ul class="feature-list list-unstyled mb-4">
                                        <li><i class="bi bi-check-circle"></i> All features included</li>
                                    </ul>
                                @endif
                                <div class="cta">
                                    @auth
                                        <button type="button" class="btn btn-choose btn-choose-paid w-100 btn-razorpay-checkout"
                                            data-plan-id="{{ $plan->id }}" data-plan-name="{{ $plan->name }}">Buy Now</button>
                                    @else
                                        <a href="{{ route('register', ['plan_id' => $plan->id]) }}"
                                            class="btn btn-choose btn-choose-paid w-100">Choose Plan</a>
                                    @endauth
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>

                @php
                    $formatLimit = function ($value) {
                        if (is_null($value)) return 'Unlimited';
                        return (int) $value === 0 ? '0' : number_format((int) $value);
                    };
                    $featureHas = function ($plan, array $keywords) {
                        $features = is_array($plan->features) ? $plan->features : [];
                        $haystack = strtolower(implode(' ', $features));
                        foreach ($keywords as $keyword) {
                            if (str_contains($haystack, strtolower($keyword))) return true;
                        }
                        return false;
                    };
                @endphp

                <div class="row justify-content-center mt-4">
                    <div class="col-12" data-aos="fade-up" data-aos-delay="150">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">Plan Comparison</th>
                                        @foreach($activePlans as $plan)
                                            <th scope="col">{{ $plan->name }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Lead limit</th>
                                        @foreach($activePlans as $plan)
                                            <td>{{ $formatLimit($plan->lead_limit) }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th scope="row">Broadcast limit</th>
                                        @foreach($activePlans as $plan)
                                            <td>{{ $formatLimit($plan->broadcast_limit) }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th scope="row">Team members</th>
                                        @foreach($activePlans as $plan)
                                            <td>{{ $featureHas($plan, ['team', 'collaboration', 'users', 'members']) ? 'Included' : '—' }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th scope="row">Analytics access</th>
                                        @foreach($activePlans as $plan)
                                            <td>{{ $featureHas($plan, ['analytics', 'reports', 'insights']) ? 'Included' : '—' }}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
            <p class="text-center small text-muted mt-4 mb-0">No credit card required • Cancel anytime • Secure payments</p>
            <p class="text-center small text-muted mt-1 mb-0">WhatsApp conversation charges apply as per Meta pricing. No
                long-term contracts.</p>
        </div>
    </section>

    <!-- FAQ Section (Have Questions? Let's Talk.) -->
    <section id="contact" class="contact faq-section section light-background">
        <div class="container section-title" data-aos="fade-up">
            <span class="description-title">FAQ</span>
            <h2>Frequently Asked Questions</h2>
            <p>Quick answers about WhatsApp CRM and getting started.</p>
        </div>
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion faq-accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
                                    What is WhatsApp CRM?
                                </button>
                            </h3>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    A WhatsApp CRM organizes your WhatsApp leads, conversations, and sales pipeline in one
                                    place. WP-CRM helps teams capture enquiries, set reminders, and close deals faster.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                                    Is there a free trial?
                                </button>
                            </h3>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes. Start a 7-day free trial with full access. No credit card required, and you can
                                    cancel anytime.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                                    Do I need WhatsApp Business API?
                                </button>
                            </h3>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    WP-CRM works with WhatsApp Business (including API). We guide you to connect the right
                                    option for your business.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">
                                    Can I upgrade later?
                                </button>
                            </h3>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes. You can upgrade or downgrade anytime to match your team size and usage.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq5" aria-expanded="false" aria-controls="faq5">
                                    Is my data secure?
                                </button>
                            </h3>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes. We use secure infrastructure and protect data with industry-standard safeguards.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="visually-hidden">Blog</h2>
            <p class="text-center mt-4 mb-0">Still have questions? <a href="{{ route('register') }}">Get started free</a>,
                <a href="{{ url('/blog') }}">read our blog</a>, or reach out to our support.</p>
        </div>
    </section>

    @auth
        @push('scripts')
            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var csrfToken = document.querySelector('meta[name="csrf-token"]') && document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    var verifyUrl = '{{ url("/payment/verify") }}';
                    document.querySelectorAll('.btn-razorpay-checkout').forEach(function (btn) {
                        btn.addEventListener('click', function () {
                            var planId = this.getAttribute('data-plan-id');
                            var planName = this.getAttribute('data-plan-name') || 'Plan';
                            if (!planId || !csrfToken) return;
                            btn.disabled = true;
                            fetch('{{ url("/checkout") }}/' + planId, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                body: JSON.stringify({}),
                                credentials: 'same-origin'
                            }).then(function (r) { return r.json(); }).then(function (data) {
                                btn.disabled = false;
                                if (data.order_id && data.key_id && data.amount !== undefined) {
                                    var options = {
                                        key: data.key_id,
                                        amount: data.amount,
                                        currency: data.currency || 'INR',
                                        order_id: data.order_id,
                                        name: '{{ config("app.name") }}',
                                        description: planName + ' subscription',
                                        handler: function (response) {
                                            fetch(verifyUrl, {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'Accept': 'application/json',
                                                    'X-CSRF-TOKEN': csrfToken,
                                                    'X-Requested-With': 'XMLHttpRequest'
                                                },
                                                body: JSON.stringify({
                                                    razorpay_order_id: response.razorpay_order_id,
                                                    razorpay_payment_id: response.razorpay_payment_id,
                                                    razorpay_signature: response.razorpay_signature,
                                                    plan_id: parseInt(planId, 10)
                                                }),
                                                credentials: 'same-origin'
                                            }).then(function (res) { return res.json(); }).then(function (result) {
                                                if (result.redirect) window.location.href = result.redirect;
                                                else if (result.message) alert(result.message);
                                            }).catch(function () { alert('Verification failed. Please contact support.'); });
                                        }
                                    };
                                    var rzp = new Razorpay(options);
                                    rzp.on('payment.failed', function () { btn.disabled = false; });
                                    rzp.open();
                                } else {
                                    alert(data.message || 'Could not start checkout.');
                                }
                            }).catch(function () {
                                btn.disabled = false;
                                alert('Could not create order. Try again or contact support.');
                            });
                        });
                    });
                });
            </script>
        @endpush
    @endauth
@endsection
