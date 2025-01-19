<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Exports\UsersExport;
use App\Helpers\Helper;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\Controller;
use App\Models\Api\Permission;
use App\Models\Branches;
use App\Models\City;
use App\Models\DropdownSettings;
use App\Models\Projects;
use App\Models\State;
use App\Models\Subplans;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function user_index(Request $request)
	{
		try {
			$User = User::where('parent_id', Auth::user()->id)->get();
            return response()->json([
                "status" => 200,
                "message" => "User List",
                "data" => $User
            ]);
		} catch (\Exception $e) {
			return response()->json([
                'status' => 'error',
                'message' => $e,
                'data' => $e,
            ], 500);
		}
	}
	
	public function saveUser(Request $request)
	{
		$message="User Added Successfully";

        if (!empty($request->input('178')) && $request->input('178') != '') {
            $data = User::find($request->input('178'));
			if (empty($data)) {
                $data =  new User();
			}
			$message="User Updated Successfully";
		} else {
            $data =  new User();
			
		}
		if (!empty($request->input('172'))) {
            $data->password = Hash::make($request->input('172'));
		}
		$data->parent_id = Auth::user()->id;
		$data->first_name = $request->input('157');
		$data->middle_name = $request->input('158');
		$data->last_name = $request->input('159');
		$data->birth_date = $request->input('160');
		$data->hire_date = $request->input('161');
		$data->driving_license = $request->input('162');
		if (empty($request->input('163')) && $request->input('163') !== 0) {
            $data->status = 0;
		}else{
            $data->status = $request->input('163');
		}
		$data->address = $request->input('167');
		$data->pincode = $request->input('130');
		$data->city_id = $request->input('128');
		$data->state_id = $request->input('127');
		$data->mobile_number = $request->input('95');
		$data->office_number = $request->input('174');
		$data->email = $request->input('175');
		$data->role_id = $request->input('173');
		$data->home_number = $request->input('168');
		$data->position = $request->input('169');
		$data->property_for_id = $request->input('176');
		$data->branch_id = json_encode($request->input('170'));
		$data->reporting_to = json_encode($request->input('171'));
		$data->property_type_id = json_encode($request->input('177'));
		$data->specific_properties = json_encode($request->input('165'));
		$data->buildings = json_encode($request->input('166'));
		$data->working = $request->input('164');
		// dd($data);
		$data->save();
		// $data->syncRoles([]);

		// if (!empty($request->input('173'))) {
		// 	$data->assignRole($request->input('173'));
		// }
		
		return response()->json([
			"status" => 200,
			"message" => $message
		]);
	}
	public function user_destroy(Request $request)
	{
		if (!empty($request->input('178'))) {
			$user=User::find($request->input('178'));
			if($user != null){
				$data = User::where('id', $request->input('178'))->delete();
				return response()->json([
					"status" => 200,"message" => "User Deleted Successfully"
				]);
			}else{
				
				return response()->json([
					"status" => 500,"message" => "Provider Id Not found"
				]);
			}
		}
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
		$projects = Projects::get();
		$property_configuration_settings = DropdownSettings::get()->toArray();
		$employees  = User::where('id', Session::get('parent_id'))->orWhere('parent_id', Session::get('parent_id'))->get();
		$roles =  Role::where('user_id', Session::get('parent_id'))->get();
		$branches = Branches::orderBy('name')->get();

		return view('admin.users.add_user', compact('roles', 'cities', 'states', 'projects', 'property_configuration_settings', 'employees','branches'));
	}

	public function editUser(Request $request)
	{
		$cities = City::orderBy('name')->where('user_id',Auth::user()->id)->get();
		$states = State::orderBy('name')->where('user_id',Auth::user()->id)->get();
		$projects = Projects::get();
		$property_configuration_settings = DropdownSettings::get()->toArray();
		$employees  = User::where('id', Session::get('parent_id'))->orWhere('parent_id', Session::get('parent_id'))->get();
		$roles =  Role::where('user_id', Session::get('parent_id'))->get();
		$branches = Branches::orderBy('name')->get();
		$current_id = $request->id;

		return view('admin.users.add_user', compact('roles', 'cities', 'states', 'projects', 'property_configuration_settings', 'employees','branches','current_id'));
	}


	public function saveRole(Request $request)
	{
		// Assuming $request->input('218') contains an array of permission names.
		$permissions = $request->input('218');

		// Create or update the role
		if (!empty($request->input('217'))) {
			$data = Role::find($request->input('217'));
			$message = "Role Updated Successfully";
		} else {
			$data = new Role();
			$message = "Role Added Successfully";
		}

		$data->name = $request->input('179') . '_---_' . Auth::user()->id;
		$data->guard_name = 'api';
		$data->save();

		// Manually create and associate permissions
		foreach ($permissions as $key => $value) {
			if ($value == 1) {
				$permissionName = $key;
				$permission = Permission::Create(['permission_id' => $value, 'role_id' => 19]);
				$data->givePermissionTo($permission);
			}
		}

		return response()->json([
			"status" => 200,
			"message" => $message
		]);

			
	}

	public function destroyRole(Request $request)
	{
		if (!empty($request->input('217')) && !empty(Role::where('id', $request->input('217')))) {
			$data = Role::where('id', $request->input('217'))->delete();
			$message="Role Deleted Successfully";
		}else{
			$message="Provided Id Not Found";
		}
		return response()->json([
			"status" => 200,
			"message" => $message
		]);
	}
	public function roleList(Request $request)
	{
		
		try {
			$Role = Role::where('user_id', Auth::user()->id)->get();
            return response()->json([
                "status" => 200,
                "message" => "Role List",
                "data" => $Role
            ]);
		} catch (\Exception $e) {
			return response()->json([
                'status' => 'error',
                'message' => $e,
                'data' => $e,
            ], 500);
		}
	}

	public function ProfileDetails(){
		try {
			$user =  Auth::user()->id;
		$plans = Subplans::get();
		$user = User::with('Branch','State','City')->where('id',$user)->first();
		$user_count =  User::where('parent_id',Auth::User()->id)->orWhere('id',Auth::User()->id)->get()->count();
		$plan_detail=Subplans::where('id',$user->plan_id)->first();
		$data=[
			'User Detail'=>$user,
			'Plans'=>$plan_detail,
			'Plan Detail'=>[
				"Subscribed On"=>$user->subscribed_on,
				"Renewal On"=>$user->subscribed_on,
				"Users "=>$user_count

			],
		];
            return response()->json([
                "status" => 200,
                "message" => "Profile Details",
                "data" => $data
            ]);
		} catch (\Exception $e) {
			return response()->json([
                'status' => 'error',
                'message' => $e,
                'data' => $e,
            ], 500);
		}
		
	}

}
