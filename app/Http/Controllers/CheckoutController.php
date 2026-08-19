<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function create(Request $request): RedirectResponse
    {
        if ($request->has('head_passenger_name') && !$request->filled('first_name')) {
            $fullName = trim((string) $request->input('head_passenger_name'));
            $parts = explode(' ', $fullName, 2);
            $request->merge([
                'first_name' => $parts[0] ?? $fullName,
                'last_name' => $parts[1] ?? '',
            ]);
        }

        if ($request->has('phone_code') && $request->filled('phone')) {
            $phone = trim((string) $request->input('phone'));
            $code = trim((string) $request->input('phone_code'));
            if (!str_starts_with($phone, '+') && !str_starts_with($phone, $code)) {
                $request->merge([
                    'phone' => $code . ' ' . $phone,
                ]);
            }
        }

        $validated = $request->validate([
            'car' => ['required', 'string'],
            'pickup' => ['required', 'string'],
            'dropoff' => ['required', 'string'],
            'distance' => ['required', 'numeric'],
            'trip_type' => ['required', 'string'],
            'total_price' => ['required', 'numeric'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'passengers' => ['nullable'],
            'luggage' => ['nullable'],
            'pickup_date' => ['required', 'date'],
            'pickup_time' => ['required', 'string'],
            'outbound_flight_number' => ['nullable', 'string'],
            'outbound_flight_time' => ['nullable', 'string'],
            'meet_greet_outbound_fee' => ['nullable', 'numeric'],
            'notes' => ['nullable', 'string'],
            'return_date' => ['nullable', 'date'],
            'return_time' => ['nullable', 'string'],
            'return_flight_number' => ['nullable', 'string'],
            'return_flight_time' => ['nullable', 'string'],
            'meet_greet_return_fee' => ['nullable', 'numeric'],
            'return_notes' => ['nullable', 'string'],
        ]);

        $stripeSecret = config('services.stripe.secret') ?: env('STRIPE_SECRET');
        Stripe::setApiKey((string) $stripeSecret);

        $session = Session::create([
            'mode' => 'payment',
            'customer_email' => $validated['email'],
            'line_items' => [[
                'quantity' => 1,
                'price_data' => [
                    'currency' => 'gbp',
                    'unit_amount' => (int) round($validated['total_price'] * 100),
                    'product_data' => [
                        'name' => $validated['car'] . ' Transfer',
                        'description' => $validated['pickup'] . ' to ' . $validated['dropoff'] . ' (' . $validated['distance'] . ' miles)',
                    ],
                ],
            ]],
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => url()->previous(),
            'metadata' => [
                'car_name' => $validated['car'],
                'pickup' => $validated['pickup'],
                'dropoff' => $validated['dropoff'],
                'miles' => (string) $validated['distance'],
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'] ?? '',
                'customer_email' => $validated['email'],
                'customer_phone' => $validated['phone'],
                'trip_type' => $validated['trip_type'],
                'pickup_date' => $validated['pickup_date'],
                'pickup_time' => $validated['pickup_time'],
                'outbound_flight_number' => $validated['outbound_flight_number'] ?? '',
                'outbound_flight_time' => $validated['outbound_flight_time'] ?? '',
                'meet_greet_outbound_fee' => (string) ($validated['meet_greet_outbound_fee'] ?? 0),
                'notes' => $validated['notes'] ?? '',
                'return_date' => $validated['return_date'] ?? '',
                'return_time' => $validated['return_time'] ?? '',
                'return_flight_number' => $validated['return_flight_number'] ?? '',
                'return_flight_time' => $validated['return_flight_time'] ?? '',
                'meet_greet_return_fee' => (string) ($validated['meet_greet_return_fee'] ?? 0),
                'return_notes' => $validated['return_notes'] ?? '',
            ],
        ]);

        return redirect($session->url);
    }

    public function success(Request $request): RedirectResponse
    {
        $sessionId = (string) $request->query('session_id', '');
        if ($sessionId === '') {
            return redirect('/')->with('error', 'Missing Stripe session id.');
        }

        $stripeSecret = config('services.stripe.secret') ?: env('STRIPE_SECRET');
        Stripe::setApiKey((string) $stripeSecret);

        try {
            $session = Session::retrieve($sessionId);
        } catch (ApiErrorException $e) {
            return redirect('/')->with('error', 'Unable to verify payment session.');
        }

        if (($session->payment_status ?? '') !== 'paid') {
            return redirect('/')->with('error', 'Payment was not completed.');
        }

        $order = Order::firstOrCreate(
            ['stripe_session_id' => $session->id],
            [
                'stripe_payment_intent_id' => (string) ($session->payment_intent ?? ''),
                'customer_email' => (string) ($session->metadata->customer_email ?? ''),
                'first_name' => (string) ($session->metadata->first_name ?? ''),
                'last_name' => (string) ($session->metadata->last_name ?? ''),
                'customer_name' => trim((string) ($session->metadata->first_name ?? '') . ' ' . (string) ($session->metadata->last_name ?? '')),
                'customer_phone' => (string) ($session->metadata->customer_phone ?? ''),
                'car_name' => (string) ($session->metadata->car_name ?? 'Taxi Booking'),
                'pickup' => (string) ($session->metadata->pickup ?? ''),
                'dropoff' => (string) ($session->metadata->dropoff ?? ''),
                'pickup_date' => ($session->metadata->pickup_date ?: null),
                'pickup_time' => ($session->metadata->pickup_time ?: null),
                'outbound_flight_number' => (string) ($session->metadata->outbound_flight_number ?? ''),
                'outbound_flight_time' => ($session->metadata->outbound_flight_time ?: null),
                'meet_greet_outbound_fee' => (float) ($session->metadata->meet_greet_outbound_fee ?? 0),
                'notes' => (string) ($session->metadata->notes ?? ''),
                'return_date' => ($session->metadata->return_date ?: null),
                'return_time' => ($session->metadata->return_time ?: null),
                'return_flight_number' => (string) ($session->metadata->return_flight_number ?? ''),
                'return_flight_time' => ($session->metadata->return_flight_time ?: null),
                'meet_greet_return_fee' => (float) ($session->metadata->meet_greet_return_fee ?? 0),
                'return_notes' => (string) ($session->metadata->return_notes ?? ''),
                'trip_type' => (string) ($session->metadata->trip_type ?? 'oneway'),
                'miles' => (float) ($session->metadata->miles ?? 0),
                'amount' => ((float) ($session->amount_total ?? 0)) / 100,
                'currency' => (string) ($session->currency ?? 'gbp'),
                'status' => 'paid',
            ]
        );

        return redirect()->route('checkout.success.view', ['order' => $order->id]);
    }

    public function showSuccess(Order $order)
    {
        return view('checkout.success', compact('order'));
    }
}
