<?php

namespace App\Http\Controllers\Superadmin;

use App\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Http\Middleware\User;
use App\Models\Notifications;
use App\Models\State;
use App\Models\SuperCity;
use App\Models\User as ModelsUser;
use App\Models\UserNotifications;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NotificationController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Request $request)
	{
	    $states = State::get();
		if ($request->ajax()) {
			$data = Notifications::get();
			return DataTables::of($data)
				->editColumn('status', function ($row) {
					if ($row->status) {
						return 'Active';
					} else {
						return 'InActive';
					}
				})
				->editColumn('Actions', function ($row) {
					$buttons = '';
					$buttons =  $buttons . '<i data-id="' . $row->id . '" onclick=getNotification(this) class="fs-22 py-2 mx-2 fa-pencil pointer fa" type="button"></i>';
					$buttons =  $buttons . ' <i data-id="' . $row->id . '" onclick=deleteNotification(this) class="fs-22 py-2 mx-2 fa-trash pointer fa text-danger" type="button"></i>';
					return $buttons;
				})
				->rawColumns(['Actions'])
				->make(true);
		}
		return view('superadmin.notifications.index', compact('states'));
	}

	public function saveNotification(Request $request)
	{
	    if (
            empty($request->message) || 
            empty($request->schedule_date) || 
            $request->schedule_date == ':00' ||
            empty($request->city)
        ) {
            return response()->json([
                'error' => true,
                'message' => 'All fields are requuired'
            ]);
        }
		if (!empty($request->id) && $request->id != '') {
			$data = Notifications::find($request->id);
			if (empty($data)) {
				$data =  new Notifications();
			}
		} else {
			$data =  new Notifications();
		}
		$data->message = $request->message;
		$data->status = $request->status;
		$data->schedule_date = $request->schedule_date;
		$data->state = $request->state;
		$data->city = $request->city;
		$data->save();
		$users = ModelsUser::where('role_id',1)->where('city_id', $request->city)->pluck('id')->toArray();
		foreach ($users as $key => $value) {
			UserNotifications::create(['user_id'=>$value,'notification'=>$request->message]);
			$matchThese = [
                'user_id' => $value,
                'notification_id' => $data->id,
                'general_notif_status' => 'Pending'
            ];
			UserNotifications::updateOrCreate($matchThese, [
                'notification' => $request->message,
                'notification_type' => Constants::GENERAL,
                'schedule_date' => $request->schedule_date,
                'general_notif_status' => 'Pending',
                'state' => $request->state,
                'city' => $request->city,
            ]);
		}
	}

	public function getSpecificNotification(Request $request)
	{
		if (!empty($request->id)) {
			$data =  Notifications::with('city')->where('id', $request->id)->first();
			return json_encode($data);
		}
	}

	public function destroy(Request $request)
	{
		if (!empty($request->id)) {
			$data = Notifications::where('id', $request->id)->delete();
		}
	}
	
	public function getCityByState(Request $request)
    {
        $state_id = $request->input('id');

        try {
            $cities = SuperCity::where('state_id', $state_id)->get();
            $view = view('superadmin.notifications.citylist', compact('cities'))->render();
            return response()->json([
                "status" => 200,
                "message" => "City List",
                "data" => $view
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred',
                'data' => $e->getMessage(),
            ], 400);
        }
    }
}
