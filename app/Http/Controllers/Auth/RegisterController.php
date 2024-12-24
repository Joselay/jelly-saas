<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function createAccount(Request $request)
    {
        $request->validate([
            "name" => "required|string",
            "email" => "required|email",
            "password" => "required|string|min:8"
        ]);

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        return redirect("/login");
    }
}
