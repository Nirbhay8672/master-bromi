<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Constants;
use App\Models\User;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Areas;
use App\Models\Branches;
use App\Models\City;
use App\Models\District;
use App\Models\DropdownSettings;
use App\Models\Projects;
use App\Models\State;
use App\Models\Subplans;
use App\Models\UserNotifications;
use App\Traits\HelperFn;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use Illuminate\Http\UploadedFile;

class UserController extends Controller
{
    use HelperFn; 
    
	public function __construct()
	{
		$this->middleware('auth');
	}

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
		
		if ($request->ajax()) {
			$data = User::where('parent_id', Auth::user()->id)->orWhere('id', Auth::user()->id)->get();

			$new_data = $data;

			return DataTables::of($new_data)
				->editColumn('email', function ($row) {
					return '<span class="text-lowercase">'.$row->email.'</span>';
				})
				->editColumn('role_id', function ($row) {
					if (!empty($row->getRoleNames()[0])) {
						if (str_contains($row->getRoleNames()[0], '_---_')) {
							$name = explode('_---_', $row->getRoleNames()[0]);
							return $name[0];
						}
						return $row->getRoleNames()[0];
					}
				})
				->editColumn('status', function ($row) {
					$hiring_days = "";
					if (!empty($row->hire_date)) {
						$days = 0;
						$start_date = Carbon::parse(date('Y-m-d 00:00:00',strtotime($row->hire_date)));
						$end_date = Carbon::now();
						$days = $start_date->diffInDays($end_date);
						$vv = Helper::convertTOYear($days);
						$str = '';
						if($vv['year'] > 0){
							$str .= $vv['year']. ' Year ';
						}
						if($vv['month'] > 0){
							$str .= $vv['month']. ' Month ';
						}
						if($vv['day'] > 0){
							$str .= $vv['day']. ' day';
						}
						$hiring_days = "<div>".$str.'  ago </div>';
					}

					$parent_user_name = '';

					if($row->parent_id) {
						$user = User::find($row->parent_id);
						$parent_user_name = $user->first_name ?? '' . $user->last_name ?? '';   
					}

					$created_by = '';

					if($parent_user_name) {
						$created_by = '<div>Created By : '.$parent_user_name.'</div>';
					}

					$created_at = '<div>Created At: '.date('d/m/Y',strtotime($row->created_at)).'</div>';
					$updated_at = '<div>Last Modify At: '.date('d/m/Y',strtotime($row->updated_at)).'</div>';
					return $hiring_days.$created_by.$created_at.$updated_at;
				})
				->editColumn('Actions', function ($row) {
					$buttons = '';

					$user = User::with(['roles', 'roles.permissions'])->where('id',Auth::user()->id)->first();

					$edit_permission = array_filter($user->roles[0]['permissions']->toArray(), function ($var) {
						return ($var['name'] == 'user-edit');
					});

					$delete_permission = array_filter($user->roles[0]['permissions']->toArray(), function ($var) {
						return ($var['name'] == 'user-delete');
					});

					if(Auth::user()->id != $row->id) {
						if(count($edit_permission) > 0) {
							$buttons =  $buttons . '<a href="'.route('admin.user.edit',$row->id).'"><i role="button" title="Edit" data-id="' . $row->id . '"  class="fs-22 py-2 mx-2 fa-pencil pointer fa  " type="button"></i></a>';
						}
	
						if(count($delete_permission) > 0) {
							$buttons =  $buttons . '<i role="button" title="Delete" data-id="' . $row->id . '" onclick=deleteUser(this) class="fa-trash pointer fa fs-22 py-2 mx-2 text-danger" type="button"></i>';
						}	
					}
					
					return $buttons;
				})
				->rawColumns(['Actions','status','email'])
				->make(true);
		}
		$cities = City::orderBy('name')->where('user_id',Auth::user()->id)->get();
		$states = State::orderBy('name')->where('user_id',Auth::user()->id)->get();
		$projects = Projects::get();
		$property_configuration_settings = DropdownSettings::get()->toArray();
		$employees  = User::where('id', Session::get('parent_id'))->orWhere('parent_id', Session::get('parent_id'))->get();
		$roles =  Role::where('user_id', Session::get('parent_id'))->get();
		$branches = Branches::orderBy('name')->get();
		$plan_details = Subplans::find(Auth::user()->plan_id);
		$plans = Subplans::get();
		$total_user = User::where('parent_id', Auth::user()->id)->count();
		return view('admin.users.index', compact('roles', 'cities', 'states', 'projects', 'property_configuration_settings', 'employees','branches','plan_details','plans','total_user'));
	}
	
	public function storeFile(UploadedFile $file)
    {
        $path = "file_".time().(string) random_int(0,5).'.'.$file->getClientOriginalExtension();
		$file->storeAs("public/file_image/", $path);
        return $path;
    }

	public function saveUser(Request $request)
	{	
		$request->validate([
			'first_name' => 'required',
			'last_name' => 'required',
			'birth_date' => 'required',
			'hire_date' => 'required',
			"city_id" => 'required',
			"state_id" => 'required',
			"mobile_number" => 'required|numeric|digits:10|unique:users,mobile_number,' . $request->id ?? 0,
			"email" => 'required|unique:users,email,'. $request->id ?? 0,
			'password' => $request->id ? '' : 'required|string',
			'role_id' => $request->id ? '' : 'required|string',
		],
		[
			'city_id.required' => 'The city field is required.',
			'state_id.required' => 'The state field is required.',
			'role_id.required' => 'The role field is required.',
		]);

		if (!empty($request->id) && $request->id != '') {
			$data = User::find($request->id);
			if (empty($data)) {
				$data =  new User();
			}
		} else {
			$data =  new User();

			$user = User::find(Auth::user()->id);

			$user->fill([
				'total_free_user' => $user->total_free_user - 1, 
			])->save();
		}
		if (!empty($request->password)) {
			$data->password = Hash::make($request->password);
		}
		
		$data->parent_id = Auth::user()->id;
		$data->first_name = $request->first_name;
		$data->middle_name = $request->middle_name;
		$data->last_name = $request->last_name;
		$data->birth_date = $request->birth_date;
		$data->hire_date = $request->hire_date;
		$data->driving_license = $request->driving_license;
		if (empty($request->status) && $request->status !== 0) {
			$data->status = 0;
		}else{
			$data->status = $request->status;
		}
		$data->address = $request->address;
		$data->pincode = $request->pincode;
		$data->city_id = $request->city_id;
		$data->state_id = $request->state_id;
		$data->mobile_number = $request->mobile_number;
		$data->office_number = $request->office_no;
		$data->email = $request->email;
		$data->role_id = $request->role_id;
		$data->home_number = $request->home_phone_no;
		$data->position = $request->position;
		$data->branch_id = $request->branch_id;
		$data->reporting_to = $request->reporting_to;
		$data->property_for_id = $request->property_for_id;
		$data->enquiry_for_id = $request->enquiry_for_id !='' ? $request->enquiry_for_id : null;
		$data->property_type_id = $request->property_type_id;

		$data->enquiry_type = $request->enquiry_type_id;
		$data->specific_enquiry = $request->specific_enquiry;
		
		$data->specific_properties = $request->specific_properties;
		$data->buildings = $request->buildings;
		$data->enquiry_permission = $request->enquiry_permission;
		$data->working = $request->working;
		$data->plan_id = Auth::user()->plan_id;

		$data->subscribed_on = Auth::user()->subscribed_on;
		$data->plan_expire_on = Auth::user()->plan_expire_on;
		
		$plan = Subplans::find(Auth::user()->plan_id);	
		
		if($plan) {
			$data->total_user_limit = $plan->user_limit;
		} else {
			$data->total_user_limit = 10;
		}
		
		$data->id_type = $request->id_type;

		if($request->id_type_file) {
			$id_type_file = $request->id_type_file;
			$data->id_file = $this->storeFile($id_type_file);
		}


		$data->save();
		$data->syncRoles([]);

		if (!empty($request->role_id)) {
			$data->assignRole($request->input('role_id'));
		}

		if (!empty($request->id) && $request->id != '') {

		} else {

			// create notification for new user
			$msg = $data->first_name .' '. $data->last_name . " user created.";
			
			$userNotification = UserNotifications::create([
				"user_id" => Auth::user()->id,
				"notification" => $msg,
				"notification_type" => Constants::NEW_USER,
				"new_user_id" => $data->id
			]);
			// if notificaton creation failed.
			if (!$userNotification) {
				Log::error('Unable to create user notification');
			}
			$user = Auth::user();
			// send if user has onesignal id
			if (!empty($user->onesignal_token)) {
				HelperFn::sendPushNotification($user->onesignal_token, $msg);
			}
			// create notification for new user end

			$state = State::find($request->state_id);
			$city = City::find($request->city_id);

			$new_state = new State();
			$new_state->fill([
				'name' => $state->name,
				'user_id' => $data->id,
			])->save();

			$new_city = new City();
			$new_city->fill([
				'name' => $city->name,
				'user_id' => $data->id,
				'state_id' => $new_state->id,
			])->save();

			$new_district = new District();

			$new_district->fill([
				'name' => $city->name,
				'state_id' => $new_state->id,
				'user_id' => $data->id,
			])->save();

			$allarea = Areas::where('city_id',$request->city_id)
				->where('state_id',$request->state_id)
				->get();
				
			foreach ($allarea as $area_obj)
			{
				$area = new Areas();

				$area->fill([
					'user_id' => $data->id,
					'name' => $area_obj->name,
					'city_id' => $new_city->id,
					'pincode' => $area_obj->pincode,
					'state_id' => $new_state->id,
				])->save();
			}
		}

		return response()->json();
	}

	public function getSpecificUser(Request $request)
	{
		if (!empty($request->id)) {
			$data =  User::where('id', $request->id)->first();
			$dataa['data'] = $data->toArray();
			$dataa['role'] = '';
			if (isset($data->getRoleNames()[0])) {
				$dataa['role'] = $data->getRoleNames()[0];
			}
			return json_encode($dataa);
		}
	}

	public function addUser(Request $request){


		$cities = City::orderBy('name')->where('user_id',Auth::user()->id)->get();
		$states = State::orderBy('name')->where('user_id',Auth::user()->id)->get();
		$projects = Projects::where('user_id',Auth::user()->id)->get();
		$property_configuration_settings = DropdownSettings::where('user_id', 8)->get()->toArray();
		$employees  = User::where('id', Session::get('parent_id'))->orWhere('parent_id', Session::get('parent_id'))->get();
		$roles =  Role::where('user_id', Session::get('parent_id'))->get();
		$branches = Branches::orderBy('name')->get();

		$first_state = State::where('user_id',Auth::user()->id)->first();
		$first_city = City::where('user_id',Auth::user()->id)->first();

		return view('admin.users.add_user', compact('roles', 'cities', 'states', 'projects', 'property_configuration_settings', 'employees','branches', 'first_state', 'first_city'));
	}

	public function editUser(Request $request)
	{
		$cities = City::orderBy('name')->where('user_id',Auth::user()->id)->get();
		$states = State::orderBy('name')->where('user_id',Auth::user()->id)->get();
		$projects = Projects::where('user_id',Auth::user()->id)->get();
		$property_configuration_settings = DropdownSettings::all()->unique('name')->toArray();
		$employees  = User::where('id', Session::get('parent_id'))->orWhere('parent_id', Session::get('parent_id'))->get();
		$roles =  Role::where('user_id', Session::get('parent_id'))->get();
		$branches = Branches::orderBy('name')->get();
		$current_id = $request->id;

		$first_state = State::where('user_id',Auth::user()->id)->first();
		$first_city = City::where('user_id',Auth::user()->id)->first();

		return view('admin.users.add_user', compact('roles', 'cities', 'states', 'projects', 'property_configuration_settings', 'employees','branches','current_id','first_state', 'first_city'));
	}

	public function destroy(Request $request)
	{
		if (!empty($request->id)) {
			$data = User::where('id', $request->id)->delete();
		}
	}
}
