<?php

namespace Database\Seeders;

use App\Models\Task\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {


        Task::create([
            'label' => 'documentation',
            'title' => 'You can\'t compress the program without quantifying the open-source SSD pixel!',
            'user_id' => 1,
            'status' => 'in progress',
            'priority' => 'medium',
        ]);

        Task::create([
            'label' => 'documentation',
            'title' => 'Try to calculate the EXE feed, maybe it will index the multi-byte pixel!',
            'user_id' => 1,
            'status' => 'backlog',
            'priority' => 'medium',
        ]);

        Task::create([
            'label' => 'bug',
            'title' => 'We need to bypass the neural TCP card!',
            'user_id' => 1,
            'status' => 'todo',
            'priority' => 'high',
        ]);
    }
}
