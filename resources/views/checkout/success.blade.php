@extends('layout.app')

@section('title', 'Booking Confirmed - Swift Ride Taxis')

@push('styles')
<style>
    /* ===== CONFIRMATION — brand system ===== */
    .confirm-wrap {
        --paper: #F4F7FB;
        --panel: #FFFFFF;
        --navy-800: #071326;
        --navy-700: #12305A;
        --signal: #FFCC26;
        --signal-dim: #F2B900;
        --sky-soft: #F0F6FF;
        --sky: #3D7BFF;
        --line: #DDE6F2;
        --steel: #71809A;
        --ink: #17253D;
        --font-mono: 'IBM Plex Mono', 'Courier New', monospace;
        --radius: 22px;
        --shadow: 0 24px 70px rgba(7, 19, 38, 0.16);
        background: var(--paper);
        padding: 64px 20px 90px;
        min-height: calc(100vh - 76px);
        position: relative;
        isolation: isolate;
    }

    .confirm-wrap::before {
        content: '';
        position: absolute;
        inset: 0 0 auto;
        height: 260px;
        background: linear-gradient(135deg, #071326 0%, #102D58 100%);
        z-index: -1;
    }

    .confirm-card {
        max-width: 760px;
        margin: 0 auto;
        background: var(--panel);
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow);
    }

    .confirm-top {
        background: var(--navy-800);
        border-bottom: 4px solid var(--signal);
        padding: 26px 32px;
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .confirm-top .tick {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 50%;
        background: var(--signal);
        color: var(--navy-800);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .confirm-top h1 {
        color: #fff;
        font-size: 24px;
        font-weight: 800;
        line-height: 1.2;
    }

    .confirm-top p {
        color: rgba(255, 255, 255, .6);
        font-family: var(--font-mono);
        font-size: 12px;
        letter-spacing: .08em;
        text-transform: uppercase;
        margin-top: 4px;
    }

    .confirm-body {
        padding: 32px;
    }

    .confirm-ref {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-family: var(--font-mono);
        font-size: 13px;
        font-weight: 700;
        color: var(--navy-700);
        background: var(--sky-soft);
        border-radius: 8px;
        padding: 8px 14px;
        margin-bottom: 24px;
    }

    .trip-sheet {
        border: 1.5px solid var(--line);
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 22px;
    }

    .trip-row {
        display: grid;
        grid-template-columns: 170px 1fr;
        gap: 12px;
        padding: 13px 18px;
        font-size: 14px;
    }

    .trip-row + .trip-row {
        border-top: 1px dashed var(--line);
    }

    .trip-row .k {
        font-family: var(--font-mono);
        font-size: 11px;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: var(--steel);
        align-self: center;
    }

    .trip-row .v {
        color: var(--ink);
        font-weight: 600;
    }

    .trip-row.total {
        background: var(--paper);
    }

    .trip-row.total .v {
        font-family: var(--font-mono);
        font-size: 18px;
        font-weight: 700;
        color: var(--navy-700);
    }

    .next-steps {
        background: var(--sky-soft);
        border: 1px solid #d5e2fb;
        border-radius: 12px;
        padding: 22px 24px;
    }

    .next-steps h2 {
        font-size: 16px;
        font-weight: 750;
        color: var(--navy-700);
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .next-steps h2 i {
        color: var(--sky);
    }

    .next-steps ul {
        margin: 0;
        padding-left: 20px;
        color: #33405c;
        font-size: 14px;
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .confirm-home-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin-top: 28px;
        padding: 14px 26px;
        background: var(--signal);
        color: var(--navy-800);
        border-radius: 9px;
        font-family: var(--font-mono);
        font-size: 13px;
        font-weight: 700;
        letter-spacing: .05em;
        text-transform: uppercase;
        transition: background .2s, transform .15s;
    }

    .confirm-home-btn:hover {
        background: var(--signal-dim);
        transform: translateY(-2px);
    }

    .confirm-home-btn:focus-visible {
        outline: 3px solid rgba(61, 123, 255, .35);
        outline-offset: 3px;
    }

    @media (max-width: 560px) {
        .confirm-wrap {
            padding: 34px 12px 60px;
            min-height: calc(100vh - 62px);
        }

        .confirm-top {
            padding: 22px 20px;
        }

        .confirm-top h1 {
            font-size: 20px;
        }

        .confirm-body {
            padding: 22px;
        }

        .trip-row {
            grid-template-columns: 1fr;
            gap: 3px;
        }
    }
</style>
@endpush

@section('content')
<div class="confirm-wrap">
    <div class="confirm-card">
        <div class="confirm-top">
            <div class="tick"><i class="fas fa-check"></i></div>
            <div>
                <h1>Thank you, {{ $order->first_name }}!</h1>
                <p>Booking confirmed · Payment complete</p>
            </div>
        </div>
        <div class="confirm-body">
            <span class="confirm-ref"><i class="fas fa-ticket"></i> Booking reference #{{ $order->id }}</span>

            <div class="trip-sheet">
                <div class="trip-row">
                    <span class="k">Vehicle</span>
                    <span class="v">{{ $order->car_name }}</span>
                </div>
                <div class="trip-row">
                    <span class="k">Route</span>
                    <span class="v">{{ $order->pickup }} → {{ $order->dropoff }}</span>
                </div>
                <div class="trip-row">
                    <span class="k">Pickup</span>
                    <span class="v">{{ optional($order->pickup_date)->format('j M Y') ?? 'N/A' }} at {{ $order->pickup_time ?? 'N/A' }}</span>
                </div>
                @if($order->trip_type === 'return')
                    <div class="trip-row">
                        <span class="k">Return</span>
                        <span class="v">{{ optional($order->return_date)->format('j M Y') ?? 'N/A' }} at {{ $order->return_time ?? 'N/A' }}</span>
                    </div>
                @endif
                <div class="trip-row total">
                    <span class="k">Total paid</span>
                    <span class="v">£{{ number_format($order->amount, 2) }}</span>
                </div>
            </div>

            <div class="next-steps">
                <h2><i class="fas fa-route"></i> What's next?</h2>
                <ul>
                    <li>Check your email for confirmation and pickup instructions.</li>
                    <li>Your driver will contact you before the journey.</li>
                    <li>If you need to edit your booking, reply to this email or contact support.</li>
                </ul>
            </div>

            <a href="{{ route('home') }}" class="confirm-home-btn"><i class="fas fa-house"></i> Back to home</a>
        </div>
    </div>
</div>
@endsection
