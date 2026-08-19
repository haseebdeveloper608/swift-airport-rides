<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_login_when_trying_to_access_admin_dashboard(): void
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirectContains('/login');
    }

    public function test_authenticated_users_can_view_admin_dashboard(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertOk();
        $response->assertViewIs('admin.dashboard');
    }
}
