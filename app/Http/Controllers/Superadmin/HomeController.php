<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\BromiEnquiry;
use App\Models\District;
use App\Models\Notifications;
use App\Models\Projects;
use App\Models\State;
use App\Models\Taluka;
use App\Models\TpScheme;
use App\Models\User;
use App\Models\Village;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class Homecontroller extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index(Request $request)
	{
		if (Auth::check()) {	
			$start_date = null;
			$end_date = Carbon::now()->format('Y-m-d 23:59:59');

			if($request->filled('date_range')){
				if($request->date_range == 'last_month' || $request->date_range == 'this_month'){
					$start_date = Carbon::now()->startOfMonth()->subMonth()->format('Y-m-d 00:00:00');
				}elseif($request->date_range == '6month'){
					$start_date = Carbon::now()->startOfMonth()->subMonth(6)->format('Y-m-d 00:00:00');
				}elseif($request->date_range == '3month'){
					$start_date = Carbon::now()->startOfMonth()->subMonth(3)->format('Y-m-d 00:00:00');
				}elseif($request->date_range == 'yearly'){
					$start_date = Carbon::now()->startOfMonth()->subMonth(12)->format('Y-m-d 00:00:00');
				}elseif($request->date_range == 'today'){
					$start_date = Carbon::now()->format('Y-m-d 00:00:00');
				}elseif($request->date_range == 'yesterday'){
					$start_date = Carbon::now()->subDay()->format('Y-m-d 00:00:00');
				}elseif($request->date_range == 'this_week'){
					$start_date = Carbon::now()->subDays(7)->format('Y-m-d 00:00:00');
				}
			}

			$total_builder = User::join('roles','users.role_id','roles.id')
			->select(['users.id'])
			->where('roles.name', 'like', '%Builder%');

			$total_members = User::where('role_id', 3);
			$total_requests = BromiEnquiry::query();
			$total_projects = Projects::query();

			if(!is_null($start_date)){
				$total_builder = $total_builder->whereBetween('users.created_at',[$start_date,$end_date]);
				$total_members = $total_members->whereBetween('created_at',[$start_date,$end_date]);
				$total_requests = $total_requests->whereBetween('created_at',[$start_date,$end_date]);
				$total_projects = $total_projects->whereBetween('created_at',[$start_date,$end_date]);
			} else {
				$total_builder = $total_builder->whereBetween('users.created_at',[Carbon::now()->startOfMonth()->subMonth()->format('Y-m-d 00:00:00'),$end_date]);
				$total_members = $total_members->whereBetween('created_at',[Carbon::now()->startOfMonth()->subMonth()->format('Y-m-d 00:00:00'),$end_date]);
				$total_requests = $total_requests->whereBetween('created_at',[Carbon::now()->startOfMonth()->subMonth()->format('Y-m-d 00:00:00'),$end_date]);
				$total_projects = $total_projects->whereBetween('created_at',[Carbon::now()->startOfMonth()->subMonth()->format('Y-m-d 00:00:00'),$end_date]);
			}

			$total_builder = $total_builder->get()->count();
			$total_members = $total_members->get()->count();
			$total_requests = $total_requests->get()->count();
			$total_projects = $total_projects->get()->count();

			$total_active_users = User::where('status',1)->where('id','!=',6)->get()->count();
			$total_users = User::where('id','!=',6)->get()->count();
			$total_sub_users = User::where('parent_id', '>', 0)->where('id','!=',6)->get()->count();
			
			$date= Carbon::now()->addDays(30);
			$total_ex_users = User::whereDate('plan_expire_on','<=', $date)->get()->count();

			return view('superadmin.dashboard')->with([
				'total_active_users' => $total_active_users,
				'total_users' => $total_users,
				'total_sub_users' => $total_sub_users,
				'total_ex_users' => $total_ex_users,
				'total_builder' => $total_builder,
				'total_members' => $total_members,
				'total_requests' => $total_requests,
				'total_projects' => $total_projects,
				'filter_value' => $request->date_range ?? 'this_month',
			]);
		}
		return redirect()->route('admin.login');
	}

	public function tpSchemeIndex(Request $request)
	{
		if ($request->ajax()) {
			$data = TpScheme::get();
			return DataTables::of($data)
				->editColumn('Actions', function ($row) {
					$buttons = '';
					$buttons =  $buttons . '<i data-id="' . $row->id . '" onclick=getTp(this) class="fs-22 py-2 mx-2 fa-pencil pointer fa" type="button"></i>';
					$buttons =  $buttons . ' <i data-id="' . $row->id . '" onclick=deleteTp(this) class="fs-22 py-2 mx-2 fa-trash pointer fa text-danger" type="button"></i>';
					return $buttons;
				})
				->rawColumns(['Actions'])
				->make(true);
		}
		$districts =  District::get();
		$talukas =  Taluka::get();
		$villages =  Village::get();

		return view('superadmin.tpscheme.index', compact('districts','talukas','villages'));
	}

	public function getTpScheme(Request $request)
	{
		if (!empty($request->id)) {
			$data =  TpScheme::where('id', $request->id)->first();
			return json_encode($data);
		}
	}

	public function deleteScheme(Request $request)
	{
		if (!empty($request->id)) {
			$data = TpScheme::where('id', $request->id)->delete();
		}
	}

	public function saveScheme(Request $request)
	{
		if (!empty($request->id) && $request->id != '') {
			$data = TpScheme::find($request->id);
			if (empty($data)) {
				$data =  new TpScheme();
			}
		} else {
			$data =  new TpScheme();
		}
		$data->name = $request->name;
		$data->villages = $request->villages;
		$data->save();
	}

	public function builders(Request $request)
	{
		if ($request->ajax()) {

			$data = User::join('roles','users.role_id','roles.id')
				->select([
					'users.id',
					'users.email',
					'users.mobile_number',
					'users.first_name AS builder_name',
					'roles.name AS role_name',
					'state.name AS state_name',
					'super_cities.name AS city_name',
				])
				->where('roles.name', 'like', '%Builder%')
				->join('state','state.id', 'users.state_id')
				->join('super_cities','super_cities.id', 'users.city_id');

			if($request->state_id > 0) {
				$data->where('state.id', $request->state_id);
			}

			if($request->city_id > 0) {
				$data->where('super_cities.id', $request->city_id);
			}
			
			$new_array = [];

			foreach ($data->get() as $user) {
				$project_count = Projects::where('user_id',$user['id'])->count();
				$user['projects_count'] = $project_count;

				array_push($new_array,$user);
			}

			return DataTables::of($new_array)->make(true);
		}

		$states = State::with(['cities'])->where('user_id',6)->get();
		
		return view('superadmin.builder.index',compact('states'));
	}
}
