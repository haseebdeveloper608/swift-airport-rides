@extends('layout.app')

@section('title', $aboutPage?->seo_title ?? 'About Us | Swift-Ride-taxis - Driven by Values')
@section('meta_description', $aboutPage?->seo_description ?? 'Swift-Ride-taxis was built to redefine airport transfers in the UK with professionalism, reliability and a customer-first approach.')

@push('styles')
<style>
    /* ==========================================================================
       ABOUT US PAGE - EXACT REFERENCE DESIGN STYLES
       ========================================================================== */

    .about-page-wrapper {
        background-color: #FFFFFF;
        color: #071326;
        padding-top: 0;
        padding-bottom: 80px;
        font-family: var(--sr-font-body);
    }

    /* Common Section Tag */
    .about-tag {
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
    .about-tag::after {
        content: '';
        display: inline-block;
        width: 30px;
        height: 1.5px;
        background: #4A6CFE;
    }

    /* ===== 1. HERO SECTION ===== */
    .about-hero-section {
        position: relative;
        padding: 140px 0 70px;
        background: linear-gradient(180deg, rgba(7, 19, 38, 0.92) 0%, rgba(3, 8, 18, 0.96) 100%),
                    url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat;
        overflow: hidden;
        color: #FFFFFF;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    }

    .about-hero-title {
        font-family: var(--sr-font-display);
        font-size: clamp(3rem, 5.5vw, 4.5rem);
        font-weight: 900;
        color: #FFFFFF;
        line-height: 1.08;
        margin-bottom: 6px;
    }

    .about-hero-subtitle {
        font-family: var(--sr-font-display);
        font-size: clamp(3rem, 5.5vw, 4.5rem);
        font-weight: 900;
        color: #FFFFFF;
        margin-bottom: 24px;
    }

    .about-hero-subtitle span.gold-text {
        color: #4A6CFE;
    }

    .about-hero-desc {
        color: rgba(255, 255, 255, 0.75);
        font-size: 16px;
        line-height: 1.65;
        max-width: 540px;
        margin-bottom: 30px;
    }

    /* Floating Quote Card */
    .hero-quote-card {
        background: rgba(7, 17, 32, 0.92);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 20px;
        padding: 24px 30px;
        backdrop-filter: blur(16px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
        max-width: 480px;
        margin-left: auto;
        margin-top: 60px;
    }

    .quote-icon {
        font-size: 32px;
        color: #4A6CFE;
        line-height: 1;
        margin-bottom: 8px;
        font-family: Georgia, serif;
    }

    .quote-text {
        font-size: 15px;
        font-weight: 700;
        color: #FFFFFF;
        line-height: 1.5;
        margin-bottom: 12px;
    }

    .quote-line {
        width: 60px;
        height: 2.5px;
        background: #4A6CFE;
        border-radius: 2px;
    }

    /* ===== 2. OUR STORY SECTION ===== */
    .story-visual-wrap {
        position: relative;
        padding-bottom: 40px;
        padding-right: 40px;
    }

    .story-img-main {
        width: 100%;
        height: 380px;
        object-fit: cover;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .story-img-overlap {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 65%;
        height: 220px;
        object-fit: cover;
        border-radius: 18px;
        border: 4px solid #FFFFFF;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }

    .badge-customer-first {
        position: absolute;
        top: 20px;
        left: -15px;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: #071326;
        border: 2px solid #4A6CFE;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 10px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .badge-customer-first span {
        font-size: 9px;
        font-weight: 900;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        color: #FFFFFF;
        line-height: 1.2;
    }

    .badge-customer-first i {
        color: #4A6CFE;
        font-size: 11px;
        margin-top: 4px;
    }

    .story-content h2 {
        font-family: var(--sr-font-display);
        font-size: clamp(2.2rem, 4vw, 3.2rem);
        font-weight: 900;
        color: #071326;
        margin-bottom: 20px;
        line-height: 1.15;
    }

    .story-content p {
        color: #475569;
        font-size: 15px;
        line-height: 1.75;
        margin-bottom: 16px;
    }

    .story-pillars-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-top: 30px;
    }

    .pillar-box {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 18px 14px;
        text-align: left;
    }

    .pillar-icon-circle {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: rgba(74, 108, 254, 0.12);
        border: 1px solid rgba(74, 108, 254, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4A6CFE;
        font-size: 15px;
        margin-bottom: 12px;
    }

    .pillar-box h5 {
        font-size: 14px;
        font-weight: 800;
        color: #071326;
        margin-bottom: 6px;
    }

    .pillar-box p {
        font-size: 11.5px;
        color: #64748B;
        line-height: 1.5;
        margin: 0;
    }

    /* ===== 3. KEY STATS CAPSULE BAR ===== */
    .about-stats-capsule-bar {
        background: #071120;
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 20px;
        padding: 24px 30px;
        margin: 60px 0 80px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
    }

    .about-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .about-stat-item {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .about-stat-item:not(:last-child) {
        border-right: 1px solid rgba(255, 255, 255, 0.08);
        padding-right: 20px;
    }

    .about-stat-icon-circle {
        width: 46px;
        height: 46px;
        min-width: 46px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4A6CFE;
        font-size: 18px;
    }

    .about-stat-text h3 {
        font-family: var(--sr-font-display);
        font-size: 20px;
        font-weight: 900;
        color: #FFFFFF;
        margin: 0;
        line-height: 1.1;
    }

    .about-stat-text h6 {
        font-size: 13px;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 2px;
    }

    .about-stat-text p {
        font-size: 11.5px;
        color: rgba(255, 255, 255, 0.55);
        margin: 0;
    }

    /* ===== 4. OUR VALUES GRID ===== */
    .values-grid-5 {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 18px;
        margin-top: 40px;
    }

    .value-card-white {
        background: #FFFFFF;
        color: #071326;
        border-radius: 20px;
        padding: 26px 18px;
        text-align: center;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
    }

    .value-card-white:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.25);
    }

    .value-icon-circle {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: #071326;
        color: #4A6CFE;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin: 0 auto 16px;
        box-shadow: 0 6px 16px rgba(7, 19, 38, 0.2);
    }

    .value-card-white h4 {
        font-family: var(--sr-font-display);
        font-size: 16px;
        font-weight: 800;
        color: #071326;
        margin-bottom: 8px;
    }

    .value-card-white p {
        font-size: 12px;
        color: #64748B;
        line-height: 1.5;
        margin: 0;
    }

    /* ===== 5. OUR MISSION CARD (EXACT REFERENCE DESIGN) ===== */
    .mission-card-banner {
        position: relative;
        background: #071120 url('/images/about-mission-banner.jpg') center/cover no-repeat;
        border-radius: 24px;
        min-height: 250px;
        display: flex;
        align-items: center;
        overflow: hidden;
        margin-top: 80px;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .mission-text-container {
        max-width: 580px;
        margin-left: auto;
        margin-right: 17%;
        padding: 50px 30px;
        position: relative;
        z-index: 2;
    }

    .mission-text-container h3 {
        font-family: var(--sr-font-display);
        font-size: clamp(1.8rem, 3.2vw, 2.4rem);
        font-weight: 800;
        color: #FFFFFF;
        line-height: 1.25;
        margin-bottom: 16px;
    }

    .mission-accent-line {
        width: 60px;
        height: 2px;
        background: #4A6CFE;
        margin-bottom: 16px;
    }

    .mission-text-container p {
        color: rgba(255, 255, 255, 0.8);
        font-size: 14.5px;
        line-height: 1.7;
        margin: 0;
    }

    @media (max-width: 991.98px) {
        .mission-card-banner {
            background: #071120;
            min-height: auto;
        }
        .mission-text-container {
            margin: 0 auto;
            padding: 36px 24px;
            max-width: 100%;
        }
    }

    /* ===== 6. BOTTOM CALL TO ACTION BAR ===== */
    .about-cta-bar-gold {
        background: var(--sr-gradient-gold);
        border-radius: 18px;
        padding: 22px 30px;
        margin-top: 60px;
        box-shadow: 0 15px 40px rgba(255, 184, 0, 0.35);
        color: #071326;
    }

    .cta-phone-icon-circle {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: rgba(7, 19, 38, 0.12);
        border: 1px solid rgba(7, 19, 38, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #071326;
        font-size: 18px;
    }

    .cta-text-box h5 {
        font-size: 16px;
        font-weight: 900;
        color: #071326;
        margin-bottom: 2px;
    }

    .cta-text-box p {
        font-size: 12.5px;
        color: rgba(7, 19, 38, 0.8);
        margin: 0;
        font-weight: 600;
    }

    .btn-cta-dark {
        background: #071326;
        color: #FFFFFF !important;
        border: none;
        border-radius: 12px;
        padding: 12px 24px;
        font-weight: 800;
        font-size: 13.5px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.25s ease;
    }

    .btn-cta-dark:hover {
        background: #030812;
        transform: translateY(-2px);
    }

    .btn-cta-outline-dark {
        background: transparent;
        color: #071326 !important;
        border: 1.5px solid rgba(7, 19, 38, 0.4);
        border-radius: 12px;
        padding: 11px 24px;
        font-weight: 800;
        font-size: 13.5px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.25s ease;
    }

    .btn-cta-outline-dark:hover {
        background: rgba(7, 19, 38, 0.1);
        border-color: #071326;
        transform: translateY(-2px);
    }

    /* ===== RESPONSIVE MEDIA QUERIES ===== */
    @media (max-width: 1199.98px) {
        .values-grid-5 {
            grid-template-columns: repeat(3, 1fr);
        }
        .about-stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .about-stat-item:nth-child(2) {
            border-right: none;
        }
    }

    @media (max-width: 991.98px) {
        .story-visual-wrap {
            margin-bottom: 40px;
            padding-right: 20px;
        }
        .story-pillars-grid {
            grid-template-columns: 1fr;
        }
        .values-grid-5 {
            grid-template-columns: repeat(2, 1fr);
        }
        .mission-img-holder {
            min-height: 240px;
        }
    }

    @media (max-width: 575.98px) {
        .about-stats-grid {
            grid-template-columns: 1fr;
        }
        .about-stat-item {
            border-right: none !important;
            padding-right: 0 !important;
        }
        .values-grid-5 {
            grid-template-columns: 1fr;
        }
        .about-cta-bar-gold {
            padding: 20px;
        }
    }
</style>
@endpush

@section('content')
@php
    $storyPillars = $aboutPage?->story_pillars ?? [
        ['icon' => 'fas fa-users', 'title' => 'People First', 'description' => 'We treat every customer like a guest, not just a booking.'],
        ['icon' => 'fas fa-shield-halved', 'title' => 'Integrity', 'description' => 'Transparent pricing, honest service and no hidden surprises.'],
        ['icon' => 'fas fa-star', 'title' => 'Excellence', 'description' => 'From our drivers to our vehicles, we aim for excellence every time.'],
    ];
    $statsItems = $aboutPage?->stats ?? [
        ['icon' => 'fas fa-headset', 'number' => '24/7', 'label' => 'Service Available', 'description' => "We're here whenever you need us."],
        ['icon' => 'fas fa-shield-check', 'number' => '100%', 'label' => 'Commitment', 'description' => 'Your safety and comfort come first.'],
        ['icon' => 'fas fa-calendar-check', 'number' => 'On-Time', 'label' => 'Every Time', 'description' => 'We value your time as much as you do.'],
        ['icon' => 'fas fa-map-location-dot', 'number' => 'Across', 'label' => 'the UK', 'description' => 'From major airports to every city.'],
    ];
    $valuesItems = $aboutPage?->values ?? [
        ['icon' => 'fas fa-steering-wheel', 'title' => 'Safety', 'description' => 'We follow the highest standards to ensure every journey is safe and secure.'],
        ['icon' => 'fas fa-thumbs-up', 'title' => 'Reliability', 'description' => 'You can count on us for punctual pickups and smooth transfers.'],
        ['icon' => 'fas fa-user-tie', 'title' => 'Professionalism', 'description' => 'Our drivers are experienced, courteous and dedicated to providing the best service.'],
        ['icon' => 'fas fa-car-side', 'title' => 'Comfort', 'description' => 'Modern vehicles, well-maintained for a premium travel experience.'],
        ['icon' => 'fas fa-comment-dots', 'title' => 'Customer Care', 'description' => 'We listen, we care and we go the extra mile for our customers.'],
    ];
    $aboutImage = fn ($path, $fallback) => $path
        ? (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') ? $path : asset('storage/' . ltrim($path, '/')))
        : $fallback;
    $heroImage = $aboutImage($aboutPage?->hero_background_image, 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?q=80&w=1600&auto=format&fit=crop');
    $storyMainImage = $aboutImage($aboutPage?->story_main_image, 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?q=80&w=800&auto=format&fit=crop');
    $storyOverlapImage = $aboutImage($aboutPage?->story_overlap_image, 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?q=80&w=600&auto=format&fit=crop');
    $missionImage = $aboutImage($aboutPage?->mission_background_image, asset('images/about-mission-banner.jpg'));
@endphp
<div class="about-page-wrapper">

    {{-- ===== 1. HERO SECTION ===== --}}
    @if($aboutPage?->is_active ?? true)
    <section class="about-hero-section" style="background-image: linear-gradient(180deg, rgba(7, 19, 38, 0.92) 0%, rgba(3, 8, 18, 0.96) 100%), url('{{ $heroImage }}');">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <span class="about-tag">{{ $aboutPage?->hero_tag ?? 'ABOUT US' }}</span>
                    <h1 class="about-hero-title">{{ $aboutPage?->hero_heading ?? 'Driven by Values.' }}</h1>
                    <div class="about-hero-subtitle">Focused on <span class="gold-text">{{ $aboutPage?->hero_highlight_text ?? 'You.' }}</span></div>
                    <p class="about-hero-desc">
                        {!! $aboutPage?->hero_subtitle ?? 'Swift-Ride-taxis was built with a simple mission — to redefine airport transfers in the UK with professionalism, reliability and a customer-first approach.' !!}
                    </p>
                </div>

            </div>
        </div>
    </section>
    @endif

    {{-- ===== 2. OUR STORY SECTION ===== --}}
    @if($aboutPage?->is_active ?? true)
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <!-- Left: Overlapping Images Composition -->
                <div class="col-lg-6">
                    <div class="story-visual-wrap">
                        <img src="{{ $storyMainImage }}" alt="Airport Terminal View" class="story-img-main">
                        <img src="{{ $storyOverlapImage }}" alt="Chauffeur Chaperone" class="story-img-overlap">
                        <div class="badge-customer-first">
                            <span>{{ $aboutPage?->story_badge_text ?? 'CUSTOMER FIRST APPROACH' }}</span>
                            <i class="fas fa-heart"></i>
                        </div>
                    </div>
                </div>

                <!-- Right: Content -->
                <div class="col-lg-6">
                    <div class="story-content">
                        <span class="about-tag">{{ $aboutPage?->story_eyebrow ?? 'OUR STORY' }}</span>
                        <h2>{{ $aboutPage?->story_heading ?? 'The Journey Behind Swift-Ride-taxis' }}</h2>
                        <p>
                            {!! $aboutPage?->story_paragraph_1 ?? 'We understand that travelling can be stressful. From flight delays to last-minute changes, you need a transfer service you can rely on.' !!}
                        </p>
                        <p>
                            {!! $aboutPage?->story_paragraph_2 ?? 'That\'s why we focus on punctuality, comfort and peace of mind — ensuring every journey is smooth from the moment you book with us.' !!}
                        </p>

                        <!-- 3 Pillars Grid -->
                        <div class="story-pillars-grid">
                            @foreach($storyPillars as $pillar)
                            <div class="pillar-box">
                                <div class="pillar-icon-circle"><i class="{{ $pillar['icon'] ?? 'fas fa-star' }}"></i></div>
                                <h5>{{ $pillar['title'] ?? '' }}</h5>
                                <p>{{ $pillar['description'] ?? '' }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== 3. KEY STATS CAPSULE BAR ===== --}}
            @if($aboutPage?->stats_visible ?? true)
            <div class="about-stats-capsule-bar">
                <div class="about-stats-grid">
                    @foreach($statsItems as $stat)
                    <div class="about-stat-item">
                        <div class="about-stat-icon-circle"><i class="{{ $stat['icon'] ?? 'fas fa-chart-bar' }}"></i></div>
                        <div class="about-stat-text">
                            <h3>{{ $stat['number'] ?? '' }}</h3>
                            <h6>{{ $stat['label'] ?? '' }}</h6>
                            <p>{{ $stat['description'] ?? '' }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- ===== 4. OUR VALUES GRID ===== --}}
            @if($aboutPage?->values_visible ?? true)
            <div class="text-center mt-5 pt-3">
                <span class="about-tag">{{ $aboutPage?->values_eyebrow ?? 'OUR VALUES' }}</span>
                <h2 class="font-display fw-black text-dark display-5">{{ $aboutPage?->values_heading ?? 'What Drives Us Every Day' }}</h2>
            </div>

            <div class="values-grid-5">
                @foreach($valuesItems as $value)
                <div class="value-card-white">
                    <div class="value-icon-circle"><i class="{{ $value['icon'] ?? 'fas fa-star' }}"></i></div>
                    <h4>{{ $value['title'] ?? '' }}</h4>
                    <p>{{ $value['description'] ?? '' }}</p>
                </div>
                @endforeach
            </div>
            @endif

            {{-- ===== 5. OUR MISSION CARD ===== --}}
            @if($aboutPage?->mission_visible ?? true)
            <div class="mission-card-banner" style="background-image: linear-gradient(90deg, rgba(7, 17, 32, 0.96), rgba(7, 17, 32, 0.65)), url('{{ $missionImage }}');">
                <div class="mission-text-container">
                    <span class="about-tag">{{ $aboutPage?->mission_eyebrow ?? 'OUR MISSION' }}</span>
                    <h3>{{ $aboutPage?->mission_heading ?? "To be the UK's most trusted airport transfer company" }}</h3>
                    @if($aboutPage?->mission_description)
                    <p>{!! $aboutPage->mission_description !!}</p>
                    @endif
                </div>
            </div>
            @endif

            {{-- ===== 6. BOTTOM CALL TO ACTION BAR ===== --}}
            @if($aboutPage?->cta_visible ?? true)
            <div class="about-cta-bar-gold">
                <div class="row align-items-center g-3">
                    <div class="col-md-5 d-flex align-items-center gap-3">
                        <div class="cta-phone-icon-circle"><i class="fas fa-headset"></i></div>
                        <div class="cta-text-box">
                            <h5>{{ $aboutPage?->cta_heading ?? 'Have Questions?' }}</h5>
                            <p>{{ $aboutPage?->cta_subheading ?? "We're here to help 24/7" }}</p>
                        </div>
                    </div>
                    <div class="col-md-7 text-md-end d-flex align-items-center justify-content-md-end gap-3 flex-wrap">
                        <a href="tel:{{ $aboutPage?->cta_phone_number ?? '02012345678' }}" class="btn-cta-dark">
                            <i class="fas fa-phone-alt me-1"></i> {{ $aboutPage?->cta_phone_label ?? 'CALL 020 1234 5678' }}
                        </a>
                        <a href="{{ $aboutPage?->cta_button_url ?? route('contact') }}" class="btn-cta-outline-dark">
                            {{ $aboutPage?->cta_button_text ?? 'GET IN TOUCH' }} <i class="fas fa-arrow-right me-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
    @endif
</div>
@endsection