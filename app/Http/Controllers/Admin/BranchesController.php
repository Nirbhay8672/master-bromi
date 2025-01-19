<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Areas;
use App\Models\Branches;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class BranchesController extends Controller
{
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
			$data = Branches::with('City')->where('user_id', Auth::user()->id)->orderBy('id','desc')->get();
			return DataTables::of($data)
				->editColumn('city_id', function ($row) {
					if (isset($row->City->name)) {
						return $row->City->name;
					}
					return '';
				})
				->editColumn('status', function ($row) {
					if ($row->status) {
						return 'active';
					} else {
						return 'not active';
					}
				})
				->editColumn('select_checkbox', function ($row) {
					$abc = '<div class="form-check checkbox checkbox-primary mb-0">
					<input class="form-check-input table_checkbox" data-id="' . $row->id . '" name="select_row[]" id="checkbox-primary-' . $row->id . '" type="checkbox">
					<label class="form-check-label" for="checkbox-primary-' . $row->id . '"></label>
					  </div>';
					return $abc;
				})
				->editColumn('Actions', function ($row) {
					$buttons = '';
					$buttons =  $buttons . '<i title="Edit" role="button" data-id="' . $row->id . '" onclick=getBranch(this) class="fa-pencil pointer fa fs-22 py-2 mx-2  " type="button"></i>';

					$buttons =  $buttons . '<i role="button" title="Delete" data-id="' . $row->id . '" onclick=deleteBranch(this) class="fa-trash pointer fa fs-22 py-2 mx-2 text-danger" type="button"></i>';

					return $buttons;
				})
				->rawColumns(['Actions','select_checkbox'])
				->make(true);
		}
		$states = State::orderBy('name')->where('user_id',Auth::user()->id)->get();
		$cities = City::orderBy('name')->where('user_id',Auth::user()->id)->get();
		$areas = Areas::orderBy('name')->where('user_id',Auth::user()->id)->get();
		return view('admin.branches.index', compact('cities','areas','states'));
	}

	public function saveBranch(Request $request)
	{
		if (!empty($request->id) && $request->id != '') {
			$data = Branches::find($request->id);
			if (empty($data)) {
				$data =  new Branches();
			}
		} else {
			$data =  new Branches();
		}
		$data->user_id = Session::get('parent_id');
		$data->name = $request->name;
		$data->state_id = $request->state_id;
		$data->city_id = $request->city_id;
		$data->area_id = $request->area_id;
		$data->status = $request->status;
		$data->save();
	}


	public function getSpecificBranch(Request $request)
	{
		if (!empty($request->id)) {
			$data = Branches::where('id', $request->id)->first()->toArray();
			return json_encode($data);
		}
	}


	public function destroy(Request $request)
	{
		if (!empty($request->id)) {
			$data = Branches::where('id', $request->id)->delete();
		}
		if (!empty($request->allids) && isset(json_decode($request->allids)[0]) ) {
			$data = Branches::whereIn('id', json_decode($request->allids))->delete();
		}

	}
}
