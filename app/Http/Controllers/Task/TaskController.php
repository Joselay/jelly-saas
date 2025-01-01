<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('updated_at', 'desc')->get()->map(function ($task) {
            return [
                "id" => $task->id,
                "label" => $task->label,
                "title" => $task->title,
                "assignee" => $task->assignee,
                "status" => $task->status,
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

    public function addTask(Request $request): void
    {
        $task = new Task();
        $task->label = $request->label;
        $task->title = $request->title;
        $task->assignee = $request->assignee;
        $task->status = $request->status;
        $task->priority = $request->priority;
        $task->save();
    }
}
