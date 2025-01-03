<?php

namespace Database\Seeders;

use App\Models\Team\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('teams')->insert([
            [
                'name' => 'Acme Inc',
                'logo' => 'path/to/logo.png',
                'plan' => 'Enterprise',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'GlobalTech',
                'logo' => 'path/to/globaltech-logo.png',
                'plan' => 'Basic',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
