<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function sendOtp(Request $request)
    {
        $email = $request->email;
        // Logic to send OTP
        return "OTP sent to " . $email;
    }
}