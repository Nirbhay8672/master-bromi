<?php

namespace App\Http\Controllers\Superadmin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Api\Properties;
use App\Models\Enquiries;
use App\Models\LoggedIn;
use App\Models\Projects;
use App\Models\State;
use App\Models\Subplans;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class UserController extends Controller
{
	use AuthenticatesUsers;

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function forceLogin(Request $request)
	{
        $request->merge([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        $this->validateLogin($request);
		
		$user_email =  User::where('email', $request->email)->first();
		$ip = $request->ip();
		if (!empty($user_email)) {
			LoggedIn::create(['user_id' => $user_email->parent_id,'employee_id' => $user_email->id, 'ipaddress' => $ip]);
		}

		if (
			method_exists($this, 'hasTooManyLoginAttempts') &&
			$this->hasTooManyLoginAttempts($request)
		) {
			$this->fireLockoutEvent($request);

			return $this->sendLockoutResponse($request);
		}
		if ($this->attemptLogin($request)) {
			if ($request->hasSession()) {
				$request->session()->put('auth.password_confirmed_at', time());
			}
		    DB::table('login_activities')->insert([
				'user_id' => Auth::user()->id,
				'ip_address' => $request->ip(),
				'date_time' => Carbon::now(),
			]);
			return $this->sendLoginResponse($request);
		}
	}

	public function loginAsUser($userId , Request $request)
	{
		$userToLogin = User::findOrFail($userId);

		Session::put('plan_id', $userToLogin->plan_id);

		if ($userToLogin->role_id == 3) {
			return redirect()->route('superadmin');
		}
		if (!empty($userToLogin->parent_id)) {
			Session::put('parent_id', $userToLogin->parent_id);
		} else {
			Session::put('parent_id', $userToLogin->id);
		}
		
		$request->merge([
			'email' => $userToLogin->email,
			'password' => base64_decode($userToLogin->temp_pass)
		]);
		
		$this->forceLogin($request);
		
		return redirect('admin');
	}

	public function customFilter($item, $searchTerm) {
		if (isset($item)) {
			return stripos($item, $searchTerm) !== false;
		}
		return false;
	}

	public function index(Request $request)
	{
		if ($request->ajax())
		{
			$admin_users = User::with(['Plan','State:id,name','superCity:id,name'])
				->select([
					'id',
					'first_name',
					'last_name',
					'email',
					'mobile_number',
					'city_id',
					'plan_id',
					'state_id',
					'role_id',
					'status',
					'company_name',
					'subscribed_on',
					'plan_expire_on',
					'parent_id',
				])
				->where('parent_id', null)
				->where('role_id','!=',3)
				->orderBy('id','DESC')
				->get();

			$final_array = [];

			foreach ($admin_users->toArray() ?? [] as $user) {
				$user['state_name'] = $user['state'] ? $user['state']['name'] : '';
				if(array_key_exists('city',$user)) {
					$user['city_name'] = $user['city'] ? $user['city']['name'] : '';
					array_push($final_array, $user);
				} else {
					$user['city_name'] = $user['super_city'] ? $user['super_city']['name'] : '';
					array_push($final_array, $user);
				}
			}

			if($request->filter_value) {
				$value = $request->filter_value;
				if($request->filter_type == 'state') {
					$final_array = array_filter($final_array, function ($item) use ($value) {
						return $this->customFilter($item['state_name'], $value);
					});
				}
				if($request->filter_type == 'city') {
					$final_array = array_filter($final_array, function ($item) use ($value) {
						return $this->customFilter($item['city_name'], $value);
					});
				}
			}

			$id_column = array_column($final_array, 'id');
			array_multisort($id_column, SORT_DESC, $final_array);

			return DataTables::of($final_array)
				->editColumn('select_checkbox', function ($row) {
					$abc = '<div class="form-check checkbox checkbox-primary mb-0">
				<input class="form-check-input table_checkbox" data-id="' . $row['id'] . '" name="select_row[]" id="checkbox-primary-' . $row['id'] . '" type="checkbox">
				<label class="form-check-label" for="checkbox-primary-' . $row['id'] . '"></label>
				</div>';
					return $abc;
				})
				->editColumn('plan', function ($row) {
					if (!empty($row['plan']['name'])) {
						return $row['plan']['name'];
					}
				})
				->editColumn('users', function ($row) {
					return User::where('users.parent_id', $row['id'])->orWhere('id', $row['id'])->get()->count();
				})
				->editColumn('subscribed_on', function ($row) {
					if (!empty($row['subscribed_on'])) {
						return date("d/m/Y", strtotime($row['subscribed_on']));
					}
				})
				->editColumn('plan_expire_on', function ($row) {
					if (!empty($row['plan_expire_on'])) {
						return date("d/m/Y", strtotime($row['plan_expire_on']));
					}
				})
				->editColumn('active', function ($row) {
					$active_button = '';

					if ($row['role_id'] != 3) {
						if ($row['status']) {
							$active_button = '<div class="media-body text-center">
								<label class="switch mb-0">
									<input type="checkbox" id="active_btn" checked="" data-id="' . $row['id'] . '" onclick=userActivate(this,0)>
									<span class="switch-state"></span>
								</label>
							</div>';
						} else {
							$active_button = '<div class="media-body text-center">
								<label class="switch mb-0">
									<input type="checkbox" id="active_btn" data-id="' . $row['id'] . '" onclick=userActivate(this,1)>
									<span class="switch-state"></span>
								</label>
							</div>';
						}
					}

					return $active_button;
				})
				->editColumn('Actions', function ($row) {
					$buttons = '';
					
					$buttons =  $buttons . '<a href="'.route('superadmin.user-profile',$row['id']).'"><i role="button" title="view profile" class="fs-22 py-2 mx-2 fa-eye pointer fa" type="button"></i></a>';
					
					if(!$row['parent_id'] || $row['parent_id'] == Auth::user()->id) {
						$buttons =  $buttons . '<i role="button" data-id="' . $row['id'] . '" onclick=getUser(this) class="fa fa-pencil pointer fa fs-22 py-2 mx-2"></i>';
					}
					
					return $buttons;
				})
				->rawColumns(['Actions', 'active', 'select_checkbox'])
				->make(true);
		}

		$roles =  Role::where('user_id')->get();
		$states = State::with(['cities'])->where('user_id', Auth::user()->id)->get();

		return view('superadmin.users.index', compact('roles', 'states'));
	}

	public function profile($id){
		
		$login_user = User::find($id);

		$plans = Subplans::get();

		if($login_user->parent_id) {
			$user = User::with('Branch','State','city')->where('id',$login_user->id)->first();
			$user->city_name = $user->city->name;
		} else {
			$user = User::with('Branch','State','superCity')->where('id',$login_user->id)->first();
			$user->city_name = $user->superCity->name;
		}

		$sub_users = User::where('parent_id',$id)->whereNull('users.vendor_id')->get();

		$user_count = $sub_users->count() + 1;

		$total_property = Properties::select('id')->where('user_id', $id)->count();
		$total_enquiry = Enquiries::select('id')->where('user_id', $id)->count();
		$total_project = Projects::select('id')->where('user_id', $id)->count();

		$transactions = DB::table('payments')
			->join('subplans','subplans.id','payments.plan_id')
			->select([
				'payments.*',
				'subplans.name AS plan_name',
				DB::raw("CASE WHEN payments.transaction_goal = 'new_subscription' THEN 'New Subscription' WHEN payments.transaction_goal = 'add_user' THEN 'Add User' WHEN payments.transaction_goal = 'upgrade' THEN 'Upgrade' ELSE '-' END AS transaction_goal_flag")
			])->where('payments.user_id',$id)->get();

		$tickets = DB::table('tickets')
			->join('categories','categories.id','tickets.id')
			->select([
				'tickets.*',
				'categories.name AS category_name',
			])->where('tickets.user_id',$id)
			->where('status', 'Open')
			->orderBy('tickets.created_at', 'asc')
			->take(10)
			->get();

		return view('superadmin.users.user_profile',compact('user','sub_users','tickets', 'plans','transactions','user_count','total_property','total_enquiry','total_project'));
	}

    public function membersList(Request $request)
	{
		if ($request->ajax()) {
			$data = User::where('role_id', '3')->where('id','!=',6)->with('Plan')->get();
			return DataTables::of($data)
				->editColumn('birth_date', function ($row) {
					if (!empty($row->birth_date)) {
						return date('d/m/Y', strtotime($row->birth_date));
					}
				})

				->editColumn('Actions', function ($row) {
                    $buttons = '';
                    if (empty(Auth::user()->parent_id)) {
                        $buttons =  $buttons . '<i role="button" data-id="' . $row->id . '" onclick=getUser(this) class="fa-pencil pointer fa fs-22 py-2 mx-2" type="button"></i>';
                    } else {
                        $buttons =  $buttons . '<i role="button" data-id="' . $row->id . '" class="fa-pencil pointer fa fs-22 py-2 mx-2" type="button" onclick="resetData()"></i>';
                    }
					
					return $buttons;
				})
				->rawColumns(['Actions'])
				->make(true);
		}

		$roles =  Role::where('user_id')->get();
		return view('superadmin.members.index', compact('roles'));
	}

	public function changeStatus(Request $request)
	{
		if (!empty($request->id)) {
			$data = User::find($request->id);
			if (!empty($data)) {
				$data->status =  $request->status;
				$data->save();
			}
		}
	}

	public function saveUser(Request $request)
	{
		if (!empty($request->id) && $request->id != '') {
			$data = User::find($request->id);
			$data->first_name = $request->first_name;
			$data->last_name = $request->last_name;
			$data->email = $request->email;
			$data->mobile_number = $request->mobile_number;
			$data->state_id = $request->state;
			$data->city_id = $request->city;
			$data->company_name = $request->company_name;
			if (!empty($request->password)) {
				$data->password = Hash::make($request->password);
			}
			$data->status = 1;
			$data->role_id = 1;
			$data->save();
		} else {
			$data =  new User();
			$data->first_name = $request->first_name;
			$data->last_name = $request->last_name;
			$data->email = $request->email;
			$data->mobile_number = $request->mobile_number;
			$data->state_id = $request->state;
			$data->city_id = $request->city;
			$data->company_name = $request->company_name;
			if (!empty($request->password)) {
				$data->password = Hash::make($request->password);
			}
			$data->status = 1;
			$data->role_id = 1;
			$data->vendor_id =  Str::random(10);
			$data->save();
			$role =  new Role();
			$role->name = 'Admin_---_' . $data->id;
			$role->user_id = $data->id;
			$role->save();
			$role->syncPermissions(Permission::where('guard_name', 'web')->get()->pluck('id')->all());
			$data->syncRoles([]);
			$data->assignRole($role->name);
		}
	}

    public function saveMember(Request $request)
	{
		if (!empty($request->id) && $request->id != '') {
			$data = User::find($request->id);
			$data->first_name = $request->first_name;
			$data->last_name = $request->last_name;
			$data->birth_date = Carbon::parse($request->birth_date)->format('Y-m-d');
			$data->email = $request->email;
			if (!empty($request->password)) {
				$data->password = Hash::make($request->password);
			}
			$data->status = 1;
			$data->role_id = 3;
			$data->permissions = json_encode($request->permissions);
			$data->save();
		} else {
			$data =  new User();
			$data->first_name = $request->first_name;
			$data->last_name = $request->last_name;
            $data->birth_date = Carbon::parse($request->birth_date)->format('Y-m-d');
			$data->email = $request->email;
			if (!empty($request->password)) {
				$data->password = Hash::make($request->password);
			}
			$data->role_id = 3;
			$data->status = 1;
			$data->plan_id = 1;
			$data->total_user_limit = 1;
            $data->permissions = json_encode($request->permissions);
			$data->save();
			$role =  Role::find(3);
			$role->syncPermissions(Permission::where('guard_name', 'web')->get()->pluck('id')->all());
			$data->syncRoles([]);
			$data->assignRole($role->name);
		}
	}

	public function getSpecificUser(Request $request)
	{
		if (!empty($request->id)) {

			$sub_users = User::where('parent_id', $request->id)->whereNull('vendor_id')->get();

			$users_id = [intval($request->id)];

			foreach ($sub_users as $user) {
				array_push($users_id, $user['id']);
			}

			$property_count = Properties::whereIn('user_id', $users_id)->get()->count();
			$project_count = Projects::whereIn('user_id', $users_id)->get()->count();
			$enquiry_count = Enquiries::whereIn('user_id', $users_id)->get()->count();

			$data = [
				'main_user' => User::where('id', $request->id)->first()->toArray(),
				'sub_user' => $sub_users,
				'total_property' => $property_count,
				'total_project' => $project_count,
				'total_enquiry' => $enquiry_count,
			];

			return response()->json($data);
		}
	}

    public function getSpecificMember(Request $request)
	{
		if (!empty($request->id)) {

			$sub_users = User::where('parent_id', $request->id)->whereNull('vendor_id')->get();

			$users_id = [intval($request->id)];

			foreach ($sub_users as $user) {
				array_push($users_id, $user['id']);
			}

			$property_count = Properties::whereIn('user_id', $users_id)->get()->count();
			$project_count = Projects::whereIn('user_id', $users_id)->get()->count();
			$enquiry_count = Enquiries::whereIn('user_id', $users_id)->get()->count();

			$data = [
				'main_user' => User::where('id', $request->id)->first()->toArray(),
				'sub_user' => $sub_users,
				'total_property' => $property_count,
				'total_project' => $project_count,
				'total_enquiry' => $enquiry_count,
			];

			return response()->json($data);
		}
	}

	public function destroy(Request $request)
	{
		if (!empty($request->id)) {
			$data = User::where('id', $request->id)->delete();
		}
	}
	
	public function destroyMember(Request $request)
	{
		if (!empty($request->id)) {
			$data = User::where('id', $request->id)->delete();
		}
	}
	
	public function loginActivity(Request $request)
	{
		if ($request->ajax()) {

			$data = DB::table('login_activities')->join('users','login_activities.user_id','users.id')
				->select([
					'login_activities.ip_address',
					'users.first_name AS username',
					'login_activities.date_time'
				])->where('user_id','!=',6)->get();

			return DataTables::of($data)->make(true);
		}

		return view('superadmin.users.login_activity');
	}

	public function checkForDeleteUsers(Request $request)
	{
		$users_list = [];
		$users_list_possible = [];
		
		foreach ($request->allids as $user_id) {
			$users = User::where('parent_id',$user_id)->get()->count();
			$properties  = Properties::where('user_id',$user_id)->get()->count();
			$enquiries  = Enquiries::where('user_id',$user_id)->get()->count();
			$projects  = Projects::where('user_id',$user_id)->get()->count();

			$total = $users + $properties + $projects + $enquiries;

			if($total > 0) {
				$user = User::withTrashed()->find($user_id);

				array_push($users_list,[
					$user->first_name.' '.$user->last_name,
				]);
			} else {
				array_push($users_list_possible,$user_id);
			}
		}

		return response()->json(['user_list' => $users_list, 'deletable_user' => $users_list_possible]);
	}

	public function deleteAllUsers(Request $request)
	{
		User::whereIn('id', $request->allids ?? [])->delete();
	}
}
