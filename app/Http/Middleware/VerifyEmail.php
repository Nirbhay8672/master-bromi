<?php

namespace App\Http\Middleware;

use App\Mail\SendOtpMail;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is logged in
        dd('adsf');
        if (Auth::check()) {
            $user = Auth::user();

            // Check if email is not verified
            if (!$user->email_verified) {
                // Generate random 4-digit OTP
                $otp = mt_rand(10000, 99999);

                // Send OTP via email
                Mail::to($user->email)->send(new SendOtpMail($otp));

                // Store OTP in user session
                $request->session()->put('otp', $otp);

                // Redirect user to OTP verification page
                return redirect()->route('admin.otp.verify');
            }
        }

        return $next($request);
    }
}
