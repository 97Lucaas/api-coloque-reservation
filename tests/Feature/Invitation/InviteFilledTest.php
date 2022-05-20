<?php

namespace Tests\Feature\Invitation;

use App\Models\Event;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InviteFilledTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function create_invitation_on_filled_event_as(?User $user) 
    {
        $event = Event::factory()->filled()->create();
        $this->actingAs($user)->get("/events/{$event->slug}/invite");
        $response = $this->actingAs($user)->post("/invitations", [
            'event_id' => $event->id,
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->safeEmail(),
        ]);

        $response->assertSessionHasErrors([
            'event_id'=>trans('validation.custom.event_id.filled')
        ]);  
    }



    public function test_guest_cannot_create_invitation_on_filled_event()
    {
        $event = Event::factory()->filled()->create();
        $this->get("/events/{$event->slug}/invite");
        $response = $this->post("/invitations", [
            'event_id' => $event->id,
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->safeEmail(),
        ]);

        $response->assertSessionHasErrors([
            'event_id'=>trans('validation.custom.event_id.filled')
        ]); 
    }

    public function test_user_cannot_create_invitation_on_filled_event()
    {
        $user = User::factory()->create();   
        $this->create_invitation_on_filled_event_as($user);
    }

    public function test_modo_cannot_create_invitation_on_filled_event()
    {
        $user = User::factory()->modo()->create();   
        $this->create_invitation_on_filled_event_as($user);   
    }

    public function test_admin_cannot_create_invitation_on_filled_event()
    {
        $user = User::factory()->admin()->create();   
        $this->create_invitation_on_filled_event_as($user);   
    }

}
