<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Car;
use App\Models\Pages as Homepage;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $cars = Car::all()->map(function ($car) {
            $image = $car->image ?: null;
            if ($image && !str_starts_with($image, 'http://') && !str_starts_with($image, 'https://')) {
                $image = asset('storage/' . ltrim($image, '/'));
            }

            return [
                'name' => $car->name,
                'tag' => $car->destination ?? '',
                'seats' => $car->seats ?? 4,
                'bags' => $car->bags ?? 2,
                'desc' => $car->description ?? '',
                'features' => $car->features ?? [],
                'image' => $image ?: 'https://pngimg.com/uploads/mercedes/mercedes_PNG80190.png',
                'calculated_price' => $car->calculated_price ?? $car->price ?? $car->base_price ?? 0,
            ];
        })->values();

        $blogs = Blog::where('status', 'published')
            ->latest('created_at')
            ->take(3)
            ->get();

        $homepage = Homepage::where('name', 'default')->first()
            ?? Homepage::latest('id')->first();
        $websiteSettings = WebsiteSetting::first() ?: WebsiteSetting::create([
            'hero_badge_text' => 'PREMIUM AIRPORT TRANSFERS ACROSS THE UK',
            'hero_title_line1' => 'Your Journey.',
            'hero_title_line2' => 'Our Priority.',
            'hero_title_gradient_text' => 'Priority',
            'hero_description' => 'Professional airport transfers, private taxi services and city-to-city rides with fixed fares, expert drivers and 24/7 support.',
            'hero_form_discount_text' => '5% Discount on Return Booking',
            'hero_form_submit_text' => 'GET AN INSTANT QUOTE',
            'hero_form_note_text' => '5% Discount on Return Booking | Fixed prices. No hidden charges.',
            'services_label' => 'OUR SERVICES',
            'services_heading_line1' => 'Ride Your Way,',
            'services_heading_line2' => 'Anytime, Anywhere',
            'services_heading_gradient' => 'Anywhere',
            'services_description' => 'From airport pickups to business travel, we\'ve got the perfect ride for every journey.',
            'services_button_text' => 'VIEW ALL SERVICES',
            'about_badge' => 'ABOUT US',
            'about_heading_line1' => 'Your Trusted Taxi',
            'about_heading_line2' => 'Partner Across the UK',
            'about_description' => 'Swift-Ride-taxis is a UK-based taxi service company dedicated to providing reliable, punctual and comfortable transport solutions. Whether you\'re travelling for business, leisure or a special occasion, we are here to make your journey smooth and hassle-free.',
            'about_experience_years' => '15+',
            'about_experience_text' => 'Years of Experience',
            'about_button_text' => 'Learn More About Us',
            'about_button_link' => '/about',
            'airports_label' => 'MAJOR AIRPORT TRANSFERS',
            'airports_heading_line1' => 'All Major Airports',
            'airports_heading_line2' => 'Across the UK',
            'airports_view_all_text' => 'View all airports',
            'coverage_label' => 'WIDE COVERAGE',
            'coverage_heading_line1' => 'We Cover All Major Cities',
            'coverage_heading_line2' => '& Airports Across the UK',
            'coverage_description' => 'Wherever you are, we\'ll get you there. Safe, on-time and comfortable.',
            'coverage_button_text' => 'EXPLORE LOCATIONS',
            'coverage_float_card_title' => 'City to City Transfers',
            'coverage_float_card_route' => 'London ↔ Manchester',
            'coverage_float_card_price' => '£120',
            'coverage_float_card_price_text' => 'From',
            'fleet_label' => 'OUR FLEET',
            'fleet_heading' => 'Travel in Comfort & Style',
            'fleet_subheading' => 'A range of modern vehicles to suit your needs.',
            'fleet_view_all_text' => 'View all vehicles',
            'story_label' => 'OUR STORY',
            'story_heading_line1' => 'The Journey Behind',
            'story_heading_line2' => 'Swift-Ride-taxis',
            'story_paragraph1' => 'We understand that travelling can be stressful. From flight delays to last-minute changes, you need a transfer service you can rely on.',
            'story_paragraph2' => 'That\'s why we focus on punctuality, comfort and peace of mind — ensuring every journey is smooth from the moment you book with us.',
            'reviews_label' => 'REVIEWS',
            'reviews_heading' => 'What passengers are saying',
            'reviews_description' => 'Verified reviews are collected after every completed journey to ensure genuine feedback and help maintain the highest standards of service.',
            'faq_label' => 'COMMON QUESTIONS',
            'faq_heading' => 'Frequently Asked Questions',
            'faq_description' => 'Everything you need to know before booking with Airport Rides.',
            'sections_enabled' => [
                'hero' => true,
                'stats' => true,
                'services' => true,
                'about' => true,
                'airports' => true,
                'coverage' => true,
                'fleet' => true,
                'story' => true,
                'reviews' => true,
                'faq' => true,
            ],
        ]);

        return view('welcome', [
            'fleetCards' => $cars,
            'blogs' => $blogs,
            'homepage' => $homepage,
            'websiteSettings' => $websiteSettings,
        ]);
    }
}
