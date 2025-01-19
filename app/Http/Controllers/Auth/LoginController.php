<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
	/*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = RouteServiceProvider::HOME;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		if (isset(Auth::user()->id) && (Auth::user()->role_id == 1 || Auth::user()->role_id == 3)) {
			return redirect()->route('admin.logout');
		}
		$this->middleware('guest')->except('logout');
	}

	public function showLoginForm()
	{
			return redirect()->route('admin-login');

	}

	/**
	 * Get the login username to be used by the controller.
	 *
	 * @return string
	 */
	protected function authenticated(Request $request, $user)
	{
// 		if ($user->role_id == 1) {
// 			Auth::logout();
// 			return redirect()->back()->with('warning', trans('auth.sufficient_permissions'));
// 		}
	}

	/**
	 * SendFailedLoginResponse
	 *
	 * @return void
	 */
	public function sendFailedLoginResponse(Request $request)
	{
		return redirect()->back()
			->withInput()
			->with('warning', trans('auth.failed'));
	}

	/**
	 * RedirectTo
	 *
	 * @return void
	 */
	public function redirectTo()
	{
		if (Auth::user()->role_id == 1) {
			$this->redirectTo = "/admin";
			return $this->redirectTo;
		}
		return $this->redirectTo;
	}

	/**
	 * Logout
	 *
	 * @param  mixed $request
	 * @return void
	 */
	public function logout(Request $request)
	{
		if (Auth::user()->role_id == 1) {
			$this->redirectTo = "/admin/login";
		}
		$this->guard()->logout();
		$request->session()->invalidate();
		return $this->loggedOut($request) ?: redirect($this->redirectTo);
	}
}
