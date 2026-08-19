@extends('layout.app')

@section('title', 'Driving Jobs London — Drive With Us | Swift-Ride-taxis')
@section('meta_description', 'Become part of a professional network of licensed private hire drivers, PCO drivers, and chauffeurs across London and major UK airports, and join Swift-Ride-taxis.')

@push('styles')
<style>
    /* ===== DRIVE WITH US HERO ===== */
    .driver-hero {
        position: relative;
        background:
            linear-gradient(115deg, rgba(10, 20, 46, 0.94) 0%, rgba(10, 20, 46, 0.80) 45%, rgba(10, 20, 46, 0.92) 100%),
            url('https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?q=80&w=1600&auto=format&fit=crop');
        background-size: cover;
        background-position: center;
        padding: 140px 20px 120px;
        color: #fff;
        overflow: hidden;
    }

    .driver-hero::after {
        content: "";
        position: absolute;
        inset: auto -10% -60% auto;
        width: 640px;
        height: 640px;
        background: radial-gradient(circle, rgba(255, 212, 38, 0.16) 0%, transparent 70%);
        pointer-events: none;
    }

    .driver-hero-inner {
        position: relative;
        max-width: 1180px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1.15fr 0.85fr;
        gap: 56px;
        align-items: center;
    }

    .hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-family: var(--font-mono);
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 2.5px;
        text-transform: uppercase;
        color: var(--signal);
        margin-bottom: 22px;
    }

    .hero-eyebrow::before {
        content: "";
        width: 26px;
        height: 1px;
        background: var(--signal);
        display: inline-block;
    }

    .driver-hero h1 {
        font-family: var(--font-display);
        font-size: clamp(34px, 4.5vw, 58px);
        font-weight: 900;
        line-height: 1.06;
        letter-spacing: -0.02em;
        text-transform: uppercase;
        color: #fff;
        margin-bottom: 20px;
    }

    .driver-hero h1 span {
        color: var(--signal);
        display: block;
    }

    .driver-hero p.hero-sub {
        font-size: 1.05rem;
        line-height: 1.65;
        color: rgba(255, 255, 255, 0.85);
        margin-bottom: 36px;
        max-width: 520px;
        font-weight: 400;
    }

    .hero-cta-row {
        display: flex;
        align-items: center;
        gap: 24px;
        flex-wrap: wrap;
    }

    .btn-apply-now {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: var(--signal);
        color: var(--navy-900);
        padding: 16px 34px;
        border-radius: 6px;
        font-family: var(--font-mono);
        font-weight: 800;
        font-size: 13px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        text-decoration: none;
        transition: all 0.25s ease;
        box-shadow: 0 10px 28px rgba(255, 212, 38, 0.3);
    }

    .btn-apply-now:hover {
        background: var(--signal-dim);
        transform: translateY(-2px);
        box-shadow: 0 14px 34px rgba(255, 212, 38, 0.45);
    }

    .hero-call-link {
        display: inline-flex;
        flex-direction: column;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.6);
    }

    .hero-call-link strong {
        font-family: var(--font-mono);
        font-size: 15px;
        color: #fff;
        letter-spacing: 0.5px;
    }

    .hero-trust-row {
        display: flex;
        flex-direction: column;
        gap: 14px;
        margin-top: 36px;
        padding-top: 24px;
        border-top: 1px solid rgba(255, 255, 255, 0.14);
    }

    .hero-trust-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.75);
        line-height: 1.4;
    }

    .hero-trust-item i {
        color: var(--signal);
        font-size: 15px;
        margin-top: 2px;
        flex-shrink: 0;
    }

    .hero-trust-item strong {
        color: #fff;
        display: block;
    }

    /* Boarding-pass style credential card */
    .hero-pass-card {
        position: relative;
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.16);
        border-radius: 14px;
        backdrop-filter: blur(14px);
        padding: 30px 28px;
        color: #fff;
    }

    .hero-pass-card::before,
    .hero-pass-card::after {
        content: "";
        position: absolute;
        width: 22px;
        height: 22px;
        background: var(--navy-900, #0A142E);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
    }

    .hero-pass-card::before { left: -11px; }
    .hero-pass-card::after { right: -11px; }

    .pass-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 18px;
        margin-bottom: 18px;
        border-bottom: 1px dashed rgba(255, 255, 255, 0.25);
    }

    .pass-header .pass-label {
        font-family: var(--font-mono);
        font-size: 11px;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.55);
    }

    .pass-header .pass-code {
        font-family: var(--font-mono);
        font-size: 11px;
        color: var(--signal);
        letter-spacing: 1px;
    }

    .pass-stat-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .pass-stat-row {
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }

    .pass-stat-row .pass-icon {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        background: rgba(255, 212, 38, 0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--signal);
        font-size: 14px;
        flex-shrink: 0;
    }

    .pass-stat-row h4 {
        font-family: var(--font-display);
        font-size: 14.5px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: #fff;
        margin-bottom: 3px;
    }

    .pass-stat-row p {
        font-size: 12.5px;
        color: rgba(255, 255, 255, 0.55);
        line-height: 1.5;
    }

    /* ===== DRIVER CARDS STRIP ===== */
    .driver-cards-section {
        background: #000;
        padding: 90px 20px 100px;
        position: relative;
    }

    .cards-section-head {
        max-width: 1140px;
        margin: 0 auto 48px;
        text-align: center;
    }

    .cards-section-head span {
        font-family: var(--font-mono);
        font-size: 11.5px;
        font-weight: 700;
        letter-spacing: 2.5px;
        text-transform: uppercase;
        color: var(--signal);
        display: block;
        margin-bottom: 10px;
    }

    .cards-section-head h2 {
        font-family: var(--font-display);
        font-size: 30px;
        font-weight: 900;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        color: #fff;
        margin-bottom: 12px;
    }

    .cards-section-head p.section-desc {
        color: rgba(255, 255, 255, 0.65);
        font-size: 15px;
        max-width: 680px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .driver-cards-grid {
        max-width: 1140px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        padding: 0 20px;
    }

    .driver-card {
        background: linear-gradient(180deg, #161616 0%, #101010 100%);
        border: 1px solid rgba(255, 255, 255, 0.10);
        padding: 38px 30px;
        border-radius: 14px;
        color: #fff;
        transition: transform 0.28s ease, border-color 0.28s ease, box-shadow 0.28s ease;
    }

    .driver-card:hover {
        transform: translateY(-6px);
        border-color: rgba(255, 212, 38, 0.4);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
    }

    .driver-card-icon {
        width: 52px;
        height: 52px;
        border-radius: 10px;
        background: rgba(255, 212, 38, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--signal);
        font-size: 22px;
        margin-bottom: 24px;
    }

    .driver-card h3 {
        font-family: var(--font-display);
        font-size: 18px;
        font-weight: 800;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        color: #fff;
        margin-bottom: 12px;
    }

    .driver-card p {
        color: #9a9aa2;
        font-size: 14px;
        line-height: 1.7;
        margin-bottom: 20px;
    }

    .driver-card-link {
        font-family: var(--font-mono);
        font-size: 11.5px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: var(--signal);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: gap 0.2s ease;
    }

    .driver-card-link:hover {
        gap: 10px;
    }

    /* ===== PROCESS STEPS ===== */
    .process-section {
        background: #0A142E;
        padding: 90px 20px;
    }

    .process-inner {
        max-width: 1140px;
        margin: 0 auto;
    }

    .process-inner .cards-section-head h2 { color: #fff; }
    .process-inner .cards-section-head { margin-bottom: 56px; }

    .process-steps {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 0;
        position: relative;
    }

    .process-steps::before {
        content: "";
        position: absolute;
        top: 24px;
        left: 12.5%;
        right: 12.5%;
        height: 1px;
        background: repeating-linear-gradient(90deg, rgba(255, 255, 255, 0.22) 0 8px, transparent 8px 16px);
    }

    .process-step {
        position: relative;
        text-align: center;
        padding: 0 16px;
    }

    .process-step-num {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: #0A142E;
        border: 1.5px solid var(--signal);
        color: var(--signal);
        font-family: var(--font-mono);
        font-weight: 800;
        font-size: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        position: relative;
        z-index: 2;
    }

    .process-step h4 {
        font-family: var(--font-display);
        font-size: 15px;
        font-weight: 800;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        color: #fff;
        margin-bottom: 8px;
    }

    .process-step p {
        font-size: 13px;
        color: rgba(255, 255, 255, 0.55);
        line-height: 1.6;
    }

    @media (max-width: 992px) {
        .driver-hero-inner {
            grid-template-columns: 1fr;
        }

        .hero-pass-card { max-width: 460px; }

        .driver-cards-grid {
            grid-template-columns: 1fr;
        }

        .process-steps {
            grid-template-columns: 1fr 1fr;
            row-gap: 40px;
        }

        .process-steps::before { display: none; }
    }

    /* ===== FINAL APPLY CTA ===== */
    .apply-cta-section {
        background: #f4f5f7;
        padding: 100px 20px;
    }

    .apply-cta-wrap {
        max-width: 1140px;
        margin: 0 auto;
    }

    .apply-ticket {
        position: relative;
        background: #0A142E;
        border-radius: 20px;
        overflow: hidden;
        display: grid;
        grid-template-columns: 1.3fr 1fr;
        box-shadow: 0 30px 70px rgba(10, 20, 46, 0.22);
    }

    .apply-ticket-main {
        padding: 64px 60px;
        color: #fff;
        position: relative;
    }

    .apply-ticket-main::after {
        content: "";
        position: absolute;
        inset: auto -20% -80% auto;
        width: 480px;
        height: 480px;
        background: radial-gradient(circle, rgba(255, 212, 38, 0.14) 0%, transparent 70%);
        pointer-events: none;
    }

    .apply-ticket-main span.eyebrow {
        font-family: var(--font-mono);
        font-size: 11.5px;
        font-weight: 700;
        letter-spacing: 2.5px;
        text-transform: uppercase;
        color: var(--signal);
        display: block;
        margin-bottom: 16px;
    }

    .apply-ticket-main h2 {
        font-family: var(--font-display);
        font-size: clamp(26px, 3.2vw, 38px);
        font-weight: 900;
        letter-spacing: 0.3px;
        text-transform: uppercase;
        line-height: 1.12;
        margin-bottom: 18px;
    }

    .apply-ticket-main p {
        font-size: 14.5px;
        line-height: 1.7;
        color: rgba(255, 255, 255, 0.72);
        margin-bottom: 24px;
    }

    .apply-checklist {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-bottom: 36px;
    }

    .apply-checklist-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        font-size: 13.5px;
        color: rgba(255, 255, 255, 0.85);
        font-weight: 500;
        line-height: 1.5;
    }

    .apply-checklist-item i {
        color: var(--signal);
        font-size: 12px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 1px solid rgba(255, 212, 38, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .apply-ticket-stub {
        position: relative;
        background: rgba(255, 255, 255, 0.03);
        border-left: 1px dashed rgba(255, 255, 255, 0.22);
        padding: 64px 44px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 28px;
    }

    .apply-ticket-stub::before,
    .apply-ticket-stub::after {
        content: "";
        position: absolute;
        left: -13px;
        width: 26px;
        height: 26px;
        background: #f4f5f7;
        border-radius: 50%;
    }

    .apply-ticket-stub::before { top: -13px; }
    .apply-ticket-stub::after { bottom: -13px; }

    .stub-label {
        font-family: var(--font-mono);
        font-size: 10.5px;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.4);
        margin-bottom: 6px;
    }

    .stub-contact {
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }

    .stub-contact .stub-icon {
        width: 40px;
        height: 40px;
        border-radius: 9px;
        background: rgba(255, 212, 38, 0.12);
        color: var(--signal);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }

    .stub-contact h4 {
        font-family: var(--font-display);
        font-size: 14px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: #fff;
        margin-bottom: 3px;
    }

    .stub-contact a,
    .stub-contact p {
        font-size: 13px;
        color: rgba(255, 255, 255, 0.6);
        text-decoration: none;
    }

    .stub-contact a:hover { color: var(--signal); }

    @media (max-width: 900px) {
        .apply-ticket { grid-template-columns: 1fr; }
        .apply-ticket-main { padding: 48px 32px; }
        .apply-ticket-stub {
            border-left: none;
            border-top: 1px dashed rgba(255, 255, 255, 0.22);
            padding: 40px 32px;
        }
        .apply-ticket-stub::before,
        .apply-ticket-stub::after {
            left: 50%;
            top: -13px;
            transform: translateX(-50%);
        }
        .apply-ticket-stub::after { bottom: auto; top: auto; }
        .apply-ticket-stub::after { bottom: -13px; top: auto; }
    }

    @media (max-width: 640px) {
        .driver-hero { padding: 96px 20px 80px; }
        .process-steps { grid-template-columns: 1fr; }
        .apply-cta-section { padding: 70px 20px; }
        .apply-ticket-main { padding: 40px 24px; }
        .apply-ticket-stub { padding: 32px 24px; }
    }
</style>
@endpush

@section('content')

<!-- ===== HERO ===== -->
<section class="driver-hero">
    <div class="driver-hero-inner">
        <div>
            <span class="hero-eyebrow">Join the fleet</span>
            <h1>
                DRIVING JOBS
                <span>LONDON</span>
            </h1>
            <p class="hero-sub">Become part of a professional network of licensed private hire drivers, PCO drivers, and chauffeurs across London and major UK airports, and join Swift-Ride-taxis.</p>

            <div class="hero-cta-row">
                <a href="https://portal.airportridesuk.com/register" class="btn-apply-now">Apply Now &rarr;</a>
                <a href="tel:{{ str_replace(' ', '', SettingsHelper::get('company_phone', '02035042315')) }}" class="hero-call-link">
                    Call Now
                    <strong>{{ SettingsHelper::get('company_phone', '020 3504 2315') }}</strong>
                </a>
            </div>

            <div class="hero-trust-row">
                <div class="hero-trust-item">
                    <i class="fas fa-shield-check"></i>
                    <div>
                        <strong>Licensed &amp; insured network</strong>
                        Provide good-quality private hire and airport transfer service.
                    </div>
                </div>
                <div class="hero-trust-item">
                    <i class="fas fa-id-card"></i>
                    <div>
                        <strong>PCO &amp; TfL compliant</strong>
                        Career opportunities for professionally and appropriately licensed drivers in London.
                    </div>
                </div>
                <div class="hero-trust-item">
                    <i class="fas fa-headset"></i>
                    <div>
                        <strong>24/7 driver support</strong>
                        Seek help when working, day or night.
                    </div>
                </div>
            </div>
        </div>

        <div class="hero-pass-card">
            <div class="pass-header">
                <span class="pass-label">Driver Network</span>
                <span class="pass-code">ARUK — LONDON</span>
            </div>
            <div class="pass-stat-list">
                <div class="pass-stat-row">
                    <div class="pass-icon"><i class="fas fa-calendar-check"></i></div>
                    <div>
                        <h4>Flexible Working</h4>
                        <p>Work on your own timetable and select the hours that work for you. There is more flexibility with our self-employed driver roles in London, as there is no fixed shift.</p>
                    </div>
                </div>
                <div class="pass-stat-row">
                    <div class="pass-icon"><i class="fas fa-route"></i></div>
                    <div>
                        <h4>Regular Airport Transfers</h4>
                        <p>Book airport transfers to and from Heathrow, Gatwick, Stansted, and other big airports for steadier and more consistent airport jobs.</p>
                    </div>
                </div>
                <div class="pass-stat-row">
                    <div class="pass-icon"><i class="fas fa-user-tie"></i></div>
                    <div>
                        <h4>Professional Drivers</h4>
                        <p>Licensed PCOs, Chauffeur Drivers, and private hire drivers are welcome across London.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== WHY CHOOSE US FOR DRIVERS ===== -->
<section class="driver-why-section">
    <style>
        .driver-why-section {
            background: #f8fafc;
            padding: 80px 20px;
            border-bottom: 1px solid #e2e8f0;
        }
        .driver-why-inner {
            max-width: 1140px;
            margin: 0 auto;
        }
        .driver-why-head {
            text-align: center;
            max-width: 760px;
            margin: 0 auto 48px;
        }
        .driver-why-head span {
            font-family: var(--font-mono);
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #2E6BE6;
            display: block;
            margin-bottom: 8px;
        }
        .driver-why-head h2 {
            font-family: var(--font-display);
            font-size: clamp(24px, 3vw, 36px);
            font-weight: 900;
            color: #0A142E;
            margin-bottom: 14px;
        }
        .driver-why-head p {
            color: #5B6478;
            font-size: 15px;
            line-height: 1.7;
            margin-bottom: 10px;
        }
        .driver-why-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }
        .why-driver-card {
            background: #fff;
            border: 1px solid #e3e8f2;
            border-radius: 14px;
            padding: 30px 24px;
            box-shadow: 0 4px 12px rgba(10,20,46,0.03);
            transition: all 0.25s ease;
        }
        .why-driver-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 32px rgba(10,20,46,0.08);
            border-color: #2E6BE6;
        }
        .why-driver-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            background: #EBF1FF;
            color: #2E6BE6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 20px;
        }
        .why-driver-card h3 {
            font-family: var(--font-display);
            font-size: 16px;
            font-weight: 800;
            color: #0A142E;
            margin-bottom: 8px;
        }
        .why-driver-card p {
            font-size: 13.5px;
            color: #5B6478;
            line-height: 1.6;
        }
        @media (max-width: 992px) {
            .driver-why-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 600px) {
            .driver-why-grid { grid-template-columns: 1fr; }
        }
    </style>
    <div class="driver-why-inner">
        <div class="driver-why-head">
            <span>Partner with us</span>
            <h2>Why is Swift-Ride-taxis the best choice?</h2>
            <p>The experience of a professional driver can be enhanced by picking the correct company. We are committed to offering licensed drivers in London the great opportunity to book a reliable service at Swift-Ride-taxis, with flexible working options and dedicated support.</p>
            <p style="font-size:14px;color:#64748b">Whether you are seeking Driving Jobs London, Chauffeur Jobs London, PCO Driver Jobs London or Self-Employed Driver Jobs London, our network is tailored to ensure that professional drivers can work with confidence.</p>
        </div>
        <div class="driver-why-grid">
            <div class="why-driver-card">
                <div class="why-driver-icon"><i class="fas fa-clock"></i></div>
                <h3>Flexible Working</h3>
                <p>Work on your own timetable and select the hours that work for you. There is more flexibility with our self-employed driver roles in London, as there is no fixed shift.</p>
            </div>
            <div class="why-driver-card">
                <div class="why-driver-icon"><i class="fas fa-plane-arrival"></i></div>
                <h3>Regular Airport Transfers</h3>
                <p>Book airport transfers to and from Heathrow, Gatwick, Stansted, and other big airports. Our Airport Driver jobs are perfect for drivers looking for a steadier and more consistent airport job.</p>
            </div>
            <div class="why-driver-card">
                <div class="why-driver-icon"><i class="fas fa-id-card"></i></div>
                <h3>Professional Drivers</h3>
                <p>Licensed PCOs, Chauffeur Drivers, and private hire drivers are welcome. If you’re looking for chauffeur driver jobs, private hire driver jobs, or PCO jobs in London, you can find a job that fits your experience.</p>
            </div>
            <div class="why-driver-card">
                <div class="why-driver-icon"><i class="fas fa-sterling-sign"></i></div>
                <h3>Competitive Earnings</h3>
                <p>Make money with private hire, chauffeur and airport transfer jobs. Your flexibility will allow you to organise your work hours around the times that suit you best.</p>
            </div>
            <div class="why-driver-card">
                <div class="why-driver-icon"><i class="fas fa-headset"></i></div>
                <h3>24/7 Driver Support</h3>
                <p>Riding to work doesn’t always occur outside of business hours. This is why our support is available 24 hours a day to help drivers when they need it with active bookings.</p>
            </div>
            <div class="why-driver-card">
                <div class="why-driver-icon"><i class="fas fa-award"></i></div>
                <h3>Professional &amp; Trusted Service</h3>
                <p>The main focus of Swift-Ride-taxis is on reliable, punctual, and professional transport of passengers. You are going to be portraying a service business that cares for customers and has professional behavior and high driving standards.</p>
            </div>
            <div class="why-driver-card">
                <div class="why-driver-icon"><i class="fas fa-user-check"></i></div>
                <h3>Simple Driver Onboarding</h3>
                <p>We’ve made the application process straightforward. Fill in the information and necessary documents in our driver portal, go through verification and onboarding, and prepare to take on eligible bookings.</p>
            </div>
            <div class="why-driver-card">
                <div class="why-driver-icon"><i class="fas fa-chart-line"></i></div>
                <h3>Grow With Swift-Ride-taxis</h3>
                <p>Professional drivers can take advantage of flexible driving opportunities with Swift-Ride-taxis, offering jobs like taxi driver positions in London, PCO driver positions, executive chauffeur jobs in London, and airport transfer jobs.</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== BENEFIT CARDS ===== -->
<section class="driver-cards-section">
    <div class="cards-section-head">
        <span>Driver roles</span>
        <h2>Find the Driving Job That Fits You</h2>
        <p class="section-desc">Whether your experience is in private hire, airport transfers or executive travel, explore professional driver jobs in London with Swift-Ride-taxis.</p>
    </div>
    <div class="driver-cards-grid">
        <div class="driver-card">
            <div class="driver-card-icon"><i class="fas fa-taxi"></i></div>
            <h3>PCO Driver Jobs London</h3>
            <p>Become a licensed PCO driver with Swift-Ride-taxis and enjoy the benefits of regular airport and private hire bookings all over London and beyond.</p>
            <a href="#apply-form" class="driver-card-link">Apply as PCO driver &rarr;</a>
        </div>

        <div class="driver-card">
            <div class="driver-card-icon"><i class="fas fa-user-tie"></i></div>
            <h3>Chauffeur Jobs London</h3>
            <p>Our chauffeur driver jobs in London are perfect for professional, experienced drivers who are capable of being on time, presentable, discreet, and providing good customer service.</p>
            <a href="#apply-form" class="driver-card-link">Apply as chauffeur &rarr;</a>
        </div>

        <div class="driver-card">
            <div class="driver-card-icon"><i class="fas fa-plane-departure"></i></div>
            <h3>Airport Transfer Driver Jobs</h3>
            <p>Enjoy dedicated airport transfers to and from London Heathrow, Gatwick, Stansted, and other airports in London and the UK.</p>
            <a href="#apply-form" class="driver-card-link">Apply as specialist &rarr;</a>
        </div>
    </div>
</section>

<!-- ===== PROCESS STEPS ===== -->
<section class="process-section">
    <div class="process-inner">
        <div class="cards-section-head">
            <span>How it works</span>
            <h2>From Application to Your First Booking</h2>
        </div>
        <div class="process-steps">
            <div class="process-step">
                <div class="process-step-num">01</div>
                <h4>Apply Online</h4>
                <p>Sign up on our safe driver portal and submit your personal, licence, and vehicle information.</p>
            </div>
            <div class="process-step">
                <div class="process-step-num">02</div>
                <h4>Driver Verification</h4>
                <p>Your driving licence, PCO/private hire documentation, identification, and vehicle information will be checked by our onboarding team.</p>
            </div>
            <div class="process-step">
                <div class="process-step-num">03</div>
                <h4>Complete Your Onboarding</h4>
                <p>Upon approval of your documents, we will let you know how the platform works, how bookings are processed, and how the payout process works.</p>
            </div>
            <div class="process-step">
                <div class="process-step-num">04</div>
                <h4>Start Driving</h4>
                <p>You can go live and begin to get eligible airport transfers and private hire bookings to and from airports.</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== FINAL APPLY CTA ===== -->
<section class="apply-cta-section" id="apply-form">
    <div class="apply-cta-wrap">
        <div class="apply-ticket">
            <div class="apply-ticket-main">
                <span class="eyebrow">Flexible driver roles</span>
                <h2>Create Your Driving Career With Swift-Ride-taxis</h2>
                <p>As a taxi driver job in London, private hire driver job, PCO job in London or professional chauffeur job, Swift-Ride-taxis provides flexibility for those looking for taxi driver jobs in London.</p>
                <p style="font-size:13.5px;color:rgba(255,255,255,0.7);margin-bottom:20px">Our network is especially geared towards self-employed drivers who desire more control over their working hours and want to book jobs at airports and private hire.</p>

                <div class="apply-checklist">
                    <div class="apply-checklist-item"><i class="fas fa-check"></i> Opportunities for flexible working (including FT and PT)</div>
                    <div class="apply-checklist-item"><i class="fas fa-check"></i> Constantly available airport booking chances</div>
                    <div class="apply-checklist-item"><i class="fas fa-check"></i> Flights throughout London and UK airports</div>
                    <div class="apply-checklist-item"><i class="fas fa-check"></i> As a PCO, private hire, and chauffeur driver, you have a variety of opportunities available to you</div>
                    <div class="apply-checklist-item"><i class="fas fa-check"></i> Executive and standard passenger bookings are part of the services offered</div>
                    <div class="apply-checklist-item"><i class="fas fa-check"></i> Travel in your own appropriate vehicle or check out rentals</div>
                    <div class="apply-checklist-item"><i class="fas fa-check"></i> Professional onboarding support</div>
                    <div class="apply-checklist-item"><i class="fas fa-check"></i> 24/7 driver assistance</div>
                </div>

                <p style="font-size:13px;color:rgba(255,255,255,0.65);margin-bottom:24px;font-style:italic">If you’re an existing private hire driver or interested in finding out more about private hire driver opportunities in London, you can submit your application online and take the next steps with Swift-Ride-taxis.</p>

                <a href="https://portal.airportridesuk.com/register" class="btn-apply-now">Apply on the portal &rarr;</a>
            </div>

            <div class="apply-ticket-stub">
                <div>
                    <div class="stub-label">Talk to onboarding</div>
                    <div class="stub-contact">
                        <div class="stub-icon"><i class="fas fa-phone"></i></div>
                        <div>
                            <h4>Call us</h4>
                            <a href="tel:{{ str_replace(' ', '', SettingsHelper::get('company_phone', '02035042315')) }}">{{ SettingsHelper::get('company_phone', '020 3504 2315') }}</a>
                        </div>
                    </div>
                </div>

                <div class="stub-contact">
                    <div class="stub-icon"><i class="fas fa-envelope"></i></div>
                    <div>
                        <h4>Email</h4>
                        <a href="mailto:{{ SettingsHelper::get('company_email', 'admin@airportridesuk.com') }}">{{ SettingsHelper::get('company_email', 'admin@airportridesuk.com') }}</a>
                    </div>
                </div>

                <div class="stub-contact">
                    <div class="stub-icon"><i class="fas fa-headset"></i></div>
                    <div>
                        <h4>Support hours</h4>
                        <p>24/7 — every day of the year</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection