<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MasterPropertyController extends Controller
{
    public function index(Request $request)
    {   
		return view('admin.master_properties.index');
    }

    public function dataTable(Request $request)
    {
        dd($request->all());               
    }
}