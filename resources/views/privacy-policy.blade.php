@extends('layout.app')

@section('title', 'Privacy Policy | Swift-Ride-taxis')
@section('meta_description', 'Privacy Policy for Swift-Ride-taxis. Learn how we collect, use, protect, and handle your personal data.')

@push('styles')
<style>
    /* ==========================================================================
       PRIVACY POLICY - MODERN REDESIGN (#5744F6 ACCENT)
       ========================================================================== */
    .legal-page-wrapper {
        background-color: #F8FAFC;
        color: #071326;
        min-height: 100vh;
        font-family: var(--sr-font-body);
    }

    /* ===== HERO BANNER ===== */
    .legal-hero-section {
        position: relative;
        padding: 140px 0 70px;
        background: linear-gradient(180deg, rgba(7, 19, 38, 0.94) 0%, rgba(3, 8, 18, 0.97) 100%),
                    url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat;
        overflow: hidden;
        color: #FFFFFF;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .legal-tag {
        font-size: 13px;
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #5744F6;
        margin-bottom: 12px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .legal-tag::after {
        content: '';
        display: inline-block;
        width: 30px;
        height: 1.5px;
        background: #5744F6;
    }

    .legal-hero-title {
        font-family: var(--sr-font-display);
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 900;
        color: #FFFFFF;
        line-height: 1.1;
        margin-bottom: 14px;
    }

    .legal-hero-subtitle {
        color: rgba(255, 255, 255, 0.75);
        font-size: 16px;
        line-height: 1.65;
        max-width: 600px;
        margin: 0 auto 24px;
    }

    .legal-hero-meta {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.7);
        flex-wrap: wrap;
        margin-bottom: 24px;
        font-weight: 600;
    }

    .legal-hero-meta i {
        color: #5744F6;
    }

    .legal-hero-breadcrumb {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.6);
    }

    .legal-hero-breadcrumb a {
        color: #5744F6;
        transition: color 0.2s ease;
    }

    .legal-hero-breadcrumb a:hover {
        color: #FFFFFF;
    }

    /* ===== LAYOUT ===== */
    .legal-container-layout {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 40px;
        padding: 70px 0 90px;
        align-items: start;
    }

    /* TOC SIDEBAR */
    .toc-sidebar-widget {
        position: sticky;
        top: 100px;
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
    }

    .toc-sidebar-widget h4 {
        font-size: 12px;
        font-weight: 800;
        color: #94A3B8;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .toc-sidebar-widget h4 i {
        color: #5744F6;
    }

    .toc-nav-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .toc-nav-list li {
        margin-bottom: 4px;
    }

    .toc-nav-list a {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13.5px;
        color: #475569;
        text-decoration: none;
        padding: 9px 14px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .toc-nav-list a i {
        font-size: 10px;
        color: #5744F6;
        opacity: 0.6;
    }

    .toc-nav-list a:hover,
    .toc-nav-list a.active {
        background: #F0EEFF;
        color: #5744F6;
    }

    .toc-nav-list a:hover i,
    .toc-nav-list a.active i {
        opacity: 1;
    }

    /* CONTENT SECTIONS */
    .legal-content-main {
        min-width: 0;
    }

    .legal-card-section {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 24px;
        padding: 36px 40px;
        margin-bottom: 24px;
        scroll-margin-top: 110px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
    }

    .section-head-flex {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 22px;
        padding-bottom: 18px;
        border-bottom: 1px solid #F1F5F9;
    }

    .section-icon-box {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 14px;
        background: #F0EEFF;
        border: 1px solid rgba(87, 68, 246, 0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #5744F6;
        font-size: 20px;
    }

    .section-head-flex h2 {
        font-family: var(--sr-font-display);
        font-size: 22px;
        font-weight: 800;
        color: #071326;
        margin: 0 0 3px;
    }

    .section-head-flex p {
        font-size: 13px;
        color: #64748B;
        margin: 0;
    }

    .legal-card-section p {
        font-size: 14.5px;
        color: #475569;
        line-height: 1.8;
        margin-bottom: 16px;
    }

    .legal-card-section p:last-child {
        margin-bottom: 0;
    }

    .legal-list-styled {
        list-style: none;
        padding: 0;
        margin: 0 0 18px;
    }

    .legal-list-styled li {
        font-size: 14px;
        color: #475569;
        line-height: 1.7;
        padding: 8px 0 8px 28px;
        position: relative;
        border-bottom: 1px solid #F1F5F9;
    }

    .legal-list-styled li:last-child {
        border-bottom: none;
    }

    .legal-list-styled li::before {
        content: '\f00c';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        position: absolute;
        left: 0;
        top: 8px;
        color: #5744F6;
        font-size: 12px;
    }

    .highlight-purple-box {
        background: #F0EEFF;
        border: 1px solid rgba(87, 68, 246, 0.25);
        border-radius: 14px;
        padding: 18px 22px;
        margin: 20px 0;
        font-size: 14px;
        color: #311B92;
        line-height: 1.7;
        display: flex;
        gap: 14px;
        align-items: flex-start;
    }

    .highlight-purple-box i {
        font-size: 18px;
        color: #5744F6;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .contact-cta-box {
        background: #071326;
        border-radius: 20px;
        padding: 30px 36px;
        margin-top: 20px;
        color: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
    }

    .contact-cta-box h4 {
        font-size: 18px;
        font-weight: 800;
        color: #FFFFFF;
        margin-bottom: 4px;
    }

    .contact-cta-box p {
        font-size: 13.5px;
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
    }

    .btn-contact-legal {
        background: #5744F6;
        color: #FFFFFF !important;
        border: none;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 800;
        font-size: 13.5px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.25s ease;
    }

    .btn-contact-legal:hover {
        background: #4332d9;
        transform: translateY(-2px);
    }

    /* RESPONSIVE */
    @media (max-width: 991.98px) {
        .legal-container-layout {
            grid-template-columns: 1fr;
            padding: 40px 0 60px;
        }
        .toc-sidebar-widget {
            position: static;
        }
    }
</style>
@endpush

@section('content')
<div class="legal-page-wrapper">

    {{-- ===== HERO BANNER ===== --}}
    <section class="legal-hero-section text-center">
        <div class="container">
            <span class="legal-tag">LEGAL & COMPLIANCE</span>
            <h1 class="legal-hero-title">Privacy Policy</h1>
            <p class="legal-hero-subtitle">
                Learn how Swift-Ride-taxis collects, protects, uses, and safeguards your personal data when booking transfers with us.
            </p>
            <div class="legal-hero-meta">
                <span><i class="far fa-calendar-alt"></i> Effective Date: January 1, 2025</span>
                <span><i class="fas fa-building"></i> Swift-Ride-taxis</span>
                <span><i class="fas fa-shield-halved"></i> GDPR & UK Data Protection Compliant</span>
            </div>
            <div class="legal-hero-breadcrumb">
                <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
                <i class="fas fa-chevron-right text-white-50" style="font-size: 10px;"></i>
                <span class="text-white fw-semibold">Privacy Policy</span>
            </div>
        </div>
    </section>

    {{-- ===== MAIN CONTENT & TOC ===== --}}
    <div class="container">
        <div class="legal-container-layout">

            <!-- Sticky Sidebar TOC -->
            <aside class="toc-sidebar-widget">
                <h4><i class="fas fa-list"></i> Table of Contents</h4>
                <ul class="toc-nav-list">
                    <li><a href="#pp-overview"><i class="fas fa-chevron-right"></i> 1. Overview</a></li>
                    <li><a href="#pp-data-collected"><i class="fas fa-chevron-right"></i> 2. Data We Collect</a></li>
                    <li><a href="#pp-how-we-use"><i class="fas fa-chevron-right"></i> 3. How We Use Data</a></li>
                    <li><a href="#pp-sharing"><i class="fas fa-chevron-right"></i> 4. Sharing & Operators</a></li>
                    <li><a href="#pp-cookies"><i class="fas fa-chevron-right"></i> 5. Cookies & Analytics</a></li>
                    <li><a href="#pp-security"><i class="fas fa-chevron-right"></i> 6. Security Standards</a></li>
                    <li><a href="#pp-your-rights"><i class="fas fa-chevron-right"></i> 7. Your GDPR Rights</a></li>
                    <li><a href="#pp-contact"><i class="fas fa-chevron-right"></i> 8. Contact DPO</a></li>
                </ul>
            </aside>

            <!-- Legal Content -->
            <main class="legal-content-main">

                <div class="legal-card-section" id="pp-overview">
                    <div class="section-head-flex">
                        <div class="section-icon-box"><i class="fas fa-shield-heart"></i></div>
                        <div>
                            <h2>1. Overview & Commitment</h2>
                            <p>Our pledge to privacy and transparency</p>
                        </div>
                    </div>
                    <div class="highlight-purple-box">
                        <i class="fas fa-info-circle"></i>
                        <span>At <strong>Swift-Ride-taxis</strong>, your privacy is paramount. We handle your personal details strictly in accordance with UK Data Protection Act 2018 and UK GDPR regulations.</span>
                    </div>
                    <p>This Privacy Policy outlines how <strong>Swift-Ride-taxis</strong> collects, stores, processes, and protects your personal information when you use our website, mobile interface, or customer support services.</p>
                </div>

                <div class="legal-card-section" id="pp-data-collected">
                    <div class="section-head-flex">
                        <div class="section-icon-box"><i class="fas fa-folder-open"></i></div>
                        <div>
                            <h2>2. Information We Collect</h2>
                            <p>Data required to process your transfer bookings</p>
                        </div>
                    </div>
                    <p>When you book an airport transfer or interact with <strong>Swift-Ride-taxis</strong>, we collect:</p>
                    <ul class="legal-list-styled">
                        <li><strong>Contact Details:</strong> Full Name, Email Address, Phone Number, and Country Code.</li>
                        <li><strong>Trip Particulars:</strong> Pickup Location, Drop-off Destination, Flight Number, Date & Pickup Time.</li>
                        <li><strong>Payment Tokens:</strong> Encrypted payment transaction IDs processed securely via PCI-DSS compliant Stripe gateways.</li>
                        <li><strong>Technical Diagnostics:</strong> IP address, device type, browser settings, and location markers for fraud prevention.</li>
                    </ul>
                </div>

                <div class="legal-card-section" id="pp-how-we-use">
                    <div class="section-head-flex">
                        <div class="section-icon-box"><i class="fas fa-gears"></i></div>
                        <div>
                            <h2>3. How We Use Your Data</h2>
                            <p>Fulfilling your journey and service excellence</p>
                        </div>
                    </div>
                    <p>Your data is processed solely for legitimate operational needs:</p>
                    <ul class="legal-list-styled">
                        <li>To dispatch licensed drivers and send live SMS/Email journey updates.</li>
                        <li>To calculate fixed pricing, process driver payouts, and issue invoices.</li>
                        <li>To provide 24/7 customer support and flight status monitoring.</li>
                        <li>To comply with TfL / UK local authority licensing and audit obligations.</li>
                    </ul>
                </div>

                <div class="legal-card-section" id="pp-sharing">
                    <div class="section-head-flex">
                        <div class="section-icon-box"><i class="fas fa-user-group"></i></div>
                        <div>
                            <h2>4. Data Sharing & Drivers</h2>
                            <p>Strict access controls with licensed partners</p>
                        </div>
                    </div>
                    <p>We share minimal essential trip details (pickup address, flight number, passenger name, and contact number) strictly with the assigned licensed operator and chauffeur for your specific booking.</p>
                    <p>We <strong>never sell, rent, or trade</strong> your personal information to third-party marketing companies.</p>
                </div>

                <div class="legal-card-section" id="pp-cookies">
                    <div class="section-head-flex">
                        <div class="section-icon-box"><i class="fas fa-cookie-bite"></i></div>
                        <div>
                            <h2>5. Cookies & Tracking Technologies</h2>
                            <p>Enhancing your online booking experience</p>
                        </div>
                    </div>
                    <p><strong>Swift-Ride-taxis</strong> uses essential cookies for form persistence, session security, and aggregate performance analytics. You can adjust your browser cookie settings at any time.</p>
                </div>

                <div class="legal-card-section" id="pp-security">
                    <div class="section-head-flex">
                        <div class="section-icon-box"><i class="fas fa-lock"></i></div>
                        <div>
                            <h2>6. Bank-Grade Security Standards</h2>
                            <p>Safeguarding your information against unauthorized access</p>
                        </div>
                    </div>
                    <p>We enforce 256-bit SSL encryption across our entire platform. Payment information is handled through PCI-DSS Level 1 certified processors, meaning your raw card number is never stored on our servers.</p>
                </div>

                <div class="legal-card-section" id="pp-your-rights">
                    <div class="section-head-flex">
                        <div class="section-icon-box"><i class="fas fa-scale-balanced"></i></div>
                        <div>
                            <h2>7. Your GDPR Rights</h2>
                            <p>Full control over your personal data</p>
                        </div>
                    </div>
                    <p>Under UK data protection laws, you possess the right to:</p>
                    <ul class="legal-list-styled">
                        <li>Request a copy of the personal data we hold about you.</li>
                        <li>Request correction of inaccurate information.</li>
                        <li>Request erasure ("Right to be forgotten") of non-statutory data.</li>
                        <li>Withdraw consent for optional communications at any time.</li>
                    </ul>
                </div>

                <div class="legal-card-section" id="pp-contact">
                    <div class="section-head-flex">
                        <div class="section-icon-box"><i class="fas fa-envelope-open-text"></i></div>
                        <div>
                            <h2>8. Contact Data Protection Officer</h2>
                            <p>Get in touch regarding your privacy</p>
                        </div>
                    </div>
                    <p>For any privacy inquiries or GDPR data requests, please reach out to our Data Protection Officer:</p>
                    <div class="contact-cta-box">
                        <div>
                            <h4>Data Protection Officer — Swift-Ride-taxis</h4>
                            <p>Email: support@swiftridetaxis.co.uk &nbsp;|&nbsp; 24/7 Dedicated Support</p>
                        </div>
                        <a href="mailto:support@swiftridetaxis.co.uk" class="btn-contact-legal">
                            <i class="fas fa-envelope"></i> Email DPO
                        </a>
                    </div>
                </div>

            </main>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll('.legal-card-section[id]');
        const tocLinks = document.querySelectorAll('.toc-nav-list a');

        const observer = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    tocLinks.forEach(l => l.classList.remove('active'));
                    const activeLink = document.querySelector(`.toc-nav-list a[href="#${e.target.id}"]`);
                    if (activeLink) activeLink.classList.add('active');
                }
            });
        }, { threshold: 0.35 });

        sections.forEach(s => observer.observe(s));

        tocLinks.forEach(a => {
            a.addEventListener('click', e => {
                e.preventDefault();
                const target = document.querySelector(a.getAttribute('href'));
                if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });
    });
</script>
@endpush