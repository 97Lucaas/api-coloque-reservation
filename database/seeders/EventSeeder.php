<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Event;
use App\Models\Invitation;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $max_invitations_array = [0, 1, 2, 10, NULL];

        foreach($max_invitations_array as $max_invitations) {
            Event::factory()
                ->has(
                    Invitation::factory()->count($max_invitations)
                )
                ->create([
                    'max_invitations' => $max_invitations
                ]);
        }
    }
}
