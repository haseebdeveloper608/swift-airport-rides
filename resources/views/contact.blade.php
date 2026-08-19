@extends('layout.app')

@php
    $siteSettings = \App\Models\Setting::first();
    $siteName = $siteSettings->site_name ?? 'Swift-Ride-taxis';
    $companyPhone = $siteSettings->company_phone ?? '020 1234 5678';
    $companyEmail = $siteSettings->company_email ?? 'info@cityairportrides.co.uk';
    $companyAddress = $siteSettings->company_address ?? 'London, United Kingdom';
    $footerAbout = $siteSettings->footer_about ?? 'Our support team is ready to assist you anytime, anywhere.';
@endphp

@section('title', 'Contact Us | ' . $siteName . ' - 24/7 Premium Support')
@section('meta_description', 'Contact ' . $siteName . ' for 24/7 airport transfer support, quotes, and booking inquiries. Call ' . $companyPhone . ' or send us a message.')

@push('styles')
<style>
    /* ==========================================================================
       CONTACT PAGE - EXACT REFERENCE DESIGN STYLES
       ========================================================================== */

    /* Fallback token: layout.app defines --sr-gradient (purple/blue) but not a
       gold gradient. Define it here so this page works even if layout.app
       hasn't been updated yet. Safe to remove once --sr-gradient-gold /
       --sr-gold exist globally in layout.app's :root. */
    .contact-page-wrapper {

        padding-bottom: 80px;
        font-family: var(--sr-font-body);
    }

    /* ===== 1. HERO SECTION ===== */
    .contact-hero-section {
        position: relative;
        padding: 120px 0 40px;
        background: linear-gradient(180deg, rgba(3, 8, 18, 0.6) 0%, #030812 100%),
                    url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat;
        overflow: hidden;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    }

    .contact-hero-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 70% 50%, rgba(91, 61, 245, 0.15) 0%, transparent 60%);
        pointer-events: none;
    }

    .contact-hero-tag {
        font-size: 13px;
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #FFB800;
        margin-bottom: 12px;
        display: inline-block;
    }

    .contact-hero-title {
        font-family: var(--sr-font-display);
        font-size: clamp(2.8rem, 5vw, 4.2rem);
        font-weight: 900;
        color: #FFFFFF;
        line-height: 1.1;
        margin-bottom: 8px;
    }

    .contact-hero-subtitle {
        font-family: var(--sr-font-display);
        font-size: clamp(2.2rem, 4vw, 3.5rem);
        font-weight: 800;
        background: linear-gradient(135deg, #FFFFFF 0%, #A9B6FF 50%, #FFB800 100%);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 20px;
    }

    .contact-hero-desc {
        color: rgba(255, 255, 255, 0.75);
        font-size: 15.5px;
        line-height: 1.6;
        max-width: 520px;
        margin-bottom: 30px;
    }

    .support-avatars-row {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .avatar-group {
        display: flex;
        align-items: center;
    }

    .avatar-group img {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        border: 2px solid #030812;
        margin-left: -12px;
        object-fit: cover;
    }

    .avatar-group img:first-child {
        margin-left: 0;
    }

    .avatar-text {
        font-size: 13px;
        color: rgba(255, 255, 255, 0.8);
        font-weight: 600;
        line-height: 1.35;
        max-width: 220px;
    }

    .hero-car-img {
        width: 100%;
        max-width: 620px;
        filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.6));
    }

    /* ===== 2. CONTACT INFO CAPSULE GRID ===== */
    .contact-info-capsule-bar {
        background: #071120;
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 20px;
        padding: 24px 30px;
        margin: 40px 0 60px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
    }

    .contact-info-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 20px;
    }

    .contact-info-item {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .contact-info-icon-circle {
        width: 46px;
        height: 46px;
        min-width: 46px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #FFB800;
        font-size: 18px;
        transition: all 0.3s ease;
    }

    .contact-info-item:hover .contact-info-icon-circle {
        background: var(--sr-gradient);
        color: #FFFFFF;
        border-color: transparent;
        transform: translateY(-2px);
    }

    .contact-info-text h6 {
        font-size: 12px;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.6);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }

    .contact-info-text strong {
        display: block;
        font-size: 14px;
        font-weight: 800;
        color: #FFFFFF;
        line-height: 1.25;
    }

    .contact-info-text span {
        font-size: 11px;
        color: rgba(255, 255, 255, 0.5);
    }

    /* ===== 3. MAIN SECTION (FORM & FIND US) ===== */
    .contact-card-white {
        background: #FFFFFF;
        color: #071326;
        border-radius: 24px;
        padding: 36px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
        height: 100%;
    }

    .contact-card-white h3 {
        font-family: var(--sr-font-display);
        font-size: 24px;
        font-weight: 900;
        color: #071326;
        margin-bottom: 6px;
    }

    .contact-card-white p.subtext {
        font-size: 13.5px;
        color: #64748B;
        margin-bottom: 28px;
    }

    .form-input-group {
        position: relative;
        margin-bottom: 18px;
    }

    .form-input-group i.input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #94A3B8;
        font-size: 15px;
        pointer-events: none;
    }

    .form-input-group textarea + i.input-icon {
        top: 20px;
        transform: none;
    }

    .form-input-group input,
    .form-input-group select,
    .form-input-group textarea {
        width: 100%;
        background: #F8FAFC;
        border: 1.5px solid #E2E8F0;
        border-radius: 12px;
        padding: 13px 16px 13px 44px;
        font-size: 14px;
        color: #0F172A;
        font-family: inherit;
        outline: none;
        transition: all 0.2s ease;
    }

    .form-input-group textarea {
        min-height: 120px;
        resize: vertical;
    }

    .form-input-group input:focus,
    .form-input-group select:focus,
    .form-input-group textarea:focus {
        border-color: #4A6CFE;
        background: #FFFFFF;
        box-shadow: 0 0 0 4px rgba(74, 108, 254, 0.15);
    }

    .btn-send-message {
        background: var(--sr-gradient-gold);
        color: #071326;
        border: none;
        border-radius: 12px;
        padding: 14px 28px;
        font-weight: 800;
        font-size: 14px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        transition: all 0.25s ease;
        box-shadow: 0 8px 24px rgba(255, 184, 0, 0.3);
    }

    .btn-send-message:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(255, 184, 0, 0.45);
    }

    .security-note {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #64748B;
        font-size: 12.5px;
    }

    .security-note i {
        color: #10B981;
        font-size: 16px;
    }

    .contact-form-status {
        display: none;
        align-items: flex-start;
        gap: 10px;
        border-radius: 12px;
        padding: 13px 15px;
        margin-bottom: 20px;
        font-size: 13px;
        line-height: 1.5;
    }

    .contact-form-status.show {
        display: flex;
    }

    .contact-form-status.success {
        color: #166534;
        background: #F0FDF4;
        border: 1px solid #BBF7D0;
    }

    .contact-form-status.error {
        color: #991B1B;
        background: #FEF2F2;
        border: 1px solid #FECACA;
    }

    .btn-send-message.is-loading {
        opacity: .7;
        pointer-events: none;
    }

    /* Map Box */
    .map-preview-box {
        width: 100%;
        height: 220px;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #E2E8F0;
        margin-bottom: 24px;
        position: relative;
    }

    .map-preview-box iframe {
        width: 100%;
        height: 100%;
        border: 0;
    }

    .office-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        align-items: center;
    }

    .office-address-box h5 {
        font-weight: 800;
        font-size: 16px;
        color: #071326;
        margin-bottom: 6px;
    }

    .office-address-box p {
        font-size: 13.5px;
        color: #64748B;
        line-height: 1.5;
        margin: 0;
    }

    .office-thumb-img {
        width: 100%;
        height: 120px;
        object-fit: cover;
        border-radius: 14px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    /* ===== 4. LOWER SECTION (FAQ & WHY CONTACT US) ===== */
    .contact-card-dark {
        background: #071120;
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 24px;
        padding: 36px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
        height: 100%;
    }

    .contact-card-dark h3 {
        font-family: var(--sr-font-display);
        font-size: 22px;
        font-weight: 800;
        color: #FFFFFF;
        margin-bottom: 24px;
    }

    /* Accordion */
    .faq-accordion-item {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.07);
        border-radius: 12px;
        margin-bottom: 12px;
        overflow: hidden;
        transition: all 0.2s ease;
    }

    .faq-accordion-header {
        padding: 16px 20px;
        font-size: 14.5px;
        font-weight: 700;
        color: #FFFFFF;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .faq-accordion-header i.chevron-icon {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.5);
        transition: transform 0.3s ease;
    }

    .faq-accordion-body {
        padding: 0 20px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease, padding 0.3s ease;
        font-size: 13.5px;
        color: rgba(255, 255, 255, 0.7);
        line-height: 1.6;
    }

    .faq-accordion-item.active {
        background: rgba(61, 123, 255, 0.08);
        border-color: rgba(61, 123, 255, 0.3);
    }

    .faq-accordion-item.active .faq-accordion-header {
        color: #3D7BFF;
    }

    .faq-accordion-item.active .faq-accordion-header i.chevron-icon {
        transform: rotate(180deg);
        color: #3D7BFF;
    }

    .faq-accordion-item.active .faq-accordion-body {
        padding: 0 20px 18px;
        max-height: 200px;
    }

    .btn-view-all-faqs {
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #FFFFFF !important;
        border-radius: 10px;
        padding: 10px 20px;
        font-size: 12.5px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 14px;
        transition: all 0.2s ease;
    }

    .btn-view-all-faqs:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: #FFFFFF;
    }

    /* Why Contact Grid */
    .why-contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .why-contact-box {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.07);
        border-radius: 16px;
        padding: 22px 18px;
        transition: all 0.3s ease;
    }

    .why-contact-box:hover {
        background: rgba(91, 61, 245, 0.1);
        border-color: rgba(91, 61, 245, 0.3);
        transform: translateY(-3px);
    }

    .why-icon-circle {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: rgba(255, 184, 0, 0.12);
        border: 1px solid rgba(255, 184, 0, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #FFB800;
        font-size: 16px;
        margin-bottom: 14px;
    }

    .why-contact-box h5 {
        font-size: 15px;
        font-weight: 800;
        color: #FFFFFF;
        margin-bottom: 6px;
    }

    .why-contact-box p {
        font-size: 12.5px;
        color: rgba(255, 255, 255, 0.65);
        line-height: 1.5;
        margin: 0;
    }

    /* ===== 5. IMMEDIATE ASSISTANCE BANNER ===== */
    .immediate-assistance-banner {
        background: linear-gradient(135deg, #071326 0%, #0B1930 100%);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 24px 30px;
        margin-top: 60px;
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.4);
    }

    .banner-car-thumb {
        width: 100%;
        max-width: 240px;
        height: 110px;
        object-fit: cover;
        border-radius: 14px;
    }

    .banner-content h4 {
        font-family: var(--sr-font-display);
        font-size: 22px;
        font-weight: 800;
        color: #FFFFFF;
        margin-bottom: 4px;
    }

    .banner-content p {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
    }

    .call-us-capsule-btn {
        background: rgba(255, 255, 255, 0.04);
        border: 1.5px solid rgba(255, 184, 0, 0.4);
        border-radius: 16px;
        padding: 14px 24px;
        display: flex;
        align-items: center;
        gap: 14px;
        color: #FFFFFF;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .call-us-capsule-btn:hover {
        background: rgba(255, 184, 0, 0.12);
        border-color: #FFB800;
        transform: scale(1.02);
    }

    .call-us-icon-circle {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #FFB800;
        color: #071326;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .call-us-info h6 {
        font-size: 11px;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.6);
        text-transform: uppercase;
        margin-bottom: 2px;
    }

    .call-us-info strong {
        font-size: 17px;
        font-weight: 900;
        color: #FFFFFF;
        display: block;
        line-height: 1.1;
    }

    .call-us-info span {
        font-size: 11px;
        color: #FFB800;
    }

    /* ===== RESPONSIVE MEDIA QUERIES ===== */
    @media (max-width: 1199.98px) {
        .contact-info-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 991.98px) {
        .contact-info-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .hero-car-img {
            margin-top: 30px;
        }
        .why-contact-grid {
            grid-template-columns: 1fr;
        }
        .office-info-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 575.98px) {
        .contact-info-grid {
            grid-template-columns: 1fr;
        }
        .contact-card-white,
        .contact-card-dark {
            padding: 24px 18px;
        }
        .immediate-assistance-banner {
            padding: 20px;
        }
    }
</style>
@endpush

@section('content')
<div class="contact-page-wrapper">
    
    {{-- ===== 1. HERO SECTION ===== --}}
    <section class="contact-hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <span class="contact-hero-tag">GET IN TOUCH</span>
                    <h1 class="contact-hero-title">Contact Us</h1>
                    <div class="contact-hero-subtitle">We're Here To Help</div>
                    <p class="contact-hero-desc">
                        Have a question or need assistance with your booking? Our team is available 24/7 to help you with all your airport transfer needs.
                    </p>
                    <div class="support-avatars-row">
                        <div class="avatar-group">
                            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=120&auto=format&fit=crop" alt="Support Agent 1">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=120&auto=format&fit=crop" alt="Support Agent 2">
                            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=120&auto=format&fit=crop" alt="Support Agent 3">
                            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=120&auto=format&fit=crop" alt="Support Agent 4">
                        </div>
                        <div class="avatar-text">
                            {{ $footerAbout }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== 2. CONTACT INFO CAPSULE GRID ===== --}}
            <div class="contact-info-capsule-bar">
                <div class="contact-info-grid">
                    <!-- Call Us -->
                    <div class="contact-info-item">
                        <div class="contact-info-icon-circle"><i class="fas fa-phone-alt"></i></div>
                        <div class="contact-info-text">
                            <h6>Call Us 24/7</h6>
                            <strong>{{ $companyPhone }}</strong>
                            <span>We're always here</span>
                        </div>
                    </div>
                    <!-- WhatsApp -->
                    <div class="contact-info-item">
                        <div class="contact-info-icon-circle"><i class="fab fa-whatsapp"></i></div>
                        <div class="contact-info-text">
                            <h6>WhatsApp</h6>
                            <strong>{{ $companyPhone }}</strong>
                            <span>Quick replies on WhatsApp</span>
                        </div>
                    </div>
                    <!-- Email -->
                    <div class="contact-info-item">
                        <div class="contact-info-icon-circle"><i class="fas fa-envelope"></i></div>
                        <div class="contact-info-text">
                            <h6>Email Us</h6>
                            <strong>{{ $companyEmail }}</strong>
                            <span>We reply within minutes</span>
                        </div>
                    </div>
                    <!-- Location -->
                    <div class="contact-info-item">
                        <div class="contact-info-icon-circle"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="contact-info-text">
                            <h6>Our Location</h6>
                            <strong>{{ $companyAddress }}</strong>
                            <span>UK Wide Service</span>
                        </div>
                    </div>
                    <!-- Hours -->
                    <div class="contact-info-item">
                        <div class="contact-info-icon-circle"><i class="fas fa-clock"></i></div>
                        <div class="contact-info-text">
                            <h6>Working Hours</h6>
                            <strong>24 Hours a Day</strong>
                            <span>7 Days a Week</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== 3. MAIN SECTION: FORM & FIND US ===== --}}
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Left: Form Card -->
                <div class="col-lg-6">
                    <div class="contact-card-white">
                        <h3>Send Us A Message</h3>
                        <p class="subtext">Fill out the form below and we'll get back to you shortly.</p>

                        <div id="contactFormStatus" class="contact-form-status" role="status" aria-live="polite"></div>

                        <form action="{{ route('contact.store') }}" method="POST" id="contactForm">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-input-group">
                                        <i class="fas fa-user input-icon"></i>
                                        <input type="text" name="first_name" placeholder="Full Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-input-group">
                                        <i class="fas fa-phone input-icon"></i>
                                        <input type="tel" name="phone" placeholder="Phone Number">
                                    </div>
                                </div>
                            </div>

                            <div class="form-input-group">
                                <i class="fas fa-envelope input-icon"></i>
                                <input type="email" name="email" placeholder="Email Address" required>
                            </div>

                            <div class="form-input-group">
                                <i class="fas fa-tag input-icon"></i>
                                <input type="text" name="subject" placeholder="Subject" required>
                            </div>

                            <div class="form-input-group">
                                <i class="fas fa-comment-dots input-icon"></i>
                                <textarea name="message" placeholder="Your Message" required></textarea>
                            </div>

                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mt-4">
                                <button type="submit" class="btn-send-message" id="contactSubmitButton">
                                    SEND MESSAGE <i class="fas fa-arrow-up-right-from-square ms-1"></i>
                                </button>

                                <div class="security-note">
                                    <i class="fas fa-shield-alt"></i>
                                    <span>Your information is secure and will never be shared.</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right: Find Us Card -->
                <div class="col-lg-6">
                    <div class="contact-card-white">
                        <h3>Find Us</h3>
                        <p class="subtext">Visit our main office or reach out to our UK wide operations team.</p>

                        <div class="map-preview-box">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d158858.4734000083!2d-0.2416813!3d51.5073509!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondon%2C%20UK!5e0!3m2!1sen!2suk!4v1700000000000!5m2!1sen!2suk" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>

                        <div class="office-info-grid">
                            <div class="office-address-box">
                                <h5>Visit Our Office</h5>
                                <p><strong>{{ $siteName }}</strong><br>
                                {{ $companyAddress }}</p>
                            </div>
                            <div>
                                <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=600&auto=format&fit=crop" alt="Swift-Ride-taxis Office" class="office-thumb-img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== 4. LOWER SECTION: FAQ & WHY CONTACT US ===== --}}
            <div class="row g-4 mt-4">
                <!-- Left: FAQ Card -->
                <div class="col-lg-6">
                    <div class="contact-card-dark">
                        <h3>Frequently Asked Questions</h3>

                        <div class="faq-accordion-item active">
                            <div class="faq-accordion-header">
                                <span>How can I get a quote?</span>
                                <i class="fas fa-chevron-down chevron-icon"></i>
                            </div>
                            <div class="faq-accordion-body">
                                Simply enter your pickup and dropoff location on our homepage quote engine, select your vehicle type, and instantly view guaranteed fixed prices.
                            </div>
                        </div>

                        <div class="faq-accordion-item">
                            <div class="faq-accordion-header">
                                <span>Can I change my booking?</span>
                                <i class="fas fa-chevron-down chevron-icon"></i>
                            </div>
                            <div class="faq-accordion-body">
                                Yes, free modifications can be made up to 12 hours prior to your scheduled pickup time by contacting our 24/7 support team with your booking ID.
                            </div>
                        </div>

                        <div class="faq-accordion-item">
                            <div class="faq-accordion-header">
                                <span>Do you provide 24/7 service?</span>
                                <i class="fas fa-chevron-down chevron-icon"></i>
                            </div>
                            <div class="faq-accordion-body">
                                Absolutely. Our drivers and customer service representatives operate 24 hours a day, 365 days a year across all major UK airports and cities.
                            </div>
                        </div>

                        <div class="faq-accordion-item">
                            <div class="faq-accordion-header">
                                <span>How will I find my driver at the airport?</span>
                                <i class="fas fa-chevron-down chevron-icon"></i>
                            </div>
                            <div class="faq-accordion-body">
                                Your driver will greet you in the arrivals hall holding a personalized name board, assist with your luggage, and escort you directly to your vehicle.
                            </div>
                        </div>

                        <div class="faq-accordion-item">
                            <div class="faq-accordion-header">
                                <span>What payment methods do you accept?</span>
                                <i class="fas fa-chevron-down chevron-icon"></i>
                            </div>
                            <div class="faq-accordion-body">
                                We accept all major credit/debit cards (Visa, MasterCard, American Express), Apple Pay, Google Pay, and secure online Stripe checkouts.
                            </div>
                        </div>

                        <a href="{{ route('faqs') }}" class="btn-view-all-faqs">
                            VIEW ALL FAQS <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Right: Why Contact Us Card -->
                <div class="col-lg-6">
                    <div class="contact-card-dark">
                        <h3>Why Contact {{ $siteName }}?</h3>

                        <div class="why-contact-grid">
                            <!-- Quick Response -->
                            <div class="why-contact-box">
                                <div class="why-icon-circle"><i class="fas fa-bolt"></i></div>
                                <h5>Quick Response</h5>
                                <p>We respond to all inquiries within minutes.</p>
                            </div>

                            <!-- 24/7 Availability -->
                            <div class="why-contact-box">
                                <div class="why-icon-circle"><i class="fas fa-clock"></i></div>
                                <h5>24/7 Availability</h5>
                                <p>Our team is available around the clock to assist you.</p>
                            </div>

                            <!-- Expert Support -->
                            <div class="why-contact-box">
                                <div class="why-icon-circle"><i class="fas fa-user-shield"></i></div>
                                <h5>Expert Support</h5>
                                <p>Get professional help from our experienced team.</p>
                            </div>

                            <!-- Reliable Service -->
                            <div class="why-contact-box">
                                <div class="why-icon-circle"><i class="fas fa-shield-alt"></i></div>
                                <h5>Reliable Service</h5>
                                <p>We are committed to providing the best service.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== 5. IMMEDIATE ASSISTANCE BANNER ===== --}}
            <div class="immediate-assistance-banner">
                <div class="row align-items-center g-4">
                    <div class="col-md-3 col-lg-3 text-center text-md-start">
                        <img src="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?q=80&w=400&auto=format&fit=crop" alt="Luxury Interior" class="banner-car-thumb">
                    </div>
                    <div class="col-md-5 col-lg-6">
                        <div class="banner-content text-center text-md-start">
                            <h4>Need Immediate Assistance?</h4>
                            <p>Call us now for instant support and speak with our customer service team.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3 text-center text-md-end">
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $companyPhone) }}" class="call-us-capsule-btn d-inline-flex">
                            <div class="call-us-icon-circle"><i class="fas fa-phone-alt"></i></div>
                            <div class="call-us-info text-start">
                                <h6>Call Us Now</h6>
                                <strong>{{ $companyPhone }}</strong>
                                <span>Available 24/7</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const contactForm = document.getElementById('contactForm');
        const contactStatus = document.getElementById('contactFormStatus');
        const contactSubmitButton = document.getElementById('contactSubmitButton');

        function showContactStatus(type, message) {
            if (!contactStatus) return;

            contactStatus.className = 'contact-form-status show ' + type;
            contactStatus.innerHTML = '<i class="fas ' + (type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle') + '"></i><span>' + message + '</span>';
        }

        if (contactForm) {
            contactForm.addEventListener('submit', async function (event) {
                event.preventDefault();

                if (!contactForm.checkValidity()) {
                    contactForm.reportValidity();
                    return;
                }

                const originalButtonHtml = contactSubmitButton.innerHTML;
                contactSubmitButton.classList.add('is-loading');
                contactSubmitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
                contactStatus.className = 'contact-form-status';

                try {
                    const response = await fetch(contactForm.action, {
                        method: 'POST',
                        body: new FormData(contactForm),
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const result = await response.json();

                    if (!response.ok) {
                        const validationMessages = result.errors
                            ? Object.values(result.errors).flat().join(' ')
                            : (result.message || 'Please check the form and try again.');
                        throw new Error(validationMessages);
                    }

                    contactForm.reset();
                    showContactStatus('success', 'Thank you! Your message has been sent successfully. Our team will get back to you shortly.');
                } catch (error) {
                    showContactStatus('error', error.message || 'Something went wrong. Please try again.');
                } finally {
                    contactSubmitButton.classList.remove('is-loading');
                    contactSubmitButton.innerHTML = originalButtonHtml;
                }
            });
        }

        // Accordion Toggle Logic
        const faqItems = document.querySelectorAll('.faq-accordion-item');
        faqItems.forEach(item => {
            const header = item.querySelector('.faq-accordion-header');
            header.addEventListener('click', () => {
                const isActive = item.classList.contains('active');
                faqItems.forEach(i => i.classList.remove('active'));
                if (!isActive) {
                    item.classList.add('active');
                }
            });
        });
    });
</script>
@endpush