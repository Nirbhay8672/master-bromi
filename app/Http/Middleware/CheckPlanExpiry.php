<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckPlanExpiry
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
        // Check if the user is authenticated
        if (Auth::check()) {
            // Get the authenticated user
            $user = Auth::user();

            // Check if the user's plan has expired
            if ($user->plan_expire_on <= now()) {
                // Plan has expired, set a session flash message
                Session::put('plan_expired_redirection', 'Your plan has expired. Please renew your subscription.');
                // Plan has expired, redirect to subscription page
                Session::put('trans_action', 'renew_subscription');
                return redirect()->route('admin.plans');
            }
        }
        Session::forget('plan_expired_redirection');
        // User's plan is active, allow the request to proceed
        return $next($request);
    }
}
