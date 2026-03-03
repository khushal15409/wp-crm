@extends('layouts.landing')

@section('meta_title', 'WhatsApp CRM Blog | Lead Management & Sales Tips')
@section('meta_description', 'Learn how to manage WhatsApp leads, pipelines, and follow-ups using WhatsApp CRM. Tips for real estate and sales teams.')

@push('styles')
<style>
.blog-hero { padding: 100px 0 60px; background: linear-gradient(180deg, color-mix(in srgb, var(--accent-color), transparent 96%) 0%, var(--background-color) 100%); }
.blog-hero .section-badge { font-size: 12px; letter-spacing: 0.12em; color: var(--accent-color); font-weight: 600; }
.blog-listing .blog-card { background: var(--surface-color); border: 1px solid color-mix(in srgb, var(--default-color), transparent 88%); border-radius: 12px; overflow: hidden; transition: transform 0.3s, box-shadow 0.3s; height: 100%; display: flex; flex-direction: column; }
.blog-listing .blog-card:hover { transform: translateY(-6px); box-shadow: 0 16px 40px color-mix(in srgb, var(--default-color), transparent 88%); border-color: color-mix(in srgb, var(--accent-color), transparent 70%); }
.blog-listing .blog-card .card-num { width: 48px; height: 48px; border-radius: 10px; background: color-mix(in srgb, var(--accent-color), transparent 88%); color: var(--accent-color); font-family: var(--heading-font); font-weight: 700; font-size: 1.25rem; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem; }
.blog-listing .blog-card .card-title { font-size: 1.2rem; font-weight: 600; margin-bottom: 0.75rem; line-height: 1.35; color: var(--heading-color); }
.blog-listing .blog-card .card-title a { color: inherit; }
.blog-listing .blog-card .card-title a:hover { color: var(--accent-color); }
.blog-listing .blog-card .card-excerpt { color: color-mix(in srgb, var(--default-color), transparent 25%); font-size: 0.9375rem; line-height: 1.55; margin-bottom: 1.25rem; flex-grow: 1; }
.blog-listing .blog-card .card-link { font-weight: 600; font-size: 0.9375rem; color: var(--accent-color); display: inline-flex; align-items: center; gap: 6px; }
.blog-listing .blog-card .card-link:hover { color: var(--accent-color); }
.blog-listing .blog-card .card-link i { transition: transform 0.2s; }
.blog-listing .blog-card:hover .card-link i { transform: translateX(4px); }
.blog-cta-section { background: var(--surface-color); border: 1px solid color-mix(in srgb, var(--default-color), transparent 90%); border-radius: 12px; padding: 2rem; }
</style>
@endpush

@section('content')
    <!-- Blog Hero -->
    <section class="blog-hero section">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <span class="section-badge d-inline-block mb-2">BLOG</span>
                    <h1 class="mb-3" style="font-size: 2.25rem; font-weight: 700;">WhatsApp CRM Insights &amp; Sales Growth Tips</h1>
                    <p class="lead mb-0" style="color: color-mix(in srgb, var(--default-color), transparent 20%); max-width: 580px; margin-left: auto; margin-right: auto;">Discover practical guides and expert insights on managing WhatsApp leads, improving follow-ups, and closing more deals using a WhatsApp CRM.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Listing -->
    <section class="blog-listing section pt-0">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="50">
                    <article class="blog-card p-4">
                        <span class="card-num">1</span>
                        <h2 class="card-title"><a href="{{ url('/blog/real-estate-whatsapp-leads') }}">Why Real Estate Agents Lose Leads on WhatsApp</a></h2>
                        <p class="card-excerpt">Learn why missed follow-ups cost deals and how WhatsApp CRM solves this for real estate teams.</p>
                        <a href="{{ url('/blog/real-estate-whatsapp-leads') }}" class="card-link">Read more <i class="bi bi-arrow-right"></i></a>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <article class="blog-card p-4">
                        <span class="card-num">2</span>
                        <h2 class="card-title"><a href="{{ url('/blog/what-is-whatsapp-crm') }}">What Is WhatsApp CRM?</a></h2>
                        <p class="card-excerpt">A complete guide to WhatsApp CRM and why sales teams use it to manage leads and pipelines.</p>
                        <a href="{{ url('/blog/what-is-whatsapp-crm') }}" class="card-link">Read more <i class="bi bi-arrow-right"></i></a>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="150">
                    <article class="blog-card p-4">
                        <span class="card-num">3</span>
                        <h2 class="card-title"><a href="{{ url('/blog/whatsapp-crm-vs-excel') }}">WhatsApp CRM vs Excel</a></h2>
                        <p class="card-excerpt">Why WhatsApp CRM beats spreadsheets for sales and follow-ups.</p>
                        <a href="{{ url('/blog/whatsapp-crm-vs-excel') }}" class="card-link">Read more <i class="bi bi-arrow-right"></i></a>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="50">
                    <article class="blog-card p-4">
                        <span class="card-num">4</span>
                        <h2 class="card-title"><a href="{{ url('/blog/convert-whatsapp-leads') }}">How to Convert More WhatsApp Leads</a></h2>
                        <p class="card-excerpt">Proven strategies using pipelines and follow-up automation to close more deals.</p>
                        <a href="{{ url('/blog/convert-whatsapp-leads') }}" class="card-link">Read more <i class="bi bi-arrow-right"></i></a>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <article class="blog-card p-4">
                        <span class="card-num">5</span>
                        <h2 class="card-title"><a href="{{ url('/blog/best-whatsapp-crm-india') }}">Best WhatsApp CRM in India</a></h2>
                        <p class="card-excerpt">Why WP-CRM is built for Indian sales teams and growing businesses.</p>
                        <a href="{{ url('/blog/best-whatsapp-crm-india') }}" class="card-link">Read more <i class="bi bi-arrow-right"></i></a>
                    </article>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="150">
                    <article class="blog-card p-4">
                        <span class="card-num">6</span>
                        <h2 class="card-title"><a href="{{ url('/blog/follow-up-automation-sales') }}">How Follow-Up Automation Increases Sales</a></h2>
                        <p class="card-excerpt">Close 40% more deals with CRM follow-up automation and reminders.</p>
                        <a href="{{ url('/blog/follow-up-automation-sales') }}" class="card-link">Read more <i class="bi bi-arrow-right"></i></a>
                    </article>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <div class="blog-cta-section text-center" data-aos="fade-up">
                        <p class="mb-3 mb-md-0 d-inline-block me-md-3">Ready to manage your WhatsApp leads like a pro?</p>
                        <a href="{{ url('/') }}#pricing" class="btn btn-primary me-2">View Pricing</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-primary">Start 7-Day Free Trial</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
