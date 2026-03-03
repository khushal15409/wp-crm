@extends('layouts.landing')

@section('meta_title', 'WhatsApp CRM for Real Estate & Sales | WhatsAppLeadCRM')
@section('meta_description', 'WhatsAppLeadCRM is a WhatsApp CRM for real estate and sales teams to manage WhatsApp leads, pipeline, and follow-ups in one simple WhatsApp sales CRM.')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-center">
                <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-right" data-aos-delay="200">
                    <div class="hero-content">
                        <h1 class="hero-title">WhatsApp CRM Built to Close More Deals</h1>
                        <p class="hero-description">Manage WhatsApp leads, pipelines, and follow-ups in one powerful WhatsApp CRM. Built for sales-driven teams and growing businesses who want faster conversions.</p>
                        <div class="hero-actions">
                            <a href="{{ route('register') }}" class="btn-primary">Get Started Free</a>
                            <a href="#about" class="btn-secondary">
                                <i class="bi bi-play-circle"></i>
                                <span>Watch Demo</span>
                            </a>
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
                            <img src="{{ asset('front/images/landify/illustration/illustration-15.webp') }}" class="img-fluid hero-image" alt="WP-CRM Dashboard" loading="lazy">
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
                        <p class="lead-text">WP-CRM works for any business that receives leads on WhatsApp. Get structured follow-ups, clear pipelines, and team collaboration in one place. No more missed enquiries, lost chats, or messy spreadsheets.</p>
                        <p class="description-text">From first message to deal closure, everything stays tracked, organized, and under control.</p>
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
                            <img src="{{ asset('front/images/landify/about/about-8.webp') }}" alt="Leads and Pipeline" class="img-fluid main-visual" loading="lazy">
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
                                    <img src="{{ asset('front/images/landify/about/about-11.webp') }}" alt="Pipeline" class="img-fluid secondary-img" loading="lazy">
                                </div>
                                <div class="col-6">
                                    <img src="{{ asset('front/images/landify/about/about-5.webp') }}" alt="Reports" class="img-fluid secondary-img" loading="lazy">
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
                                    <p>Never miss a WhatsApp lead. Clear pipelines and real-time reports. Track performance across teams and campaigns.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="feature-box">
                                    <div class="feature-icon">
                                        <i class="bi bi-shield-check"></i>
                                    </div>
                                    <h5>Secure & Reliable</h5>
                                    <p>Your data is protected with enterprise-grade security, encrypted storage, and regular backups.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="feature-box">
                                    <div class="feature-icon">
                                        <i class="bi bi-lightning-charge"></i>
                                    </div>
                                    <h5>Fast & Simple</h5>
                                    <p>Faster follow-ups and team accountability. Start in minutes, no technical knowledge required.</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="feature-box">
                                    <div class="feature-icon">
                                        <i class="bi bi-headset"></i>
                                    </div>
                                    <h5>Expert Support</h5>
                                    <p>Higher conversion rates with less chaos. Our support team is always ready to guide you.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features section">
        <div class="container section-title" data-aos="fade-up">
            <span class="description-title">Features</span>
            <h2>WhatsApp CRM Features to Close More Deals</h2>
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
                                    <p>Turn WhatsApp enquiries into structured leads. Capture, qualify, and nurture without missing a single opportunity.</p>
                                    <div class="feature-grid">
                                        <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>Auto capture WhatsApp leads</span></div>
                                        <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>Assign owners & add notes</span></div>
                                        <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>Complete activity history</span></div>
                                        <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>Smart filters & quick search</span></div>
                                    </div>
                                    <a href="{{ route('register') }}" class="btn-primary">Get Started <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="visual-content">
                                    <div class="main-image">
                                        <img src="{{ asset('front/images/landify/features/features-4.png') }}" alt="Leads" class="img-fluid" loading="lazy">
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
                                    <p>Visual stages for any sales process. See where every lead stands and what to do next.</p>
                                    <div class="feature-grid">
                                        <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>Custom sales stages</span></div>
                                        <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>Drag & drop leads</span></div>
                                        <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>Conversion tracking</span></div>
                                        <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>Deal status clarity</span></div>
                                    </div>
                                    <a href="{{ route('register') }}" class="btn-primary">Try Pipeline <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="visual-content">
                                    <div class="main-image">
                                        <img src="{{ asset('front/images/landify/features/features-2.webp') }}" alt="Pipeline" class="img-fluid" loading="lazy">
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
                                    <p>Send offers, updates, and follow-ups to many leads at once. Reach the right people at the right time.</p>
                                    <div class="feature-grid">
                                        <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>Send bulk WhatsApp messages</span></div>
                                        <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>Campaign scheduling</span></div>
                                        <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>Delivery tracking</span></div>
                                        <div class="feature-item"><i class="bi bi-check-circle-fill"></i><span>Plan-based access</span></div>
                                    </div>
                                    <a href="{{ route('register') }}" class="btn-primary">Start Broadcasting <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="visual-content">
                                    <div class="main-image">
                                        <img src="{{ asset('front/images/landify/features/features-6.webp') }}" alt="Broadcasts" class="img-fluid" loading="lazy">
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
                    <p class="mb-0 lead">Sales teams and growing businesses using WP-CRM close more deals because they never miss a follow-up and always know the next action.</p>
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
                        <p>Whether you manage sales, clients, or enquiries — WP-CRM helps you close more deals on WhatsApp.</p>
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
                        <img src="{{ asset('front/images/landify/misc/misc-6.webp') }}" alt="Get Started" class="img-fluid main-image" loading="lazy">
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
                    <p class="main-description">WP-CRM helps teams stay organized, respond faster, and convert more leads from WhatsApp.</p>
                </div>
            </div>
            <div class="stats-grid">
                <div class="row g-4">
                    <div class="col-xl-3 col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="stat-item">
                            <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
                            <div class="stat-content">
                                <div class="stat-number"><span data-purecounter-start="0" data-purecounter-end="500" data-purecounter-duration="2" class="purecounter"></span>+</div>
                                <div class="stat-label">Leads Managed</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="stat-item featured">
                            <div class="stat-icon"><i class="bi bi-graph-up-arrow"></i></div>
                            <div class="stat-content">
                                <div class="stat-number"><span data-purecounter-start="0" 
                                data-purecounter-end="98" data-purecounter-duration="2" 
                                class="purecounter"></span>%</div>
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
            <h2>Simple Pricing for Teams of All Sizes</h2>
        </div>
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <!-- Free Trial Banner (single card; trial days from plans) -->
            <div class="row gy-4 justify-content-center mb-0">
                <div class="col-12" data-aos="fade-up" data-aos-delay="150">
                    <article class="price-card price-card-free-trial">
                        <div class="card-head">
                            <h3 class="title">Start Free for {{ $trialDays }} Days</h3>
                            <p class="subtitle">Try WP-CRM with full features before you pay anything.</p>
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
                    <article class="price-card price-card-paid {{ $plan->is_popular ? 'featured' : '' }} h-100 position-relative">
                        @if($plan->is_popular)
                        <div class="ribbon"><i class="bi bi-star-fill"></i> Most Popular</div>
                        @endif
                        <div class="card-head">
                            <span class="badge-title">{{ $plan->name }}</span>
                            <div class="price-wrap price-wrap-paid">
                                <span class="price price-monthly"><span class="price-currency">₹</span><span class="price-value">{{ $plan->getPriceMonthlyInr() }}</span><span class="period">/month</span></span>
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
                        <ul class="feature-list list-unstyled mb-4"><li><i class="bi bi-check-circle"></i> All features included</li></ul>
                        @endif
                        <div class="cta">
                            <a href="{{ route('register', ['plan_id' => $plan->id]) }}" class="btn btn-choose btn-choose-paid w-100">Choose Plan</a>
                        </div>
                    </article>
                </div>
                @endforeach
            </div>
            @endif
            <p class="text-center small text-muted mt-4 mb-0">No credit card required • Cancel anytime</p>
            <p class="text-center small text-muted mt-1 mb-0">WhatsApp conversation charges apply as per Meta pricing. No long-term contracts.</p>
        </div>
    </section>

    <!-- FAQ Section (Have Questions? Let's Talk.) -->
    <section id="contact" class="contact faq-section section light-background">
        <div class="container section-title" data-aos="fade-up">
            <span class="description-title">FAQ</span>
            <h2>Have Questions? Let’s Talk.</h2>
            <p>Common questions about WP-CRM and WhatsApp lead management.</p>
        </div>
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion faq-accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
                                    What is WP-CRM?
                                </button>
                            </h3>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    WP-CRM is a WhatsApp-focused CRM that helps sales teams and businesses manage leads, pipelines, and follow-ups in one place. You can track conversations, set reminders, and close more deals without switching between apps.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                                    How does the 7-day free trial work?
                                </button>
                            </h3>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Sign up and get full access to WP-CRM for 7 days. No credit card is required. You can use all features—leads, pipeline, follow-ups, and more. After the trial, choose a plan that fits your business or cancel anytime.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                                    Do I need a WhatsApp Business account?
                                </button>
                            </h3>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes. WP-CRM works with WhatsApp Business API or Business app. You connect your WhatsApp number to sync leads and conversations. We guide you through the setup so you can start managing leads quickly.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">
                                    What’s included in the Starter, Pro, and Business plans?
                                </button>
                            </h3>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <strong>Starter</strong> (₹299/month): Up to 300 WhatsApp leads, lead inbox, basic pipeline, follow-up reminders, notes, and email support. <strong>Pro</strong> (₹599/month): Unlimited leads, advanced pipeline, broadcast messaging, custom deal stages, and priority support. <strong>Business</strong> (₹999/month): Everything in Pro plus team access, role-based permissions, advanced analytics, and dedicated support.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="false" aria-controls="faq5">
                                    Can I cancel or change my plan later?
                                </button>
                            </h3>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes. You can upgrade or downgrade your plan at any time. If you cancel, you keep access until the end of your billing period. There are no long-term contracts—you stay in control.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6" aria-expanded="false" aria-controls="faq6">
                                    How do I get started?
                                </button>
                            </h3>
                            <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <a href="{{ route('register') }}">Register</a> for a free account to start your 7-day trial. Once you’re in, connect your WhatsApp number and start adding leads. Need help? Use the in-app support or <a href="{{ route('login') }}">log in</a> to your dashboard for guides.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-center mt-4 mb-0">Still have questions? <a href="{{ route('register') }}">Get started free</a> or reach out to our support.</p>
        </div>
    </section>
@endsection
