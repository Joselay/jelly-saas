<?php

namespace Database\Seeders;

use App\Models\Team\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{

    public function run(): void
    {
        Team::create([
            'name' => 'Development Team',
        ]);

        Team::create([
            'name' => 'Marketing Team',
        ]);

        Team::create([
            'name' => 'Design Team',
        ]);
    }
}
