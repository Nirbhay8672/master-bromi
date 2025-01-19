<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Imports\AreaImport;
use App\Imports\CityImport;
use App\Imports\DistrictImport;
use App\Imports\StateImport;
use App\Imports\TalukaImport;
use App\Imports\VillageImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function stateImport(Request $request)
    {	
        Excel::import(new StateImport,$request->file('csv_file'));
        return back();
    }

	public function cityImport(Request $request)
    {	
        Excel::import(new CityImport,$request->file('csv_file'));
        return back();
    }

    public function localityImport(Request $request)
    {	
        Excel::import(new AreaImport,$request->file('csv_file'));
        return back();
    }

    public function districtImport(Request $request)
    {	
        Excel::import(new DistrictImport,$request->file('csv_file'));
        return back();
    }

    public function talukaImport(Request $request)
    {	
        Excel::import(new TalukaImport,$request->file('csv_file'));
        return back();
    }

    public function villageImport(Request $request)
    {	
        Excel::import(new VillageImport,$request->file('csv_file'));
        return back();
    }
}
