<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('about_pages')) {
            Schema::table('about_pages', function (Blueprint $table) {
                $table->string('hero_tag')->default('ABOUT US');
                $table->string('hero_highlight_text')->default('You.');
                $table->string('hero_background_image')->nullable();
                $table->text('hero_quote_text')->nullable();
                $table->string('hero_quote_author')->nullable();
                $table->boolean('hero_quote_visible')->default(true);
                $table->string('story_main_image')->nullable();
                $table->string('story_overlap_image')->nullable();
                $table->string('story_badge_text')->default('CUSTOMER FIRST APPROACH');
                $table->json('story_pillars')->nullable();
                $table->json('stats')->nullable();
                $table->boolean('stats_visible')->default(true);
                $table->string('values_eyebrow')->default('OUR VALUES');
                $table->string('values_heading')->nullable();
                $table->json('values')->nullable();
                $table->boolean('values_visible')->default(true);
                $table->string('mission_eyebrow')->default('OUR MISSION');
                $table->text('mission_heading')->nullable();
                $table->text('mission_description')->nullable();
                $table->string('mission_background_image')->nullable();
                $table->boolean('mission_visible')->default(true);
                $table->string('cta_subheading')->default("We're here to help 24/7");
                $table->string('cta_phone_label')->default('CALL 020 1234 5678');
                $table->string('cta_phone_number')->default('02012345678');
                $table->string('cta_button_text')->default('GET IN TOUCH');
                $table->string('cta_button_url')->default('/contact');
                $table->boolean('cta_visible')->default(true);
                $table->boolean('is_active')->default(true);
                $table->string('page_slug')->unique()->default('about-us');
                $table->timestamp('published_at')->nullable();
                $table->softDeletes();
            });

            return;
        }

        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->string('hero_heading')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_tag')->default('ABOUT US');
            $table->string('hero_highlight_text')->default('You.');
            $table->string('hero_background_image')->nullable();
            $table->text('hero_quote_text')->nullable();
            $table->string('hero_quote_author')->nullable();
            $table->boolean('hero_quote_visible')->default(true);
            $table->string('story_eyebrow')->default('OUR STORY');
            $table->string('story_heading')->nullable();
            $table->text('story_paragraph_1')->nullable();
            $table->text('story_paragraph_2')->nullable();
            $table->string('story_main_image')->nullable();
            $table->string('story_overlap_image')->nullable();
            $table->string('story_badge_text')->default('CUSTOMER FIRST APPROACH');
            $table->json('story_pillars')->nullable();
            $table->json('stats')->nullable();
            $table->boolean('stats_visible')->default(true);
            $table->string('values_eyebrow')->default('OUR VALUES');
            $table->string('values_heading')->nullable();
            $table->json('values')->nullable();
            $table->boolean('values_visible')->default(true);
            $table->string('mission_eyebrow')->default('OUR MISSION');
            $table->text('mission_heading')->nullable();
            $table->text('mission_description')->nullable();
            $table->string('mission_background_image')->nullable();
            $table->boolean('mission_visible')->default(true);
            $table->string('cta_heading')->default('Have Questions?');
            $table->string('cta_subheading')->default("We're here to help 24/7");
            $table->string('cta_phone_label')->default('CALL 020 1234 5678');
            $table->string('cta_phone_number')->default('02012345678');
            $table->string('cta_button_text')->default('GET IN TOUCH');
            $table->string('cta_button_url')->default('/contact');
            $table->boolean('cta_visible')->default(true);
            $table->boolean('is_active')->default(true);
            $table->string('page_slug')->unique()->default('about-us');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_pages');
    }
};