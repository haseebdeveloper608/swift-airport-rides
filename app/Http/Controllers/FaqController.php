<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        // Auto-seed default FAQs if table is empty
        if (Faq::count() === 0) {
            $defaultFaqs = [
                [
                    'question' => 'How do I book an airport transfer with Swift Ride Taxis?',
                    'answer' => 'You can book directly on our website in under two minutes. Simply enter your pickup location, drop-off destination, pickup date and time, select your preferred vehicle class, and complete your fixed-fare booking online.',
                    'category' => 'Booking & Fares',
                    'sort_order' => 1,
                    'is_active' => true,
                ],
                [
                    'question' => 'Are your fares 100% fixed with no hidden costs?',
                    'answer' => 'Yes! All prices listed during checkout are fully fixed. There are no hidden charges, no meter rates, and no surge pricing regardless of traffic conditions.',
                    'category' => 'Booking & Fares',
                    'sort_order' => 2,
                    'is_active' => true,
                ],
                [
                    'question' => 'What happens if my flight is delayed?',
                    'answer' => 'We monitor all flights in real time using official flight tracking data. If your flight is delayed, your driver will automatically adjust their arrival time at no additional charge.',
                    'category' => 'Airport Pickups',
                    'sort_order' => 3,
                    'is_active' => true,
                ],
                [
                    'question' => 'Where will I meet my driver at the airport?',
                    'answer' => 'Our driver will meet you inside the arrivals terminal holding a nameboard with your name. Specific meeting points for Heathrow, Gatwick, Stansted, Luton, and London City will also be detailed in your booking confirmation email.',
                    'category' => 'Airport Pickups',
                    'sort_order' => 4,
                    'is_active' => true,
                ],
                [
                    'question' => 'What vehicle options and luggage capacities are available?',
                    'answer' => 'We offer Saloons (up to 4 passengers, 2 large bags), Executive Saloons (up to 4 passengers, 2 large bags), MPVs (up to 6 passengers, 4 bags), and Minibuses (up to 8 passengers, 8 bags).',
                    'category' => 'Vehicles & Luggage',
                    'sort_order' => 5,
                    'is_active' => true,
                ],
                [
                    'question' => 'Can I request child seats or booster seats?',
                    'answer' => 'Yes, child and booster seats are available upon request during the booking process to ensure safe travel for your family.',
                    'category' => 'Vehicles & Luggage',
                    'sort_order' => 6,
                    'is_active' => true,
                ],
                [
                    'question' => 'What is your cancellation and refund policy?',
                    'answer' => 'You can cancel your booking free of charge up to 24 hours prior to pickup. Cancellations within 24 hours can be processed through our customer support team as per our standard terms.',
                    'category' => 'Payments & Cancellations',
                    'sort_order' => 7,
                    'is_active' => true,
                ],
                [
                    'question' => 'What payment methods do you accept?',
                    'answer' => 'We accept all major credit and debit cards (Visa, MasterCard, American Express) securely processed via SSL encryption.',
                    'category' => 'Payments & Cancellations',
                    'sort_order' => 8,
                    'is_active' => true,
                ],
            ];

            foreach ($defaultFaqs as $faq) {
                Faq::create($faq);
            }
        }

        $faqs = Faq::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy('category');

        return view('faq', compact('faqs'));
    }
}
