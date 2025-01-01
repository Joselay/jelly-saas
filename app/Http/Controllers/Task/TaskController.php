<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task\Task;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all()->map(function ($task) {
            return [
                "id" => $task->id,
                "title" => $task->title,
                "status" => $task->status,
                "label" => $task->label,
                "priority" => $task->priority,
            ];
        });

        return Inertia::render("Task/Task", [
            "tasks" => $tasks,
        ]);
    }

    public function deleteTaskById($id): void
    {
        $task = Task::find($id);
        $task->delete();
    }
}
