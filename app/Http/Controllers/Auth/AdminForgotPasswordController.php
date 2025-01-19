<?php

namespace App\Http\Controllers\Auth;

use Throwable;
use App\Models\User;
// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class AdminForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * ShowLinkRequestForm
     *
     * @return void
     */
    public function showLinkRequestForm()
    {
        return view('admin.auth.email');
    }

    /**
     * SendResetLinkEmail
     *
     * @param  mixed $request
     * @return void
     */
    public function sendResetLinkEmail(Request $request)
    {
        try {
            $this->validate($request, ['email' => 'required|email']);
            $user = User::where('email', $request->email)->first();

            if ($user) {
                if ($user->role_id != 1) {
                    return redirect()->back()->with('warning', trans('auth.sufficient_permissions'));
                } else {
                    $response = $this->broker()->sendResetLink(
                        $request->only('email')
                    );

                    if ($response === Password::RESET_LINK_SENT) {
                        return redirect()->route('admin.login')->with('success', trans($response));
                    }

                    return back()->withErrors(
                        ['email' => trans($response)]
                    );
                }
            } else {
                return redirect()->back()->withErrors(['email' => trans('auth.email_not_found')]);
            }
        } catch (Throwable $e) {
        }
    }
}
