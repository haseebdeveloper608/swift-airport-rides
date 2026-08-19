@extends('layout.app')

@section('title', 'Travel Blog & Airport Guides | Swift-Ride-taxis')
@section('meta_description', 'Insider advice, UK travel guides, airport route tips, and news from Swift-Ride-taxis.')

@push('styles')
<style>
    /* ==========================================================================
       BLOG INDEX PAGE - MODERN REDESIGN
       ========================================================================== */
    .blog-page-wrapper {
        background-color: #F8FAFC;
        color: #071326;
        min-height: 100vh;
        font-family: var(--sr-font-body);
    }

    /* ===== HERO BANNER ===== */
    .blog-hero-section {
        position: relative;
        padding: 130px 0 70px;
        background: linear-gradient(180deg, rgba(7, 19, 38, 0.92) 0%, rgba(3, 8, 18, 0.96) 100%),
                    url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat;
        overflow: hidden;
        color: #FFFFFF;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .blog-tag {
        font-size: 13px;
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #4A6CFE;
        margin-bottom: 12px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .blog-tag::after {
        content: '';
        display: inline-block;
        width: 30px;
        height: 1.5px;
        background: #4A6CFE;
    }

    .blog-hero-title {
        font-family: var(--sr-font-display);
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 900;
        color: #FFFFFF;
        line-height: 1.1;
        margin-bottom: 12px;
    }

    .blog-hero-subtitle {
        color: rgba(255, 255, 255, 0.75);
        font-size: 16.5px;
        line-height: 1.65;
        max-width: 580px;
        margin: 0 auto 28px;
    }

    .blog-hero-breadcrumb {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-size: 13.5px;
        color: rgba(255, 255, 255, 0.6);
    }
    .blog-hero-breadcrumb a {
        color: #4A6CFE;
        transition: color 0.2s ease;
    }
    .blog-hero-breadcrumb a:hover {
        color: #FFFFFF;
    }

    /* ===== POSTS GRID ===== */
    .blog-grid-section {
        padding: 70px 0 90px;
    }

    .blog-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }

    .blog-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .blog-card:hover {
        transform: translateY(-6px);
        border-color: #4A6CFE;
        box-shadow: 0 20px 40px rgba(74, 108, 254, 0.12);
    }

    .blog-card-thumb {
        position: relative;
        height: 220px;
        overflow: hidden;
        background: #071326;
    }

    .blog-card-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .blog-card:hover .blog-card-thumb img {
        transform: scale(1.06);
    }

    .blog-category-badge {
        position: absolute;
        top: 14px;
        left: 14px;
        background: rgba(7, 19, 38, 0.85);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.15);
        color: #4A6CFE;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        padding: 5px 12px;
        border-radius: 8px;
    }

    .blog-card-body {
        padding: 24px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .blog-card-meta {
        display: flex;
        align-items: center;
        gap: 14px;
        font-size: 12.5px;
        color: #64748B;
        margin-bottom: 12px;
        font-weight: 600;
    }

    .blog-card-meta i {
        color: #4A6CFE;
    }

    .blog-card-title {
        font-family: var(--sr-font-display);
        font-size: 18px;
        font-weight: 800;
        color: #071326;
        line-height: 1.35;
        margin-bottom: 10px;
        transition: color 0.2s ease;
    }

    .blog-card:hover .blog-card-title {
        color: #4A6CFE;
    }

    .blog-card-excerpt {
        color: #475569;
        font-size: 14px;
        line-height: 1.65;
        margin-bottom: 20px;
        flex: 1;
    }

    .blog-card-footer {
        padding-top: 16px;
        border-top: 1px solid #F1F5F9;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .blog-read-btn {
        color: #4A6CFE;
        font-weight: 800;
        font-size: 13.5px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: gap 0.2s ease;
    }

    .blog-card:hover .blog-read-btn {
        gap: 10px;
    }

    .blog-empty-state {
        grid-column: 1 / -1;
        background: #FFFFFF;
        border: 2px dashed #E2E8F0;
        border-radius: 20px;
        padding: 60px 30px;
        text-align: center;
    }

    .blog-empty-state i {
        font-size: 48px;
        color: #4A6CFE;
        margin-bottom: 16px;
    }

    .blog-empty-state h4 {
        font-size: 20px;
        font-weight: 800;
        color: #071326;
        margin-bottom: 8px;
    }

    .blog-empty-state p {
        color: #64748B;
        font-size: 14px;
        margin: 0;
    }

    /* Responsive */
    @media (max-width: 1199.98px) {
        .blog-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 767.98px) {
        .blog-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="blog-page-wrapper">

    {{-- ===== HERO BANNER ===== --}}
    <section class="blog-hero-section text-center">
        <div class="container">
            <span class="blog-tag">TRAVEL JOURNAL</span>
            <h1 class="blog-hero-title">Latest Travel Stories & Guides</h1>
            <p class="blog-hero-subtitle">
                Insider advice, UK travel guides, airport route tips, and news from Swift-Ride-taxis.
            </p>
            <div class="blog-hero-breadcrumb">
                <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
                <i class="fas fa-chevron-right text-white-50" style="font-size: 10px;"></i>
                <span class="text-white fw-semibold">Blog</span>
            </div>
        </div>
    </section>

    {{-- ===== POSTS GRID ===== --}}
    <section class="blog-grid-section">
        <div class="container">
            <div class="blog-grid">
                @forelse($blogs as $blog)
                    <article class="blog-card">
                        <a href="{{ route('blog.show', $blog->slug) }}" class="blog-card-thumb">
                            <img src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('images/blog-default.jpg') }}" alt="{{ $blog->title }}" loading="lazy">
                            <span class="blog-category-badge"><i class="fas fa-tag me-1"></i> Travel Guide</span>
                        </a>
                        <div class="blog-card-body">
                            <div class="blog-card-meta">
                                <span><i class="far fa-calendar-alt me-1"></i> {{ $blog->created_at->format('M d, Y') }}</span>
                                <span><i class="far fa-clock me-1"></i> 5 min read</span>
                            </div>
                            <h3 class="blog-card-title">
                                <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                            </h3>
                            <p class="blog-card-excerpt">
                                {{ Str::limit(strip_tags($blog->content), 130) }}
                            </p>
                            <div class="blog-card-footer">
                                <span class="text-muted small fw-semibold"><i class="far fa-user text-primary me-1"></i> Swift-Ride-taxis Editorial</span>
                                <a href="{{ route('blog.show', $blog->slug) }}" class="blog-read-btn">
                                    Read Article <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="blog-empty-state">
                        <i class="fas fa-newspaper"></i>
                        <h4>No Blog Articles Found</h4>
                        <p>We're crafting new travel guides and airport tips. Check back soon!</p>
                    </div>
                @endforelse
            </div>

            @if(method_exists($blogs, 'links'))
                <div class="d-flex justify-content-center mt-5">
                    {{ $blogs->links() }}
                </div>
            @endif
        </div>
    </section>

</div>
@endsection
