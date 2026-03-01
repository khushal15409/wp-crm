@extends('layouts.front')

@section('meta_title', 'WP-CRM – Never Miss a WhatsApp Lead Again | WhatsApp CRM for Real Estate & Sales')
@section('meta_description', 'WhatsApp CRM built for Real Estate & Sales Teams. Auto lead capture, pipeline, follow-ups & broadcast. Start free trial today.')
@section('meta_keywords', 'WhatsApp CRM, real estate CRM, lead management, WhatsApp business, sales pipeline, follow-up reminders, broadcast messaging, real estate agents')

@section('content')
{{-- 1. Nav --}}
<header>
    <nav class="navbar navbar-expand-lg landing-nav">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">WP-CRM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#landingNav" aria-controls="landingNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="landingNav">
                <ul class="navbar-nav ms-auto align-items-center gap-1">
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#how-it-works">How it works</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pricing">Pricing</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-cta" href="{{ route('dashboard') }}">Dashboard</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main>
    {{-- 2. Hero --}}
    <section class="landing-hero" aria-labelledby="hero-heading">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-right">
                    <h1 id="hero-heading">Never Miss a WhatsApp Lead Again</h1>
                    <p class="lead">WhatsApp CRM built for Real Estate & Sales Teams. Capture leads, track pipelines, and close more deals from one place.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('dashboard') }}" class="btn btn-primary-crm">Start Free Trial</a>
                        <a href="#pricing" class="btn btn-outline-crm">Book Demo</a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 mb-4 mb-lg-0" data-aos="fade-left">
                    <div class="hero-mockup float-ani">
                        <div class="bg-white rounded-4 shadow-lg border p-4 p-md-5" style="max-width: 480px; margin: 0 auto;">
                            <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                                <div class="rounded-circle bg-success bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                </div>
                                <span class="fw-semibold text-dark">WhatsApp Inbox</span>
                            </div>
                            <div class="rounded-3 bg-light p-3 mb-2" style="min-height: 120px;">
                                <div class="d-flex gap-2 mb-2">
                                    <div class="rounded-pill bg-primary bg-opacity-25 px-3 py-1 small text-primary">Lead</div>
                                    <div class="rounded-pill bg-secondary bg-opacity-25 px-3 py-1 small text-secondary">New</div>
                                </div>
                                <div class="small text-muted">Pipeline stages • Follow-up reminders</div>
                            </div>
                            <div class="text-muted small">Dashboard mockup</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. Trust / Problem --}}
    <section class="landing-section gradient-soft" id="problem" aria-labelledby="problem-title">
        <div class="container">
            <h2 id="problem-title" class="section-title text-center">Why Most Agents Lose 30–40% Leads</h2>
            <p class="section-sub text-center">Common gaps that cost you deals every day</p>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="0">
                    <div class="landing-card">
                        <div class="card-icon">📩</div>
                        <h3>Missed Follow-ups</h3>
                        <p>Leads go cold when you forget to follow up. No system, no reminders.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="landing-card">
                        <div class="card-icon">📊</div>
                        <h3>No Lead Tracking</h3>
                        <p>WhatsApp chats everywhere. No single view of who’s hot and who’s not.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="landing-card">
                        <div class="card-icon">💬</div>
                        <h3>WhatsApp Chat Mess</h3>
                        <p>Multiple numbers, lost history, no notes. Hard to hand off or scale.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="landing-card">
                        <div class="card-icon">🔄</div>
                        <h3>No Sales Pipeline</h3>
                        <p>Deals slip through the cracks. No stages, no visibility, no forecast.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. Solution --}}
    <section class="landing-section" id="solution" aria-labelledby="solution-title">
        <div class="container">
            <h2 id="solution-title" class="section-title text-center">WP-CRM Solves This</h2>
            <p class="section-sub text-center">One place for all your WhatsApp leads and deals</p>
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                    <ul class="solution-list">
                        <li>
                            <span class="icon-wrap"><svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></span>
                            <div><strong>Auto WhatsApp lead capture</strong><br><span>Every conversation in one inbox with tags and status.</span></div>
                        </li>
                        <li>
                            <span class="icon-wrap"><svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19a2 2 0 002 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM9 10H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2z"/></svg></span>
                            <div><strong>Pipeline stages</strong><br><span>Move leads from New → Qualified → Proposal → Closed.</span></div>
                        </li>
                        <li>
                            <span class="icon-wrap"><svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/></svg></span>
                            <div><strong>Follow-up reminders</strong><br><span>Never drop a lead. Get nudges so you follow up on time.</span></div>
                        </li>
                        <li>
                            <span class="icon-wrap"><svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg></span>
                            <div><strong>Notes & history</strong><br><span>Full context per lead. Notes, history, and team visibility.</span></div>
                        </li>
                        <li>
                            <span class="icon-wrap"><svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/></svg></span>
                            <div><strong>Broadcast messaging</strong><br><span>Send updates and offers to segments without spamming.</span></div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="rounded-4 overflow-hidden shadow-lg border bg-white p-4">
                        <div class="ratio ratio-16x10 bg-light rounded-3 d-flex align-items-center justify-content-center">
                            <span class="text-muted">CRM screen illustration</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 5. Features grid --}}
    <section class="landing-section gradient-soft" id="features" aria-labelledby="features-title">
        <div class="container">
            <h2 id="features-title" class="section-title text-center">Everything You Need to Close More Deals</h2>
            <p class="section-sub text-center">Built for teams that live on WhatsApp</p>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                    <div class="landing-card">
                        <div class="card-icon">📥</div>
                        <h3>WhatsApp Lead Inbox</h3>
                        <p>All chats in one place. Tag, filter, and never lose a lead.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="landing-card">
                        <div class="card-icon">⏰</div>
                        <h3>Smart Follow-ups</h3>
                        <p>Reminders and tasks so you follow up at the right time.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="landing-card">
                        <div class="card-icon">📈</div>
                        <h3>Sales Pipeline</h3>
                        <p>Stages from lead to closed. See where every deal stands.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                    <div class="landing-card">
                        <div class="card-icon">📢</div>
                        <h3>Broadcast Campaigns</h3>
                        <p>Send bulk messages to segments without spamming.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="landing-card">
                        <div class="card-icon">💳</div>
                        <h3>Subscription Plans</h3>
                        <p>Simple monthly plans. Scale as you grow.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="landing-card">
                        <div class="card-icon">🔒</div>
                        <h3>Secure Cloud System</h3>
                        <p>Your data safe in the cloud. Access from anywhere.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 6. How it works --}}
    <section class="landing-section" id="how-it-works" aria-labelledby="how-title">
        <div class="container">
            <h2 id="how-title" class="section-title text-center">How It Works</h2>
            <p class="section-sub text-center">Three steps to start closing more leads</p>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="timeline-step" data-aos="fade-up">
                        <span class="step-num">1</span>
                        <h4>Connect WhatsApp</h4>
                        <p>Link your WhatsApp Business number in minutes. No coding.</p>
                    </div>
                    <div class="timeline-step" data-aos="fade-up">
                        <span class="step-num">2</span>
                        <h4>Leads auto captured</h4>
                        <p>Every new chat becomes a lead. Tag, assign, and track in one inbox.</p>
                    </div>
                    <div class="timeline-step" data-aos="fade-up">
                        <span class="step-num">3</span>
                        <h4>Close deals faster</h4>
                        <p>Use pipeline, reminders, and broadcast to follow up and convert.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 7. Pricing --}}
    <section class="landing-section gradient-soft" id="pricing" aria-labelledby="pricing-title">
        <div class="container">
            <h2 id="pricing-title" class="section-title text-center">Simple Pricing</h2>
            <p class="section-sub text-center">Choose a plan that fits your team</p>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                    <div class="pricing-card">
                        <h3 class="h5 mb-2">Basic</h3>
                        <p class="text-muted small mb-3">For solo agents</p>
                        <div class="price mb-2">$19 <small>/mo</small></div>
                        <p class="small text-muted mb-3">Up to 1,000 WhatsApp conversations/mo</p>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary btn-pricing">Get Started</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="pricing-card highlight">
                        <span class="badge-top">Popular</span>
                        <h3 class="h5 mb-2">Pro</h3>
                        <p class="text-muted small mb-3">For small teams</p>
                        <div class="price mb-2">$49 <small>/mo</small></div>
                        <p class="small text-muted mb-3">Up to 5,000 WhatsApp conversations/mo</p>
                        <a href="{{ route('dashboard') }}" class="btn btn-pricing">Get Started Free</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="pricing-card">
                        <h3 class="h5 mb-2">Premium</h3>
                        <p class="text-muted small mb-3">For growing teams</p>
                        <div class="price mb-2">$99 <small>/mo</small></div>
                        <p class="small text-muted mb-3">Unlimited conversations + priority support</p>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary btn-pricing">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 8. Who is it for --}}
    <section class="landing-section" id="who" aria-labelledby="who-title">
        <div class="container">
            <h2 id="who-title" class="section-title text-center">Who Is It For</h2>
            <p class="section-sub text-center">Built for people who sell on WhatsApp</p>
            <div class="row g-4">
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="0">
                    <div class="landing-card text-center">
                        <div class="card-icon mx-auto">🏠</div>
                        <h3 class="h6">Real Estate Agents</h3>
                        <p class="small mb-0">Manage property leads from one inbox.</p>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="landing-card text-center">
                        <div class="card-icon mx-auto">🏢</div>
                        <h3 class="h6">Brokers</h3>
                        <p class="small mb-0">Track team pipelines and follow-ups.</p>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="landing-card text-center">
                        <div class="card-icon mx-auto">👥</div>
                        <h3 class="h6">Sales Teams</h3>
                        <p class="small mb-0">Close more deals with shared CRM.</p>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="landing-card text-center">
                        <div class="card-icon mx-auto">📦</div>
                        <h3 class="h6">Small Businesses</h3>
                        <p class="small mb-0">Professional WhatsApp without the mess.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 9. CTA --}}
    <section class="landing-cta" aria-labelledby="cta-heading">
        <div class="container">
            <h2 id="cta-heading">Start Managing WhatsApp Leads Like a Pro</h2>
            <p class="mb-4 opacity-90">Join teams who never miss a lead. No credit card required.</p>
            <a href="{{ route('dashboard') }}" class="btn btn-cta-large">Get Started Free</a>
        </div>
    </section>
</main>

{{-- 10. Footer --}}
<footer class="landing-footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <a href="{{ url('/') }}" class="brand d-inline-block mb-2">WP-CRM</a>
                <p class="small">WhatsApp CRM for Real Estate & Sales. Capture leads, track pipelines, close more deals.</p>
            </div>
            <div class="col-md-2">
                <p class="small fw-semibold mb-2">Product</p>
                <ul class="list-unstyled small">
                    <li><a href="#features">Features</a></li>
                    <li><a href="#pricing">Pricing</a></li>
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <p class="small fw-semibold mb-2">Company</p>
                <ul class="list-unstyled small">
                    <li><a href="#">Privacy</a></li>
                    <li><a href="#">Terms</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-4 text-md-end">
                <p class="small fw-semibold mb-2">Follow us</p>
                <a href="#" class="text-white opacity-75 me-3" aria-label="Twitter">𝕏</a>
                <a href="#" class="text-white opacity-75 me-3" aria-label="LinkedIn">in</a>
                <a href="#" class="text-white opacity-75" aria-label="Instagram">📷</a>
            </div>
        </div>
        <hr class="my-4 border-secondary">
        <p class="small text-center mb-0">&copy; {{ date('Y') }} WP-CRM. All rights reserved.</p>
    </div>
</footer>
@endsection
