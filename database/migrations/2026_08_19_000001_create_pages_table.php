<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('pages')) {
            $textColumns = [
                'hero_badge_text', 'hero_title_line1', 'hero_title_line2', 'hero_title_gradient_text',
                'hero_description', 'hero_background_image', 'hero_form_discount_text',
                'hero_form_submit_text', 'hero_form_note_text', 'services_label', 'services_heading_line1',
                'services_heading_line2', 'services_heading_gradient', 'services_description',
                'services_button_text', 'about_badge', 'about_heading_line1', 'about_heading_line2',
                'about_description', 'about_experience_years', 'about_experience_text', 'about_image',
                'about_button_text', 'about_button_link', 'airports_label', 'airports_heading_line1',
                'airports_heading_line2', 'airports_view_all_text', 'coverage_label', 'coverage_heading_line1',
                'coverage_heading_line2', 'coverage_description', 'coverage_button_text', 'coverage_map_image',
                'coverage_background_image', 'coverage_float_card_title', 'coverage_float_card_route',
                'coverage_float_card_price', 'coverage_float_card_price_text', 'fleet_label', 'fleet_heading',
                'fleet_subheading', 'fleet_view_all_text', 'story_label', 'story_heading_line1',
                'story_heading_line2', 'story_paragraph1', 'story_paragraph2', 'story_image', 'reviews_label',
                'reviews_heading', 'reviews_description', 'faq_label', 'faq_heading', 'faq_description',
                'meta_title', 'meta_description', 'meta_keywords', 'meta_og_image', 'schema_type',
                'schema_org_name', 'schema_org_url', 'schema_org_logo', 'schema_org_phone', 'schema_org_email',
                'schema_business_street', 'schema_business_city', 'schema_business_state',
                'schema_business_postal', 'schema_business_country', 'schema_social_profiles',
                'schema_custom_json',
            ];
            $jsonColumns = ['hero_benefits', 'stats', 'services_list', 'about_checkmarks', 'airports_list', 'story_values', 'reviews_list', 'faq_list'];
            $booleanColumns = ['reviews_enabled', 'faq_enabled', 'schema_enabled'];

            Schema::table('pages', function (Blueprint $table) use ($textColumns, $jsonColumns, $booleanColumns) {
                foreach ($textColumns as $column) {
                    if (!Schema::hasColumn('pages', $column)) {
                        $table->text($column)->nullable();
                    }
                }
                foreach ($jsonColumns as $column) {
                    if (!Schema::hasColumn('pages', $column)) {
                        $table->json($column)->nullable();
                    }
                }
                foreach ($booleanColumns as $column) {
                    if (!Schema::hasColumn('pages', $column)) {
                        $table->boolean($column)->default(true);
                    }
                }
                if (!Schema::hasColumn('pages', 'deleted_at')) {
                    $table->softDeletes();
                }
            });

            return;
        }

        $textColumns = [
            'hero_badge_text', 'hero_title_line1', 'hero_title_line2', 'hero_title_gradient_text', 'hero_description',
            'hero_background_image', 'hero_form_discount_text', 'hero_form_submit_text', 'hero_form_note_text',
            'services_label', 'services_heading_line1', 'services_heading_line2', 'services_heading_gradient',
            'services_description', 'services_button_text', 'about_badge', 'about_heading_line1', 'about_heading_line2',
            'about_description', 'about_experience_years', 'about_experience_text', 'about_image', 'about_button_text',
            'about_button_link', 'airports_label', 'airports_heading_line1', 'airports_heading_line2',
            'airports_view_all_text', 'coverage_label', 'coverage_heading_line1', 'coverage_heading_line2',
            'coverage_description', 'coverage_button_text', 'coverage_map_image', 'coverage_background_image',
            'coverage_float_card_title', 'coverage_float_card_route', 'coverage_float_card_price',
            'coverage_float_card_price_text', 'fleet_label', 'fleet_heading', 'fleet_subheading', 'fleet_view_all_text',
            'story_label', 'story_heading_line1', 'story_heading_line2', 'story_paragraph1', 'story_paragraph2',
            'story_image', 'reviews_label', 'reviews_heading', 'reviews_description', 'faq_label', 'faq_heading',
            'faq_description', 'meta_title', 'meta_description', 'meta_keywords', 'meta_og_image', 'schema_type',
            'schema_org_name', 'schema_org_url', 'schema_org_logo', 'schema_org_phone', 'schema_org_email',
            'schema_business_street', 'schema_business_city', 'schema_business_state', 'schema_business_postal',
            'schema_business_country', 'schema_social_profiles', 'schema_custom_json',
        ];
        $jsonColumns = ['hero_benefits', 'stats', 'services_list', 'about_checkmarks', 'airports_list', 'fleet_vehicles', 'story_values', 'reviews_list', 'faq_list', 'sections_enabled'];

        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('default');
            $table->string('slug')->unique();
            $table->text('hero_badge_text')->nullable();
            $table->text('hero_title_line1')->nullable();
            $table->text('hero_title_line2')->nullable();
            $table->text('hero_title_gradient_text')->nullable();
            $table->text('hero_description')->nullable();
            $table->json('hero_benefits')->nullable();
            $table->json('stats')->nullable();
            $table->json('services_list')->nullable();
            $table->json('about_checkmarks')->nullable();
            $table->json('airports_list')->nullable();
            $table->json('fleet_vehicles')->nullable();
            $table->json('story_values')->nullable();
            $table->json('reviews_list')->nullable();
            $table->json('faq_list')->nullable();
            $table->json('sections_enabled')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('pages', function (Blueprint $table) use ($textColumns, $jsonColumns) {
            foreach ($textColumns as $column) {
                if (!Schema::hasColumn('pages', $column)) {
                    $table->text($column)->nullable();
                }
            }
            foreach (['reviews_enabled', 'faq_enabled', 'schema_enabled'] as $column) {
                $table->boolean($column)->default(true);
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};