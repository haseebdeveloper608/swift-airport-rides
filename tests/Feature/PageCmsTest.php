<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageCmsTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_page_with_auto_generated_slug_and_persist_to_database(): void
    {
        $response = $this->post(route('admin.pages.store'), [
            'title' => 'Privacy Policy',
            'content' => '<p>Privacy content</p>',
            'status' => 'published',
            'meta_title' => 'Privacy Policy',
            'meta_description' => 'Privacy policy for the site',
            'show_in_header' => true,
        ]);

        $response->assertRedirect(route('admin.pages.index'));
        $this->assertDatabaseHas('pages', [
            'title' => 'Privacy Policy',
            'slug' => 'privacy-policy',
            'status' => 'published',
            'show_in_header' => true,
        ]);
    }
}
