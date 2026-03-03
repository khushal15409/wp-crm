@extends('layouts.landing')

@section('meta_title', 'Best WhatsApp CRM in India (2025)')
@section('meta_description', 'Looking for the best WhatsApp CRM in India? See why WP-CRM is built for Indian sales teams.')

@push('styles')
<style>
.blog-article-hero { padding: 100px 0 50px; background: linear-gradient(180deg, color-mix(in srgb, var(--accent-color), transparent 96%) 0%, var(--background-color) 100%); }
.blog-article-hero .breadcrumb { background: none; padding: 0; margin-bottom: 1rem; font-size: 0.875rem; }
.blog-article-hero .breadcrumb a { color: var(--accent-color); }
.blog-article-hero .breadcrumb a:hover { color: var(--accent-color); text-decoration: underline; }
.blog-article-hero .breadcrumb-item + .breadcrumb-item::before { color: color-mix(in srgb, var(--default-color), transparent 50%); }
.blog-article-hero h1 { font-size: 2rem; font-weight: 700; margin-bottom: 1rem; }
.blog-article-hero .lead { color: color-mix(in srgb, var(--default-color), transparent 20%); font-size: 1.1rem; }
.blog-article-body { padding: 2rem 0 3rem; }
.blog-article-body h2 { font-size: 1.35rem; font-weight: 600; margin-top: 2.25rem; margin-bottom: 1rem; color: var(--heading-color); }
.blog-article-body p { margin-bottom: 1rem; line-height: 1.7; }
.blog-article-body ul { margin-bottom: 1.25rem; padding-left: 1.5rem; }
.blog-article-body ul li { margin-bottom: 0.5rem; line-height: 1.6; }
.blog-article-cta { background: linear-gradient(135deg, color-mix(in srgb, var(--accent-color), transparent 94%) 0%, var(--surface-color) 100%); border: 1px solid color-mix(in srgb, var(--accent-color), transparent 80%); border-radius: 12px; padding: 2rem; margin-top: 2.5rem; }
</style>
@endpush

@section('content')
<section class="blog-article-hero section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/blog') }}">Blog</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Best WhatsApp CRM India</li>
                    </ol>
                </nav>
                <h1>Best WhatsApp CRM in India</h1>
            </div>
        </div>
    </div>
</section>

<section class="blog-article-body section pt-0">
    <div class="container">
        <div class="row justify-content-center">
            <article class="col-lg-8">
                <h2>What Indian Teams Need</h2>
                <ul>
                    <li>Affordable pricing</li>
                    <li>Simple UI</li>
                    <li>WhatsApp Cloud API support</li>
                </ul>

                <h2>Why WP-CRM Is Ideal</h2>
                <ul>
                    <li>Designed for Indian workflows</li>
                    <li>Easy onboarding</li>
                    <li>Reliable support</li>
                </ul>

                <div class="blog-article-cta">
                    <p class="mb-3 fw-semibold">Join Indian sales teams already using WP-CRM.</p>
                    <a href="{{ route('register') }}" class="btn btn-primary">Try India's Smart WhatsApp CRM</a>
                    <a href="{{ url('/') }}#pricing" class="btn btn-outline-primary ms-2">View Pricing</a>
                </div>
            </article>
        </div>
    </div>
</section>
@endsection
