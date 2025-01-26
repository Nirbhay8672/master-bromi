<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\MasterProperty\MasterProperty;
use App\Models\MasterProperty\PropertyCategory;
use App\Models\MasterProperty\PropertyConstructionType;
use App\Models\MasterProperty\PropertyForType;
use App\Models\MasterProperty\PropertyLandUnit;
use App\Models\MasterProperty\PropertySource;
use App\Models\Projects;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MasterPropertyController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.master_properties.index');
    }

    public function dataTable(Request $request)
    {
        $query = MasterProperty::query();

        $query->with([
            'project',
            'city',
            'propertyFor',
            'propertyConstructionType',
            'propertyCategory',
            'propertySubCategory',
        ]);
        
        $user = Auth::user();

        // check admin or sub user
        if($user->parent_id) {
            $query->where('user_id', $user->id);
        } else {
            $sub_users_ids = User::where('parent_id', $user->parent_id)->pluck('id')->toArray();
            array_push($sub_users_ids, $user->id);
        }

        // return datatable
        return DataTables::of($query->get())
            ->editColumn('project_name', function ($row) {
                return $row->project->project_name;
            })
            ->editColumn('information', function ($row) {
                return $row->propertyFor->name . " > " . $row->propertyConstructionType->name . " > " . $row->propertyCategory->name . " > " . $row->propertySubCategory->name;
            })
            ->editColumn('city_name', function ($row) {
                return $row->city->name;
            })
            ->editColumn('select_checkbox', function ($row) {
                $checkbox = '<div class="form-check checkbox checkbox-primary mb-0">
                    <input class="form-check-input table_checkbox" data-id="' . $row->id . '" name="select_row[]" id="checkbox-primary-' . $row->id . '" type="checkbox">
                    <label class="form-check-label" for="checkbox-primary-' . $row->id . '"></label>
                </div>';

                return $checkbox;
            })
            ->editColumn('Actions', function ($row) {
                $buttons = '<span class="text-danger">Next step</span>';

                return $buttons;
            })
            ->rawColumns(['Actions','select_checkbox'])
            ->make(true);
    }

    public function addForm()
    {
        $user = Auth::user();
        $is_admin = $user->parent_id ? false : true;
        $user_ids = [];

        if($is_admin) {
            $sub_users_ids = User::where('parent_id', $user->id)->pluck('id')->toArray();
            array_push($sub_users_ids, $user->id);
            $user_ids = $sub_users_ids;
        } else {
            $sub_users_ids = User::where('parent_id', $user->parent_id)->pluck('id')->toArray();
            array_push($sub_users_ids, $user->id);
            $user_ids = $sub_users_ids;
        }

        $property_for_type = PropertyForType::all();
        $property_construction_type = PropertyConstructionType::with(['category.subCategory'])->get();

        $cities = City::with(['localities'])->whereIn('user_id', $user_ids)->get();
        $projects = Projects::whereIn('user_id', $user_ids)->get();
        $land_units = PropertyLandUnit::all();
        $property_source = PropertySource::all();
        $country_codes = DB::table('countries')->get();

        return view('admin.master_properties.add_form')->with([
            'property_for_type' => $property_for_type,
            'property_construction_type' => $property_construction_type,
            'cities' => $cities,
            'projects' => $projects,
            'land_units' => $land_units,
            'property_source' => $property_source,
            'country_codes' => $country_codes,
        ]);
    }
}
