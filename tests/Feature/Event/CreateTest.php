<?php

namespace Tests\Feature\Event;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_create_event()
    {
        $user = User::factory()->create();   
        $response = $this->actingAs($user)->get('/events/create');
        $response->assertStatus(403);
    }

    public function test_modo_can_create_event()
    {
        $user = User::factory()->modo()->create();
        $response = $this->actingAs($user)->get('/events/create');
        $response->assertStatus(200);
    }

    public function test_admin_can_create_event()
    {
        $user = User::factory()->admin()->create();
        $response = $this->actingAs($user)->get('/events/create');
        $response->assertStatus(200);
    }
}
