<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        $websiteSettings = WebsiteSetting::first();

        if (! $websiteSettings) {
            $websiteSettings = WebsiteSetting::create($this->getDefaultSettings());
        }

        return view('admin.pages.inner.home', compact('websiteSettings'));
    }

    public function store(Request $request)
    {
        $settings = WebsiteSetting::firstOrNew();
        $payload = $this->normalizePayload($request);

        $settings->fill($payload);
        $settings->save();

        return response()->json([
            'success' => true,
            'message' => 'Homepage content saved successfully.',
            'settings_id' => $settings->id,
        ]);
    }

    public function update(Request $request)
    {
        return $this->store($request);
    }

    protected function normalizePayload(Request $request): array
    {
        $payload = [];
        $persistableKeys = $this->getPersistableKeys();
        $arrayFields = ['hero_benefits', 'stats', 'services_list', 'about_checkmarks', 'airports_list', 'fleet_vehicles', 'story_values', 'reviews_list', 'faq_list', 'sections_enabled'];
        $boolFields = ['reviews_enabled', 'faq_enabled', 'schema_enabled'];

        foreach ($request->all() as $key => $value) {
            if (! in_array($key, $persistableKeys, true)) {
                continue;
            }

            if (in_array($key, $arrayFields, true)) {
                $payload[$key] = $this->normalizeJsonValue($value);
                continue;
            }

            if (in_array($key, $boolFields, true)) {
                $payload[$key] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
                continue;
            }

            if ($request->hasFile($key)) {
                $path = $request->file($key)->store('homepage', 'public');
                $payload[$key] = 'storage/' . $path;
                continue;
            }

            $payload[$key] = $this->normalizeTextValue($value);
        }

        if ($request->has('sections_enabled')) {
            $payload['sections_enabled'] = $this->normalizeJsonValue($request->input('sections_enabled', []));
        }

        return $payload;
    }

    protected function getPersistableKeys(): array
    {
        return [
            'hero_badge_text',
            'hero_title_line1',
            'hero_title_line2',
            'hero_title_gradient_text',
            'hero_description',
            'hero_background_image',
            'hero_benefits',
            'hero_form_discount_text',
            'hero_form_submit_text',
            'hero_form_note_text',
            'stats',
            'services_label',
            'services_heading_line1',
            'services_heading_line2',
            'services_heading_gradient',
            'services_description',
            'services_button_text',
            'services_list',
            'about_badge',
            'about_heading_line1',
            'about_heading_line2',
            'about_description',
            'about_experience_years',
            'about_experience_text',
            'about_image',
            'about_checkmarks',
            'about_button_text',
            'about_button_link',
            'airports_label',
            'airports_heading_line1',
            'airports_heading_line2',
            'airports_view_all_text',
            'airports_list',
            'coverage_label',
            'coverage_heading_line1',
            'coverage_heading_line2',
            'coverage_description',
            'coverage_button_text',
            'coverage_map_image',
            'coverage_background_image',
            'coverage_float_card_title',
            'coverage_float_card_route',
            'coverage_float_card_price',
            'coverage_float_card_price_text',
            'fleet_label',
            'fleet_heading',
            'fleet_subheading',
            'fleet_view_all_text',
            'fleet_vehicles',
            'story_label',
            'story_heading_line1',
            'story_heading_line2',
            'story_paragraph1',
            'story_paragraph2',
            'story_image',
            'story_values',
            'reviews_label',
            'reviews_heading',
            'reviews_description',
            'reviews_enabled',
            'reviews_list',
            'faq_label',
            'faq_heading',
            'faq_description',
            'faq_enabled',
            'faq_list',
            'meta_title',
            'meta_description',
            'meta_keywords',
            'meta_og_image',
            'sections_enabled',
            'schema_enabled',
            'schema_type',
            'schema_org_name',
            'schema_org_url',
            'schema_org_logo',
            'schema_org_phone',
            'schema_org_email',
            'schema_business_street',
            'schema_business_city',
            'schema_business_state',
            'schema_business_postal',
            'schema_business_country',
            'schema_social_profiles',
            'schema_custom_json',
        ];
    }

    protected function getDefaultSettings(): array
    {
        return [
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
            'reviews_enabled' => true,
            'faq_label' => 'COMMON QUESTIONS',
            'faq_heading' => 'Frequently Asked Questions',
            'faq_description' => 'Everything you need to know before booking with Airport Rides.',
            'faq_enabled' => true,
            'schema_enabled' => true,
            'schema_type' => 'organization',
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
        ];
    }

    protected function normalizeJsonValue($value)
    {
        if (is_string($value) && $value !== '') {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }
        }

        if (is_array($value)) {
            return $value;
        }

        return [];
    }

    protected function normalizeTextValue($value)
    {
        if (is_array($value)) {
            foreach ($value as $key => $item) {
                $value[$key] = $this->normalizeTextValue($item);
            }

            return $value;
        }

        if ($value === null) {
            return null;
        }

        if (is_string($value)) {
            $value = preg_replace('/<p[^>]*>/i', '', $value);
            $value = preg_replace('/<\/p>/i', '', $value);
            $value = preg_replace('/<br\s*\/>/i', "\n", $value);

            return trim($value);
        }

        return $value;
    }
}
