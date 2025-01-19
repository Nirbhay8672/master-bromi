<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\SharedProperty;
use App\Models\User;
use App\Models\UserNotifications;
use App\Models\UserPartner;
use App\Traits\HelperFn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PartnerController extends Controller
{
	use HelperFn;

	public function __construct()
	{
		$this->middleware('auth');
		// 		$this->middleware('permission:property-list', ['only' => ['index']]);
	}

	/**
	 * Find user Record in Add Partner
	 *
	 * @return \Illuminate\Http\Response JSON
	 */
	public function findUserRecords(Request $request)
	{
		$partnerEmail = $request->input('partner_email');
		$partnerNumber = $request->input('partner_number');

		$userRecords = User::where(function ($query) use ($partnerEmail, $partnerNumber) {
			$query->whereNotNull('email')
				->where('email', $partnerEmail)
				->orWhereNotNull('mobile_number')
				->where('mobile_number', $partnerNumber);
		})->get();
		return response()->json($userRecords);
	}

	/**
	 * Display Find User Records
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

		// dd("index-partner");
		if ($request->ajax()) {
			// $partner = Partner::with('user')->where('partner_id', Auth::user()->id)->get();
			$partner = Partner::with('user')->where('user_id', Auth::user()->id)->get();
			return DataTables::of($partner)->addIndexColumn()
				->addColumn('partner_name', function (Partner $partner) {
					if (!empty($partner->user->first_name) || !empty($partner->user->last_name)) {
						return $partner->user->first_name . ' ' . $partner->user->last_name;
					} else {
						return 'N/A';
					}
				})
				->addColumn('partner_email', function (Partner $partner) {
					if (!empty($partner->user->email)) {
						$email  = '';
						$email = '<span style="text-transform: lowercase !important;">' . strtolower($partner->user->email) . '</span>';
						return $email;
					} else {
						return 'N/A';
					}
				})
				->addColumn('company_name', function (Partner $partner) {
					if (!empty($partner->user->company_name)) {
						return $partner->user->company_name;
					} else {
						return 'N/A';
					}
				})
				->addColumn('partner_number', function (Partner $partner) {
					if (!empty($partner->user->mobile_number)) {
						return $partner->user->mobile_number;
					} else {
						return 'N/A';
					}
				})
				->addColumn('user_number', function (Partner $partner) {
					if (!empty(Auth::user()->mobile_number)) {
						return Auth::user()->mobile_number;
					} else {
						return 'N/A';
					}
				})
				->addColumn('action', function (Partner $partner) {
					$action  = '';
					$action .= '<i role="button" title="Delete" data-id=' . $partner->id . ' onclick="deletePartner(this)" class="fs-22 py-2 mx-2 fa-trash pointer fa text-danger" type="button"></i>';
					return $action;
				})
				->rawColumns(['action', 'partner_name', 'company_name', 'partner_email', 'partner_number', 'user_number'])
				->make(true);
		}
		return view('admin.partner.index');
	}


	/**
	 * Add Partner
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function addPartner(Request $request)
	{
		// dd("Add Partner");
		if (Auth::check()) {
			$Partner_Check = Partner::where('partner_id', $request->user_id)->first();
			if (empty($Partner_Check)) {
				$authenticatedUserId = Auth::user()->id;
				$validatedData = $request->validate([
					'user_id' => 'required|numeric',
				]);

				Partner::create([
					'user_id' => $authenticatedUserId,
					'partner_id' => $validatedData['user_id'],
					'status' => 'Pending',
				]);
				$message = Auth::user()->first_name . " " . Auth::user()->last_name . "has sent you partner request.";
				# code...
				try {
					UserNotifications::create([
						"user_id" => (int) $validatedData['user_id'],
						"notification" => $message,
						"notification_type" => Constants::PARTNER_REQUEST,
						'by_user' => (int) $authenticatedUserId,
					]);
					/* if (!empty($sender->onesignal_token)) {
                        HelperFn::sendPushNotification($sender->onesignal_token, $message);
                    } else {
                        Log::error("Accept Add Partner Request Error: ");
                        Log::error("User id: $sender->id does not have onesignal token");
                        Log::error("That's why notification not sent.");
                    } */
				} catch (\Throwable $th) {
					// if notificaton creation failed.
					Log::error("On Accept add partner request attempt failed by user Id:" . $validatedData['user_id']);
					Log::error("Error Message: $th->getMessage()");
				}
				return response()->json(['message' => 'Partner added successfully', 'status' => 'sucess']);
			} else {
				return response()->json(['message' => 'Alredy Added Partner', 'status' => 'error']);
			}
		}

		return response()->json(['error' => 'Unauthorized'], 401);
	}

	/**
	 * Other Partner Requests
	 *
	 * @return \Illuminate\Http\Response JSON
	 *
	 */
	public function partnerRequest(Request $request)
	{
		// dd("request-partner");
		if ($request->ajax()) {
			$sharedproperty = SharedProperty::with('Property_details', 'User')->where('user_id', Auth::user()->id)->withTrashed()->get();
			// $sharedproperty2 = SharedProperty::with('Property_details', 'User')->where('partner_id', Auth::user()->id)->withTrashed()->get();

			// $mergedData = $sharedproperty->concat($sharedproperty2);
			// 			dd(Auth::user()->id,"shared",$sharedproperty);
			return DataTables::of($sharedproperty)
				// ->editColumn('project_name', function ($sharedproperty) use ($request) {
				// 	// dd($row->Property_details,"prj");
				// 	$first =  '<td style="vertical-align:top">
				// 	<font size="3"><a href="#" style="font-weight: bold;">' . ((isset($sharedproperty->User->Projects->project_name)) ? $sharedproperty->Property_details->Projects->project_name : '') . '</a>';
				// 	$first_middle = '';

				// 	$first_end = '</font>';
				// 	$last =     '</td>';

				// 	'</td>';
				// 	return $first . $first_middle . $first_end . $last;

				// 	return '';
				// })
				->addColumn('partner_name', function ($SharedProperty) {
					if (!empty($SharedProperty->User->first_name)) {
						return $SharedProperty->User->first_name;
					} else {
						return 'N/A';
					}
				})
				->addColumn('partner_email', function ($SharedProperty) {
					if (!empty($SharedProperty->User->email)) {
						return $SharedProperty->User->email;
					} else {
						return 'N/A';
					}
				})
				->addColumn('company_name', function ($SharedProperty) {
					if (!empty($SharedProperty->User->company_name)) {
						return $SharedProperty->User->company_name;
					} else {
						return 'N/A';
					}
				})
				->addColumn('partner_number', function ($SharedProperty) {
					if (!empty($SharedProperty->User->mobile_number)) {
						return $SharedProperty->User->mobile_number;
					} else {
						return 'N/A';
					}
				})
				// ->addColumn('user_number', function ($SharedProperty) {
				// 	if (!empty(Auth::user()->mobile_number)) {
				// 		return Auth::user()->mobile_number;
				// 	} else {
				// 		return 'N/A';
				// 	}
				// })
				->addColumn('status', function ($SharedProperty) {
					if ($SharedProperty->accepted == 1) {
						return '<center><span class="badge badge-success">Active</span></center>';
					} else if ($SharedProperty->accepted == 2) {
						return '<center><span class="badge badge-danger">Cancel</span></center>';
					} else {
						return '<center><span class="badge badge-info">Pending</span></center>';
					}
				})
				// ->addColumn('action', function ($SharedProperty) {
				// 	$action  = '';
				// 	$action .= '<i role="button" title="Delete" data-id=' . $SharedProperty->id . ' onclick="deletePartner(this)" class="fs-22 py-2 mx-2 fa-trash pointer fa text-danger" type="button"></i>';
				// 	return $action;
				// })
				->rawColumns(['partner_name', 'partner_number', 'company_name', 'partner_email',   'status'])
				->make(true);
		}
		return view('admin.partner.partner_req');
	}
	/**
	 * Add Partner to share User Records
	 *
	 * @return \Illuminate\Http\Response JSON
	 */
	public function userPartner(Request $request)
	{
		// dd($request->all());
		foreach ($request->partner_id as $val) {
			try {
				SharedProperty::create([
					'partner_id' => (int)$val,
					'user_id' => Auth::user()->id,
					'property_id' => $request->property_id,
				]);
				// create notification for new user
				$userNotification = UserNotifications::create([
					"user_id" => (int) $val,
					"notification" => Auth::user()->first_name . " has shared property.",
					"notification_type" => Constants::PROPERTY_SHARED,
					"property_id" => $request->property_id
				]);
				// if notificaton creation failed.
				if (!$userNotification) {
					Log::error('Unable to create user notification, for user partner to share property.');
				}
			} catch (\Exception $e) {
				dd("err", $e);
			}
		}
	}

	/**
	 * Property Index Users Records
	 *
	 * @return \Illuminate\Http\Response JSON
	 */
	public function users()
	{
		// changed by user list all displayed so
		$users = Partner::with('user')->where('status', '=', 'Active')->where('user_id',Auth::user()->id)->withTrashed()->get();
		return response()->json($users);
	}

	/**
	 * Delete Partner Record
	 *
	 * @return \Illuminate\Http\Response JSON
	 */
	public function deletedPartner(Request $request)
	{
		if (!empty($request->id)) {
			$dlt_partner = Partner::where('id', $request->id)->delete();
			return json_encode($dlt_partner);
		}
	}

	public function userRequest(Request $request)
	{
		if ($request->ajax()) {
			// $sharedproperty = SharedProperty::with('Property_details', 'User')->where('user_id', Auth::user()->id)->withTrashed()->get();

			$sharedUsersReq = Partner::with('User')->where('partner_id', Auth::user()->id)->get();
			// dd("user REqs :",$sharedUsersReq);
			return DataTables::of($sharedUsersReq)->addIndexColumn()
				->addColumn('partner_name', function (Partner $sharedUser) {
					if (!empty($sharedUser->User->first_name || $sharedUser->User->last_name)) {
						return $sharedUser->User->first_name . ' ' . $sharedUser->User->last_name;
					} else {
						return 'N/A';
					}
				})
				->addColumn('company_name', function (Partner $sharedUser) {
					if (!empty($sharedUser->User->company_name)) {
						return $sharedUser->User->company_name;
					} else {
						return 'N/A';
					}
				})
				->addColumn('partner_email', function (Partner $sharedUser) {
					if (!empty($sharedUser->User->email)) {
						return $sharedUser->User->email;
					} else {
						return 'N/A';
					}
				})
				->addColumn('action', function (Partner $sharedUser) {
					$buttons = '';
					if (!$sharedUser->accepted) {
						$buttons .=   ' <button data-id="' . $sharedUser->id . '" onclick=acceptUsersRequest(this) class="btn btn-pill btn-danger" type="button">Accept</button>';
					}
					$buttons .=   ' <button data-id="' . $sharedUser->id . '" onclick=cancelRequest(this) class="btn btn-pill btn-primary" type="button">Cancel</button>';
					return $buttons;
				})
				->rawColumns(['partner_name', 'company_name', 'partner_email',   'action'])
				->make(true);
		}
		return view('admin.properties.user_shared_req');
	}

	public function acceptUserRequest(Request $request)
	{
		if ($request->ajax()) {
			if (!empty($request->id)) {
				try {
					// Find the Partner record and load related users
					$partnerReq = Partner::find($request->id)->load(['requestSendingUser', 'user']);
		
					// Update the status to 'Active'
					$partnerReq->update(['status' => 'Active']);
		
					// Get user objects
					$receiver = $partnerReq->user;
					$sender = $partnerReq->requestSendingUser;
		
					// Prepare notification message
					$message = "$receiver->first_name $receiver->last_name has accepted your request regarding adding as partner.";
		
					// Create a user notification
					UserNotifications::create([
						"user_id" => (int) $sender->id,
						"notification" => $message,
						"notification_type" => Constants::PARTNER_REQUEST_ACCEPTED,
						'by_user' => (int) $receiver->id,
					]);
		
					// Send push notification if sender has OneSignal token
					if (!empty($sender->onesignal_token)) {
						HelperFn::sendPushNotification($sender->onesignal_token, $message);
					} else {
						Log::error("Accept Add Partner Request Error: ");
						Log::error("User id: $sender->id does not have OneSignal token");
						Log::error("That's why notification not sent.");
					}
		
					// Delete the Partner record
					$deleted_partner = Partner::where('id', $request->id)->delete();
		
					// Return success response
					return response()->json(['success' => true, 'deleted_partner' => $deleted_partner]);
		
				} catch (\Throwable $th) {
					// Handle any errors
					Log::error("On Accept add partner request attempt failed by user Id: $receiver->id");
					Log::error("Error Message: " . $th->getMessage());
					return response()->json(['success' => false, 'error' => $th->getMessage()]);
				}
			}
		}
	}
}
