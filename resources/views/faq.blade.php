@extends('layout.app')

@section('title', 'Frequently Asked Questions (FAQ) | Swift-Ride-taxis')
@section('meta_description', 'Find answers to common questions about Swift-Ride-taxis airport transfers, fixed fares, flight tracking, luggage allowances, and cancellation policies.')

@push('styles')
<style>
    /* ==========================================================================
       FAQ PAGE - MODERN REDESIGN (#5843F6 ACCENT)
       ========================================================================== */
    .faq-page-wrapper {
        background-color: #F8FAFC;
        color: #071326;
        min-height: 100vh;
        font-family: var(--sr-font-body);
        padding-bottom: 90px;
    }

    /* ===== HERO BANNER ===== */
    .faq-hero-section {
        position: relative;
        padding: 140px 0 70px;
        background: linear-gradient(180deg, rgba(7, 19, 38, 0.94) 0%, rgba(3, 8, 18, 0.97) 100%),
                    url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat;
        overflow: hidden;
        color: #FFFFFF;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .faq-hero-tag {
        font-size: 13px;
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #5843F6;
        margin-bottom: 12px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .faq-hero-tag::after {
        content: '';
        display: inline-block;
        width: 30px;
        height: 1.5px;
        background: #5843F6;
    }

    .faq-hero-title {
        font-family: var(--sr-font-display);
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 900;
        color: #FFFFFF;
        line-height: 1.1;
        margin-bottom: 14px;
    }

    .faq-hero-subtitle {
        color: rgba(255, 255, 255, 0.75);
        font-size: 16.5px;
        line-height: 1.65;
        max-width: 620px;
        margin: 0 auto 30px;
    }

    .faq-search-box-wrapper {
        max-width: 620px;
        margin: 0 auto 24px;
        position: relative;
    }

    .faq-search-input {
        width: 100%;
        padding: 16px 24px 16px 56px;
        border-radius: 16px;
        border: 2px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.96);
        font-size: 15px;
        color: #071326;
        outline: none;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
        transition: all 0.25s ease;
    }

    .faq-search-input:focus {
        border-color: #5843F6;
        background: #FFFFFF;
        box-shadow: 0 15px 35px rgba(88, 67, 246, 0.3);
    }

    .faq-search-box-wrapper i {
        position: absolute;
        left: 22px;
        top: 50%;
        transform: translateY(-50%);
        color: #5843F6;
        font-size: 18px;
    }

    .faq-hero-breadcrumb {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.6);
    }

    .faq-hero-breadcrumb a {
        color: #5843F6;
        transition: color 0.2s ease;
    }

    .faq-hero-breadcrumb a:hover {
        color: #FFFFFF;
    }

    /* ===== MAIN CONTENT ===== */
    .faq-container-main {
        max-width: 960px;
        margin: -40px auto 0;
        position: relative;
        z-index: 10;
    }

    /* CATEGORY TABS */
    .faq-tabs-row {
        display: flex;
        justify-content: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 40px;
    }

    .faq-tab-btn {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        color: #475569;
        font-size: 13.5px;
        font-weight: 700;
        padding: 10px 20px;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .faq-tab-btn:hover {
        background: #F0EEFF;
        color: #5843F6;
        border-color: #5843F6;
        transform: translateY(-1px);
    }

    .faq-tab-btn.active {
        background: #5843F6;
        color: #FFFFFF;
        border-color: #5843F6;
        box-shadow: 0 8px 20px rgba(88, 67, 246, 0.3);
    }

    .faq-tab-btn .badge-count {
        background: rgba(255, 255, 255, 0.25);
        padding: 2px 8px;
        border-radius: 20px;
        font-size: 11.5px;
    }

    .faq-tab-btn:not(.active) .badge-count {
        background: #F1F5F9;
        color: #64748B;
    }

    /* ACCORDION GROUP */
    .faq-group-box {
        margin-bottom: 36px;
    }

    .faq-group-heading {
        font-family: var(--sr-font-display);
        font-size: 18px;
        font-weight: 800;
        color: #071326;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .faq-group-heading i {
        color: #5843F6;
    }

    .faq-item-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 18px;
        margin-bottom: 14px;
        overflow: hidden;
        transition: all 0.25s ease;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.03);
    }

    .faq-item-card:hover {
        border-color: #5843F6;
        box-shadow: 0 10px 25px rgba(88, 67, 246, 0.1);
    }

    .faq-item-card.active {
        border-color: #5843F6;
        box-shadow: 0 12px 30px rgba(88, 67, 246, 0.14);
    }

    .faq-question-btn {
        padding: 22px 26px;
        font-size: 16px;
        font-weight: 800;
        color: #071326;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        user-select: none;
    }

    .faq-question-btn-text {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .faq-question-btn-text i {
        color: #5843F6;
        font-size: 18px;
    }

    .faq-icon-pill {
        width: 32px;
        height: 32px;
        min-width: 32px;
        border-radius: 50%;
        background: #F0EEFF;
        color: #5843F6;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        transition: all 0.25s ease;
    }

    .faq-item-card.active .faq-icon-pill {
        background: #5843F6;
        color: #FFFFFF;
        transform: rotate(180deg);
    }

    .faq-answer-collapse {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.35s cubic-bezier(0, 1, 0, 1), padding 0.3s ease;
        padding: 0 26px;
        color: #475569;
        font-size: 15px;
        line-height: 1.8;
    }

    .faq-item-card.active .faq-answer-collapse {
        max-height: 1000px;
        padding: 0 26px 24px;
        border-top: 1px solid #F1F5F9;
    }

    .faq-answer-body {
        padding-top: 18px;
    }

    /* CTA CARD */
    .faq-contact-cta {
        background: #071326;
        border-radius: 24px;
        padding: 45px 30px;
        color: #FFFFFF;
        text-align: center;
        margin-top: 50px;
        box-shadow: 0 20px 40px rgba(7, 19, 38, 0.2);
    }

    .faq-contact-cta h3 {
        font-family: var(--sr-font-display);
        font-size: 24px;
        font-weight: 900;
        color: #FFFFFF;
        margin-bottom: 10px;
    }

    .faq-contact-cta p {
        color: rgba(255, 255, 255, 0.75);
        font-size: 15px;
        margin-bottom: 26px;
        max-width: 540px;
        margin-left: auto;
        margin-right: auto;
    }

    .faq-cta-btn-group {
        display: flex;
        justify-content: center;
        gap: 16px;
        flex-wrap: wrap;
    }

    .btn-faq-primary {
        background: #5843F6;
        color: #FFFFFF !important;
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 800;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.25s ease;
    }

    .btn-faq-primary:hover {
        background: #4332d9;
        transform: translateY(-2px);
    }

    .btn-faq-secondary {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #FFFFFF !important;
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 800;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.25s ease;
    }

    .btn-faq-secondary:hover {
        background: rgba(255, 255, 255, 0.18);
        transform: translateY(-2px);
    }

    .no-results-box {
        text-align: center;
        padding: 60px 30px;
        background: #FFFFFF;
        border-radius: 20px;
        border: 2px dashed #E2E8F0;
        display: none;
    }

    .no-results-box i {
        font-size: 44px;
        color: #5843F6;
        margin-bottom: 14px;
    }

    .no-results-box h4 {
        font-size: 20px;
        font-weight: 800;
        color: #071326;
        margin-bottom: 8px;
    }

    .no-results-box p {
        color: #64748B;
        font-size: 14px;
        margin: 0;
    }
</style>
@endpush

@section('content')

{{-- FAQ SCHEMA MARKUP FOR SEO --}}
@php
    $schemaFaqs = [];
    foreach($faqs as $cat => $group) {
        foreach($group as $item) {
            $schemaFaqs[] = [
                '@type' => 'Question',
                'name' => $item->question,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => strip_tags($item->answer)
                ]
            ];
        }
    }
@endphp
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": {!! json_encode($schemaFaqs, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
}
</script>

<div class="faq-page-wrapper">

    {{-- ===== HERO BANNER ===== --}}
    <section class="faq-hero-section text-center">
        <div class="container">
            <span class="faq-hero-tag">HELP & SUPPORT</span>
            <h1 class="faq-hero-title">Frequently Asked Questions</h1>
            <p class="faq-hero-subtitle">
                Everything you need to know about our airport transfer bookings, fixed fares, flight tracking, and vehicle fleet.
            </p>

            {{-- Live Instant Search --}}
            <div class="faq-search-box-wrapper">
                <i class="fas fa-search"></i>
                <input type="text" id="faqSearchInput" class="faq-search-input" placeholder="Search questions or keywords (e.g. flight tracking, luggage, cancellations)..." onkeyup="filterFaqs()">
            </div>

            <div class="faq-hero-breadcrumb">
                <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
                <i class="fas fa-chevron-right text-white-50" style="font-size: 10px;"></i>
                <span class="text-white fw-semibold">FAQs</span>
            </div>
        </div>
    </section>

    {{-- ===== MAIN CONTENT ===== --}}
    <div class="container">
        <div class="faq-container-main">

            {{-- Category Filter Pills --}}
            <div class="faq-tabs-row" id="categoryTabs">
                <button type="button" class="faq-tab-btn active" data-category="all" onclick="selectCategory('all')">
                    <i class="fas fa-layer-group"></i> All Questions
                    <span class="badge-count">{{ $faqs->flatten()->count() }}</span>
                </button>
                @foreach($faqs as $category => $items)
                    <button type="button" class="faq-tab-btn" data-category="{{ Str::slug($category) }}" onclick="selectCategory('{{ Str::slug($category) }}')">
                        {{ $category }}
                        <span class="badge-count">{{ $items->count() }}</span>
                    </button>
                @endforeach
            </div>

            {{-- FAQs Accordions List --}}
            <div id="faqContainer">
                @forelse($faqs as $category => $items)
                    <div class="faq-group-box" data-category="{{ Str::slug($category) }}">
                        <div class="faq-group-heading">
                            <i class="fas fa-folder-open"></i> {{ $category }}
                        </div>
                        @foreach($items as $faq)
                            <div class="faq-item-card" data-question="{{ strtolower($faq->question) }}" data-answer="{{ strtolower(strip_tags($faq->answer)) }}">
                                <div class="faq-question-btn" onclick="toggleFaq(this)">
                                    <div class="faq-question-btn-text">
                                        <i class="far fa-question-circle"></i>
                                        <span>{{ $faq->question }}</span>
                                    </div>
                                    <div class="faq-icon-pill">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                                <div class="faq-answer-collapse">
                                    <div class="faq-answer-body">
                                        {!! $faq->answer !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <div class="no-results-box" style="display: block;">
                        <i class="fas fa-question-circle"></i>
                        <h4>No FAQs Currently Available</h4>
                        <p>We are updating our knowledge base. Check back soon!</p>
                    </div>
                @endforelse

                <div class="no-results-box" id="noSearchResults">
                    <i class="fas fa-search"></i>
                    <h4>No matching questions found</h4>
                    <p>Try searching with different keywords or select a category above.</p>
                </div>
            </div>

            {{-- Contact CTA Card --}}
            <div class="faq-contact-cta">
                <h3>Still Have Questions?</h3>
                <p>Can't find the answer you are looking for? Our customer support team is available 24/7 to assist you.</p>
                <div class="faq-cta-btn-group">
                    <a href="{{ route('contact') }}" class="btn-faq-primary">
                        <i class="fas fa-envelope"></i> Contact Support
                    </a>
                    @if($phone = SettingsHelper::get('company_phone'))
                        <a href="tel:{{ $phone }}" class="btn-faq-secondary">
                            <i class="fas fa-phone"></i> Call {{ $phone }}
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    let activeCategory = 'all';

    function toggleFaq(element) {
        const item = element.parentElement;
        const isActive = item.classList.contains('active');

        document.querySelectorAll('.faq-item-card').forEach(el => {
            if (el !== item) el.classList.remove('active');
        });

        item.classList.toggle('active', !isActive);
    }

    function selectCategory(categorySlug) {
        activeCategory = categorySlug;

        document.querySelectorAll('.faq-tab-btn').forEach(btn => {
            btn.classList.toggle('active', btn.dataset.category === categorySlug);
        });

        filterFaqs();
    }

    function filterFaqs() {
        const searchInput = document.getElementById('faqSearchInput').value.toLowerCase().trim();
        const groups = document.querySelectorAll('.faq-group-box');
        let visibleCount = 0;

        groups.forEach(group => {
            const groupCategory = group.dataset.category;
            const matchesCategory = (activeCategory === 'all' || groupCategory === activeCategory);
            let groupVisibleItems = 0;

            const items = group.querySelectorAll('.faq-item-card');
            items.forEach(item => {
                const questionText = item.dataset.question;
                const answerText = item.dataset.answer;
                const matchesSearch = !searchInput || questionText.includes(searchInput) || answerText.includes(searchInput);

                if (matchesCategory && matchesSearch) {
                    item.style.display = 'block';
                    groupVisibleItems++;
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            if (groupVisibleItems > 0) {
                group.style.display = 'block';
            } else {
                group.style.display = 'none';
            }
        });

        const noResults = document.getElementById('noSearchResults');
        if (noResults) {
            noResults.style.display = (visibleCount === 0 && searchInput.length > 0) ? 'block' : 'none';
        }
    }
</script>
@endpush
