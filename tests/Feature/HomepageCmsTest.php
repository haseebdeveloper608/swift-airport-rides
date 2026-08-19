<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomepageCmsTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_cms_form_can_save_content_to_database(): void
    {
        $response = $this->postJson('/admin/homepage', [
            'hero_title' => 'Test hero title',
            'hero_subtitle' => '<p>Test hero subtitle</p>',
            'trust_strip' => [
                ['icon' => 'fas fa-tag', 'text' => 'FIXED FARES'],
            ],
            'ticker_label' => 'Trusted by travellers from',
            'ticker_items' => ['Heathrow', 'Gatwick'],
            'sections_enabled' => ['hero' => true, 'trust' => false],
        ]);

        $response->assertJsonPath('success', true);
        $this->assertDatabaseHas('homepages', [
            'hero_title' => 'Test hero title',
        ]);
        $this->assertDatabaseHas('homepages', [
            'hero_subtitle' => 'Test hero subtitle',
        ]);
    }
}
