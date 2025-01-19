<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class LocationController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Request $request)
	{
		// dd(request()->server('SERVER_ADDR'));

		// $ip = $request->ip();

        // $ip = '162.159.24.227';
        $ip = '162.159.24.227';
        $currentUserInfo = Location::get($ip);

		return view('admin.location.index', compact('currentUserInfo'));
	}
}
