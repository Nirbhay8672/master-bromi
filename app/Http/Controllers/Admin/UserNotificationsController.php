<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserNotifications;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class UserNotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
            $status = Auth::user()->status;
			if($status == 0) {
				Auth::logout();
				Session::flush();
				Session::flash('inactive_user', 'Oops .. Your account is inactive.');
				return redirect('admin/login');
			}
        }

		UserNotifications::where('user_id',Auth::User()->id)->where('seen',0)->update(['seen'=>1]);
		if ($request->ajax()) {
			$data = UserNotifications::where('user_id',Auth::User()->id)->orderBy('id','DESC')->get();
			return DataTables::of($data)
				->editColumn('created_at', function ($row) {
					return Carbon::parse($row->created_at)->format('d-m-Y | h:i A');
				})
				->make(true);
		}

		return view('admin.notifications.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserNotifications  $userNotifications
     * @return \Illuminate\Http\Response
     */
    public function show(UserNotifications $userNotifications)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserNotifications  $userNotifications
     * @return \Illuminate\Http\Response
     */
    public function edit(UserNotifications $userNotifications)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserNotifications  $userNotifications
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserNotifications $userNotifications)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserNotifications  $userNotifications
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserNotifications $userNotifications)
    {
        //
    }
}
