<?php

namespace App\Http\Controllers\Api;

// use JWTAuth;
use App\Models\User;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
     */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $keyResolver;

    public function __construct()
    {
    }

    /**
     * Verify
     *
     * @param  mixed $request
     * @return void
     */
    public function verify(Request $request)
    {

        $url = stripslashes($request->url);
        $userId = explode('/', explode('?', $url)[0]);
        $userId = end($userId);
        $user = User::findOrFail($userId);
        $token = JWTAuth::fromUser($user);
        $request = Request::create($url);

        if ($request->hasValidSignature()) {
            if (!empty($user->email_verified_at)) {
                return response()->json(
                    [
                        'status' => 0,
                        'message' => trans('auth.account_already_verified'),
                        'result' => null
                    ]
                );
            }

            $mail_data = [
                'email_id' => 3,
                'user_id' => $user->id,
                'email' => $user->email,
            ];

            dispatch(new SendEmailJob($mail_data));

            if ($user->markEmailAsVerified()) {
                event(new Verified($user));
            }

            if ($user->role_id == 4) {
                if ($user->status == 0) {
                    return response()->json(
                        [
                            'status' => 0,
                            'message' => trans('auth.Your_account_is_not_activated_please_activated_first'),
                            'result' => null
                        ]
                    );
                } else if ($user->status == 2) {
                    return response()->json(
                        [
                            'status' => 0,
                            'message' => trans('auth.Your_account_is_not_deactivated'),
                            'result' => null
                        ]
                    );
                } else {
                    $nuser = User::select("id", "name", "email", "photo", "email_verified_at", "is_active")
                        ->where('id', $user->id)
                        ->first();

                    //unset($nuser->id);
                    $nuser['token'] = $token;
                    return response()->json(
                        [
                            'status' => 200,
                            'message' => trans('auth.Logged_in_successfully'),
                            'result' => $nuser
                        ]
                    );
                }
            } else {
                return response()->json(
                    [
                        'status' => 0,
                        'message' => trans('auth.sufficient_permissions_app'),
                        'result' => null
                    ]
                );
            }
        } else {
            return response()->json(
                [
                    'status' => 0,
                    'message' => trans('auth.Invalid_Signature'),
                    'result' => null
                ]
            );
        }
    }

    /**
     * Resend
     *
     * @param  mixed $request
     * @return void
     */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(
                [
                    'status' => 0,
                    'message' => trans('auth.account_already_verified'),
                    'result' => null
                ]
            );
        }

        $request->user()->sendEmailVerificationNotification();
        return response()->json(
            [
                'status' => 200,
                'message' => trans('auth.Resend_activation_link_please_activate_your_account'),
                'result' => null
            ]
        );
    }
}
