<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get("/", fn() => Inertia::render("Welcome"));
Route::get("/login", fn() => Inertia::render("Auth/Login"));
