<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Task\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

Route::get("/", fn() => Inertia::render("Home/Home"));


Route::get("/login", [LoginController::class, "index"])->name("auth.login");
Route::get("/register", [RegisterController::class, "index"])->name("auth.register");
Route::get("/tasks", [TaskController::class, "index"])->name("task.task");


Route::post("/register", [RegisterController::class, "createAccount"]);
Route::post("/send-otp", [RegisterController::class, "sendOtp"]);
Route::post("/login", [LoginController::class, "loginUser"]);
Route::post("/logout", [LoginController::class, "logoutUser"]);

Route::get("/auth/google/redirect", [LoginController::class, "loginWithGoogle"]);

Route::get("/auth/google/callback", function (Request $request) {
    dd(Socialite::driver("google")->user());
});
