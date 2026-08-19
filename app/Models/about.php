<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class about extends Model
{
    protected $table = 'about_pages';

    protected $fillable = [
        'seo_title',
        'seo_description',
        'seo_keywords',
        'hero_heading',
        'hero_subtitle',
        'hero_tag',
        'hero_highlight_text',
        'hero_background_image',
        'hero_quote_text',
        'hero_quote_author',
        'hero_quote_visible',
        'story_eyebrow',
        'story_heading',
        'story_paragraph_1',
        'story_paragraph_2',
        'story_main_image',
        'story_overlap_image',
        'story_badge_text',
        'story_pillars',
        'stats',
        'stats_visible',
        'values_eyebrow',
        'values_heading',
        'values',
        'values_visible',
        'mission_eyebrow',
        'mission_heading',
        'mission_description',
        'mission_background_image',
        'mission_visible',
        'cta_heading',
        'cta_subheading',
        'cta_phone_label',
        'cta_phone_number',
        'cta_button_text',
        'cta_button_url',
        'cta_visible',
        'is_active',
        'page_slug',
        'published_at',
    ];

    protected $casts = [
        'story_pillars' => 'array',
        'stats' => 'array',
        'values' => 'array',
        'hero_quote_visible' => 'boolean',
        'stats_visible' => 'boolean',
        'values_visible' => 'boolean',
        'mission_visible' => 'boolean',
        'cta_visible' => 'boolean',
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];
}
