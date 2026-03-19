<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class PasswordResetController extends Controller
// {
//     //
// }

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{

    public function forgotForm()
    {
        return view('auth.forgot');
    }

    // public function sendOtp(Request $request)
    // {
    //     $request->validate([
    //         'email'=>'required|email'
    //     ]);

    //     $otp = rand(100000,999999);

    //     Otp::create([
    //         'email'=>$request->email,
    //         'otp'=>$otp,
    //         'expires_at'=>now()->addMinutes(5)
    //     ]);

    //     return redirect('/verify-otp')
    //     ->with('otp',$otp)
    //     ->with('email',$request->email);
    // }


    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $otp = rand(100000, 999999);

        Otp::updateOrCreate(
            ['email' => $request->email],
            [
                'otp' => $otp,
                'expires_at' => now()->addMinutes(5)
            ]
        );

        //     return back()
        //         ->with('otp', $otp)
        //         ->with('email', $request->email);

        return redirect('/verify-otp')
            ->with('otp', $otp)
            ->with('email', $request->email);
    }

    public function verifyForm()
    {
        return view('auth.verify');
    }

    // public function verifyOtp(Request $request)
    // {
    //     $otp = Otp::where('email', $request->email)
    //         ->where('otp', $request->otp)
    //         ->where('expires_at', '>', now())
    //         ->first();

    //     if (!$otp) {
    //         return back()->with('error', 'Invalid OTP');
    //     }

    //     return redirect('/reset-password')
    //         ->with('email', $request->email);
    // }


    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required'
        ]);

        $otp = Otp::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        if (!$otp) {
            return back()->with('error', 'Invalid or expired OTP');
        }

        // ✅ VERY IMPORTANT
        session(['reset_email' => $request->email]);

        return redirect('/reset-password');
    }
    public function resetForm()
    {
        return view('auth.reset');
    }

    // public function resetPassword(Request $request)
    // {

    //     $request->validate([
    //         'password' => [
    //             'required',
    //             'confirmed',
    //             'min:8',
    //             'regex:/[A-Z]/',
    //             'regex:/[a-z]/',
    //             'regex:/[0-9]/'
    //         ]
    //     ]);

    //     $user = User::where('email', $request->email)->first();

    //     $user->password = Hash::make($request->password);
    //     // $user->password = $request->password;
    //     $user->save();

    //     return redirect('/login')->with('success', 'Password Reset Success');
    // }


    // use Illuminate\Support\Facades\Hash;

    public function resetPassword(Request $request)
    {
        // dd(session('reset_email'));

        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        // ✅ get email from session (NOT from form)
        $email = session('reset_email');

        if (!$email) {
            return redirect('/forgot-password')->with('error', 'Session expired');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->with('error', 'User not found');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // delete OTP
        Otp::where('email', $email)->delete();

        // clear session
        session()->forget('reset_email');

        return redirect('/admin')->with('success', 'Password reset successful');
    }
}
