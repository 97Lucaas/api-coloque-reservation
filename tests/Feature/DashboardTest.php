<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_dashboard()
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_user_cannot_access_dashboard()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(403);
    }

    public function test_modo_can_access_dashboard()
    {
        $user = User::factory()->modo()->create();
        
        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_admin_can_access_dashboard()
    {
        $user = User::factory()->admin()->create();
        
        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
    }
}
