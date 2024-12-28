<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => "required|email"]);

        $otp = rand(100000, 999999);

        Session::put("otp", $otp);

        Mail::to($request->email)->send(new OtpMail($otp));
    }

    public function createAccount(Request $request)
    {
        if (!Session::has("otp"))
            return redirect()->back()->withErrors(['otp' => 'OTP is required to create an account.']);

        $request->validate([
            "name" => "required|string",
            "email" => "required|email",
            "password" => "required|string|min:8",
            "otp" => "required|integer|digits:6"
        ]);



        if ($request->otp !== Session::get('otp')) {
            return redirect()->back()->withErrors(['otp' => 'Invalid OTP.']);
        }

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        Session::forget('otp');

        return redirect("/login")->with('success', 'Account created successfully.');
    }
}
