<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function index()
    {
        return Inertia::render("Task/Task");
    }
}
