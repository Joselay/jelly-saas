<?php

namespace Database\Seeders;

use App\Models\Task\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        Task::create([
            'label' => 'documentation',
            'title' => 'You can\'t compress the program without quantifying the open-source SSD pixel!',
            'assignee' => 'John Doe',
            'status' => 'in progress',
            'priority' => 'medium',
        ]);

        Task::create([
            'label' => 'documentation',
            'title' => 'Try to calculate the EXE feed, maybe it will index the multi-byte pixel!',
            'assignee' => 'Jane Smith',
            'status' => 'backlog',
            'priority' => 'medium',
        ]);

        Task::create([
            'label' => 'bug',
            'title' => 'We need to bypass the neural TCP card!',
            'assignee' => 'Alice Brown',
            'status' => 'todo',
            'priority' => 'high',
        ]);
    }
}
