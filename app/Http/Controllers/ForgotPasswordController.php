<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OTPCode;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    public function showForm()
    {
        return view('user.user_forgotpassword'); 
    }

    public function showOtpForm()
    {
        return view('user.user_otpcode');
    }

    public function showNewPasswordForm()
    {
        if (!Session::has('verified_user_id')) {
            return redirect()->route('user.user_forgotpassword')
                ->with('error', 'Please verify your email first.');
        }
        
        return view('user.user_newpassword');
    }

    public function sendOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'This email is not registered in 4notes.'
            ]);
        }

        $existingOtp = OTPCode::where('user_id', $user->id)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if ($existingOtp) {
            return back()->withErrors(['email' => 'An OTP was already sent. Check your email.']);
        }

        $otp = rand(1000, 9999);
        $otpCode = OTPCode::create([
            'user_id' => $user->id,
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(2)
        ]);

        // Send email
        try {
            Mail::send('email.otp', ['otp' => $otp], function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Your OTP Code for 4notes');
            });

            Session::put('otp_id', $otpCode->id);

            return response()->json([
                'success' => true,
                'message' => 'OTP sent to your email.',
                'redirect' => route('user.user_otpcode')
            ]);

        } catch (\Exception $e) {
            // Log error for debugging
            \Log::error('Mail send failed: '.$e->getMessage());

            Session::put('otp_id', $otpCode->id);

            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP email. Please try again later.',
                'redirect' => route('user.user_otpcode')
            ]);
        }
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:4',
        ]);

        $otpRecord = OTPCode::where('otp', $request->otp)
            ->where('expires_at', '>', Carbon::now())
            ->latest()
            ->first();

        if (!$otpRecord) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired OTP code.'
            ]);
        }

        // OTP is valid — optionally, delete it after verification
        $otpRecord->delete();

        Session::put('verified_user_id', $otpRecord->user_id);

        return response()->json([
            'success' => true,
            'message' => 'OTP verified successfully!',
            'redirect' => route('user.user_newpassword')
        ]);
    }

    public function resetPassword(Request $request)
    {
        if (!Session::has('verified_user_id')) {
            return response()->json([
                'success' => false,
                'message' => 'Session expired. Please start the password reset process again.'
            ]);
        }

        // Fix validation names to match frontend request
        $request->validate([
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|same:newPassword',
        ]);

        $userId = Session::get('verified_user_id');
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
            ]);
        }

        $user->password = Hash::make($request->newPassword);
        $user->save();

        Session::forget('verified_user_id');
        Session::forget('otp_id');

        return response()->json([
            'success' => true,
            'message' => 'Password reset successfully! You can now login with your new password.',
            'redirect' => route('user.user_login')
        ]);
    }


}

