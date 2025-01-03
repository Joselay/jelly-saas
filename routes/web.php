<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Settings\AccountController;
use App\Http\Controllers\Settings\AppearanceController;
use App\Http\Controllers\Settings\NotificationsController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\Task\TaskController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get("/", fn() => Inertia::render("Home/Home"));


Route::get("/login", [LoginController::class, "index"])->name("auth.login");
Route::get("/register", [RegisterController::class, "index"])->name("auth.register");

Route::get("/tasks", [TaskController::class, "index"])->name("task.task");
Route::delete("/tasks/{id}", [TaskController::class, "deleteTaskById"])->name("task.delete");
Route::post("/tasks", [TaskController::class, "addTask"])->name("task.add");
Route::patch("/tasks/{id}", [TaskController::class, "updateTaskById"])->name("task.update");

Route::prefix('settings')->group(function () {
    Route::get("/profile", [ProfileController::class, "index"])->name("settings.profile");
    Route::get("/account", [AccountController::class, "index"])->name("settings.account");
    Route::get("/appearance", [AppearanceController::class, "index"])->name("settings.appearance");
    Route::get("/notifications", [NotificationsController::class, "index"])->name("settings.notifications");
});


Route::post("/register", [RegisterController::class, "createAccount"]);
Route::post("/send-otp", [RegisterController::class, "sendOtp"]);
Route::post("/login", [LoginController::class, "loginUser"]);
Route::post("/logout", [LoginController::class, "logoutUser"]);

Route::get("/auth/google/redirect", [LoginController::class, "loginWithGoogle"]);

Route::get("/auth/google/callback", [LoginController::class, "loginWithGoogleCallback"]);
