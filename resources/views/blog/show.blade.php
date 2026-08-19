@extends('layout.app')

@section('title', $blog->meta_title ?: $blog->title)
@section('meta_description', $blog->meta_description ?: Str::limit(strip_tags($blog->content), 160))

@section('schema_markup')
    @if(!empty($blog->schema_markup))
        {!! $blog->schema_markup !!}
    @endif
@endsection

@push('styles')
<style>
    /* ==========================================================================
       BLOG SINGLE POST PAGE - MODERN REDESIGN
       ========================================================================== */
    .blog-show-wrapper {
        background-color: #F8FAFC;
        color: #071326;
        min-height: 100vh;
        font-family: var(--sr-font-body);
        padding-bottom: 90px;
    }

    /* ===== HERO BANNER ===== */
    .blog-show-hero {
        position: relative;
        padding: 140px 0 60px;
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

    .blog-post-title {
        font-family: var(--sr-font-display);
        font-size: clamp(2.2rem, 4.5vw, 3.4rem);
        font-weight: 900;
        color: #FFFFFF;
        line-height: 1.18;
        margin-bottom: 20px;
        max-width: 860px;
    }

    .blog-post-meta {
        display: flex;
        align-items: center;
        gap: 20px;
        font-size: 13.5px;
        color: rgba(255, 255, 255, 0.75);
        flex-wrap: wrap;
        margin-bottom: 24px;
        font-weight: 600;
    }
    .blog-post-meta i {
        color: #4A6CFE;
    }

    .blog-hero-breadcrumb {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.6);
    }
    .blog-hero-breadcrumb a {
        color: #4A6CFE;
        transition: color 0.2s ease;
    }
    .blog-hero-breadcrumb a:hover {
        color: #FFFFFF;
    }

    /* ===== ARTICLE MAIN ===== */
    .article-container {
        max-width: 860px;
        margin: -40px auto 0;
        position: relative;
        z-index: 10;
    }

    .article-card-main {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.08);
    }

    .article-cover-wrap {
        width: 100%;
        max-height: 520px;
        overflow: hidden;
        background: #071326;
        position: relative;
        cursor: zoom-in;
    }

    .article-cover-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .article-cover-wrap:hover img {
        transform: scale(1.02);
    }

    .article-body-content {
        padding: 45px 50px;
    }

    .article-text-body {
        font-size: 16px;
        line-height: 1.85;
        color: #334155;
    }

    .article-text-body h2, 
    .article-text-body h3, 
    .article-text-body h4 {
        font-family: var(--sr-font-display);
        color: #071326;
        font-weight: 800;
        margin-top: 36px;
        margin-bottom: 16px;
    }

    .article-text-body p {
        margin-bottom: 20px;
    }

    .article-text-body img {
        max-width: 100% !important;
        height: auto !important;
        border-radius: 16px;
        margin: 28px 0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        cursor: zoom-in;
    }

    .article-text-body blockquote {
        border-left: 4px solid #4A6CFE;
        background: #F0F4FF;
        padding: 20px 24px;
        border-radius: 0 16px 16px 0;
        font-style: italic;
        color: #071326;
        font-weight: 600;
        margin: 28px 0;
    }

    .article-author-box {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 18px;
        padding: 24px;
        margin-top: 40px;
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .author-avatar {
        width: 54px;
        height: 54px;
        border-radius: 50%;
        background: #071326;
        color: #4A6CFE;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    .author-info h6 {
        font-size: 15px;
        font-weight: 800;
        color: #071326;
        margin-bottom: 2px;
    }

    .author-info p {
        font-size: 13px;
        color: #64748B;
        margin: 0;
    }

    /* Share & Back Controls */
    .article-footer-controls {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 35px;
        padding-top: 24px;
        border-top: 1px solid #E2E8F0;
        flex-wrap: wrap;
        gap: 16px;
    }

    .btn-back-blog {
        color: #4A6CFE;
        font-weight: 800;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: transform 0.2s ease;
    }

    .btn-back-blog:hover {
        transform: translateX(-4px);
    }

    /* Lightbox Modal */
    .blog-img-modal {
        display: none;
        position: fixed;
        z-index: 99999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(7, 19, 38, 0.95);
        backdrop-filter: blur(10px);
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .blog-img-modal.show {
        display: flex;
    }
    .blog-img-modal-content {
        max-width: 92vw;
        max-height: 90vh;
        object-fit: contain;
        border-radius: 14px;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.8);
    }
    .blog-img-modal-close {
        position: absolute;
        top: 24px;
        right: 32px;
        color: #FFFFFF;
        font-size: 36px;
        cursor: pointer;
    }

    @media (max-width: 767.98px) {
        .article-body-content {
            padding: 30px 22px;
        }
        .article-container {
            margin-top: 0;
        }
    }
</style>
@endpush

@section('content')
<div class="blog-show-wrapper">

    {{-- ===== HERO BANNER ===== --}}
    <section class="blog-show-hero">
        <div class="container">
            <span class="blog-tag">TRAVEL GUIDE</span>
            <h1 class="blog-post-title">{{ $blog->title }}</h1>
            <div class="blog-post-meta">
                <span><i class="far fa-calendar-alt me-1"></i> Published {{ $blog->created_at->format('F d, Y') }}</span>
                <span><i class="far fa-clock me-1"></i> 5 min read</span>
                <span><i class="fas fa-check-circle me-1"></i> Verified Guide</span>
            </div>
            <div class="blog-hero-breadcrumb">
                <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
                <i class="fas fa-chevron-right text-white-50" style="font-size: 10px;"></i>
                <a href="{{ route('blog.index') }}">Blog</a>
                <i class="fas fa-chevron-right text-white-50" style="font-size: 10px;"></i>
                <span class="text-white fw-semibold">{{ Str::limit($blog->title, 40) }}</span>
            </div>
        </div>
    </section>

    {{-- ===== ARTICLE CONTAINER ===== --}}
    <div class="container">
        <div class="article-container">
            <article class="article-card-main">
                <!-- Cover Image -->
                <div class="article-cover-wrap" onclick="openBlogImageModal('{{ $blog->image ? asset('storage/' . $blog->image) : asset('images/blog-default.jpg') }}')">
                    <img src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('images/blog-default.jpg') }}" alt="{{ $blog->title }}">
                </div>

                <!-- Post Content -->
                <div class="article-body-content">
                    <div class="article-text-body">
                        {!! $blog->content !!}
                    </div>

                    <!-- Author Box -->
                    <div class="article-author-box">
                        <div class="author-avatar">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div class="author-info">
                            <h6>Swift-Ride-taxis Editorial Team</h6>
                            <p>Providing professional UK airport transfer advice, travel updates, and route guides.</p>
                        </div>
                    </div>

                    <!-- Footer Controls -->
                    <div class="article-footer-controls">
                        <a href="{{ route('blog.index') }}" class="btn-back-blog">
                            <i class="fas fa-arrow-left"></i> Back to All Articles
                        </a>
                        <a href="{{ route('home') }}#quote" class="btn btn-primary px-4 py-2 rounded-3 fw-bold">
                            <i class="fas fa-taxi me-2"></i> Book Airport Transfer
                        </a>
                    </div>
                </div>
            </article>
        </div>
    </div>

</div>

<!-- Lightbox Modal -->
<div id="blogImageModal" class="blog-img-modal" onclick="closeBlogImageModal()">
    <span class="blog-img-modal-close">&times;</span>
    <img class="blog-img-modal-content" id="modalFullImage" alt="Full View Image">
</div>
@endsection

@push('scripts')
<script>
    function openBlogImageModal(src) {
        const modal = document.getElementById('blogImageModal');
        const modalImg = document.getElementById('modalFullImage');
        if (modal && modalImg) {
            modalImg.src = src;
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeBlogImageModal() {
        const modal = document.getElementById('blogImageModal');
        if (modal) {
            modal.classList.remove('show');
            document.body.style.overflow = '';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const articleImages = document.querySelectorAll('.article-text-body img');
        articleImages.forEach(img => {
            img.addEventListener('click', function() {
                openBlogImageModal(this.src);
            });
        });
    });
</script>
@endpush
