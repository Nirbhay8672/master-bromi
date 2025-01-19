<?php

namespace App\Http\Controllers\Superadmin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Request $request)
	{
		if ($request->ajax()) {
			$data = User::whereNotNull('vendor_id')->with('Plan')->get();
			return DataTables::of($data)
				->editColumn('plan', function ($row) {
					if (!empty($row->Plan->name)) {
						return $row->Plan->name;
					}
				})
				->editColumn('users', function ($row) {
					return User::where('parent_id', $row->id)->whereNull('vendor_id')->get()->count();
				})
				->editColumn('Actions', function ($row) {
					$buttons = '';
					$buttons =  $buttons . '<button data-id="' . $row->id . '" onclick=getUser(this) class="btn btn-pill btn-primary" type="button">View</button>';
					if ($row->role_id != 3) {
						if ($row->status) {
							$buttons =  $buttons . ' <button data-id="' . $row->id . '" onclick=userActivate(this,0) class="btn btn-pill btn-danger" type="button">Deactivate</button>';
						} else {
							$buttons =  $buttons . ' <button data-id="' . $row->id . '" onclick=userActivate(this,1) class="btn btn-pill btn-primary" type="button">Activate</button>';
						}
					}
					return $buttons;
				})
				->rawColumns(['Actions'])
				->make(true);
		}
		$roles =  Role::where('user_id')->get();
		return view('superadmin.users.index', compact('roles'));
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
			if (!empty($data)) {
				$data =  new User();
				$data->first_name = $request->first_name;
				$data->last_name = $request->last_name;
				$data->email = $request->email;
				if (!empty($request->password)) {
					$data->password = Hash::make($request->password);
				}
				$data->status = 1;
				$data->role_id = 1;
				$data->save();
			}
		} else {
			$data =  new User();
			$data->first_name = $request->first_name;
			$data->last_name = $request->last_name;
			$data->email = $request->email;
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

	public function getSpecificUser(Request $request)
	{
		if (!empty($request->id)) {
			$data =  User::where('id', $request->id)->first()->toArray();
			return json_encode($data);
		}
	}

	public function destroy(Request $request)
	{
		if (!empty($request->id)) {
			$data = User::where('id', $request->id)->delete();
		}
	}
}
