@extends('layout.app')

@section('title', 'Terms & Conditions | Swift-Ride-taxis')
@section('meta_description', 'Terms & Conditions for Swift-Ride-taxis. Read our passenger service agreement, cancellation policy, fixed pricing, and legal terms.')

@push('styles')
<style>
    /* ==========================================================================
       TERMS & CONDITIONS - MODERN REDESIGN (#5744F6 ACCENT)
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

    .legal-table-custom {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 13.5px;
    }

    .legal-table-custom th {
        background: #F0EEFF;
        color: #311B92;
        font-weight: 800;
        padding: 12px 16px;
        text-align: left;
        border-bottom: 2px solid rgba(87, 68, 246, 0.2);
    }

    .legal-table-custom td {
        padding: 12px 16px;
        color: #475569;
        border-bottom: 1px solid #F1F5F9;
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
            <span class="legal-tag">PASSENGER AGREEMENT</span>
            <h1 class="legal-hero-title">Terms & Conditions</h1>
            <p class="legal-hero-subtitle">
                Please review these Terms carefully. By booking an airport transfer with Swift-Ride-taxis, you agree to these service conditions.
            </p>
            <div class="legal-hero-meta">
                <span><i class="far fa-calendar-alt"></i> Effective Date: January 1, 2025</span>
                <span><i class="fas fa-building"></i> Swift-Ride-taxis</span>
                <span><i class="fas fa-scale-balanced"></i> Governed by Laws of England & Wales</span>
            </div>
            <div class="legal-hero-breadcrumb">
                <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
                <i class="fas fa-chevron-right text-white-50" style="font-size: 10px;"></i>
                <span class="text-white fw-semibold">Terms & Conditions</span>
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
                    <li><a href="#tc-intro"><i class="fas fa-chevron-right"></i> 1. Introduction</a></li>
                    <li><a href="#tc-definitions"><i class="fas fa-chevron-right"></i> 2. Definitions</a></li>
                    <li><a href="#tc-booking-rules"><i class="fas fa-chevron-right"></i> 3. Booking Rules</a></li>
                    <li><a href="#tc-pricing"><i class="fas fa-chevron-right"></i> 4. Fixed Pricing & VAT</a></li>
                    <li><a href="#tc-cancellations"><i class="fas fa-chevron-right"></i> 5. Cancellations Policy</a></li>
                    <li><a href="#tc-responsibilities"><i class="fas fa-chevron-right"></i> 6. Passenger & Driver Duties</a></li>
                    <li><a href="#tc-liability"><i class="fas fa-chevron-right"></i> 7. Liability Limits</a></li>
                    <li><a href="#tc-governing"><i class="fas fa-chevron-right"></i> 8. Governing Law</a></li>
                </ul>
            </aside>

            <!-- Legal Content -->
            <main class="legal-content-main">

                <div class="legal-card-section" id="tc-intro">
                    <div class="section-head-flex">
                        <div class="section-icon-box"><i class="fas fa-file-contract"></i></div>
                        <div>
                            <h2>1. Introduction</h2>
                            <p>Agreement between you and Swift-Ride-taxis</p>
                        </div>
                    </div>
                    <div class="highlight-purple-box">
                        <i class="fas fa-info-circle"></i>
                        <span>These Terms & Conditions ("Terms") govern your use of the <strong>Swift-Ride-taxis</strong> platform. By creating a booking or using our site, you confirm you agree to these Terms.</span>
                    </div>
                    <p>These Terms apply to all bookings made through <strong>Swift-Ride-taxis</strong> across the UK. Please read them thoroughly prior to completing checkout.</p>
                </div>

                <div class="legal-card-section" id="tc-definitions">
                    <div class="section-head-flex">
                        <div class="section-icon-box"><i class="fas fa-book"></i></div>
                        <div>
                            <h2>2. Definitions</h2>
                            <p>Key terms used throughout our service contract</p>
                        </div>
                    </div>
                    <table class="legal-table-custom">
                        <thead>
                            <tr>
                                <th>Term</th>
                                <th>Meaning</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>"Swift-Ride-taxis"</strong></td>
                                <td>Swift-Ride-taxis Ltd, platform operator and transfer booking service.</td>
                            </tr>
                            <tr>
                                <td><strong>"Passenger / You"</strong></td>
                                <td>Any individual or company booking or travelling via our platform.</td>
                            </tr>
                            <tr>
                                <td><strong>"Licensed Operator"</strong></td>
                                <td>Fully vetted, DBS-checked, and licensed UK private hire or taxi operator.</td>
                            </tr>
                            <tr>
                                <td><strong>"Fixed Fare"</strong></td>
                                <td>The guaranteed total price quoted at checkout, inclusive of taxes and fees.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="legal-card-section" id="tc-booking-rules">
                    <div class="section-head-flex">
                        <div class="section-icon-box"><i class="fas fa-calendar-check"></i></div>
                        <div>
                            <h2>3. Booking Confirmations & Procedures</h2>
                            <p>Securing your transfer ride</p>
                        </div>
                    </div>
                    <p>A booking is confirmed once you complete payment and receive your electronic confirmation receipt containing your unique booking reference.</p>
                    <ul class="legal-list-styled">
                        <li>Assigned driver and vehicle registration details are dispatched to your mobile/email prior to pickup.</li>
                        <li>Passengers must ensure all flight details, dates, and times provided during booking are accurate.</li>
                        <li>Airport pickups include flight tracking with up to 60 minutes free waiting time after landing.</li>
                    </ul>
                </div>

                <div class="legal-card-section" id="tc-pricing">
                    <div class="section-head-flex">
                        <div class="section-icon-box"><i class="fas fa-sterling-sign"></i></div>
                        <div>
                            <h2>4. Guaranteed Fixed Pricing & No Hidden Charges</h2>
                            <p>Transparent fares with zero surprise fees</p>
                        </div>
                    </div>
                    <p>All prices displayed by <strong>Swift-Ride-taxis</strong> are guaranteed Fixed Fares. There are no hidden card fees, surge multipliers, or booking surcharges.</p>
                    <ul class="legal-list-styled">
                        <li>Toll charges, airport drop-off fees, and VAT are included in your final quote.</li>
                        <li>Additional unannounced via-stops or destination changes requested during travel may incur extra charges agreed with the driver.</li>
                    </ul>
                </div>

                <div class="legal-card-section" id="tc-cancellations">
                    <div class="section-head-flex">
                        <div class="section-icon-box"><i class="fas fa-clock-rotate-left"></i></div>
                        <div>
                            <h2>5. Cancellations & Refund Policy</h2>
                            <p>Fair refund tiers for your flexibility</p>
                        </div>
                    </div>
                    <table class="legal-table-custom">
                        <thead>
                            <tr>
                                <th>Cancellation Window</th>
                                <th>Refund Entitlement</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>More than 24 hours before pickup</td>
                                <td>100% Full Refund</td>
                            </tr>
                            <tr>
                                <td>Between 2 and 24 hours before pickup</td>
                                <td>50% Refund</td>
                            </tr>
                            <tr>
                                <td>Less than 2 hours before pickup / Passenger No-Show</td>
                                <td>No Refund</td>
                            </tr>
                        </tbody>
                    </table>
                    <p>To request a cancellation, email <a href="mailto:support@swiftridetaxis.co.uk" style="color: #5744F6; font-weight: 700;">support@swiftridetaxis.co.uk</a> with your booking reference.</p>
                </div>

                <div class="legal-card-section" id="tc-responsibilities">
                    <div class="section-head-flex">
                        <div class="section-icon-box"><i class="fas fa-user-shield"></i></div>
                        <div>
                            <h2>6. Passenger & Driver Conduct</h2>
                            <p>Ensuring safety, courtesy, and vehicle care</p>
                        </div>
                    </div>
                    <p>Passengers must ensure luggage and passenger counts adhere strictly to the vehicle category booked. Drivers reserve the right to refuse service if safety limits are exceeded.</p>
                </div>

                <div class="legal-card-section" id="tc-liability">
                    <div class="section-head-flex">
                        <div class="section-icon-box"><i class="fas fa-gavel"></i></div>
                        <div>
                            <h2>7. Limitation of Liability</h2>
                            <p>Legal boundaries and protections</p>
                        </div>
                    </div>
                    <p><strong>Swift-Ride-taxis</strong> connects passengers with licensed operators. While we enforce strict vetting, liability for physical transportation rests with the licensed operator in accordance with UK private hire regulations.</p>
                </div>

                <div class="legal-card-section" id="tc-governing">
                    <div class="section-head-flex">
                        <div class="section-icon-box"><i class="fas fa-landmark"></i></div>
                        <div>
                            <h2>8. Governing Law & Contact</h2>
                            <p>Jurisdiction and legal support contact</p>
                        </div>
                    </div>
                    <p>These Terms are governed by and construed under the laws of England & Wales.</p>
                    <div class="contact-cta-box">
                        <div>
                            <h4>Legal Team — Swift-Ride-taxis</h4>
                            <p>Have questions about our Terms? Contact our dedicated support team 24/7.</p>
                        </div>
                        <a href="mailto:support@swiftridetaxis.co.uk" class="btn-contact-legal">
                            <i class="fas fa-envelope"></i> Contact Support
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