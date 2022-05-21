<?php

namespace Tests\Feature\Invitation;

use App\Models\Event;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InviteAlmostFullPublicTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function create_invitation_on_almost_full_public_event_as($user)
    {
        $event = Event::factory()->public()->almostFull()->create();

        $responseView = $this->actingAs($user)->get("/events/{$event->slug}");
        $responseView->assertStatus(200);

        $responsePost = $this->actingAs($user)->post("/invitations", [
            'event_id' => $event->id,
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->safeEmail(),
        ]);

        $responsePost->assertRedirect();
    }

    public function test_guest_can_create_invitation_on_almost_full_public_event()
    {
        $event = Event::factory()->public()->almostFull()->create();
        $responseView = $this->get("/events/{$event->slug}");
        $responseView->assertStatus(200);

        $responsePost = $this->post("/invitations", [
            'event_id' => $event->id,
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->safeEmail(),
        ]);

        $responsePost->assertRedirect();
    }

    public function test_user_can_create_invitation_on_almost_full_public_event()
    {
        $user = User::factory()->create();   
        $this->create_invitation_on_almost_full_public_event_as($user);
    }

    public function test_modo_can_create_invitation_on_almost_full_public_event()
    {
        $user = User::factory()->modo()->create();   
        $this->create_invitation_on_almost_full_public_event_as($user);
    }

    public function test_admin_can_create_invitation_on_almost_full_public_event()
    {
        $user = User::factory()->admin()->create();   
        $this->create_invitation_on_almost_full_public_event_as($user);
    }
}
