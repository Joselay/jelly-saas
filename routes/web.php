<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get("/login", fn() => Inertia::render("Auth/Login"))->name("auth.login");
Route::get("/register", fn() => Inertia::render("Auth/Register"));
Route::get("/", fn() => Inertia::render("Task/Task"));

Route::post("/register", [RegisterController::class, "createAccount"]);
Route::post("/send-otp", [RegisterController::class, "sendOtp"]);
Route::post("/login", [LoginController::class, "loginUser"]);
Route::post("/logout", [LoginController::class, "logoutUser"]);
