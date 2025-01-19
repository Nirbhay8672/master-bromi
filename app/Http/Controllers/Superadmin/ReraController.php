<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Rera;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReraController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Request $request)
	{
		if ($request->ajax()) {
			$data = Rera::get();
			return DataTables::of($data)
				->make(true);
		}
		return view('superadmin.rera.index');
	}
}
