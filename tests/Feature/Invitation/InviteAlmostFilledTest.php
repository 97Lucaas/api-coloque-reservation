<?php

namespace Tests\Feature\Invitation;

use App\Models\Event;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InviteAlmostFilledTest extends TestCase
{
    use RefreshDatabase;

    public function create_invitation_on_almost_filled_event_as($user)
    {
        $event = Event::factory()->almostFilled()->create();
        $response = $this->actingAs($user)->get("/events/{$event->slug}/invite");
        $response->assertStatus(200);
    }

    public function test_guest_can_create_invitation_on_almost_filled_event()
    {
        $event = Event::factory()->almostFilled()->create();
        $response = $this->get("/events/{$event->slug}/invite");

        $response->assertStatus(200);
    }

    public function test_user_can_create_invitation_on_almost_filled_event()
    {
        $user = User::factory()->create();   
        $this->create_invitation_on_almost_filled_event_as($user);
    }

    public function test_modo_can_create_invitation_on_almost_filled_event()
    {
        $user = User::factory()->modo()->create();   
        $this->create_invitation_on_almost_filled_event_as($user);
    }

    public function test_admin_can_create_invitation_on_almost_filled_event()
    {
        $user = User::factory()->admin()->create();   
        $this->create_invitation_on_almost_filled_event_as($user);
    }
}
