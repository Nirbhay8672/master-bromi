<?php

namespace App\Http\Controllers\Superadmin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Api\Properties;
use App\Models\Enquiries;
use App\Models\Projects;
use App\Models\Units;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index(Request $request)
	{
		if ($request->ajax()) {
			$data = DB::table('land_units')->get();
			return DataTables::of($data)
			->editColumn('Actions', function ($row) {
				$buttons = '';

				$buttons =  $buttons . '<i role="button" title="Delete" data-id="' . $row->id . '" onclick=getUnit(this) class="fa-pencil pointer fa fs-22 py-2 mx-2 text-primary" type="button"></i>';

				$buttons =  $buttons . '<i role="button" title="Delete" data-id="' . $row->id . '" onclick=deleteUnit(this) class="fa-trash pointer fa fs-22 py-2 mx-2 text-danger" type="button"></i>';
				return $buttons;
			})
			->rawColumns(['Actions'])
			->make(true);
		}

		return view('superadmin.measurement_units.index');
	}

	public function getUnit(Request $request)
	{
		if (!empty($request->id)) {
			$unit = Units::find($request->id);
			return $unit;
		}
	}

	public function saveUnit(Request $request)
	{
		$unit = Units::find($request->id) ?? new Units();

		$unit->fill([
			'unit_name' => $request->name,
		])->save();
	}

	public function destroy(Request $request)
	{
		Units::where('id', $request->id)->delete();
	}
}
