<?php

namespace Tests\Feature\Event;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_delete_event()
    {
        $event = Event::factory()->create();
        $response = $this->delete("/events/{$event->id}");
        $response->assertRedirect('/login');
    }

    public function test_user_cannot_delete_event()
    {
        $event = Event::factory()->create();
        $user = User::factory()->create();   
        $response = $this->actingAs($user)->delete("/events/{$event->id}");
        $response->assertStatus(403);
    }

    public function test_modo_can_delete_event()
    {
        $event = Event::factory()->create();
        $user = User::factory()->modo()->create();
        $response = $this->actingAs($user)->delete("/events/{$event->id}");
        $response->assertStatus(302);
        $response->assertRedirect('/events');
    }

    public function test_admin_can_delete_event()
    {
        $event = Event::factory()->create();
        $user = User::factory()->admin()->create();
        $response = $this->actingAs($user)->delete("/events/{$event->id}");
        $response->assertStatus(302);
        $response->assertRedirect('/events');
    }
}
