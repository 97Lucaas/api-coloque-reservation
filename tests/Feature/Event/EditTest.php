<?php

namespace Tests\Feature\Event;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_edit_event()
    {
        $event = Event::factory()->create();
        $response = $this->get("/events/{$event->id}/edit");
        $response->assertRedirect('/login');
    }

    public function test_user_cannot_edit_event()
    {
        $event = Event::factory()->create();
        $user = User::factory()->create();   
        $response = $this->actingAs($user)->get("/events/{$event->id}/edit");
        $response->assertStatus(403);
    }

    public function test_modo_can_edit_event()
    {
        $event = Event::factory()->create();
        $user = User::factory()->modo()->create();
        $response = $this->actingAs($user)->get("/events/{$event->id}/edit");
        $response->assertStatus(200);
    }

    public function test_admin_can_edit_event()
    {
        $event = Event::factory()->create();
        $user = User::factory()->admin()->create();
        $response = $this->actingAs($user)->get("/events/{$event->id}/edit");
        $response->assertStatus(200);
    }
}
