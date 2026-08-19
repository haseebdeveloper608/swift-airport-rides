<?php
// database/migrations/2026_07_27_000000_create_homepages_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('homepages', function (Blueprint $table) {
            $table->id();
            
            // Section Enable/Disable
            $table->json('sections_enabled')->nullable();
            
            // Hero Section
            $table->string('hero_badge_text')->nullable();
            $table->text('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_background')->nullable();
            $table->json('hero_stats')->nullable();
            
            // Trust Strip
            $table->json('trust_strip')->nullable();
            
            // Why Choose Us Section
            $table->string('why_badge')->nullable();
            $table->text('why_heading')->nullable();
            $table->text('why_description')->nullable();
            $table->json('why_features')->nullable();
            $table->string('why_rating_label')->nullable();
            $table->string('why_rating_subtext')->nullable();
            $table->string('why_rating_icon')->nullable();
            $table->string('why_instant_label')->nullable();
            $table->string('why_instant_subtext')->nullable();
            $table->string('why_instant_icon')->nullable();
            $table->string('why_save_label')->nullable();
            $table->string('why_save_subtext')->nullable();
            $table->string('why_save_icon')->nullable();
            $table->string('why_btn_text')->nullable();
            $table->string('why_btn_link')->nullable();
            
            // Steps Section
            $table->string('steps_badge')->nullable();
            $table->text('steps_heading')->nullable();
            $table->string('steps_subheading')->nullable();
            $table->json('steps')->nullable();
            
            // Analytics Section
            $table->string('analytics_badge')->nullable();
            $table->text('analytics_heading')->nullable();
            $table->text('analytics_description')->nullable();
            $table->string('analytics_btn_text')->nullable();
            $table->string('analytics_btn_link')->nullable();
            $table->string('analytics_image')->nullable();
            
            // Compare Section
            $table->string('compare_badge')->nullable();
            $table->text('compare_heading')->nullable();
            $table->text('compare_subheading')->nullable();
            $table->text('compare_description')->nullable();
            $table->json('compare_features')->nullable();
            
            // Cities Section
            $table->string('cities_badge')->nullable();
            $table->text('cities_heading')->nullable();
            $table->string('cities_subheading')->nullable();
            $table->json('cities')->nullable();
            $table->json('airport_cities')->nullable();
            $table->json('train_cities')->nullable();
            
            // Fleet Section
            $table->string('fleet_badge')->nullable();
            $table->text('fleet_heading')->nullable();
            $table->text('fleet_subheading')->nullable();
            $table->json('fleet_vehicles')->nullable();
            
            // Testimonials Section
            $table->string('testimonials_badge')->nullable();
            $table->text('testimonials_heading')->nullable();
            $table->string('testimonials_subheading')->nullable();
            $table->json('testimonials')->nullable();
            
            // FAQ Section
            $table->string('faq_badge')->nullable();
            $table->text('faq_heading')->nullable();
            $table->string('faq_subheading')->nullable();
            $table->json('faqs')->nullable();
            
            // Blog Section
            $table->string('blog_badge')->nullable();
            $table->text('blog_heading')->nullable();
            $table->string('blog_subheading')->nullable();
            $table->integer('blog_posts_count')->default(3);
            
            // SEO Meta
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('seo_keywords')->nullable();
            $table->text('seo_schema')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepages');
    }
};