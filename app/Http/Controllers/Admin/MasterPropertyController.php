<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterProperty\MasterProperty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            ->editColumn('select_checkbox', function ($row) {
                $checkbox = '<div class="form-check checkbox checkbox-primary mb-0">
                    <input class="form-check-input table_checkbox" data-id="' . $row->id . '" name="select_row[]" id="checkbox-primary-' . $row->id . '" type="checkbox">
                    <label class="form-check-label" for="checkbox-primary-' . $row->id . '"></label>
                </div>';

                return $checkbox;
            })
            ->editColumn('Actions', function ($row) {
                $buttons = '';

                $buttons += '<a href="{{ route(`admin.master_properties.addForm`) }}" class="btn custom-icon-theme-button tooltip-btn" data-tooltip="Edit Property"><i class="fa fa-pencil"></i></a>';
                
                return $buttons;
            })
            ->rawColumns(['Actions','select_checkbox'])
            ->make(true);
    }

    public function addForm()
    {
        dd(1);
    }
}
