@extends('layouts.landing')

@section('meta_title', 'What Is WhatsApp CRM? Complete Guide | WP-CRM')
@section('meta_description', 'Learn what WhatsApp CRM is, how it works, and why sales teams use it to manage leads and pipelines.')

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
                        <li class="breadcrumb-item active" aria-current="page">What Is WhatsApp CRM</li>
                    </ol>
                </nav>
                <h1>What Is WhatsApp CRM?</h1>
                <p class="lead">WhatsApp CRM connects WhatsApp conversations with lead management, pipelines, and follow-ups in one system.</p>
            </div>
        </div>
    </div>
</section>

<section class="blog-article-body section pt-0">
    <div class="container">
        <div class="row justify-content-center">
            <article class="col-lg-8">
                <h2>Why WhatsApp CRM Matters</h2>
                <ul>
                    <li>WhatsApp has highest open rates</li>
                    <li>Customers expect fast replies</li>
                    <li>Manual tracking doesn't scale</li>
                </ul>

                <h2>Who Should Use WhatsApp CRM?</h2>
                <ul>
                    <li>Real estate agents</li>
                    <li>Sales teams</li>
                    <li>Insurance &amp; loan agents</li>
                    <li>Service businesses</li>
                </ul>

                <h2>Benefits of Using WhatsApp CRM</h2>
                <ul>
                    <li>Centralized lead inbox</li>
                    <li>Automated follow-ups</li>
                    <li>Higher conversions</li>
                </ul>

                <div class="blog-article-cta">
                    <p class="mb-3 fw-semibold">Try WhatsApp CRM free and see the difference.</p>
                    <a href="{{ route('register') }}" class="btn btn-primary">Try WhatsApp CRM Free</a>
                    <a href="{{ url('/') }}#pricing" class="btn btn-outline-primary ms-2">View Pricing</a>
                </div>
            </article>
        </div>
    </div>
</section>
@endsection
