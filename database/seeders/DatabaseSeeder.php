<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $user = User::firstOrCreate(
            ['email' =>  'admin@admin.dev'],
            ['name' => 'Administrator', 'password' => Hash::make('password'), 'email_verified_at' => now()]
        );

        $teams = [];
        for( $i = 0; $i < 100; $i++ ) {
            $team = Team::firstOrCreate(
                ['name' =>  'Team ' . $i],
                ['name' => 'Team ' . $i]
            );  
            array_push($teams, $team);
        }

        foreach( $teams as $team ) {
            $team->users()->save($user);
        }
    }
}
