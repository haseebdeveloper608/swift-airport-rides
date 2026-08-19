<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('website_settings')) {
            Schema::create('website_settings', function (Blueprint $table) {
                $table->id();

                $table->string('hero_badge_text')->default('PREMIUM AIRPORT TRANSFERS ACROSS THE UK');
                $table->string('hero_title_line1')->default('Your Journey.');
                $table->string('hero_title_line2')->default('Our Priority.');
                $table->string('hero_title_gradient_text')->default('Priority');
                $table->text('hero_description')->default('Professional airport transfers, private taxi services and city-to-city rides with fixed fares, expert drivers and 24/7 support.');
                $table->string('hero_background_image')->nullable();
                $table->json('hero_benefits')->nullable();
                $table->string('hero_form_discount_text')->default('5% Discount on Return Booking');
                $table->string('hero_form_submit_text')->default('GET AN INSTANT QUOTE');
                $table->string('hero_form_note_text')->default('5% Discount on Return Booking | Fixed prices. No hidden charges.');

                $table->json('stats')->nullable();

                $table->string('services_label')->default('OUR SERVICES');
                $table->string('services_heading_line1')->default('Ride Your Way,');
                $table->string('services_heading_line2')->default('Anytime, Anywhere');
                $table->string('services_heading_gradient')->default('Anywhere');
                $table->text('services_description')->default('From airport pickups to business travel, we\'ve got the perfect ride for every journey.');
                $table->string('services_button_text')->default('VIEW ALL SERVICES');
                $table->json('services_list')->nullable();

                $table->string('about_badge')->default('ABOUT US');
                $table->string('about_heading_line1')->default('Your Trusted Taxi');
                $table->string('about_heading_line2')->default('Partner Across the UK');
                $table->text('about_description')->default('Swift-Ride-taxis is a UK-based taxi service company dedicated to providing reliable, punctual and comfortable transport solutions. Whether you\'re travelling for business, leisure or a special occasion, we are here to make your journey smooth and hassle-free.');
                $table->string('about_experience_years')->default('15+');
                $table->string('about_experience_text')->default('Years of Experience');
                $table->string('about_image')->nullable();
                $table->json('about_checkmarks')->nullable();
                $table->string('about_button_text')->default('Learn More About Us');
                $table->string('about_button_link')->default('/about');

                $table->string('airports_label')->default('MAJOR AIRPORT TRANSFERS');
                $table->string('airports_heading_line1')->default('All Major Airports');
                $table->string('airports_heading_line2')->default('Across the UK');
                $table->string('airports_view_all_text')->default('View all airports');
                $table->json('airports_list')->nullable();

                $table->string('coverage_label')->default('WIDE COVERAGE');
                $table->string('coverage_heading_line1')->default('We Cover All Major Cities');
                $table->string('coverage_heading_line2')->default('& Airports Across the UK');
                $table->text('coverage_description')->default('Wherever you are, we\'ll get you there. Safe, on-time and comfortable.');
                $table->string('coverage_button_text')->default('EXPLORE LOCATIONS');
                $table->string('coverage_map_image')->nullable();
                $table->string('coverage_background_image')->nullable();
                $table->string('coverage_float_card_title')->default('City to City Transfers');
                $table->string('coverage_float_card_route')->default('London ↔ Manchester');
                $table->string('coverage_float_card_price')->default('£120');
                $table->string('coverage_float_card_price_text')->default('From');

                $table->string('fleet_label')->default('OUR FLEET');
                $table->string('fleet_heading')->default('Travel in Comfort & Style');
                $table->string('fleet_subheading')->default('A range of modern vehicles to suit your needs.');
                $table->string('fleet_view_all_text')->default('View all vehicles');
                $table->json('fleet_vehicles')->nullable();

                $table->string('story_label')->default('OUR STORY');
                $table->string('story_heading_line1')->default('The Journey Behind');
                $table->string('story_heading_line2')->default('Swift-Ride-taxis');
                $table->text('story_paragraph1')->default('We understand that travelling can be stressful. From flight delays to last-minute changes, you need a transfer service you can rely on.');
                $table->text('story_paragraph2')->default('That\'s why we focus on punctuality, comfort and peace of mind — ensuring every journey is smooth from the moment you book with us.');
                $table->string('story_image')->nullable();
                $table->json('story_values')->nullable();

                $table->string('reviews_label')->default('REVIEWS');
                $table->string('reviews_heading')->default('What passengers are saying');
                $table->text('reviews_description')->default('Verified reviews are collected after every completed journey to ensure genuine feedback and help maintain the highest standards of service.');
                $table->boolean('reviews_enabled')->default(true);
                $table->json('reviews_list')->nullable();

                $table->string('faq_label')->default('COMMON QUESTIONS');
                $table->string('faq_heading')->default('Frequently Asked Questions');
                $table->text('faq_description')->default('Everything you need to know before booking with Airport Rides.');
                $table->boolean('faq_enabled')->default(true);
                $table->json('faq_list')->nullable();

                $table->string('meta_title')->nullable();
                $table->text('meta_description')->nullable();
                $table->string('meta_keywords')->nullable();
                $table->string('meta_og_image')->nullable();

                $table->json('sections_enabled')->nullable();

                $table->boolean('schema_enabled')->default(true);
                $table->string('schema_type')->default('organization');
                $table->string('schema_org_name')->nullable();
                $table->string('schema_org_url')->nullable();
                $table->string('schema_org_logo')->nullable();
                $table->string('schema_org_phone')->nullable();
                $table->string('schema_org_email')->nullable();
                $table->string('schema_business_street')->nullable();
                $table->string('schema_business_city')->nullable();
                $table->string('schema_business_state')->nullable();
                $table->string('schema_business_postal')->nullable();
                $table->string('schema_business_country')->nullable();
                $table->text('schema_social_profiles')->nullable();
                $table->text('schema_custom_json')->nullable();

                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('website_settings');
    }
};
