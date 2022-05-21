<?php

namespace Tests\Feature\Event;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SeeAllTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_see_events()
    {
        $response = $this->get('/events');
        $response->assertStatus(200);
    }

    public function test_user_can_see_events()
    {
        $user = User::factory()->create();   
        $response = $this->actingAs($user)->get('/events');
        $response->assertStatus(200);
    }

    public function test_modo_can_see_events()
    {
        $user = User::factory()->modo()->create();
        $response = $this->actingAs($user)->get('/events');
        $response->assertStatus(200);
    }

    public function test_admin_can_see_events()
    {
        $user = User::factory()->admin()->create();
        $response = $this->actingAs($user)->get('/events');
        $response->assertStatus(200);
    }
}
