@extends('layout.app')

@section('title', $page->meta_title ?? $page->title)
@section('meta_description', $page->meta_description ?? '')

@section('content')

@include('components.booker')

<br>

<!-- PAGE CONTENT -->
<div class="container">
    <div class="page-content-wrap">
        <div class="page-content">
            {!! $page->content !!}
        </div>
    </div>
</div>

<!-- ===== WHY CHOOSE US SECTION ===== -->
<section class="why-choose-section">
    <div class="container">
        <div class="why-choose-grid">
            <div class="why-choose-media">
                {{-- Replace with a real photo of a driver assisting a passenger, e.g. asset('images/airport-transfer.jpg') --}}
                <img src="https://media.istockphoto.com/id/1389679521/photo/a-taxi-uber-driver-helping-a-passenger-with-her-luggage-at-the-airport.jpg?s=612x612&w=0&k=20&c=3eAujZ1PBiDg5AMd9kmRpwxtIZOpZGY_XCL8ffSkPNo=" alt="RideOn Minicabs driver assisting a passenger with luggage">
                <div class="why-choose-badge">
                    <i class="fas fa-award"></i>
                    <div>
                        <strong>15,000+</strong>
                        <span>Transfers Completed</span>
                    </div>
                </div>
            </div>

            <div class="why-choose-content">
                <span class="section-tag section-tag--dark">About RideOn Minicabs</span>
                <h2>Why Choose RideOn Minicabs for Airport Transfers in London?</h2>

                <p>If you're looking for a taxi service you can actually rely on, RideOn Minicabs is built for exactly that. We run punctual, comfortable and competitively priced airport transfers across London and the wider UK — every single time.</p>

                <p>Our fully licensed drivers know every route, terminal and shortcut, so you arrive on time from Heathrow, Gatwick, Stansted, Luton or London City Airport. It's a modern online booking service that's still as reliable as a traditional cab — no surprises, no hidden fees, and no last-minute scrambles, backed by real-time flight tracking, transparent pricing and 24/7 support.</p>

                <ul class="why-choose-list">
                    <li>
                        <i class="fas fa-check"></i>
                        <div><strong>Fixed Transparent Fares</strong><span>No meter, no surge pricing, no hidden charges.</span></div>
                    </li>
                    <li>
                        <i class="fas fa-check"></i>
                        <div><strong>PCO-Licensed Drivers</strong><span>Vetted, experienced and uniformed chauffeurs.</span></div>
                    </li>
                    <li>
                        <i class="fas fa-check"></i>
                        <div><strong>Modern, Clean Vehicles</strong><span>Saloons, executive cars, MPVs and 8-seaters.</span></div>
                    </li>
                    <li>
                        <i class="fas fa-check"></i>
                        <div><strong>Free Flight Tracking</strong><span>We automatically adjust your pickup if your flight changes.</span></div>
                    </li>
                </ul>

                <a href="#" class="btn btn-gold">Get Free Quote</a>
            </div>
        </div>
    </div>
</section>

<!-- ===== FEATURES SECTION ===== -->
<section class="features-section">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-tag">Why Book With Us</span>
            <h2>Reliable Transfers, Every Time</h2>
            <p class="section-subtitle">No surge pricing, no surprises — just a professional driver waiting when you land.</p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-plane-arrival"></i>
                </div>
                <h3>Live Flight Tracking</h3>
                <p>We monitor your flight in real time, so your driver adjusts pickup automatically if you're early or delayed — at no extra cost.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-tag"></i>
                </div>
                <h3>Fixed Price, No Surge</h3>
                <p>The fare you're quoted is the fare you pay. No meters, no peak-time multipliers, no last-minute add-ons.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h3>Meet &amp; Greet</h3>
                <p>Your driver waits inside the terminal with a name board, helps with luggage, and walks you straight to the car.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Licensed &amp; Insured</h3>
                <p>Every driver is fully licensed, DBS-checked, and insured for private hire — vetted before they're ever on the road.</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== TESTIMONIALS SECTION ===== -->
<section class="testimonials-section">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-tag">Passenger Reviews</span>
            <h2>Trusted by Thousands of Travellers</h2>
            <p class="section-subtitle">Real reviews from passengers who booked their airport transfer with us</p>
        </div>

        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="testimonial-stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="testimonial-text">Landed at Heathrow after an 11-hour delay and the driver had already adjusted the pickup time — no calls, no stress, he was just there waiting.</p>
                <div class="testimonial-author">
                    <div class="author-avatar">
                        <img src="https://ui-avatars.com/api/?name=Robert+Hale&background=1a56db&color=fff&size=60" alt="Robert Hale">
                    </div>
                    <div class="author-info">
                        <h4>Robert Hale</h4>
                        <span>Heathrow Terminal 5 → Central London</span>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <div class="testimonial-stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="testimonial-text">Booked for a family of five with two car seats arranged in advance. Driver was early, the car was spotless, and the price matched the quote exactly.</p>
                <div class="testimonial-author">
                    <div class="author-avatar">
                        <img src="https://ui-avatars.com/api/?name=Amelia+Cross&background=1a56db&color=fff&size=60" alt="Amelia Cross">
                    </div>
                    <div class="author-info">
                        <h4>Amelia Cross</h4>
                        <span>Gatwick Airport → Brighton</span>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <div class="testimonial-stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="testimonial-text">I travel for work most weeks and this is the only transfer service I trust for early morning starts. Always on time, always professional.</p>
                <div class="testimonial-author">
                    <div class="author-avatar">
                        <img src="https://ui-avatars.com/api/?name=David+Okafor&background=1a56db&color=fff&size=60" alt="David Okafor">
                    </div>
                    <div class="author-info">
                        <h4>David Okafor</h4>
                        <span>Frequent Business Traveller</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== FAQ SECTION ===== -->
<section class="faq-section">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-tag">FAQ</span>
            <h2>Frequently Asked Questions</h2>
            <p class="section-subtitle">Everything you need to know before booking your transfer</p>
        </div>

        <div class="faq-grid">
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>What happens if my flight is delayed?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>We track every flight automatically using its flight number, so your pickup time updates in real time if you're delayed. There's no need to contact us — your driver will already know, and there's no extra charge for the wait.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>Is the quoted price the final price?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Yes. The fare shown at booking is fixed and confirmed by email — it includes meet &amp; greet, flight tracking, and standard luggage. There are no hidden fees, surge pricing, or charges added on the day.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>Where will my driver meet me?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>For airport pickups, your driver waits inside the arrivals hall holding a name board, so you can spot them as soon as you clear customs. Exact meeting points are confirmed in your booking details.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>Can I request a child seat or extra luggage space?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Absolutely. Child seats, booster seats, and larger vehicles for extra luggage can all be added when you book — just let us know what you need and we'll match you with the right vehicle.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>How far in advance do I need to book?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>You can book as little as a few hours ahead for most routes, though we recommend booking at least 24 hours in advance during peak travel periods to guarantee availability at your preferred time.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== CTA SECTION ===== -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content text-center">
            <h2>Ready to Book Your Transfer?</h2>
            <p>Get a fixed quote in seconds and lock in your driver before prices change.</p>
            <div class="cta-buttons">
                <a href="#" class="btn btn-primary"><i class="fas fa-calendar-check"></i> Book Now</a>
                <a href="#" class="btn btn-outline"><i class="fas fa-phone"></i> Talk to Us</a>
            </div>
        </div>
    </div>
</section>

<style>
    /* ===== PAGE HEADER ===== */
    .page-header {
        background: linear-gradient(135deg, var(--blue) 0%, var(--blue-dark) 100%);
        padding: 48px 0 40px;
        margin-bottom: 48px;
    }

    .page-breadcrumb {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        font-weight: 500;
        color: rgba(255, 255, 255, .75);
        margin-bottom: 16px;
    }

    .page-breadcrumb a {
        color: rgba(255, 255, 255, .85);
        transition: color .2s;
    }

    .page-breadcrumb a:hover {
        color: #fff;
    }

    .page-breadcrumb i {
        font-size: 10px;
        color: rgba(255, 255, 255, .5);
    }

    .page-breadcrumb span {
        color: #fff;
        font-weight: 600;
    }

    .page-header h1 {
        color: #fff;
        font-size: 26px;
        font-weight: 800;
        letter-spacing: -0.02em;
    }

    .page-subtitle {
        color: rgba(255, 255, 255, .85);
        font-size: 15px;
        margin-top: 10px;
        max-width: 640px;
    }

    /* ===== PAGE CONTENT ===== */
    .page-content-wrap {
        max-width: 860px;
        margin: 0 auto 64px;
        height: 700px;
        overflow-y: auto;
        padding: 8px 4px;
    }

    .page-content {
        font-size: 15px;
        line-height: 1.8;
        color: var(--text);
    }

    .page-content h2 {
        font-size: 20px;
        font-weight: 800;
        color: var(--text);
        margin-top: 40px;
        margin-bottom: 16px;
        letter-spacing: -0.01em;
    }

    .page-content h3 {
        font-size: 17px;
        font-weight: 700;
        color: var(--text);
        margin-top: 28px;
        margin-bottom: 12px;
    }

    .page-content p {
        margin-bottom: 18px;
        color: #374151;
    }

    .page-content ul,
    .page-content ol {
        margin-bottom: 18px;
        padding-left: 22px;
    }

    .page-content li {
        margin-bottom: 8px;
        color: #374151;
    }

    .page-content a {
        color: var(--blue);
        font-weight: 600;
        text-decoration: underline;
        text-decoration-color: rgba(46, 107, 230, .3);
    }

    .page-content a:hover {
        color: var(--blue-dark);
    }

    .page-content strong {
        color: var(--text);
        font-weight: 700;
    }

    .page-content img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        margin: 24px 0;
        box-shadow: 0 4px 16px rgba(0, 0, 0, .08);
    }

    .page-content blockquote {
        border-left: 3px solid var(--blue);
        background: var(--blue-light);
        padding: 16px 20px;
        margin: 24px 0;
        border-radius: 0 8px 8px 0;
        color: #374151;
        font-style: italic;
    }

    .page-content table {
        width: 100%;
        border-collapse: collapse;
        margin: 24px 0;
        font-size: 14px;
    }

    .page-content table th {
        background: var(--bg-light);
        font-weight: 700;
        text-align: left;
        padding: 12px 16px;
        border: 1px solid var(--border);
    }

    .page-content table td {
        padding: 12px 16px;
        border: 1px solid var(--border);
    }

    .page-content hr {
        border: none;
        border-top: 1px solid var(--border);
        margin: 32px 0;
    }

    /* ===== SECTION COMMON ===== */
    .section-header {
        max-width: 640px;
        margin: 0 auto 52px;
    }

    .section-header h2 {
        font-size: 26px;
        font-weight: 800;
        color: var(--text);
        margin-bottom: 10px;
        letter-spacing: -0.02em;
        line-height: 1.25;
    }

    .section-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--blue-light);
        color: var(--blue);
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        padding: 7px 16px 7px 12px;
        border-radius: 20px;
        margin-bottom: 18px;
    }

    .section-tag::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--blue);
        flex-shrink: 0;
    }

    .section-subtitle {
        color: #6b7280;
        font-size: 16px;
        max-width: 560px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* ===== WHY CHOOSE US SECTION ===== */
    .why-choose-section {
        padding: 96px 0;
        background: radial-gradient(circle at 15% 20%, rgba(255, 212, 38, .10), transparent 45%),
                    linear-gradient(160deg, #0A142E 0%, #101E45 60%, #0A142E 100%);
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    .why-choose-grid {
        display: grid;
        grid-template-columns: 0.95fr 1.05fr;
        gap: 56px;
        align-items: center;
        max-width: 1180px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .why-choose-media {
        position: relative;
        border-radius: 18px;
        overflow: hidden;
    }

    .why-choose-media img {
        width: 100%;
        height: 100%;
        max-height: 480px;
        object-fit: cover;
        display: block;
        border-radius: 18px;
        border: 1px solid rgba(255, 255, 255, .08);
    }

    .why-choose-badge {
        position: absolute;
        bottom: 20px;
        left: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        background: rgba(13, 16, 22, .85);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 212, 38, .35);
        border-radius: 12px;
        padding: 12px 18px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, .35);
    }

    .why-choose-badge i {
        color: #FFD426;
        font-size: 20px;
    }

    .why-choose-badge strong {
        display: block;
        font-size: 16px;
        font-weight: 800;
        color: #fff;
        line-height: 1.2;
    }

    .why-choose-badge span {
        font-size: 12px;
        color: rgba(255, 255, 255, .65);
    }

    .section-tag--dark {
        background: rgba(255, 212, 38, .12);
        color: #FFD426;
    }

    .section-tag--dark::before {
        background: #FFD426;
    }

    .why-choose-content h2 {
        font-size: 25px;
        font-weight: 800;
        line-height: 1.3;
        letter-spacing: -0.02em;
        margin-bottom: 20px;
        color: #fff;
    }

    .why-choose-content p {
        font-size: 15px;
        line-height: 1.75;
        color: rgba(255, 255, 255, .68);
        margin-bottom: 16px;
    }

    .why-choose-content p a {
        color: #FFD426;
        font-weight: 600;
        text-decoration: underline;
        text-decoration-color: rgba(255, 212, 38, .4);
    }

    .why-choose-list {
        list-style: none;
        margin: 28px 0 32px;
        padding: 0;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px 24px;
    }

    .why-choose-list li {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .why-choose-list i {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: rgba(255, 212, 38, .15);
        color: #FFD426;
        font-size: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .why-choose-list strong {
        display: block;
        font-size: 14.5px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 3px;
    }

    .why-choose-list span {
        font-size: 13px;
        color: rgba(255, 255, 255, .55);
        line-height: 1.5;
    }

    .btn-gold {
        background: linear-gradient(135deg, #FFE066 0%, #F2C400 100%);
        color: #0A142E;
        box-shadow: 0 10px 28px rgba(255, 212, 38, .3);
    }

    .btn-gold:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 32px rgba(255, 212, 38, .4);
        color: #0A142E;
    }

    /* ===== FEATURES SECTION ===== */
    .features-section {
        padding: 88px 0;
        background: #fff;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
        gap: 24px;
        max-width: 1080px;
        margin: 0 auto;
    }

    .feature-card {
        background: var(--bg-light);
        border-radius: 16px;
        padding: 34px 26px;
        text-align: left;
        border: 1px solid var(--border);
        transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
        position: relative;
    }

    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 26px;
        right: 26px;
        height: 3px;
        border-radius: 0 0 3px 3px;
        background: var(--blue);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform .35s ease;
    }

    .feature-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(10, 20, 46, .08);
        border-color: transparent;
        background: #fff;
    }

    .feature-card:hover::before {
        transform: scaleX(1);
    }

    .feature-icon {
        width: 52px;
        height: 52px;
        background: var(--blue);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        font-size: 20px;
        color: #fff;
        box-shadow: 0 8px 20px rgba(46, 107, 230, .25);
    }

    .feature-card h3 {
        font-size: 17px;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 10px;
        letter-spacing: -0.01em;
    }

    .feature-card p {
        font-size: 14.5px;
        color: #6b7280;
        line-height: 1.65;
        margin: 0;
    }

    /* ===== TESTIMONIALS SECTION ===== */
    .testimonials-section {
        padding: 88px 0;
        background: var(--bg-light);
    }

    .testimonials-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 28px;
        max-width: 1080px;
        margin: 0 auto;
    }

    .testimonial-card {
        background: #fff;
        border-radius: 16px;
        padding: 34px;
        border: 1px solid var(--border);
        transition: transform .3s ease, box-shadow .3s ease;
        position: relative;
    }

    .testimonial-card::before {
        content: '\201C';
        position: absolute;
        top: 18px;
        right: 26px;
        font-size: 56px;
        font-weight: 800;
        color: var(--blue-light);
        line-height: 1;
        font-family: Georgia, serif;
    }

    .testimonial-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 40px rgba(10, 20, 46, .08);
    }

    .testimonial-stars {
        color: #F2C400;
        margin-bottom: 16px;
        font-size: 13px;
        letter-spacing: 3px;
    }

    .testimonial-text {
        font-size: 15.5px;
        line-height: 1.7;
        color: #374151;
        margin-bottom: 24px;
        position: relative;
        z-index: 1;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 14px;
        padding-top: 18px;
        border-top: 1px solid var(--border);
    }

    .author-avatar {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        overflow: hidden;
        flex-shrink: 0;
    }

    .author-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .author-info h4 {
        font-size: 14.5px;
        font-weight: 700;
        color: var(--text);
        margin: 0;
    }

    .author-info span {
        font-size: 12.5px;
        color: #6b7280;
    }

    /* ===== FAQ SECTION ===== */
    .faq-section {
        padding: 88px 0;
        background: #fff;
    }

    .faq-grid {
        max-width: 760px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .faq-item {
        background: var(--bg-light);
        border-radius: 12px;
        overflow: hidden;
        transition: box-shadow .25s ease, background .25s ease;
        border: 1px solid var(--border);
    }

    .faq-item:hover {
        box-shadow: 0 6px 24px rgba(10, 20, 46, .06);
    }

    .faq-item.active {
        background: #fff;
        border-color: var(--blue);
    }

    .faq-question {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 19px 24px;
        cursor: pointer;
        font-weight: 600;
        font-size: 16px;
        color: var(--text);
        transition: color .2s;
        user-select: none;
    }

    .faq-item.active .faq-question {
        color: var(--blue);
    }

    .faq-question i {
        font-size: 13px;
        color: var(--blue);
        transition: transform .3s ease;
        flex-shrink: 0;
        margin-left: 16px;
    }

    .faq-item.active .faq-question i {
        transform: rotate(180deg);
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height .4s cubic-bezier(.4, 0, .2, 1), padding .3s;
        padding: 0 24px;
    }

    .faq-item.active .faq-answer {
        max-height: 300px;
        padding: 0 24px 22px;
    }

    .faq-answer p {
        color: #4b5563;
        font-size: 14.5px;
        line-height: 1.7;
        margin: 0;
    }

    /* ===== CTA SECTION ===== */
    .cta-section {
        padding: 90px 0;
        background: linear-gradient(135deg, var(--blue) 0%, var(--blue-dark) 100%);
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: -60%;
        right: -10%;
        width: 420px;
        height: 420px;
        background: rgba(255, 255, 255, .06);
        border-radius: 50%;
    }

    .cta-content {
        position: relative;
        z-index: 1;
        text-align: center;
    }

    .cta-content h2 {
        color: #fff;
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 12px;
        letter-spacing: -0.02em;
    }

    .cta-content p {
        color: rgba(255, 255, 255, .85);
        font-size: 16px;
        margin-bottom: 32px;
        max-width: 480px;
        margin-left: auto;
        margin-right: auto;
    }

    .cta-buttons {
        display: flex;
        justify-content: center;
        gap: 16px;
        flex-wrap: wrap;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 13px 30px;
        font-weight: 700;
        font-size: 15px;
        border-radius: 8px;
        text-decoration: none;
        transition: all .25s ease;
        border: 2px solid transparent;
        cursor: pointer;
    }

    .btn-primary {
        background: #fff;
        color: var(--blue);
    }

    .btn-primary:hover {
        background: transparent;
        color: #fff;
        border-color: #fff;
        transform: translateY(-2px);
    }

    .btn-outline {
        background: transparent;
        color: #fff;
        border-color: rgba(255, 255, 255, .35);
    }

    .btn-outline:hover {
        background: rgba(255, 255, 255, .12);
        border-color: #fff;
        transform: translateY(-2px);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 900px) {
        .why-choose-grid {
            grid-template-columns: 1fr;
            gap: 36px;
        }

        .why-choose-media img {
            max-height: 320px;
        }
    }

    @media (max-width: 768px) {
        .section-header h2 {
            font-size: 26px;
        }

        .faq-section,
        .testimonials-section,
        .features-section,
        .cta-section,
        .why-choose-section {
            padding: 60px 0;
        }

        .testimonials-grid,
        .features-grid {
            grid-template-columns: 1fr;
        }

        .why-choose-list {
            grid-template-columns: 1fr;
        }

        .cta-content h2 {
            font-size: 26px;
        }

        .page-header h1 {
            font-size: 24px;
        }
    }

    @media (max-width: 600px) {
        .page-header {
            padding: 36px 0 30px;
            margin-bottom: 32px;
        }

        .page-header h1 {
            font-size: 24px;
        }

        .faq-question {
            font-size: 15px;
            padding: 14px 18px;
        }

        .testimonial-card,
        .feature-card {
            padding: 24px;
        }

        .cta-buttons {
            flex-direction: column;
        }

        .btn {
            justify-content: center;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .feature-card,
        .testimonial-card,
        .btn,
        .faq-question i,
        .faq-answer {
            transition: none !important;
        }
    }
</style>

<script>
    function toggleFaq(element) {
        const item = element.closest('.faq-item');
        const isActive = item.classList.contains('active');

        // Close all other items
        document.querySelectorAll('.faq-item').forEach(el => {
            if (el !== item) {
                el.classList.remove('active');
            }
        });

        if (isActive) {
            item.classList.remove('active');
        } else {
            item.classList.add('active');
        }
    }

    // Auto-open first FAQ item
    document.addEventListener('DOMContentLoaded', function() {
        const firstFaq = document.querySelector('.faq-item');
        if (firstFaq) {
            firstFaq.classList.add('active');
        }
    });
</script>

@endsection