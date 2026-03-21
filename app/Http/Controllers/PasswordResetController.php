<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;

class PasswordResetController extends Controller
{
    // Show forgot password form
    public function forgotForm()
    {
        return view('auth.forgot');
    }

    // Send OTP
    // public function sendOtp(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email|exists:users,email',
    //     ]);

    //     $otp = random_int(100000, 999999);

    //     // Save OTP in DB
    //     Otp::updateOrCreate(
    //         ['email' => $request->email],
    //         [
    //             'otp' => $otp,
    //             'expires_at' => now()->addMinutes(5)
    //         ]
    //     );

    //     // Save email in session
    //     session(['reset_email' => $request->email]);

    //     // Try sending email (non-blocking)
    //     try {
    //         Mail::to($request->email)->queue(new SendOtpMail($otp));
    //     } catch (\Exception $e) {
    //         // If mail fails, still redirect for testing
    //         return redirect('/verify-otp')
    //             ->with('success', 'OTP generated but email could not be sent. Use this OTP: ' . $otp);
    //     }

    //     return redirect('/verify-otp')
    //         ->with('success', 'OTP sent to your email');
    // }

//     public function sendOtp(Request $request)
// {
//     $request->validate([
//         'email' => 'required|email|exists:users,email',
//     ]);

//     $otp = random_int(100000, 999999);

//     Otp::updateOrCreate(
//         ['email' => $request->email],
//         [
//             'otp' => $otp,
//             'expires_at' => now()->addMinutes(5)
//         ]
//     );

//     session(['reset_email' => $request->email]);

//     // DEBUG: skip sending mail for now
//     // Mail::to($request->email)->send(new SendOtpMail($otp));

//     // Show OTP on page for testing
//     return redirect('/verify-otp')->with([
//         'success' => 'OTP generated successfully!',
//         'otp' => $otp
//     ]);
// }
public function sendOtp(Request $request)
{
    // dd('Send OTP function reached', $request->all());
    $request->validate([
        'email' => 'required|email|exists:users,email',
    ]);

    $otp = random_int(100000, 999999);

    // OTP DB me save karo
    Otp::updateOrCreate(
        ['email' => $request->email],
        [
            'otp' => $otp,
            'expires_at' => now()->addMinutes(5)
        ]
    );

    // Email session me save karo (verify OTP ke liye)
    session(['reset_email' => $request->email]);

    // Mail bhejna (Gmail SMTP working hone pe)
    try {
        Mail::to($request->email)->send(new SendOtpMail($otp));
    } catch (\Exception $e) {
        // Agar email nahi gaya, fir bhi flow continue
        return redirect('/verify-otp')->with([
            'success' => 'OTP generated! (Check email if SMTP is configured)',
            'otp' => $otp  // for testing, remove in production
        ]);
    }

    return redirect('/verify-otp')->with([
        'success' => 'OTP sent to your email!',
        'otp' => $otp  // for testing, remove in production
    ]);
}

    // Show verify OTP form
    public function verifyForm()
    {
        return view('auth.verify');
    }

    // // Verify OTP
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

        // Save email in session for reset password
        session(['reset_email' => $request->email]);

        return redirect('/reset-password')->with('success', 'OTP verified. You can reset your password now.');
    }

//     public function verifyOtp(Request $request)
// {
//     $request->validate([
//         'email' => 'required|email',
//         'otp' => 'required'
//     ]);

//     $otp = Otp::where('email', $request->email)
//               ->where('otp', $request->otp)
//               ->where('expires_at', '>', now())
//               ->first();

//     if(!$otp) {
//         return back()->with('error', 'Invalid or expired OTP');
//     }

//     // Session me email save
//     session(['reset_email' => $request->email]);

//     return redirect('/reset-password');
// }

    // Show reset password form
    public function resetForm()
    {
        return view('auth.reset');
    }

    // Reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $email = session('reset_email');

        if (!$email) {
            return redirect('/forgot-password')->with('error', 'Session expired. Please start again.');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->with('error', 'User not found');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Delete OTP and clear session
        Otp::where('email', $email)->delete();
        session()->forget('reset_email');

        return redirect('/admin')->with('success', 'Password reset successful. You can login now.');
    }


// public function resetPassword(Request $request)
// {
//     $request->validate([
//         'password' => 'required|min:6|confirmed',
//     ]);

//     $email = session('reset_email');

//     if(!$email) {
//         return redirect('/forgot-password')->with('error', 'Session expired');
//     }

//     $user = User::where('email', $email)->first();

//     if(!$user) {
//         return back()->with('error', 'User not found');
//     }

//     $user->password = Hash::make($request->password);
//     $user->save();

//     // OTP delete
//     Otp::where('email', $email)->delete();

//     // Clear session
//     session()->forget('reset_email');

//     return redirect('/admin')->with('success', 'Password reset successful');
// }
}