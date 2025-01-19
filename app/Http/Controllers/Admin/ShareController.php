<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Models\Areas;
use App\Models\DropdownSettings;
use App\Models\ShareProperty;
use App\Models\SharedProperty;
use App\Models\User;
use App\Models\UserNotifications;
use App\Traits\HelperFn;
use Illuminate\Http\Request;
use App\Models\LandUnit;
use App\Models\Projects;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class ShareController extends Controller
{
    use HelperFn;
    //
    // shared 4
    public function acceptRequest(Request $request)
    {
        if ($request->ajax()) {
            if (!empty($request->id)) {
                // $dataa = SharedProperty::find($request->id)->update(['accepted' => 1]);
                /* $dataa = DB::table('share_property')
                    ->where('id', $request->id)
                    ->update(['accepted' => 1]); */
                    // $sharedProp = SharedProperty::where('partner_id',$request->id);
                    // // dd("share",$sharedProp,$request->id);
                    // if ($sharedProp) {
                    //     $sharedProp->update(['accepted' => 1]);
                    //     return redirect()->route('admin.shared.properties');
                    // }
                // $sharedProp = SharedProperty::where('user_id',$request->id);
                $sharedProp = SharedProperty::with(['Partner', 'User'])->where('user_id',$request->id);
                $sharedProp->update(['accepted' => 1]);
                // $receiver = $sharedProp->Partner;
                // $sender = $sharedProp->User;
                $deleted_prop = SharedProperty::where('id', $request->id)->delete();
                return redirect()->route('admin.shared.properties');
                
		
                // // send notification to the sending user about the acceptance of the request.
                // $message = "$receiver->first_name $receiver->last_name has accepted your request regarding property share.";
                // try {
                //     UserNotifications::create([
                //         "user_id" => (int) $sender->id,
                //         "notification" => $message,
                //         "notification_type" => Constants::PROPERTY_REQUEST_ACCEPTED,
                //         'by_user' => (int) $receiver->id,
                //     ]);
                //     if (!empty($sender->onesignal_token)) {
                //         HelperFn::sendPushNotification($sender->onesignal_token, $message);
                //     } else {
                //         Log::error("Accept Property Share Request Error: ");
                //         Log::error("User id: $sender->id does not have onesignal token");
                //         Log::error("That's why notification not sent.");
                //     }

                //     $deleted_prop = SharedProperty::where('id', $request->id)->delete();
                // // return response()->json(['success' => true, 'deleted_partner' => $deleted_prop]);

                //     return redirect()->route('admin.shared.properties');
                // } catch (\Throwable $th) {
                //     // if notificaton creation failed.
                //     Log::error("On Accept property share request attempt failed by user Id: $receiver->id");
                //     Log::error("Error Message: $th->getMessage()");
                //     return redirect()->route('admin.shared.properties');
                // }
            }
        }
    }

    // shared 3
    public function cancelRequest(Request $request)
    {
        if ($request->ajax()) {
            if (!empty($request->id)) {
                // SharedProperty::find($request->id)->update(['accepted' => 2]);
                // $dlt_share_prop = SharedProperty::where('id', $request->id)->delete();
                // return json_encode($dlt_share_prop);
                $affectedRows = DB::table('share_property')
                    ->where('id', $request->id)
                    ->update(['accepted' => 2]);

                // $deletedRows = DB::table('share_property')
                //     ->where('id', $request->id)
                //     ->delete();

                return json_encode([
                    'updated_rows' => $affectedRows,
                ]);
            }
        }
    }


    // shared 1
    public function sharedPropertyRequests(Request $request)
    {
        // dd("shared-requests third party pending");
        if ($request->ajax()) {
            $data = DB::table('share_property')
                ->select([
                   'share_property.*',
                    'projects.*',
                    'properties.*',
                    'users.*',
                    DB::raw("CONCAT('<b>Name</b> :', users.first_name ,'  ',users.last_name,' <br> <b>Company</b> : ',users.company_name) AS user_name")
                ])
                ->join('properties', 'properties.id', 'share_property.property_id')
                ->join('projects', 'projects.id', 'properties.project_id')
                ->join('users', 'users.id', 'share_property.user_id')
                ->where('share_property.partner_id', Auth::user()->id)
                ->get();

            return DataTables::of($data)
            ->addColumn('project_name', function ($row) {
// dd("row->hot_property",$row->property_type);
                    $first =  '<td style="vertical-align:top">
                    <font size="3"><a href="" style="font-weight: bold;">' . (!empty($row->project_name) ? $row->project_name : "") . '</a>';

                $first_middle = '';
                // if (isset($row->Projects->is_prime) && $row->Projects->is_prime) {
                //     $first_middle = '<img style="height:24px" src="' . asset('assets/images/primeProperty.png') . '" alt="">';
                // }
                if ($row->hot_property) {
                    $first_middle = $first_middle . '<img style="height:24px" src="' . asset('assets/images/hotProperty.png') . '" alt="">';
                }
                $first_end = '</font>';
                $second = '<br>Locality: ' . ((!empty($row->Projects->Area->name)) ? $row->Projects->Area->name : 'Null') . '	</font>';
                $third = (!empty($row->location_link) ? '<br> <a href="' . $row->location_link . '" target="_blank"><i class="fa fa-map-marker fa-1x cursor-pointer color-code-popover" data-bs-trigger="hover focus">  check on map  </i></a>' : "");
                $last = '</td>';
                '</td>';
                return $first . $first_middle . $first_end .$second .$third . $last;

                return '';
                })
                ->addColumn('property_info', function ($shared) {
                    if (!empty($shared->user_name)) {
                        return $shared->user_name;
                        // return $shared->User->first_name . ' ' . $shared->User->last_name . ' | ' . $shared->User->company_name;
                    } else {
                        return 'N/A';
                    }
                })
                ->addColumn('user_name', function ($shared) {
                    if (!empty($shared->user_name)) {
                        return $shared->user_name;
                        // return $shared->User->first_name . ' ' . $shared->User->last_name . ' | ' . $shared->User->company_name;
                    } else {
                        return 'N/A';
                    }
                })

                ->editColumn('Action', function ($row) {
                    $buttons = '';
                    //  dd($row->id);
                    if (!$row->accepted) {
                        $buttons .=   ' <button data-id="' . $row->id . '" onclick=acceptRequest(this) class="btn btn-pill btn-danger" type="button">Accept</button>';
                    }
                    $buttons .=   ' <button data-id="' . $row->id . '" onclick=cancelRequest(this) class="btn btn-pill btn-primary" type="button">Cancel</button>';
                    return $buttons;
                })
                ->rawColumns(['project_name', 'property_info','user_name', 'Action'])
                ->make(true);
        }
        return view('admin.properties.shared_requets');
    }

    // shared 2
    public function sharedPropertyIndex(Request $request)
    {
        //   dd("shared-properties Me working done  ===>");
        if ($request->ajax()) {
            $dropdowns = DropdownSettings::get()->toArray();
            $land_units = LandUnit::all();
            $dropdownsarr = [];
            foreach ($dropdowns as $key => $value) {
                $dropdownsarr[$value['id']] = $value;
            }
            $dropdowns = $dropdownsarr;
            // $data = SharedProperty::with('Property_details', 'User')
            //     ->where('partner_id', Auth::user()->id)
            //     ->Where('accepted', '1')
            //     ->get();

            // $data2 = SharedProperty::with('Property_details', 'User')->where('user_id', Auth::user()->id)->get();

            // $data = DB::table('share_property')
            //     ->select('share_property.*', 'properties.constructed_salable_area as constructed_salable_area', 'users.first_name as first_name', 'properties.salable_plot_area as salable_plot_area', 'properties.salable_area as salable_area', 'properties.configuration as property_configuration', 'properties.unit_details as unit_details', 'users.office_number as office_number', 'users.mobile_number as mobile_number', 'users.last_name as last_name', 'projects.project_name', 'properties.remarks as remarks', 'properties.property_category as property_category', 'properties.property_for as property_for', 'properties.location_link as property_link', 'areas.name as area_name')
            //     ->leftJoin('properties', 'share_property.property_id', '=', 'properties.id')
            //     ->leftJoin('projects', 'properties.project_id', '=', 'projects.id')
            //     ->leftJoin('areas', 'projects.area_id', '=', 'areas.id')
            //     ->leftJoin('users', 'share_property.user_id', '=', 'users.id')
            //     ->where('share_property.partner_id', Auth::user()->id)
            //     ->where('share_property.accepted', 1)
            //     ->get();

            // $data2 = DB::table('share_property')
            //     ->select('share_property.*', 'properties.constructed_salable_area as constructed_salable_area', 'users.first_name as first_name', 'properties.salable_plot_area as salable_plot_area', 'properties.salable_area as salable_area', 'properties.unit_details as unit_details', 'properties.configuration as property_configuration', 'users.office_number as office_number', 'users.mobile_number as mobile_number', 'users.last_name as last_name', 'projects.project_name', 'properties.remarks as remarks', 'properties.property_category as property_category', 'properties.property_for as property_for', 'properties.location_link as property_link', 'areas.name as area_name')
            //     ->leftJoin('properties', 'share_property.property_id', '=', 'properties.id')
            //     ->leftJoin('projects', 'properties.project_id', '=', 'projects.id')
            //     ->leftJoin('areas', 'projects.area_id', '=', 'areas.id')
            //     ->leftJoin('users', 'share_property.user_id', '=', 'users.id')
            //     ->where('share_property.user_id', Auth::user()->id)
            //     ->get();
            // $mergedData = $data->concat($data2);
            $data = DB::table('share_property')
                ->select('share_property.*', 'properties.constructed_salable_area as constructed_salable_area', 'users.first_name as first_name', 'properties.salable_plot_area as salable_plot_area', 'properties.salable_area as salable_area', 'properties.configuration as property_configuration', 'properties.unit_details as unit_details', 'users.office_number as office_number', 'users.mobile_number as mobile_number', 'users.last_name as last_name', 'projects.project_name', 'properties.remarks as remarks', 'properties.property_category as property_category', 'properties.property_for as property_for', 'properties.location_link as property_link', 'areas.name as area_name')
                ->leftJoin('properties', 'share_property.property_id', '=', 'properties.id')
                ->leftJoin('projects', 'properties.project_id', '=', 'projects.id')
                ->leftJoin('areas', 'projects.area_id', '=', 'areas.id')
                ->leftJoin('users', 'share_property.user_id', '=', 'users.id')
                ->where('accepted','1')
                ->when($request->filter_property_for || empty(Auth::user()->property_for_id), function ($query) use ($request) {
                    return $query->where(function ($query) use ($request) {
                        $query->where('properties.property_for', $request->filter_property_for)
                            ->orWhere('properties.property_for', 'Both');
                    });
                })
                ->when($request->filter_property_type || empty(json_decode(Auth::user()->property_type_id)), function ($query) use ($request) {
                    $filterPropertyType = intval($request->filter_property_type); // Convert to integer
                    return $query->where('properties.property_type', $filterPropertyType);
                })
                ->when($request->filter_specific_type || empty(json_decode(Auth::user()->specific_properties)), function ($query) use ($request) {
                    return $query->where('properties.property_category', $request->filter_specific_type);
                })
                ->when($request->filter_configuration, function ($query) use ($request) {
                    return $query->where('properties.configuration', $request->filter_configuration);
                })
                ->when($request->filter_building_id, function ($query) use ($request) {
                    return $query->whereIn('properties.project_id', ($request->filter_building_id));
                })
                ->when($request->filter_area_id, function ($query) use ($request) {
                    return $query->whereIn('projects.area_id', $request->filter_area_id);
                })
                ->when($request->filter_furnished_status, function ($query) use ($request) {
                    return $query->where('properties.furnished_status', $request->filter_furnished_status);
                })
                ->when($request->filter_availability_status, function ($query) use ($request) {
                    return $query->where('properties.availability_status', $request->filter_availability_status);
                })
                ->when($request->filter_owner_is, function ($query) use ($request) {
                    return $query->where('properties.owner_is', $request->filter_owner_is);
                })
                ->when($request->filter_Property_priority, function ($query) use ($request) {
                    return $query->where('properties.Property_priority', $request->filter_Property_priority);
                })
                ->when(($request->filter_property_status || $request->filter_property_status == '0'), function ($query) use ($request) {
                    return $query->where('properties.status', $request->filter_property_status);
                })
                ->when($request->filter_from_date, function ($query) use ($request) {
                    return $query->whereDate('properties.created_at', '>=', $request->filter_from_date);
                })
                ->when($request->filter_to_date, function ($query) use ($request) {
                    return $query->whereDate('properties.created_at', '<=', $request->filter_to_date);
                })
                ->when($request->filter_is_terraced, function ($query) use ($request) {
                    return $query->where('properties.is_terrace', $request->filter_is_terraced);
                })
                ->when($request->filter_is_hot, function ($query) use ($request) {
                    return $query->where('properties.hot_property', $request->filter_is_hot);
                })
                ->when($request->filter_is_preleased, function ($query) use ($request) {
                    return $query->where('properties.is_pre_leased', $request->filter_is_preleased);
                })
                ->where('share_property.partner_id', Auth::user()->id)
                // ->where('share_property.accepted', 1)
                // ->where('properties.prop_status','=','1')
                ->get();

            $data2 = DB::table('share_property')
                ->select('share_property.*', 'properties.constructed_salable_area as constructed_salable_area', 'users.first_name as first_name', 'properties.salable_plot_area as salable_plot_area', 'properties.salable_area as salable_area', 'properties.unit_details as unit_details', 'properties.configuration as property_configuration', 'users.office_number as office_number', 'users.mobile_number as mobile_number', 'users.last_name as last_name', 'projects.project_name', 'properties.remarks as remarks', 'properties.property_category as property_category', 'properties.property_for as property_for', 'properties.location_link as property_link', 'areas.name as area_name')
                ->leftJoin('properties', 'share_property.property_id', '=', 'properties.id')
                ->leftJoin('projects', 'properties.project_id', '=', 'projects.id')
                ->leftJoin('areas', 'projects.area_id', '=', 'areas.id')
                ->leftJoin('users', 'share_property.user_id', '=', 'users.id')
                ->where('accepted','1')
                ->when($request->filter_property_for || empty(Auth::user()->property_for_id), function ($query) use ($request) {
                    return $query->where(function ($query) use ($request) {
                        $query->where('properties.property_for', $request->filter_property_for)
                            ->orWhere('properties.property_for', 'Both');
                    });
                })
                ->when($request->filter_property_type || empty(json_decode(Auth::user()->property_type_id)), function ($query) use ($request) {
                    $filterPropertyType = intval($request->filter_property_type); // Convert to integer
                    return $query->where('properties.property_type', $filterPropertyType);
                })
                ->when($request->filter_specific_type || empty(json_decode(Auth::user()->specific_properties)), function ($query) use ($request) {
                    return $query->where('properties.property_category', $request->filter_specific_type);
                })
                ->when($request->filter_configuration, function ($query) use ($request) {
                    return $query->where('properties.configuration', $request->filter_configuration);
                })
                ->when($request->filter_building_id, function ($query) use ($request) {
                    return $query->whereIn('properties.project_id', ($request->filter_building_id));
                })
                ->when($request->filter_area_id, function ($query) use ($request) {
                    return $query->whereIn('projects.area_id', $request->filter_area_id);
                })
                ->when($request->filter_furnished_status, function ($query) use ($request) {
                    return $query->where('properties.furnished_status', $request->filter_furnished_status);
                })
                ->when($request->filter_availability_status, function ($query) use ($request) {
                    return $query->where('properties.availability_status', $request->filter_availability_status);
                })
                ->when($request->filter_owner_is, function ($query) use ($request) {
                    return $query->where('properties.owner_is', $request->filter_owner_is);
                })
                ->when($request->filter_Property_priority, function ($query) use ($request) {
                    return $query->where('properties.Property_priority', $request->filter_Property_priority);
                })
                ->when(($request->filter_property_status || $request->filter_property_status == '0'), function ($query) use ($request) {
                    return $query->where('properties.status', $request->filter_property_status);
                })
                ->when($request->filter_from_date, function ($query) use ($request) {
                    return $query->whereDate('properties.created_at', '>=', $request->filter_from_date);
                })
                ->when($request->filter_to_date, function ($query) use ($request) {
                    return $query->whereDate('properties.created_at', '<=', $request->filter_to_date);
                })
                ->when($request->filter_is_terraced, function ($query) use ($request) {
                    return $query->where('properties.is_terrace', $request->filter_is_terraced);
                })
                ->when($request->filter_is_hot, function ($query) use ($request) {
                    return $query->where('properties.hot_property', $request->filter_is_hot);
                })
                ->when($request->filter_is_preleased, function ($query) use ($request) {
                    return $query->where('properties.is_pre_leased', $request->filter_is_preleased);
                })
                ->where('share_property.user_id', Auth::user()->id)
                ->get();
            $mergedData = $data->concat($data2);

            return DataTables::of($mergedData)
                ->editColumn('project_name', function ($row) use ($request) {
                    $first =  '<td style="vertical-align:top">
                         <font size="3"><a href="#" style="font-weight: bold;">' . ((isset($row->project_name)) ? $row->project_name : '') . '</a>';
                    $first_end = '</font>';
                    $second = '<br> <a href="' . $row->property_link . '" target="_blank"> <font size="2" style="font-style:italic">Locality: ' . ((!empty($row->area_name)) ? $row->area_name : '') . '	</font> </a>';
                    $third = (!empty($row->property_link) ? '<br> <a href="' . $row->property_link . '" target="_blank"><i class="fa fa-map-marker fa-1x cursor-pointer color-code-popover" data-bs-trigger="hover focus">  check on map  </i></a>' : "");
                    $last =     '</td>';

                    '</td>';
                    return $first . $first_end . $second  . $third . $last;

                    return '';
                })
                ->editColumn('super_builtup_area', function ($row) use ($dropdowns, $land_units) {
                    $new_array = array('', 'office space', 'Co-working', 'Ground floor', '1st floor', '2nd floor', '3rd floor', 'Warehouse', 'Cold Storage', 'ind. shed', 'Commercial Land', 'Agricultural/Farm Land', 'Industrial Land', '1 rk', '1bhk', '2bhk', '3bhk', '4bhk', '5bhk', '5+bhk', 'Test', 'testw', 'fgfgmf', 'sfbsbsfn', '252626', 'sh');
                    if ($row->property_for == 'Both') {
                        $forr = 'Rent & Sell';
                    } else {
                        $forr = $row->property_for;
                    }
                    $fstatus  = '';
                    $sub_cat = ((!empty($dropdowns[$row->property_category]['name'])) ? ' | ' . $dropdowns[$row->property_category]['name'] : '');
                    // dd("cc",$row->property_configuration);
                    if (!is_null($row->property_configuration)) {
                        $catId = (int)$row->property_configuration;
                        //$getsub_category = Helper::getsubcategory($catId);
                        $getsub_category = $new_array[$catId];

                        if (!is_null($getsub_category)) {
                            $sub_cat = ' | ' . $getsub_category;
                            if ($sub_cat == " | Agricultural/Farm Land") {
                                $sub_cat = " | Agricultural";
                            }
                        }
                    }
                    $category = $sub_cat;
                    if ($row->property_category == '256') {
                        $fstatus  = '';
                    } else {
                        $fstatus  = 'Unfurnished';
                        if (!empty($row->unit_details) && !empty(json_decode($row->unit_details)[0])) {
                            $vv = json_decode($row->unit_details);
                            if (isset($vv[0][8])) {
                                if (!empty($vv[0][8])) {
                                    if ($vv[0][8] == "106") {
                                        $fstatus = 'Furnished';
                                    } elseif ($vv[0][8] == "107") {
                                        $fstatus = 'Semi Furnished';
                                    } elseif ($vv[0][8] == "108") {
                                        $fstatus = 'Unfurnished';
                                    } else {
                                        $fstatus = 'Can Furnished';
                                    }
                                }
                            }
                        }
                    }

                    $salable_area_print = $this->generateAreaUnitDetails($row, $dropdowns[$row->property_category]['name'], $land_units);
                    if (empty($salable_area_print)) {
                        $salable_area_print = "Area Not Available";
                    }
                    try {
                        return '
                     <td style="vertical-align:top">
                        ' . ((!empty($forr)) ?  $forr : '')  . $category . '
                        <font size="2" style="font-style:italic">
                        <br>
                        ' . $salable_area_print . '
                        </font>
                        <br>' . $fstatus . '
                     </td>';
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                })
                // ->editColumn('owner_details', function ($row) {
                // 	$detail = '';
                // 	if (!empty($row->User)) {
                // 		$detail =  '<td align="center" style="vertical-align:top">
                // 			' . $row->User->first_name . ' ' . $row->User->last_name . ' <br>
                // 			<a href="tel:' .  $row->User->office_number . '">' . $row->User->mobile_number . '</a>
                // 			 </td>';
                // 	};
                // 	return $detail;
                // })
                ->editColumn('units', function ($row) {
                    $all_units = [];
                    if (!empty($row->unit_details) && !empty(json_decode($row->unit_details)[0])) {
                        $vv = json_decode($row->unit_details);
                        foreach ($vv as $key => $value) {
                            $price = '';
                            if (!empty($value['7'])) {
                                $price = $value['7'];
                            } else if (!empty($value['4'])) {
                                $price = $value['4'];
                            } else if (!empty($value['3'])) {
                                $price = $value['3'];
                            }
                            $data = [];
                            $data[0] = $value[0];
                            $data[1] = $value[1];
                            $data[2] = $price;
                            array_push($all_units, $data);
                        }
                    }
                    if (!empty($all_units)) {
                        $vvv = '';
                        foreach ($all_units as $key => $value) {
                            $vvv = $vvv .  ((!empty($value[0])) ? $value[0] . '<br>' : '') . ((!empty($value[1])) ? $value[1] : '');
                        }
                        return $vvv;
                    }

                    return "N/A";
                })
                ->editColumn('price', function ($row) {
                    //$all_units = [];
                    $all_units = [];
                    // dd(($row->Property_details->unit_details));
                    if (!empty($row->unit_details) && !empty(json_decode($row->unit_details)[0])) {
                        $vv = json_decode($row->unit_details);
                        foreach ($vv as $key => $value) {
                            $price = '';
                            if (!empty($value['7'])) {
                                $price = $value['7'];
                            } else if (!empty($value['4'])) {
                                $price = $value['4'];
                            } else if (!empty($value['3'])) {
                                $price = $value['3'];
                            }
                            $data = [];
                            $data[0] = $value[0];
                            $data[1] = $value[1];
                            $data[2] = $price;
                            array_push($all_units, $data);
                        }
                    }
                    if (!empty($all_units)) {
                        $vvv = "";
                        foreach ($all_units as $key => $value) {
                            if (count($all_units) > 1 && $key > 0) {
                                $vvv .= ' <br> ';
                            }
                            $vvv .= $value[2];
                        }
                        return nl2br($vvv);
                    }
                    return;
                })
                ->editColumn('contact_name', function ($row) {
                    $partner_id = $row->partner_id;
                    $auth_id = Auth::user()->id;
                    $detail = '';
                    if ($partner_id != $auth_id) {
                        // $partner_details = User::where('id', $partner_id)->first();
                        $partner_details = DB::table('users')
                            ->select('*')
                            ->where('id', $partner_id)
                            ->first();

                        if (!empty($partner_details)) {
                            $detail =  'Sended By <td align="center" style="vertical-align:top">
                             ' . $partner_details->first_name . ' ' . $partner_details->last_name . '<br>
                             <a href="tel:' .  $partner_details->office_number . '">' . $partner_details->mobile_number . '</a>
                              </td>';
                        }
                    } elseif ($partner_id == $auth_id) {
                        if (!empty($row->first_name)) {
                            $detail =  'Received By <td align="center" style="vertical-align:top">
                             ' . $row->first_name . ' ' . $row->last_name . '<br>
                             <a href="tel:' .  $row->office_number . '">' . $row->mobile_number . '</a>
                              </td>';
                        }
                    }
                    return $detail;
                })
                ->editColumn('remarks', function ($row) {
                    return $row->remarks;
                })
                ->addColumn('action', function($row){
                    return '
                        <i role="button" title="Delete" data-id="' . $row->id . '" onclick=deleteShareProperty(this) class="fs-22 py-2 mx-2 fa-trash pointer fa text-danger" type="button"></i>';
                })
                ->rawColumns(['action','project_name',  'super_builtup_area', 'contact_name', 'remarks', 'property_unit_no', 'units', 'price', 'owner_details'])
                ->make(true);
        }
        $property_configuration_settings = DropdownSettings::get()->toArray();
        $prop_type = [];
        foreach ($property_configuration_settings as $key => $value) {
            if (($value['name'] == 'Commercial' || $value['name'] == 'Residential') && str_contains($value['dropdown_for'], 'property_')) {
                array_push($prop_type, $value['id']);
            }
        }
        $areas = Areas::where('user_id', Auth::user()->id)->get();
        $projects = Projects::whereNotNull('project_name')->where('id', '!=', 261)->get();

        return view('admin.properties.shared_index', compact('property_configuration_settings', 'prop_type', 'projects', 'areas'));
    }

    public function generateAreaUnitDetails($row, $type, $land_units)
	{
		$area = '';
		$measure = '';
		if ($type == 'Office' || $type == 'Retail' || $type == 'Flat' || $type == 'Penthouse' || $type == 'Plot') {
			$area = explode('_-||-_', $row->salable_area)[0];
			$measure = explode('_-||-_', $row->salable_area)[1];
		} elseif ($type == 'Storage/industrial') {
			$area = explode('_-||-_', $row->salable_plot_area)[0];
			$constructed = explode('_-||-_', $row->constructed_salable_area)[0];
			$measure = explode('_-||-_', $row->salable_plot_area)[1];
			if (empty($salable)) {
				$salable = '';
			}
			$res = $area ? "P:" . $area : "";
			if ($res) {
				$constructed = $constructed ? " - C: " . $constructed : "";
			} else {
				$constructed = $constructed ? " C: " . $constructed : "";
			}
			$area = $res . $constructed;
		} elseif ($type == 'Vila/Bunglow') {
			$salable = explode('_-||-_', $row->salable_plot_area)[0];
			$constructed = explode('_-||-_', $row->constructed_salable_area)[0];
			$measure = explode('_-||-_', $row->constructed_salable_area)[1];
			if (empty($salable)) {
				$salable = '';
			}
			$res = $salable ? "P:" . $salable : "";
			if ($res) {
				$constructed = $constructed ? " - C: " . $constructed : "";
			} else {
				$constructed = $constructed ? " C: " . $constructed : "";
			}
			$area = $res . $constructed;
		} elseif ($type == 'Farmhouse') {
			$area = explode('_-||-_', $row->salable_plot_area)[0];
			$measure = explode('_-||-_', $row->salable_plot_area)[1];
		}
		$unit_name = '';
		foreach ($land_units as $unit) {
			if ($unit->id == $measure) {
				$unit_name = $unit->unit_name;
				break;
			}
		}

		if (!empty($area) && !empty($unit_name)) {
			$formattedArea = $area . ' ' . $unit_name;
			return $formattedArea;
		} else {
			return "Area Not Available";
		}
	}

    public function generateAreaDetails($row, $type, $dropdowns)
    {
        $area = '';
        $measure = '';

        if ($type == 'Office' || $type == 'Retail' || $type == 'Flat' || $type == 'Penthouse' || $type == 'Plot') {
            $area = explode('_-||-_', $row->salable_area)[0];
            $measure = explode('_-||-_', $row->salable_area)[1];
        } elseif ($type == 'Storage/industrial') {
            $area = explode('_-||-_', $row->salable_plot_area)[0];
            $measure = explode('_-||-_', $row->salable_plot_area)[1];
        } elseif ($type == 'Vila/Bunglow') {
            $salable = explode('_-||-_', $row->salable_plot_area)[0];
            $constructed = explode('_-||-_', $row->constructed_salable_area)[0];
            $measure = explode('_-||-_', $row->constructed_salable_area)[1];
            if (empty($salable)) {
                $salable = '';
            }
            // $area = "C:" . $constructed . ' ' . $dropdowns[$measure]['name'] . ' - P: ' . $salable;
            $area = "P:" . $salable . ' - C: ' . $constructed;
        } elseif ($type == 'Farmhouse') {
            $area = explode('_-||-_', $row->salable_plot_area)[0];
            $measure = explode('_-||-_', $row->salable_plot_area)[1];
        }

        if (!empty($area) && !empty($measure)) {
            $formattedArea = $area . ' ' . $dropdowns[$measure]['name'];
            return $formattedArea;
        } else {
            return "Area Not Available";
        }
    }


    public function destroyShareProp(Request $request)
    {
        // dd("request->id asd",$request->id);
        if (!empty($request->id)) {
			$dlt_partner = ShareProperty::where('id', $request->id)->delete();
			return json_encode($dlt_partner);
		}
      
    }
}
