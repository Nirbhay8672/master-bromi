<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Areas;
use App\Models\City;
use App\Models\District;
use App\Models\DropdownSettings;
use App\Models\Enquiries;
use App\Models\LandImages;
use App\Models\LandUnit;
use App\Models\Projects;
use App\Models\PropertyConstructionDocs;
use App\Models\Properties;
use App\Models\PropertyReport;
use App\Models\PropertyViewer;
use App\Models\QuickSiteVisit;
use App\Models\SharedProperty;
use App\Models\ShareProperty;
use App\Models\State;
use App\Models\Taluka;
use App\Models\User;
use App\Models\UserNotifications;
use App\Models\Village;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use PDF;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Rap2hpoutre\FastExcel\FastExcel;
use Yajra\DataTables\DataTables;
use ZipArchive;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
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
        
        // dd("indd");
        $sharedlk = '';
        $shareddata = '';
        if (!empty($request->shareproperty)) {
            $prop = Helper::theDecrypt($request->shareproperty);
            $sharedlk = $request->shareproperty;
            if (empty(Properties::find($prop))) {
                $shareddata = [];
                $sharedpr = Properties::with('Projects.Area')->withoutGlobalScopes()->find($prop);
                if (isset($sharedpr->property_for)) {
                    $shareddata['for'] = ($sharedpr->property_for == 'Both') ? 'Rent & Sell' : '';
                }
                if (!empty($sharedpr->building_id)) {
                    $sahred_project = Projects::withoutGlobalScopes()->find($sharedpr->building_id);
                    $shareddata['project_name'] = isset($sahred_project->project_name) ? $sahred_project->project_name : '';
                    if (!empty($sahred_project->area_id)) {
                        $shareddata['area'] = isset(Areas::withoutGlobalScopes()->find($sahred_project->area_id)->name) ? Areas::withoutGlobalScopes()->find($sahred_project->area_id)->name : '';
                    }
                    if (!empty($sharedpr->configuration)) {
                        $shareddata['config'] = isset(DropdownSettings::withoutGlobalScopes()->find($sharedpr->configuration)->name) ? DropdownSettings::withoutGlobalScopes()->find($sharedpr->configuration)->name : '';
                    }
                }
            }
        }
        if ($request->ajax()) {
            $dropdowns = DropdownSettings::get()->toArray();
            $land_units = LandUnit::all();

            $dropdownsarr = [];
            foreach ($dropdowns as $key => $value) {
                $dropdownsarr[$value['id']] = $value;
            }

            $enq = '';
            if (!empty($request->search_enq)) {
                $enq = Enquiries::find($request->search_enq);
            }
            $dropdowns = $dropdownsarr;
            $is_sub_admin = User::where('id', Auth::id())->whereNotNull('parent_id')->first();

            if ($is_sub_admin) {
                 // common part start
                 if (($is_sub_admin->property_type_id)) {
                    $propertyTypeIdArray = str_replace("'", '"', $is_sub_admin->property_type_id);
                    $propertyTypeIdArray = json_decode($propertyTypeIdArray, true);
                }
                if (($is_sub_admin->specific_properties)) {
                    $specificpropertieStr = str_replace("'", '"', $is_sub_admin->specific_properties);
                    $subcategoryArray = json_decode($specificpropertieStr, true);
                }

                $data = Properties::query();

                $data->select('properties.*')->with('Projects.Area')
                    ->join('projects', 'projects.id', '=', 'properties.project_id')
                    ->where('properties.property_category', '!=', '256')
                    ->where('properties.property_category', '!=', '261')
                    ->where('properties.property_category', '!=', '262');

                // common part end

                // filter part start

                if($request->filter_apply == 1) {

                    $userPropertyFor = $is_sub_admin->property_for_id; // 'rent', 'sell', 'both'
                    $userPropertyTypes = $propertyTypeIdArray; // e.g., ['commercial', 'residential'] or []

                    // Filter by property_for
                    if ($userPropertyFor) {
                        $data->where(function ($q) use ($userPropertyFor) {
                            if ($userPropertyFor === 'Rent') {
                                $q->where('property_for', 'Rent')->orWhere('property_for', 'Both');
                            } elseif ($userPropertyFor === 'Sell') {
                                $q->where('property_for', 'Sell')->orWhere('property_for', 'Both');
                            } elseif ($userPropertyFor === 'Both') {
                                $q->whereIn('property_for', ['Rent', 'Sell', 'Both']);
                            }
                        });
                    }
                
                    // Filter properties by `property_type` if not empty
                    if (!empty($userPropertyTypes)) {
                        $data->whereIn('properties.property_type', $userPropertyTypes);
                    }

                    // Filter properties by `property_category` if not empty
                    if (!empty($subcategoryArray)) {
                        $data->whereIn('properties.property_category', $subcategoryArray);
                    }

                    // Apply additional filters from user input (optional)
                    if ($request->filled('filter_property_for')) {
                        if ($request->input('filter_property_for') == 'Rent') {
                            $data->whereIn('properties.property_for', ['Rent', 'Both']);
                        } elseif ($request->input('filter_property_for') == 'Sell') {
                            $data->whereIn('properties.property_for', ['Sell', 'Both']);
                        }
                    }
                
                    if ($request->filled('filter_property_type')) {
                        $data->where('properties.property_type', $request->input('filter_property_type'));
                    }

                    if ($request->filled('filter_specific_type')) {
                        $data->where('properties.property_category', $request->input('filter_specific_type'));
                    }

                    if ($request->filled('filter_configuration')) {
                        $data->where('properties.configuration', $request->input('filter_configuration'));
                    }

                    if ($request->filled('filter_building_id') && count($request->input('filter_building_id')) > 0) {
                        $data->whereIn('properties.project_id', $request->input('filter_building_id'));
                    }

                    if ($request->filled('filter_Property_priority')) {
                        $data->where('properties.Property_priority', $request->input('filter_Property_priority'));
                    }
                    
                    if ($request->filled('filter_area_id')) {
                        $data->whereIn('projects.area_id', $request->input('filter_area_id'));
                    }

                    if ($request->filled('filter_availability_status')) {
                        $data->where('properties.availability_status', $request->input('filter_availability_status'));
                    }
                    
                    if ($request->filled('filter_owner_is')) {
                        $data->where('properties.owner_is', $request->input('filter_owner_is'));
                    }

                    if ($request->filled('filter_property_status')) {
                        $data->where('properties.status', $request->input('filter_property_status'));
                    }
                    if ($request->filled('filter_from_date')) {
                        $data->whereDate('properties.created_at', '>=', $request->input('filter_from_date'));
                    }
                    if ($request->filled('filter_to_date')) {
                        $data->where('properties.created_at','<=', $request->input('filter_to_date'));
                    }

                    if ($request->filled('filter_is_terraced')) {
                        $data->where('properties.is_terrace', $request->input('filter_is_terraced'));
                    }

                    if ($request->filled('filter_is_weekend')) {
                        $data->where('properties.week_end_villa', $request->input('filter_is_weekend'));
                    }
                    
                    if ($request->filled('filter_is_hot')) {
                        $data->where('properties.hot_property', $request->input('filter_is_hot'));
                    }

                } else {
                    if ($is_sub_admin->property_for_id) {
                        if($is_sub_admin->property_for_id != 'Both') {
                            if($is_sub_admin->property_for_id == 'Sell') {
                                $data->whereIn('properties.property_for', ['Sell', 'Both']);
                            }
                            if($is_sub_admin->property_for_id == 'Rent') {
                                $data->whereIn('properties.property_for', ['Rent', 'Both']);
                            }
                        } else {
                            $data->whereIn('properties.property_for', ['Rent', 'Both' , 'Sell']);
                        }
                    } else {
                        $data->whereIn('properties.property_for', ['Rent', 'Both' , 'Sell']);
                    }

                    if (count($propertyTypeIdArray) > 0) {
                        $data->whereIn('properties.property_type', $propertyTypeIdArray);
                    } else {
                        $data->whereIn('properties.property_type', ["85", "87"]);
                    }
                    
                    
                    $data->when(!empty($request->search_enq), function ($query) use ($request, $enq) {
                        if (!empty($enq)) {
                            // property for
                            if ($request->match_enquiry_for) {
                                $property_for = ($enq->enquiry_for == 'Buy') ? 'Sell' : $enq->enquiry_for;
                                // dd("match_enquiry_for", $enq->enquiry_for, "..", $property_for);
                                // dd($request->all(), $enq);
                                if ($property_for === 'Rent') {
                                    $query->whereIn('properties.property_for', ['Rent', 'Both']);
                                }
                                if ($property_for === 'Sell') {
                                    $query->whereIn('properties.property_for', ['Sell', 'Both']);
                                }
                            }
                            //requirement ytpe
                            if ($request->match_property_type && !empty($enq->requirement_type)) {
                                // dd("match_property_type", $enq->requirement_type, "..", $request->match_property_type);
                                $query->where('properties.property_type', $enq->requirement_type);
                            }
                            //property category
                            if ($request->match_specific_type && !empty($enq->property_type)) {
                                // dd("match_specific_type", $enq->property_type, "..", $request->match_specific_type);
                                $query->where('properties.property_category', $enq->property_type);
                            }

                            if ($request->match_specific_sub_type && !empty($enq->configuration)) {
                                $configurations = json_decode($enq->configuration, true);
                                if (is_array($configurations)) {
                                    $query->whereIn('properties.configuration', $configurations);
                                }
                            }
                            if ($request->match_enquiry_weekend && ($enq->weekend_enq == '1')) {
                                // dd("asdads",$enq->weekend_enq);
                                // $query->where('properties.week_end_villa', $enq->weekend_enq);
                                $query->where('properties.week_end_villa', $enq->weekend_enq);
                            }
                            
                            // Property price & unit_price
                            if ($request->match_budget_from_type) {
                                $budgetFrom = str_replace(',', '', $enq->budget_from);
                                $budgetTo = str_replace(',', '', $enq->budget_to);
                                $rentPrice = str_replace(',', '', $enq->rent_price);
                                $sellPrice = str_replace(',', '', $enq->sell_price);

                                if ($budgetFrom !== "" && $budgetTo !== "" && $enq->enquiry_for !== "Both") {
                                    $query->where(function ($query) use ($budgetFrom, $budgetTo, $enq) {
                                        $query->where(function ($query) use ($budgetFrom, $budgetTo) {
                                            $query->where('properties.survey_price', '>=', $budgetFrom)
                                                ->where('properties.survey_price', '<=', $budgetTo);
                                        })->orWhere(function ($query) use ($budgetFrom, $budgetTo, $enq) {
                                            // Rent type properties
                                            if ($enq->enquiry_for == 'Rent') {
                                                $query->where(function ($query) use ($budgetFrom, $budgetTo) {
                                                    for ($i = 0; $i < 2; $i++) { // assuming maximum 2 arrays to check
                                                        $query->orWhereRaw('CAST(REPLACE(REPLACE(JSON_EXTRACT(properties.unit_details, "$[' . $i . '][4]"), ",", ""), "\"", "") AS UNSIGNED) >= ?', $budgetFrom)
                                                            ->whereRaw('CAST(REPLACE(REPLACE(JSON_EXTRACT(properties.unit_details, "$[' . $i . '][4]"), ",", ""), "\"", "") AS UNSIGNED) <= ?', $budgetTo);
                                                    }
                                                });
                                            }
                                        })->orWhere(function ($query) use ($budgetFrom, $budgetTo, $enq) {
                                            if ($enq->enquiry_for == 'Buy') {
                                                $query->where(function ($query) use ($budgetFrom, $budgetTo) {
                                                    for ($i = 0; $i < 2; $i++) {
                                                        $query->orWhereRaw('CAST(REPLACE(REPLACE(JSON_EXTRACT(properties.unit_details, "$[' . $i . '][3]"), ",", ""), "\"", "") AS UNSIGNED) >= ?', $budgetFrom)
                                                            ->whereRaw('CAST(REPLACE(REPLACE(JSON_EXTRACT(properties.unit_details, "$[' . $i . '][3]"), ",", ""), "\"", "") AS UNSIGNED) <= ?', $budgetTo);
                                                    }
                                                });
                                            }
                                        })->orWhere(function ($query) use ($budgetFrom, $budgetTo) {
                                            $query->where(function ($query) use ($budgetFrom, $budgetTo) {
                                                for ($i = 0; $i < 2; $i++) {
                                                    $query->orWhereRaw('CAST(REPLACE(REPLACE(JSON_EXTRACT(properties.unit_details, "$[' . $i . '][7]"), ",", ""), "\"", "") AS UNSIGNED) >= ?', $budgetFrom)
                                                        ->whereRaw('CAST(REPLACE(REPLACE(JSON_EXTRACT(properties.unit_details, "$[' . $i . '][7]"), ",", ""), "\"", "") AS UNSIGNED) <= ?', $budgetTo);
                                                }
                                            });
                                        });
                                    });
                                } else {
                                    $query->where(function ($query) use ($rentPrice, $sellPrice) {
                                        $query->where('properties.survey_price', '>=', $rentPrice)
                                            ->where('properties.survey_price', '<=', $sellPrice);
                                    });
                                }
                            }

                            // size
                            if ($request->match_enquiry_size) {
                                // dd("request->match_enquiry_size",$request->match_enquiry_size,"enq->area_from,enq->area_to",$enq->area_from, $enq->area_to,"Measure",$enq->area_from_measurement,"enq->property_type",$enq->property_type);
                                // $query->where(function ($query) use ($enq) {
                                //     $query->whereRaw("SUBSTRING_INDEX(properties.salable_area, '_-||-_', 1) BETWEEN ? AND ?", [$enq->area_from, $enq->area_to])
                                //         ->orWhereRaw("SUBSTRING_INDEX(properties.constructed_salable_area, '_-||-_', 1) BETWEEN ? AND ?", [$enq->area_from, $enq->area_to])
                                //         ->orWhereRaw("SUBSTRING_INDEX(properties.survey_plot_size, '_-||-_', 1) BETWEEN ? AND ?", [$enq->area_from, $enq->area_to]);
                                // });

                                $query->where(function ($query) use ($enq) {
                                    if ($enq->property_type !== '259' && $enq->property_type !== '260' && $enq->property_type !== '254') {
                                        // dd("inn");
                                        $query->whereRaw("SUBSTRING_INDEX(properties.salable_area, '_-||-_', 1) BETWEEN ? AND ?", [$enq->area_from, $enq->area_to])
                                            ->whereRaw("SUBSTRING_INDEX(properties.salable_area, '_-||-_', -1) = ?", [$enq->area_from_measurement])
                                            ->orWhereRaw("SUBSTRING_INDEX(properties.salable_plot_area, '_-||-_', 1) BETWEEN ? AND ?", [$enq->area_from, $enq->area_to])
                                            ->whereRaw("SUBSTRING_INDEX(properties.salable_plot_area, '_-||-_', -1) = ?", [$enq->area_from_measurement])
                                            // ->orWhereRaw("SUBSTRING_INDEX(properties.constructed_salable_area, '_-||-_', 1) BETWEEN ? AND ?", [$enq->area_from, $enq->area_to])
                                            // ->whereRaw("SUBSTRING_INDEX(properties.constructed_salable_area, '_-||-_', -1) = ?", [$enq->area_from_measurement])
                                            ->orWhereRaw("SUBSTRING_INDEX(properties.survey_plot_size, '_-||-_', 1) BETWEEN ? AND ?", [$enq->area_from, $enq->area_to])
                                            ->whereRaw("SUBSTRING_INDEX(properties.survey_plot_size, '_-||-_', -1) = ?", [$enq->area_from_measurement]);
                                    } else {
                                        $area_from_int = (int) $enq->area_from;
                                        $area_to_int = (int) $enq->area_to;
                                        // dd("out",$area_from_int,$area_to_int);
                                        $query->whereRaw("SUBSTRING_INDEX(properties.salable_area, '_-||-_', 1) BETWEEN ? AND ?", [$area_from_int, $area_to_int])
                                            ->whereRaw("SUBSTRING_INDEX(properties.salable_area, '_-||-_', -1) = ?", [$enq->area_from_measurement])
                                            ->orWhereRaw("SUBSTRING_INDEX(properties.salable_plot_area, '_-||-_', 1) BETWEEN ? AND ?", [$enq->area_from, $enq->area_to])
                                            ->whereRaw("SUBSTRING_INDEX(properties.salable_plot_area, '_-||-_', -1) = ?", [$enq->area_from_measurement])
                                            // ->orWhereRaw("SUBSTRING_INDEX(properties.constructed_salable_area, '_-||-_', 1) BETWEEN ? AND ?", [$enq->area_from_int, $enq->area_to_int])
                                            // ->whereRaw("SUBSTRING_INDEX(properties.constructed_salable_area, '_-||-_', -1) = ?", [$enq->area_from_measurement])
                                            ->orWhereRaw("SUBSTRING_INDEX(properties.survey_plot_size, '_-||-_', 1) BETWEEN ? AND ?", [$enq->area_from_int, $enq->area_to_int])
                                            ->whereRaw("SUBSTRING_INDEX(properties.survey_plot_size, '_-||-_', -1) = ?", [$enq->area_from_measurement]);
                                    }
                                });
                            }
                        }
                    });
                }

                $data->where('prop_status', 1);

                $data->orderByRaw('CASE
                    WHEN properties.prop_status = 1 THEN 1
                    ELSE 2
                    END,  properties.id DESC');
            } else {
                $data = Properties::select('properties.*')->with('Projects.Area')
                    ->join('projects', 'projects.id', '=', 'properties.project_id')
                    ->where('properties.property_category', '!=', '256')
                    ->where('properties.property_category', '!=', '261')
                    ->where('properties.property_category', '!=', '262')
                    ->when($request->filter_by, function ($query) use ($request) {
                        if ($request->filter_by == 'reminder') {
                            return $query->whereDate('properties.created_at', '>=', Carbon::now()->subDays(7)->format('Y-m-d'))
                                ->where('properties.prop_status', 1);
                        } elseif ($request->filter_by == 'favourite') {
                            return $query->where('is_favourite', 1)
                                ->where('properties.prop_status', 1);
                        } elseif ($request->filter_by == 'new') {
                            return $query->whereDate('properties.created_at', '>=', Carbon::now()->subDays(30)->format('Y-m-d'))
                                ->where('properties.prop_status', 1);
                        }
                    })
                    ->when($request->filter_property_for || empty(Auth::user()->property_for_id), function ($query) use ($request) {
                        return $query->where(function ($query) use ($request) {
                            $query->where('properties.property_for', $request->filter_property_for)->orWhere('property_for', 'Both');
                        })->where('properties.prop_status', 1);
                    })
                    ->when($request->filter_property_type || empty(json_decode(Auth::user()->property_type_id)), function ($query) use ($request) {
                        $filterPropertyType = intval($request->filter_property_type); // Convert to integer
                        return $query->where('properties.property_type', $filterPropertyType)
                            ->where('properties.prop_status', 1);
                    })
                    ->when($request->filter_specific_type || empty(json_decode(Auth::user()->specific_properties)), function ($query) use ($request) {
                        return $query->where('properties.property_category', $request->filter_specific_type)
                            ->where('properties.prop_status', 1);
                    })
                    ->when($request->filter_configuration, function ($query) use ($request) {
                        return $query->where('properties.configuration', $request->filter_configuration)
                            ->where('properties.prop_status', 1);
                    })
                    ->when($request->filter_building_id, function ($query) use ($request) {
                        return $query->whereIn('properties.project_id', ($request->filter_building_id))
                            ->where('properties.prop_status', 1);
                    })
                    ->when($request->filter_area_id, function ($query) use ($request) {

                        return $query->whereIn('projects.area_id', $request->filter_area_id)
                            ->where('properties.prop_status', 1);
                    })
                    ->when($request->filter_furnished_status, function ($query) use ($request) {
                        return $query->where('furnished_status', $request->filter_furnished_status)
                            ->where('properties.prop_status', 1);
                    })
                    ->when($request->filter_availability_status, function ($query) use ($request) {
                        return $query->where('properties.availability_status', $request->filter_availability_status)
                            ->where('properties.prop_status', 1);
                    })
                    ->when($request->filter_owner_is, function ($query) use ($request) {
                        return $query->where('owner_is', $request->filter_owner_is)
                            ->where('properties.prop_status', 1);
                    })
                    ->when($request->filter_Property_priority, function ($query) use ($request) {
                        return $query->where('Property_priority', $request->filter_Property_priority)
                            ->where('properties.prop_status', 1);
                    })
                    ->when(($request->filter_property_status || $request->filter_property_status == '0'), function ($query) use ($request) {
                        return $query->where('properties.status', $request->filter_property_status)
                            ->where('properties.prop_status', 1);
                    })
                    ->when($request->filter_from_date, function ($query) use ($request) {
                        return $query->whereDate('properties.created_at', '>=', $request->filter_from_date)
                            ->where('properties.prop_status', 1);
                    })
                    ->when($request->filter_to_date, function ($query) use ($request) {
                        return $query->whereDate('properties.created_at', '<=', $request->filter_to_date)
                            ->where('properties.prop_status', 1);
                    })
                    ->when($request->filter_is_terraced, function ($query) use ($request) {
                        return $query->where('properties.is_terrace', $request->filter_is_terraced)
                            ->where('properties.prop_status', 1);
                    })
                    ->when($request->filter_is_weekend, function ($query) use ($request) {
                        // dd("week end",$request->filter_is_weekend);
                        return $query->where('properties.week_end_villa', $request->filter_is_weekend)
                            ->where('properties.prop_status', 1);
                    })
                    ->when($request->filter_is_hot, function ($query) use ($request) {
                        return $query->where('hot_property', $request->filter_is_hot)
                            ->where('properties.prop_status', 1);
                    })
                    ->when($request->filter_is_preleased, function ($query) use ($request) {
                        return $query->where('is_pre_leased', $request->filter_is_preleased)
                            ->where('properties.prop_status', 1);
                    })
                    ->when(!empty($request->search_enq), function ($query) use ($request, $enq) {
                        if (!empty($enq)) {
                            // property for
                            if ($request->match_enquiry_for) {
                                $property_for = ($enq->enquiry_for == 'Buy') ? 'Sell' : $enq->enquiry_for;
                                // dd("match_enquiry_for", $enq->enquiry_for, "..", $property_for);
                                // dd($request->all(), $enq);
                                if ($property_for === 'Rent') {
                                    $query->whereIn('properties.property_for', ['Rent', 'Both']);
                                }
                                if ($property_for === 'Sell') {
                                    $query->whereIn('properties.property_for', ['Sell', 'Both']);
                                }
                            }
                            //requirement ytpe
                            if ($request->match_property_type && !empty($enq->requirement_type)) {
                                // dd("match_property_type", $enq->requirement_type, "..", $request->match_property_type);
                                $query->where('properties.property_type', $enq->requirement_type);
                            }
                            //property category
                            if ($request->match_specific_type && !empty($enq->property_type)) {
                                // dd("match_specific_type", $enq->property_type, "..", $request->match_specific_type);
                                $query->where('properties.property_category', $enq->property_type);
                            }

                            if ($request->match_specific_sub_type && !empty($enq->configuration)) {
                                $configurations = json_decode($enq->configuration, true);
                                if (is_array($configurations)) {
                                    $query->whereIn('properties.configuration', $configurations);
                                }
                            }
                            if ($request->match_enquiry_weekend && ($enq->weekend_enq == '1')) {
                                // dd("asdads",$enq->weekend_enq);
                                // $query->where('properties.week_end_villa', $enq->weekend_enq);
                                $query->where('properties.week_end_villa', $enq->weekend_enq);
                            }
                            
                            // Property price & unit_price
                            if ($request->match_budget_from_type) {
                                $budgetFrom = str_replace(',', '', $enq->budget_from);
                                $budgetTo = str_replace(',', '', $enq->budget_to);
                                $rentPrice = str_replace(',', '', $enq->rent_price);
                                $sellPrice = str_replace(',', '', $enq->sell_price);

                                if ($budgetFrom !== "" && $budgetTo !== "" && $enq->enquiry_for !== "Both") {
                                    $query->where(function ($query) use ($budgetFrom, $budgetTo, $enq) {
                                        $query->where(function ($query) use ($budgetFrom, $budgetTo) {
                                            $query->where('properties.survey_price', '>=', $budgetFrom)
                                                ->where('properties.survey_price', '<=', $budgetTo);
                                        })->orWhere(function ($query) use ($budgetFrom, $budgetTo, $enq) {
                                            // Rent type properties
                                            if ($enq->enquiry_for == 'Rent') {
                                                $query->where(function ($query) use ($budgetFrom, $budgetTo) {
                                                    for ($i = 0; $i < 2; $i++) { // assuming maximum 2 arrays to check
                                                        $query->orWhereRaw('CAST(REPLACE(REPLACE(JSON_EXTRACT(properties.unit_details, "$[' . $i . '][4]"), ",", ""), "\"", "") AS UNSIGNED) >= ?', $budgetFrom)
                                                            ->whereRaw('CAST(REPLACE(REPLACE(JSON_EXTRACT(properties.unit_details, "$[' . $i . '][4]"), ",", ""), "\"", "") AS UNSIGNED) <= ?', $budgetTo);
                                                    }
                                                });
                                            }
                                        })->orWhere(function ($query) use ($budgetFrom, $budgetTo, $enq) {
                                            if ($enq->enquiry_for == 'Buy') {
                                                $query->where(function ($query) use ($budgetFrom, $budgetTo) {
                                                    for ($i = 0; $i < 2; $i++) {
                                                        $query->orWhereRaw('CAST(REPLACE(REPLACE(JSON_EXTRACT(properties.unit_details, "$[' . $i . '][3]"), ",", ""), "\"", "") AS UNSIGNED) >= ?', $budgetFrom)
                                                            ->whereRaw('CAST(REPLACE(REPLACE(JSON_EXTRACT(properties.unit_details, "$[' . $i . '][3]"), ",", ""), "\"", "") AS UNSIGNED) <= ?', $budgetTo);
                                                    }
                                                });
                                            }
                                        })->orWhere(function ($query) use ($budgetFrom, $budgetTo) {
                                            $query->where(function ($query) use ($budgetFrom, $budgetTo) {
                                                for ($i = 0; $i < 2; $i++) {
                                                    $query->orWhereRaw('CAST(REPLACE(REPLACE(JSON_EXTRACT(properties.unit_details, "$[' . $i . '][7]"), ",", ""), "\"", "") AS UNSIGNED) >= ?', $budgetFrom)
                                                        ->whereRaw('CAST(REPLACE(REPLACE(JSON_EXTRACT(properties.unit_details, "$[' . $i . '][7]"), ",", ""), "\"", "") AS UNSIGNED) <= ?', $budgetTo);
                                                }
                                            });
                                        });
                                    });
                                } else {
                                    $query->where(function ($query) use ($rentPrice, $sellPrice) {
                                        $query->where('properties.survey_price', '>=', $rentPrice)
                                            ->where('properties.survey_price', '<=', $sellPrice);
                                    });
                                }
                            }

                            // size
                            if ($request->match_enquiry_size) {
                                // dd("request->match_enquiry_size",$request->match_enquiry_size,"enq->area_from,enq->area_to",$enq->area_from, $enq->area_to,"Measure",$enq->area_from_measurement,"enq->property_type",$enq->property_type);
                                // $query->where(function ($query) use ($enq) {
                                //     $query->whereRaw("SUBSTRING_INDEX(properties.salable_area, '_-||-_', 1) BETWEEN ? AND ?", [$enq->area_from, $enq->area_to])
                                //         ->orWhereRaw("SUBSTRING_INDEX(properties.constructed_salable_area, '_-||-_', 1) BETWEEN ? AND ?", [$enq->area_from, $enq->area_to])
                                //         ->orWhereRaw("SUBSTRING_INDEX(properties.survey_plot_size, '_-||-_', 1) BETWEEN ? AND ?", [$enq->area_from, $enq->area_to]);
                                // });

                                $query->where(function ($query) use ($enq) {
                                    if ($enq->property_type !== '259' && $enq->property_type !== '260' && $enq->property_type !== '254') {
                                        // dd("inn");
                                        $query->whereRaw("SUBSTRING_INDEX(properties.salable_area, '_-||-_', 1) BETWEEN ? AND ?", [$enq->area_from, $enq->area_to])
                                            ->whereRaw("SUBSTRING_INDEX(properties.salable_area, '_-||-_', -1) = ?", [$enq->area_from_measurement])
                                            ->orWhereRaw("SUBSTRING_INDEX(properties.salable_plot_area, '_-||-_', 1) BETWEEN ? AND ?", [$enq->area_from, $enq->area_to])
                                            ->whereRaw("SUBSTRING_INDEX(properties.salable_plot_area, '_-||-_', -1) = ?", [$enq->area_from_measurement])
                                            // ->orWhereRaw("SUBSTRING_INDEX(properties.constructed_salable_area, '_-||-_', 1) BETWEEN ? AND ?", [$enq->area_from, $enq->area_to])
                                            // ->whereRaw("SUBSTRING_INDEX(properties.constructed_salable_area, '_-||-_', -1) = ?", [$enq->area_from_measurement])
                                            ->orWhereRaw("SUBSTRING_INDEX(properties.survey_plot_size, '_-||-_', 1) BETWEEN ? AND ?", [$enq->area_from, $enq->area_to])
                                            ->whereRaw("SUBSTRING_INDEX(properties.survey_plot_size, '_-||-_', -1) = ?", [$enq->area_from_measurement]);
                                    } else {
                                        $area_from_int = (int) $enq->area_from;
                                        $area_to_int = (int) $enq->area_to;
                                        // dd("out",$area_from_int,$area_to_int);
                                        $query->whereRaw("SUBSTRING_INDEX(properties.salable_area, '_-||-_', 1) BETWEEN ? AND ?", [$area_from_int, $area_to_int])
                                            ->whereRaw("SUBSTRING_INDEX(properties.salable_area, '_-||-_', -1) = ?", [$enq->area_from_measurement])
                                            ->orWhereRaw("SUBSTRING_INDEX(properties.salable_plot_area, '_-||-_', 1) BETWEEN ? AND ?", [$enq->area_from, $enq->area_to])
                                            ->whereRaw("SUBSTRING_INDEX(properties.salable_plot_area, '_-||-_', -1) = ?", [$enq->area_from_measurement])
                                            // ->orWhereRaw("SUBSTRING_INDEX(properties.constructed_salable_area, '_-||-_', 1) BETWEEN ? AND ?", [$enq->area_from_int, $enq->area_to_int])
                                            // ->whereRaw("SUBSTRING_INDEX(properties.constructed_salable_area, '_-||-_', -1) = ?", [$enq->area_from_measurement])
                                            ->orWhereRaw("SUBSTRING_INDEX(properties.survey_plot_size, '_-||-_', 1) BETWEEN ? AND ?", [$enq->area_from_int, $enq->area_to_int])
                                            ->whereRaw("SUBSTRING_INDEX(properties.survey_plot_size, '_-||-_', -1) = ?", [$enq->area_from_measurement]);
                                    }
                                });
                            }

                            // if ($request->match_building && !empty(json_decode($enq->building_id)[0])) {
                            //     return $query->whereIn('properties.project_id', json_decode($enq->building_id));
                            // }

                            // if ($request->match_inquiry_source && !empty($enq->enquiry_source)) {
                            //     $query->where('properties.source_of_property', $enq->enquiry_source);
                            // }
                        }
                    })
                    // ->where('prop_status', 1)
                    ->orderByRaw('CASE
				WHEN properties.prop_status = 1 THEN 1
				ELSE 2
				END,  properties.id DESC');
                // dd("data 22",$data);
            }
            $parts = explode('?', $request->location);

            if (count($parts) > 1) {
                $value = $parts[1];
                $value = trim($value);

                if (strpos($value, 'data_id') !== false) {
                    $value_part = explode('=', $value);
                    if ($value_part[1] > 0) {
                        $data->where('properties.id', $value_part[1]);
                    }
                }
            }
            $data = $data->get()->filter(function ($value) use ($request) {
                $theArea = 0;

                if (!empty($value->salable_area)) {
                    $theArea = explode('_-||-_', $value->salable_area)[0];
                } elseif (!empty($value->salable_plot_area)) {
                    $theArea = explode('_-||-_', $value->salable_plot_area);
                }

                if (!empty($request->filter_from_area) && !($theArea >= $request->filter_from_area)) {
                    return false;
                }

                if (!empty($request->filter_to_area) && !($theArea <= $request->filter_to_area)) {
                    return false;
                }

                $allPrices = [];

                if (!empty($value->unit_details) && !empty(json_decode($value->unit_details)[0])) {
                    foreach (json_decode($value->unit_details) as $key3 => $value3) {
                        if (!empty($value3['7'])) {
                            $allPrices[] = $value3['7'];
                        }
                        if (!empty($value3['4'])) {
                            $allPrices[] = $value3['4'];
                        }
                        if (!empty($value3['3'])) {
                            $allPrices[] = $value3['3'];
                        }
                    }
                }

                if (!empty($request->filter_from_price)) {
                    $from_passed = false;
                    foreach ($allPrices as $key5 => $value5) {
                        if ((Helper::c_to_n($value5) >= Helper::c_to_n($request->filter_from_price))) {
                            $from_passed = true;
                            break;
                        }
                    }
                    if (!$from_passed) {
                        return false;
                    }
                }

                if (!empty($request->filter_to_price)) {
                    $to_passed = false;
                    foreach ($allPrices as $key6 => $value6) {
                        if ((Helper::c_to_n($value6) <= Helper::c_to_n($request->filter_to_price))) {
                            $to_passed = true;
                            break;
                        }
                    }
                    if (!$to_passed) {
                        return false;
                    }
                }

                return true;
            });
            // foreach ($data->get() as $key => $value) {
            //     $theArea = 0;
            //     if (!empty($value->salable_area)) {
            //         $theArea = explode('_-||-_', $value->salable_area)[0];
            //     } elseif (!empty($value->salable_plot_area)) {
            //         $theArea = explode('_-||-_', $value->salable_plot_area);
            //     }
            //     if ((!empty($request->filter_from_area) && !($theArea >= $request->filter_from_area))) {
            //         unset($data[$key]);
            //         continue;
            //     }
            //     if (!empty($request->filter_to_area) && !($theArea <= $request->filter_to_area)) {
            //         unset($data[$key]);
            //         continue;
            //     }
            //     $allPrices = [];

            //     if (!empty($value->unit_details) && !empty(json_decode($value->unit_details)[0])) {
            //         foreach (json_decode($value->unit_details) as $key3 => $value3) {
            //             if (!empty($value3['7'])) {
            //                 array_push($allPrices, $value3['7']);
            //             }
            //             if (!empty($value3['4'])) {
            //                 array_push($allPrices, $value3['4']);
            //             }
            //             if (!empty($value3['3'])) {
            //                 array_push($allPrices, $value3['3']);
            //             }
            //         }
            //     }
            //     if (!empty($request->filter_from_price)) {
            //         $from_passed = 0;
            //         foreach ($allPrices as $key5 => $value5) {
            //             if ((Helper::c_to_n($value5) >= Helper::c_to_n($request->filter_from_price))) {
            //                 $from_passed = 1;
            //                 break;
            //             }
            //         }
            //         if (!$from_passed) {
            //             unset($data[$key]);
            //             continue;
            //         }
            //     }
            //     if (!empty($request->filter_to_price)) {
            //         $to_passed = 0;
            //         foreach ($allPrices as $key6 => $value6) {
            //             if ((Helper::c_to_n($value6) <= Helper::c_to_n($request->filter_to_price))) {
            //                 $to_passed = 1;
            //                 break;
            //             }
            //         }
            //         if (!$to_passed) {
            //             unset($data[$key]);
            //         }
            //     }
            // }
            return DataTables::of($data)
                ->editColumn('project_id', function ($row) use ($request) {
                    $isShared = ShareProperty::where('property_id', $row->id)->where('user_id', Auth::user()->id)->first();
                    // $first = '<td style="vertical-align:top">
                    // 	<font size="3"><a href="' . route('admin.project.view', encrypt($row->id)) . '" style="font-weight: bold;">' . ((isset($row->Projects->project_name)) ? $row->Projects->project_name : 'tests') . '</a>';
                    $first =  '<td style="vertical-align:top">
                        <font size="3"><a href="' . route('admin.project.view', encrypt($row->id)) . '" style="font-weight: bold;">' . (!empty($row->Projects->project_name) ? $row->Projects->project_name : $row->Village->name) . '</a>';

                    //Project name or vilage
                    // if ($row->property_category === '258' && $row->project_id !== '') {
                    //     // dd("on");
                    //     // if (isset($row->Village->name)) {
                    //     //     $first = $row->Village->name;
                    //     // }
                    //     // return '<a href="' . route('admin.project.view', encrypt($row->id)) . '" style="font-weight: bold;">' . $name . '</a>';
                    // }
                    $first_middle = '';
                    $forth = '';
                    if (isset($row->Projects->is_prime) && $row->Projects->is_prime) {
                        $first_middle = '<img style="height:24px" src="' . asset('assets/images/primeProperty.png') . '" alt="">';
                    }
                    if ($row->hot_property) {
                        $first_middle = $first_middle . '<img style="height:24px" src="' . asset('assets/images/hotProperty.png') . '" alt="">';
                    }
                    $first_end = '</font>';
                    // $second = '<br> <a href="' . $row->location_link . '" target="_blank"> <font size="2" style="font-style:italic">Locality: ' . ((!empty($row->Projects->Area->name)) ? $row->Projects->Area->name : 'Null') . '    </font> </a>';
                    $second = '<br>Locality: ' . ((!empty($row->Projects->Area->name)) ? $row->Projects->Area->name : 'Null') . '	</font>';
                    $third = (!empty($row->location_link) ? '<br> <a href="' . $row->location_link . '" target="_blank"><i class="fa fa-map-marker fa-1x cursor-pointer color-code-popover" data-bs-trigger="hover focus">  check on map  </i></a>' : "");
                    if ($isShared) {
                        $forth = '<img style="height:24px;float:right;" src="' . asset('assets/images/sharedImg.png') . '" alt="">';
                    } else {
                        $forth = '';
                    }

                    // $third = '<br> <font size="2" style="font-style:italic">Added On: ' . Carbon::parse($row->created_at)->format('d-m-Y') . '</font>';
                    $last = '</td>';
                    '</td>';
                    return  $first . $first_middle . $forth .  $first_end .   $second . $third . $last;

                    return '';
                })
                ->editColumn('updated_at', function ($row) {
                    return '<td style="vertical-align:top">
					' . Carbon::parse($row->updated_at)->format('d-m-Y') . '<br>' . Carbon::parse($row->updated_at)->diffInDays() . ' days</td>';
                })
                ->editColumn('property_category', function ($row) use ($dropdowns, $land_units) {
                    // $new_array = array('', 'office space', 'Co-working', 'Ground floor', '1st floor', '2nd floor', '3rd floor', 'Warehouse', 'Cold Storage', 'ind. shed', 'Commercial Land', 'Agricultural/Farm Land', 'Industrial Land', '1 rk', '1bhk', '2bhk', '3bhk', '4bhk', '5bhk');
                    $new_array = array('', 'office space', 'Co-working', 'Ground floor', '1st floor', '2nd floor', '3rd floor', 'Warehouse', 'Cold Storage', 'ind. shed', 'Commercial Land', 'Agricultural/Farm Land', 'Industrial Land', '1 rk', '1bhk', '2bhk', '3bhk', '4bhk', '5bhk', '5+bhk', 'Test', 'testw');
                    if ($row->property_for == 'Both') {
                        $forr = 'Rent & Sell';
                    } else {
                        $forr = $row->property_for;
                    }
                    $sub_cat = ((!empty($dropdowns[$row->property_category]['name'])) ? ' | ' . $dropdowns[$row->property_category]['name'] : '');

                    // if (!is_null($row->configuration)) {
                    if (!is_null($row->configuration) && $dropdowns[$row->property_category]['name'] !== "Farmhouse") {
                        $catId = (int) $row->configuration;
                        //$getsub_category = Helper::getsubcategory($catId);
                        $getsub_category = $new_array[$catId];
                        if (!is_null($getsub_category)) {
                            $sub_cat = ' | ' . $getsub_category;
                            if ($sub_cat == " | Agricultural/Farm Land") {
                                $sub_cat = " | Agricultural";
                            }
                        }
                    }
                    //$category = ((!empty($dropdowns[$row->property_category]['name'])) ? ' | '. $dropdowns[$row->property_category]['name'] : '');
                    $category = $sub_cat;
                    // BHARAT HIDE FURNISHED
                    if ($row->property_category == '256') {
                        $fstatus = '';
                    } else {
                        $fstatus = '';
                        if (!empty($row->unit_details) && !empty(json_decode($row->unit_details)[0])) {
                            $vv = json_decode($row->unit_details);
                            // dd("vv",$vv[0][9]);
                            if (isset($vv[0][8])) {
                                if (!empty($vv[0][8])) {
                                    if ($vv[0][8] == "106" || $vv[0][8] == "34") {
                                        $fstatus = 'Furnished';
                                    } elseif ($vv[0][8] == "107" || $vv[0][8] == "35") {
                                        $fstatus = 'Semi Furnished';
                                    } elseif ($vv[0][8] == "108" || $vv[0][8] == "36") {
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

                    if ($row->Property_priority == "91") {
                        $row->image_path = '<img style="height:24px;float: right;bottom: 38px;right:17px;position:relative;" src="' . asset('assets/prop_images/Blue-Star.png') . '" alt="">';
                    } else if ($row->Property_priority == "90") {
                        $row->image_path = '<img style="height:24px;float: right;bottom: 38px;right:17px;position:relative;" src="' . asset('assets/prop_images/Yellow-Star.png') . '" alt="">';
                    } else if ($row->Property_priority == "17") {
                        $row->image_path = '<img style="height:24px;float: right;bottom: 38px;right:17px;position:relative;" src="' . asset('assets/prop_images/Red-Star.png') . '" alt="">';
                    }
                    try {
                        $value = json_decode($row->unit_details)[0];
                        $tooltipHtml = "";
                        if ($fstatus === 'Furnished' || $fstatus === 'Semi Furnished' || $fstatus === 'Can Furnished') {
                            if ($row->property_category == '259') // Office
                            {
                                $tooltipHtml = '<div class="dropdown-basic" style="position:relative; float:right;">
                                                <div class="dropdown">
                                                    <i class="dropbtn fa fa-info-circle p-0 text-dark"></i>
                                                    <div class="dropdown-content py-2 px-2 mx-wd-350 cust-top-20 rounded">
                                                        <div class="row">';

                                if (isset($value[9][0]) && $value[9][0] !== "0") {
                                    $tooltipHtml .= '<div class="col-4 d-flex justify-content-between">
                                                        <b>Seats:</b> ' . $value[9][0] . '
                                                     </div>';
                                }

                                $tooltipHtml .= (isset($value[9][1]) && $value[9][1] !== "0") ?
                                    '<div class="col-4 d-flex justify-content-between">
                                                    <b>Cabins:</b> ' . $value[9][1] . '
                                                 </div>' : '';

                                $tooltipHtml .= (isset($value[9][2]) && $value[9][2] !== "0") ?
                                    '<div class="col-4 d-flex justify-content-between">
                                                    <b>Conference Room:</b> ' . $value[9][2] . '
                                                 </div>' : '';

                                $tooltipHtml .= '</div><hr><div class="row">';

                                $tooltipHtml .= (isset($value[10][0]) && $value[10][0] !== "0") ?
                                    '<div class="col-6 d-flex justify-content-between">
                                                    <b>Pantry:</b> <span>' . ($value[10][0] == 1 ? 'Yes' : 'No') . '</span>
                                                 </div>' : '';

                                $tooltipHtml .= (isset($value[10][1]) && $value[10][1] !== "0") ?
                                    '<div class="col-6 d-flex justify-content-between">
                                                    <b>Reception:</b> <span>' . ($value[10][1] == 1 ? 'Yes' : 'No') . '</span>
                                                 </div>' : '';

                                $tooltipHtml .= '</div></div></div></div>';
                            } else if ($row->property_category !== '260' && $row->property_category !== '262' && $row->property_category !== '261' && $row->property_category !== '256') {
                                $tooltipHtml = '<div class="dropdown-basic" style="position:relative; float:right;">
                                                <div class="dropdown">
                                                    <i class="dropbtn fa fa-info-circle p-0 text-dark"></i>
                                                    <div class="dropdown-content py-2 px-2 mx-wd-350 cust-top-20 rounded">
                                                        <div class="row">';

                                $tooltipHtml .= (isset($value[9][0]) && $value[9][0] != "0") ?
                                    '<div class="col-4 d-flex justify-content-between">
                                                    <b>Light:</b> ' . $value[9][0] . '
                                                 </div>' : '';

                                $tooltipHtml .= (isset($value[9][1]) && $value[9][1] != "0") ?
                                    '<div class="col-4 d-flex justify-content-between">
                                                    <b>Fans:</b> ' . $value[9][1] . '
                                                 </div>' : '';

                                $tooltipHtml .= (isset($value[9][2]) && $value[9][2] != "0") ?
                                    '<div class="col-4 d-flex justify-content-between">
                                                    <b>AC:</b> ' . $value[9][2] . '
                                                 </div>' : '';

                                $tooltipHtml .= '</div><div class="row">';

                                $tooltipHtml .= (isset($value[9][3]) && $value[9][3] != "0") ?
                                    '<div class="col-4 d-flex justify-content-between">
                                                    <b>TV:</b> ' . $value[9][3] . '
                                                 </div>' : '';

                                $tooltipHtml .= (isset($value[9][4]) && $value[9][4] != "0") ?
                                    '<div class="col-4 d-flex justify-content-between">
                                                    <b>Beds:</b> ' . $value[9][4] . '
                                                 </div>' : '';

                                $tooltipHtml .= (isset($value[9][5]) && $value[9][5] != "0") ?
                                    '<div class="col-4 d-flex justify-content-between">
                                                    <b>Wardrobe:</b> ' . $value[9][5] . '
                                                 </div>' : '';

                                $tooltipHtml .= '</div><div class="row">';

                                $tooltipHtml .= (isset($value[9][6]) && $value[9][6] != "0") ?
                                    '<div class="col-4 d-flex justify-content-between">
                                                    <b>Geyser:</b> ' . $value[9][6] . '
                                                 </div>' : '';

                                $tooltipHtml .= (isset($value[9][7]) && $value[9][7] != "0") ?
                                    '<div class="col-4 d-flex justify-content-between">
                                                    <b>Sofa:</b> ' . $value[9][7] . '
                                                 </div>' : '';

                                $tooltipHtml .= '</div><hr><div class="row">';

                                $tooltipHtml .= (isset($value[10][0]) && $value[10][0] != "0") ?
                                    '<div class="col-6 d-flex justify-content-between">
                                    <b>Washing Machine:</b> <span>' . ($value[10][0] == '1' ? 'Yes' : 'No') . '</span>
                                </div>' : '';
                                $tooltipHtml .= (isset($value[10][1]) && $value[10][1] != "0") ?
                                    '<div class="col-6 d-flex justify-content-between">
                                        <b>Stove:</b> <span>'  . ($value[10][1] == '1' ? 'Yes' : 'No') . '</span>
                                        </div>' : '';

                                $tooltipHtml .= (isset($value[10][2]) && $value[10][2] != "0") ?
                                    '<div class="col-6 d-flex justify-content-between">
                                                    <b>Fridge:</b> ' . ($value[10][2] == '1' ? 'Yes' : 'No') . '
                                                 </div>' : '';

                                $tooltipHtml .= (isset($value[10][3]) && $value[10][3] != "0") ?
                                    '<div class="col-6 d-flex justify-content-between">
                                                    <b>Water Purifier:</b> ' . ($value[10][3] == '1' ? 'Yes' : 'No') . '
                                                 </div>' : '';

                                $tooltipHtml .= (isset($value[10][4]) && $value[10][4] != "0") ?
                                    '<div class="col-6 d-flex justify-content-between">
                                                    <b>Microwave:</b> ' . ($value[10][4] == '1' ? 'Yes' : 'No') . '
                                                 </div>' : '';

                                $tooltipHtml .= (isset($value[10][5]) && $value[10][5] != "0") ?
                                    '<div class="col-6 d-flex justify-content-between">
                                                    <b>Modular Kitchen:</b> ' . ($value[10][5] == '1' ? 'Yes' : 'No') . '
                                                 </div>' : '';

                                $tooltipHtml .= (isset($value[10][6]) && $value[10][6] != "0") ?
                                    '<div class="col-6 d-flex justify-content-between">
                                                    <b>Chimney:</b> ' . ($value[10][6] == '1' ? 'Yes' : 'No') . '
                                                 </div>' : '';

                                $tooltipHtml .= (isset($value[10][7]) && $value[10][7] != "0") ?
                                    '<div class="col-6 d-flex justify-content-between">
                                                    <b>Dining Table:</b> ' . ($value[10][7] == '1' ? 'Yes' : 'No') . '
                                                 </div>' : '';

                                $tooltipHtml .= (isset($value[10][8]) && $value[10][8] != "0") ?
                                    '<div class="col-6 d-flex justify-content-between">
                                                    <b>Curtains:</b> ' . ($value[10][8] == '1' ? 'Yes' : 'No') . '
                                                 </div>' : '';

                                $tooltipHtml .= (isset($value[10][9]) && $value[10][9] != "0") ?
                                    '<div class="col-6 d-flex justify-content-between">
                                                    <b>Exhaust Fan:</b> ' . ($value[10][9] == '1' ? 'Yes' : 'No') . '
                                                 </div>' : '';

                                $tooltipHtml .= '</div></div></div></div>';
                            } else if ($row->property_category == '260') {
                                $tooltipHtml = '<div class="dropdown-basic" style="position:relative; float:right;">
                                    <div class="dropdown">
                                        <i class="dropbtn fa fa-info-circle p-0 text-dark"></i>
                                        <div class="dropdown-content py-2 px-2 mx-wd-350 cust-top-20 rounded">
                                            <div class="row">';
                                
                                $tooltipHtml .= (isset($value[9][0]) && $value[9][0] != "0") ?
                                    '<div class="col-12">
                                        <b class="m-2">Remarks:</b>
                                        <span class="short-text">' . substr($value[9][0], 0, 100) . '...</span>
                                        <span class="full-text d-none">' . $value[9][0] . '</span>
                                        <a href="#" class="read-more-link">Read More</a>
                                    </div>' : '';
                            
                                $tooltipHtml .= '</div></div></div></div>';
                            }
                            else {
                                $tooltipHtml = "";
                            }
                        }
                        return '
                        <td style="vertical-align:top">
                            ' . ((!empty($forr)) ? $forr : "") . ($category ? $category : $dropdowns[$row->property_category]['name']) . '
                            <font size="2" style="font-style:italic">
                            <br>
                            ' . $salable_area_print . '
                            </font>
                            <br>' . $row->image_path . '
                            ' . $fstatus . '
                            ' . $tooltipHtml . '
                        </td>';
                    } catch (\Throwable $th) {
                        dd($th);
                    }
                })
                ->editColumn('contact_details', function ($row) {
                    $detail = '';
                    if (!empty($row->contact_details)) {
                        $contacts = json_decode($row->contact_details);
                        foreach ($contacts as $key => $value) {
                            if (!empty($value[0]) && !empty($value[1])) {
                                $detail = '<td align="center" style="vertical-align:top">
								' . $value[0] . ' <br>
								<a href="tel:' . $value[1] . '">' . $value[1] . '</a>
				 				</td>';
                                break;
                            }
                        }
                    };
                    return $detail;
                })
                ->editColumn('unit_details', function ($row) {
                    $all_units = [];
                    if (!empty($row->unit_details) && !empty(json_decode($row->unit_details)[0])) {
                        $vv = json_decode($row->unit_details);
                        foreach ($vv as $key => $value) {
                            if ($value[2] == "Rent Out") {
                                $all_units = [];
                            } else if ($value[2] == "Sold Out") {
                                $all_units = [];
                            } else if ($row->property_for === 'Both') {
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
                            } else {
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
                    }

                    if (!empty($all_units)) {
                        $vvv = '';
                        $all_units_length = count($all_units);
                        if ($all_units_length > 2) {
                            foreach ($all_units as $key => $value) {
                                $vvv = $vvv . '<br> ' . ((!empty($value[0])) ? $value[0] . '-' : '') . '' . $value[1];
                            }
                            $second = '' . ((!empty($all_units[0][0])) ? $all_units[0][0] . '-' : '') . '' . $all_units[0][1] . ' <i class="fa ml-1 fa-info-circle cursor-pointer color-code-popover" data-container="body"  data-bs-content="' . $vvv . '" data-bs-trigger="hover focus"></i>';
                            return $second;
                        } else {
                            foreach ($all_units as $key => $value) {
                                $vvv = $vvv . ((!empty($value[0])) ? $value[0] . '-' : ' ') . ((!empty($value[1])) ? $value[1] . '<br>' : '');
                            }
                            return $vvv;
                        }
                    }
                    // if (!empty($all_units)) {
                    //     $vvv = '';
                    //     foreach ($all_units as $key => $value) {
                    //         $vvv = $vvv .  ((!empty($value[0])) ? $value[0] . '-' : ' ') . ((!empty($value[1])) ? $value[1] . '<br>' : '');
                    //     }

                    //     return $vvv;
                    // }
                    return;
                })
                ->editColumn('price', function ($row) {
                    //$all_units = [];
                    $all_units = [];
                    // dd($row->unit_details,"price",$row->property_for);
                    if (!empty($row->unit_details) && !empty(json_decode($row->unit_details)[0])) {
                        $vv = json_decode($row->unit_details);
                        // dd($vv,"price");
                        $all_units_length = count($all_units);
                        //price
                        foreach ($vv as $key => $value) {
                            $price = '';
                            if ($row->property_for === 'Both') {
                                if (!empty($value['7']) && !empty($value['4'])) {
                                    $price = '  R : ₹ ' . $value['4'] . '<br>' . '  S : ₹ ' . $value['7'];
                                } elseif (!empty($value['3']) && !empty($value['4'])) {
                                    $price = '  R : ₹ ' . $value['4'] . '<br>' . '  S : ₹ ' . $value['3'];
                                }
                            } else {
                                if (!empty($value['7'])) {
                                    $price = ' ₹ ' . $value['7'];
                                } else if (!empty($value['4'])) {
                                    $price = ' ₹ ' . $value['4'];
                                } else if (!empty($value['3'])) {
                                    $price = ' ₹ ' . $value['3'];
                                }
                            }
                            $data = [];
                            $data[0] = $value[0];
                            $data[1] = $value[1];
                            $data[2] = $price;
                            array_push($all_units, $data);
                        }
                    }
                    // dd("all2",$all_units);

                    if (!empty($all_units)) {
                        $vvv = '';
                        $unit_wing = '';
                        // foreach ($all_units as $key => $value) {
                        //     $vvv = $vvv .  ((!empty($value[2])) ? $value[2] . ' ' : ''); // . ((!empty($value[1])) ? $value[1] : '');
                        // }

                        // return $vvv;
                        $all_units_length = count($all_units);
                        if ($all_units_length > 2) {
                            foreach ($all_units as $key => $value) {
                                $vvv = $vvv . '<br> ' . ((!empty($value[0])) ? $value[0] . '-' : '') . '' . $value[1];
                                $vvv = $vvv . ' - ' . ((!empty($value[2])) ? $value[2] : '');
                            }
                            $second = '' . ((!empty($all_units[0][2])) ? $all_units[0][2] : '') . ' <i class="fa ml-1 fa-info-circle cursor-pointer color-code-popover" data-container="body"  data-bs-content="' . $unit_wing . $vvv . '" data-bs-trigger="hover focus"></i>';
                            // $second = '' . ((!empty($all_units[0][0])) ? $all_units[0][0] . '-' : '') . '' . $all_units[0][1] .  ' <i class="fa ml-1 fa-info-circle cursor-pointer color-code-popover" data-container="body"  data-bs-content="' . $vvv . '" data-bs-trigger="hover focus"></i>';
                            return $second;
                        } else {
                            foreach ($all_units as $key => $value) {
                                $vvv = $vvv . ((!empty($value[2])) ? $value[2] . '<br>' : '');
                            }
                            return $vvv;
                        }
                    }
                    return;
                })
                ->editColumn('status_change', function ($row) {
                    $ischecked = $row->status;
                    $status = '<div class="d-flex align-items-center mb-3 col-md-2">
						<div class="media-body text-end icon-state">
							<label class="switch mb-0">
								<input type="checkbox" class="changeTheStatus"  data-id="' . $row->id . '" ' . (($ischecked) ? 'checked' : '') . ' >
								<span class="switch-state"></span>
							</label>
						</div>
					</div>';

                    return $status;
                })
                ->editColumn('select_checkbox', function ($row) {
                    $abc = '<div class="form-check checkbox checkbox-primary mb-0">
					<input class="form-check-input table_checkbox" data-id="' . $row->id . '" name="select_row[]" id="checkbox-primary-' . $row->id . '" type="checkbox">
					<label class="form-check-label" for="checkbox-primary-' . $row->id . '"></label>
				  	</div>';
                    return $abc;
                })
                ->addColumn('Actions2', function ($row) use ($dropdowns, $land_units) {
                    $buttons = '';
                    $building_name = '';
                    $area = '';
                    $config = '';
                    $super_built_area = '';
                    $super_built_measure = '';
                    $carpet_area = '';
                    $carpet_measure = '';
                    $furniture = '';
                    $user = User::with(['roles', 'roles.permissions'])
                        ->where('id', Auth::user()->id)
                        ->first();
                    $permissions = $user->roles[0]['permissions']->pluck('name')->toArray();
                    // bharat edit
                    if (in_array('property-edit', $permissions)) {
                        $buttons = $buttons . '<a href="' . route('admin.property.edit', $row->id) . '"><i role="button" title="Edit" data-id="' . $row->id . '"  class="fs-22 py-2 mx-2 fa-pencil pointer fa  " type="button"></i></a>';
                    }
                    if (in_array('property-delete', $permissions)) {
                        $buttons = $buttons . '<i role="button" title="Delete" data-id="' . $row->id . '" onclick=deleteProperty(this) class="fs-22 py-2 mx-2 fa-trash pointer fa text-danger" type="button"></i>';
                    }
                    if (isset($row->Projects->project_name)) {
                        $building_name = $row->Projects->project_name;
                    }
                    if (isset($row->Projects->Area->name)) {
                        $area = $row->Projects->Area->name;
                    }
                    if (isset($dropdowns[$row->property_category]['name'])) {
                        $config = $dropdowns[$row->property_category]['name'];
                    }

                    if (isset($row->carpet_area)) {
                        $carpet_area = $row->carpet_area;
                    }
                    if (isset($dropdowns[$row->carpet_measurement]['name'])) {
                        $carpet_measure = $dropdowns[$row->carpet_measurement]['name'];
                    }
                    if (isset($dropdowns[$row->furnished_status]['name'])) {
                        $furniture = $dropdowns[$row->furnished_status]['name'];
                    }

                    // $sharestring = 'https://api.whatsapp.com/send?phone=the_phone_number_to_send&text=' . $building_name . ' | ' . $area . ' %2c%0D%0A ' . $config . '%20 | %20' . $this->generateAreaDetails($row, $config, $dropdowns)  . $row->price . '%2c%0D%0AAvailable%20For%20' . (($row->property_for == 'Both') ? 'Rent & Sell' : '') . '%0a%0a%0a Link: ' . $row->location_link;
                    $building_name = urlencode($building_name);
                    $area = urlencode($area);
                    $config = urlencode($config);
                    $price = urlencode($row->price);
                    $property_for = urlencode(($row->property_for == 'Both') ? 'Rent & Sell' : '');
                    $details = urlencode($this->generateAreaUnitDetails($row, $config, $land_units));
                    $location_link = urlencode($row->location_link);
                    $message = "$building_name | $area \n $config | $details | $price \n Available For : $property_for\n\n | Link: $location_link";
                    $sharestring = 'https://api.whatsapp.com/send?phone=the_phone_number_to_send&text=' . $message;
                    $buttons = $buttons . '<i title="Send On Whatsapp" data-share_string="' . $sharestring . '"  onclick=openwamodel(this)  class="fa fs-22 py-2 mx-2 fa-whatsapp text-success"></i><br>';

                    $buttons = $buttons . '<i title="Matching Enquiry" data-id="' . $row->id . '" onclick=matchingEnquiry(this) class="fa fs-22 py-2 mx-2 fa-plane text-info"></i>';
                    //     $buttons =  $buttons . '<a  href="javascript:void(0)" onclick="ShareLink(this)" data-link="' . route('admin.properties') . '?shareproperty=' . encrypt($row->id) . '"><i title="Share" data-id="' . $row->id . '"  class="fa fa-clipboard fs-22 py-2 mx-2 text-secondary"></i> </a>';
                    if (in_array('shared-property', $permissions)) {
                        $buttons = $buttons . '<a  href="javascript:void(0)" data-id="' . $row->id . '" onclick="shareUserModal(this)"><i title="Share"   class="fa fa-clipboard fs-22 py-2 mx-2 text-secondary"></i> </a>';
                    }
                    $vvv = '';
                    if (!empty($row->other_contact_details) && !empty(json_decode($row->other_contact_details))) {
						$cd = json_decode($row->other_contact_details);
						$vvv = ''; // Ensure this variable is initialized
						foreach ($cd as $key => $value) {
							if (!empty($value[1])) { // Check if $contact is not empty
								$space = $vvv == '' ? '' : '<br>';
								$other_name = $value[0];
								$other_position = $value[3];
								$contact = $value[1];
								$vvv .= $space . $other_name . ' - ' . $other_position . ' - ' . $contact;
							}
						}
					}

                    $owner_type = '';
                    if ($row->owner_is == '111') {
                        $owner_type = 'Individual';
                    } elseif ($row->owner_is == '112') {
                        $owner_type = 'Investor';
                    } elseif ($row->owner_is == '110') {
                        $owner_type = 'Builder';
                    }

                    $other_details = $owner_type . ' - ' . $row->owner_name . ' - ' . $row->owner_contact;
                    $contact_info = ($vvv != "") ? $vvv : ' ';
                    // $buttons =  $buttons . '<i title="Contacts" class="fa fa-phone-square fa-2x cursor-pointer color-code-popover" data-container="body"  data-bs-content="' . $contact_info . '" data-bs-trigger="hover focus"></i>';
                    // $buttons .= '<i title="Contacts" class="fa fa-phone-square fa-2x cursor-pointer color-code-popover" data-container="body"  data-bs-content="' . ($contact_info != ' ' ? $contact_info : $row->owner_contact) . '" data-bs-trigger="hover focus"></i>';
                    $buttons .= '<i title="Contacts" class="fa fa-phone-square fa-2x cursor-pointer color-code-popover" data-container="body" data-bs-content="'
                        . ($other_details  != ' ' ? $other_details  : '')
                        . ($other_details  != ' ' && $contact_info ? '<br>' : '')
                        . ($contact_info ? $contact_info : '')
                        . '" data-bs-trigger="hover focus"></i>';
                    return $buttons;
                })
                ->rawColumns(['select_checkbox', 'project_id', 'unit_details', 'updated_at', 'property_category', 'contact_details', 'price', 'Actions2', 'status_change'])
                ->make(true);
        }
        $projects = Projects::whereNotNull('project_name')
        ->where('id', '!=', 261)
        ->where('user_id', Auth::user()->id)
        ->get();
        $areas = Areas::where('user_id', Auth::user()->id)->get();
        $conatcts_numbers = [];
        $contacts = Enquiries::get();

        foreach ($contacts as $key => $value) {
            if (!empty($value->client_mobile) && !empty($value->client_name)) {
                $arr = [];
                $arr['name'] = $value->client_name;
                $arr['number'] = $value->client_mobile;
                array_push($conatcts_numbers, $arr);
            }
            if (!empty($value->other_contacts)) {
                $val = json_decode($value->other_contacts);
                foreach ($val as $key1 => $value1) {
                    $arr = [];
                    $arr['name'] = $value1[0];
                    $arr['number'] = $value1[1];
                    array_push($conatcts_numbers, $arr);
                }
            }
        }
        $property_configuration_settings = DropdownSettings::get()->toArray();
        $prop_type = [];
        foreach ($property_configuration_settings as $key => $value) {
            if (($value['name'] == 'Commercial' || $value['name'] == 'Residential') && str_contains($value['dropdown_for'], 'property_')) {
                array_push($prop_type, $value['id']);
            }
        }
        return view('admin.properties.index', compact('projects', 'property_configuration_settings', 'areas', 'conatcts_numbers', 'prop_type', 'shareddata', 'sharedlk'));
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

    public function sendRequest(Request $request)
    {
        if ($request->ajax()) {
            $response_mesage = '';
            if (!empty($request->shareproperty)) {
                $prop = Helper::theDecrypt($request->shareproperty);

                if (Properties::find($prop)) {
                    $response_mesage = 'This property is already in your list';
                } else {
                    $pr = Properties::withoutGlobalScopes()->find($prop);
                    $co = SharedProperty::where('main_owner_id', $pr->user_id)->where('owner_id', Session::get('parent_id'))->where('property_id', $prop)->count();
                    if ($co == 0) {
                        $sc = new SharedProperty;
                        $sc->main_owner_id = $pr->user_id;
                        $sc->property_id = $prop;
                        $sc->owner_id = Session::get('parent_id');
                        $sc->save();
                        UserNotifications::create(['user_id' => $pr->user_id, 'notification' => 'You have received request for property']);
                    }
                    $response_mesage = 'Request sent to the owner';
                }
            }
            return $response_mesage;
        }
    }

    // shared 4
    public function acceptRequest(Request $request)
    {
        if ($request->ajax()) {
            if (!empty($request->id)) {
                SharedProperty::find($request->id)->update(['accepted' => 1]);
            }
        }
    }

    // shared 3
    public function cancelRequest(Request $request)
    {
        if ($request->ajax()) {
            if (!empty($request->id)) {
                SharedProperty::find($request->id)->update(['accepted' => 2]);
                $dlt_share_prop = SharedProperty::where('id', $request->id)->delete();
                return json_encode($dlt_share_prop);
            }
        }
    }

    // shared 1
    public function sharedPropertyRequests(Request $request)
    {
        // dd("shared-requests");
        if ($request->ajax()) {
            $data = SharedProperty::where('partner_id', Auth::user()->id)->with(['Property', 'User'])->get();

            // dd("data",$data);
            return DataTables::of($data)
                ->addColumn('project_name', function (SharedProperty $shared) {
                    if (!empty($shared->Property->Projects->project_name)) {
                        dd($shared->Property->Projects->project_name);
                    } else {
                        return 'N/A';
                    }
                })
                ->addColumn('user_name', function (SharedProperty $shared) {
                    if (!empty($shared->User->first_name || $shared->User->last_name)) {
                        return $shared->User->first_name . ' ' . $shared->User->last_name;
                        // return $shared->User->first_name . ' ' . $shared->User->last_name . ' | ' . $shared->User->company_name;
                    } else {
                        return 'N/A';
                    }
                })

                ->editColumn('Action', function ($row) {
                    $buttons = '';
                    if (!$row->accepted) {
                        $buttons .= ' <button data-id="' . $row->id . '" onclick=acceptRequest(this) class="btn btn-pill btn-danger" type="button">Accept</button>';
                    }
                    $buttons .= ' <button data-id="' . $row->id . '" onclick=cancelRequest(this) class="btn btn-pill btn-primary" type="button">Cancel</button>';
                    return $buttons;
                })
                ->rawColumns(['project_name', 'user_name', 'Action'])
                ->make(true);
        }
        return view('admin.properties.shared_requets');
    }

    public function changePropertyStatus(Request $request)
    {
        if ($request->ajax()) {
            if (isset($request->id)) {
                $vv = Properties::find($request->id);
                $vv->status = $request->status;
                $vv->save();
            }
        }
    }

    // to update property status on view
    public function updatePropertyStatus(Request $request)
    {
        $status = $request->status;
        $vv = Properties::where('id', $request->id)->update(['prop_status' => $status]); //find and update property status
        return redirect('admin/Properties');
    }

    public function importPropertyTemplate(Request $request)
    {
        // dd("import prop",$request->type);
        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();

        // $allFields = ['Property For','Property Type','category','subcategory','Project','city','locality','address','location link','district','taluka','village','zone','Constructed Carpet Area','Constructed Salable Area','Constructed Builtup Area','Salable Plot Area','Carpet Plot Area','Centre Height','Salable Area','Length of plot','Width of plot','Carpet Area','Opening Width','Ceiling Height','Builtup Area','Plot Area','Terrace','Contruction Area','Terrace Carpet Area','Terrace Salable Area','Total Units in project','Total no. of floor','Total Units in tower','Property On Floor','No Of Elavators','No Of Balcony','Total No. of units','No. of room','No Of Bathrooms','No Of Floors Allowed','No Of Side Open','Service Elavator','Servant Room','Hot','Favourite','Washrooms','Road width of front side','constructed allowed for','Fsi','Four Wheeler Parking','Two wheeler Parking','Pre Leased','Pre leased remarks','Availability','Age of Property','Amenities','Swimming Pool','Club house','Passenger Lift','Garden & Children Play Area','Service Lift','Streature Lift','Central AC','Gym','Pollution Control Board','EC NOC','Bail Membership','Discharge','Gas','Power','Water','Machinery','ETL CEPT NLTL','Two Road Corner','Survey Number ','Plot Size','Survey Price','TP Number','FP Number','Plot Size','FP Price ','Owner is','Owner Name','Contact','Email','NRI','Other contact','Other contact No.','Care Taker Name','Care Taker Contact','Key available at','Wing 1','Unit 1','Available Status 1','Price Rent 1','Price 1','Furnished Status 1','Wing 2','Unit 2','Available Status 2','Price Rent 2','Price 2','Furnished Status 2','Wing 3','Unit 3','Available Status 3','Price Rent 3','Price 3','Furnished Status 3'];

        $allCells = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG'];

        $allFields = [];
        $type = 'Flat';

        if (!empty($request->type)) {
            $type = $request->type;
        }

        if ($type == 'Flat') {
            $allFields = ['Property For', 'Property Type', 'Category', 'Subcategory', 'Project', 'city', 'address', 'location link', 'Salable Area', 'Carpet Area', 'Constructed Builtup Area', 'Constructed Carpet Area', 'Salable Plot Area', 'Constructed Salable Area', 'Terrace Carpet Area', 'Carpet Measurement', 'Super Builtup Measurement', 'Builtup Area', 'Total Units in project', 'Total no. of floor', 'Total Units in tower', 'Property On Floor', 'No Of Elavators', 'No Of Bathrooms', 'Service Elavator', 'Servant Room', 'Hot', 'Favourite', 'Four Wheeler Parking', 'Two wheeler Parking', 'Availability', 'Age of Property', 'Owner is', 'Owner Name', 'Contact', 'Email', 'NRI', 'Other contact', 'Other contact No.', 'Key available at', 'Wing 1', 'Unit 1', 'Available Status 1', 'Price Rent 1', 'Price 1', 'Furnished Status 1', 'remarks'];
        } else if ($type == 'Vila/Bunglow') {
            $allFields = ['Property For', 'Property Type', 'Category', 'Subcategory', 'Project', 'city', 'address', 'location link', 'Constructed Carpet Area', 'Constructed Salable Area', 'Constructed Builtup Area', 'Salable Plot Area', 'Carpet Plot Area', 'No Of Balcony', 'Total No. of units', 'No. of room', 'No Of Bathrooms', 'No Of Side Open', 'Servant Room', 'Hot', 'Favourite', 'Four Wheeler Parking', 'Availability', 'Age of Property', 'Owner is', 'Owner Name', 'Contact', 'Email', 'NRI', 'Other contact', 'Other contact No.', 'Key available at', 'Wing 1', 'Unit 1', 'Available Status 1', 'Price Rent 1', 'Price 1', 'Furnished Status 1', 'Wing 2', 'Unit 2', 'Available Status 2', 'Price Rent 2', 'Price 2', 'Furnished Status 2', 'Wing 3', 'Unit 3', 'Available Status 3', 'Price Rent 3', 'Price 3', 'Furnished Status 3', 'remarks'];
        } else if ($type == 'Land,Plot') {
            $allFields = ['Property For', 'Property Type', 'Category', 'Subcategory', 'Project', 'city', 'address', 'location link', 'Carpet Plot Area', 'Salable Area', 'Length of plot', 'Width of plot', 'Total No. of units', 'No Of Floors Allowed', 'No Of Side Open', 'Hot', 'Favourite', 'Owner is', 'Owner Name', 'Contact', 'Email', 'NRI', 'Other contact', 'Other contact No.', 'Key available at', 'Unit 1', 'Available Status 1', 'Price Rent 1', 'Price 1', 'Unit 2', 'Available Status 2', 'Price Rent 2', 'Price 2', 'Unit 3', 'Available Status 3', 'Price Rent 3', 'Price 3', 'remarks'];
        } else if ($type == 'Penthouse') {
            $allFields = ['Property For', 'Property Type', 'Category', 'Subcategory', 'Project', 'city', 'address', 'location link', 'Salable Area', 'Carpet Area', 'Constructed Builtup Area', 'Constructed Carpet Area', 'Salable Plot Area', 'Constructed Salable Area', 'Terrace Carpet Area', 'Carpet Measurement', 'Super Builtup Measurement', 'Builtup Area', 'Terrace Carpet Area', 'Terrace Salable Area', 'Total Units in project', 'Total no. of floor', 'Total Units in tower', 'Property On Floor', 'No Of Elavators', 'No Of Balcony', 'No Of Bathrooms', 'Service Elavator', 'Servant Room', 'Hot', 'Favourite', 'Availability', 'Age of Property', 'Owner is', 'Owner Name', 'Contact', 'Email', 'NRI', 'Other contact', 'Other contact No.', 'Key available at', 'Wing 1', 'Unit 1', 'Available Status 1', 'Price Rent 1', 'Price 1', 'Furnished Status 1', 'remarks'];
        } else if ($type == 'Farmhouse') {
            $allFields = ['Property For', 'Property Type', 'Category', 'Subcategory', 'Project', 'city', 'address', 'location link', 'district', 'taluka', 'village', 'zone', 'Constructed Carpet Area', 'Constructed Salable Area', 'Constructed Builtup Area', 'Salable Plot Area', 'Carpet Plot Area', 'No Of Balcony', 'Total No. of units', 'No. of room', 'No Of Bathrooms', 'No Of Side Open', 'Servant Room', 'Hot', 'Favourite', 'Four Wheeler Parking', 'Availability', 'Age of Property', 'Owner is', 'Owner Name', 'Contact', 'Email', 'NRI', 'Other contact', 'Other contact No.', 'Key available at', 'Unit 1', 'Available Status 1', 'Price Rent 1', 'Price 1', 'Furnished Status 1', 'Unit 2', 'Available Status 2', 'Price Rent 2', 'Price 2', 'Furnished Status 2', 'Unit 3', 'Available Status 3', 'Price Rent 3', 'Price 3', 'Furnished Status 3', 'remarks'];
        } else if ($type == 'Office') {
            $allFields = ['Property For', 'Property Type', 'Category', 'Subcategory', 'Project', 'city', 'address', 'location link', 'Salable Area', 'Carpet Area', 'Constructed Builtup Area', 'Constructed Carpet Area', 'Salable Plot Area', 'Constructed Salable Area', 'Terrace Carpet Area', 'Carpet Measurement', 'Super Builtup Measurement', 'Total Units in project', 'Total no. of floor', 'Total Units in tower', 'Property On Floor', 'No Of Elavators', 'Service Elavator', 'Servant Room', 'Hot', 'Favourite', 'Washrooms', 'Four Wheeler Parking', 'Availability', 'Age of Property', 'Owner is', 'Owner Name', 'Contact', 'Email', 'NRI', 'Other contact', 'Other contact No.', 'Key available at', 'Wing 1', 'Unit 1', 'Available Status 1', 'Price Rent 1', 'Price 1', 'Furnished Status 1', 'remarks'];
        } else if ($type == 'Retail') {
            $allFields = ['Property For', 'Property Type', 'Category', 'Subcategory', 'Project', 'city', 'address', 'location link', 'Salable Area', 'Carpet Area', 'Constructed Builtup Area', 'Constructed Carpet Area', 'Salable Plot Area', 'Constructed Salable Area', 'Terrace Carpet Area', 'Carpet Measurement', 'Super Builtup Measurement', 'Opening Width', 'Ceiling Height', 'Total Units in project', 'Total no. of floor', 'Total Units in tower', 'No Of Elavators', 'Service Elavator', 'Servant Room', 'Hot', 'Favourite', 'Washrooms', 'Four Wheeler Parking', 'Two wheeler Parking', 'Availability', 'Age of Property', 'Two Road Corner', 'Owner is', 'Owner Name', 'Contact', 'Email', 'NRI', 'Other contact', 'Other contact No.', 'Key available at', 'Wing 1', 'Unit 1', 'Available Status 1', 'Price Rent 1', 'Price 1', 'Furnished Status 1', 'remarks'];
        } else if ($type == 'Storage/industrial') {
            $allFields = ['Property For', 'Property Type', 'Category', 'Subcategory', 'Project', 'city', 'address', 'location link', 'Constructed Carpet Area', 'Constructed Salable Area', 'Salable Plot Area', 'Carpet Plot Area', 'Centre Height', 'Hot', 'Favourite', 'Four Wheeler Parking', 'Two wheeler Parking', 'Availability', 'Age of Property', 'Pollution Control Board', 'EC NOC', 'Bail Membership', 'Discharge', 'Gas', 'Power', 'Water', 'Machinery', 'ETL CEPT NLTL', 'Owner is', 'Owner Name', 'Contact', 'Email', 'NRI', 'Other contact', 'Other contact No.', 'Key available at', 'Wing 1', 'Unit 1', 'Available Status 1', 'Price Rent 1', 'Price 1', 'Furnished Status 1', 'remarks'];
        } else if ($type == 'Plot,Land') {
            $allFields = ['Property For', 'Property Type', 'Category', 'Subcategory', 'Project', 'city', 'address', 'district', 'taluka', 'village', 'zone', 'Length of plot', 'Width of plot', 'No Of Floors Allowed', 'Hot', 'Favourite', 'Road width of front side', 'constructed allowed for', 'Fsi', 'Availability', 'Age of Property', 'Survey Number ', 'Plot Size', 'Survey Price', 'TP Number', 'FP Number', 'Plot Size', 'FP Price ', 'Owner is', 'Owner Name', 'Contact', 'Email', 'NRI', 'Other contact', 'Other contact No.'];
        }

        $subcategoryOptions = [];
        $categoryOptions = [];
        $propertyTypeOptions = [];
        if ($type == 'Flat') {
            $subcategoryOptions = ['1rk', '1bhk', '2bhk', '3bhk', '4bhk', '5bhk', '5+bhk'];
            $categoryOptions = ['Flat'];
            $propertyTypeOptions = ['Residential'];
        } elseif ($type == 'Vila/Bunglow') {
            $subcategoryOptions = ['1bhk', '2bhk', '3bhk', '4bhk', '5bhk', '5+bhk'];
            $categoryOptions = ['Vila/Bunglow'];
            $propertyTypeOptions = ['Residential'];
        } elseif ($type == 'Land') {
            $subcategoryOptions = ['Commercial Land', 'Agricultural/Farm Land'];
            $categoryOptions = ['Land'];
            $propertyTypeOptions = ['Commercial'];
        } elseif ($type == 'Penthouse') {
            $subcategoryOptions = ['1bhk', '2bhk', '3bhk', '4bhk', '5bhk', '5+bhk'];
            $categoryOptions = ['Penthouse'];
            $propertyTypeOptions = ['Residential'];
        } elseif ($type == 'Farmhouse') {
            $subcategoryOptions = [''];
            $categoryOptions = ['Farmhouse'];
            $propertyTypeOptions = ['Residential'];
        } elseif ($type == 'Office') {
            $subcategoryOptions = ['office space', 'Co-working'];
            $categoryOptions = ['Office'];
            $propertyTypeOptions = ['Commercial'];
        } elseif ($type == 'Retail') {
            $subcategoryOptions = ['Ground floor', '1st floor', '2st floor', '3rd floor'];
            $categoryOptions = ['Retail'];
            $propertyTypeOptions = ['Commercial'];
        } elseif ($type == 'Storage/industrial') {
            $subcategoryOptions = ['Warehouse', 'Cold Storage', 'ind. shed', 'Plotting'];
            $categoryOptions = ['Storage/industrial'];
            $propertyTypeOptions = ['Commercial'];
        } elseif ($type == 'Plot') {
            $subcategoryOptions = [''];
            $categoryOptions = ['Plot'];
            $propertyTypeOptions = ['Residential'];
        }

        $allCells2 = [];
        foreach ($allFields as $key => $value) {
            $allCells2[] = $allCells[$key];
        }

        $allCells = $allCells2;

        foreach ($allCells as $key => $value) {
            $sheet->setCellValue($value . '1', $allFields[$key]);
        }

        foreach ($allCells as $key => $value) {
            $spreadsheet->getActiveSheet()->getColumnDimension($value)->setWidth(15);
        }

        $dd1 = Projects::whereNotNull('project_name')->with('Area')->get()->toArray();
        $projects = [];
        foreach ($dd1 as $key => $value) {
            $projects[] = $value['project_name'] . ((isset($value['area']['name'])) ? ' - ' . $value['area']['name'] : '');
        }
        $projects = '"' . implode(",", $projects) . '"';

        $dd1 = City::whereNotNull('name')->get()->toArray();
        $cities = [];
        foreach ($dd1 as $key => $value) {
            $cities[] = $value['name'];
        }
        // $cities = '"' . implode(",", $cities) . '"';

        $dd1 = Areas::whereNotNull('name')->get()->toArray();
        $localities = [];
        foreach ($dd1 as $key => $value) {
            $localities[] = $value['name'];
        }
        // $localities = '"' . implode(",", $localities) . '"';

        $dd1 = District::whereNotNull('name')->get()->toArray();
        $districts = [];
        foreach ($dd1 as $key => $value) {
            $districts[] = $value['name'];
        }
        $districts = '"' . implode(",", $districts) . '"';

        $dd1 = Taluka::whereNotNull('name')->get()->toArray();
        $talukas = [];
        foreach ($dd1 as $key => $value) {
            $talukas[] = $value['name'];
        }
        $talukas = '"' . implode(",", $talukas) . '"';

        $dd1 = Village::whereNotNull('name')->get()->toArray();
        $villages = [];
        foreach ($dd1 as $key => $value) {
            $villages[] = $value['name'];
        }
        $villages = '"' . implode(",", $villages) . '"';

        $dropdowns = DropdownSettings::get()->toArray();
        $dropdownsarr = [];
        foreach ($dropdowns as $key => $value) {
            $dropdownsarr[$value['dropdown_for']][] = $value['name'];
        }

        $property_configuration = [];
        foreach (config('constant.property_configuration') as $key => $value) {
            array_push($property_configuration, $value);
        }

        $propertyFor = '"Rent, Sell , Both"';
        // $PropertyType = '"' . implode(",", $dropdownsarr['property_construction_type']) . '"';
        // $PropertyType = '"Commercial, Residential"';
        $zone = '"' . implode(",", $dropdownsarr['property_zone']) . '"';
        $furnishedStatus = '"' . implode(",", $dropdownsarr['property_furniture_type']) . '"';
        $constructedallowed = '"Commercial, Industrial, Residential"';
        $washrooms_type_2 = '"Private Washrooms,Public Washrooms,Not-Available"';
        $availability_status = '"Available,Under construction"';
        $unit_available = '"Available,Rent Out,Sold Out"';
        $property_age = '"0-1 years,1-5 years,5-10 years,10+ years"';
        $yes_no = '"Yes,No"';
        $owner_is = '"Builder,Individual Owner,Investor"';
        $key_available_at = '"Office,Owner,Care Taker"';
        $arrDetails['Property For'] = $propertyFor;
        $arrDetails['Property Type'] = '"' . implode(",", $propertyTypeOptions) . '"';;
        $arrDetails['Category'] = '"' . implode(",", $categoryOptions) . '"';
        $arrDetails['Subcategory'] = '"' . implode(",", $subcategoryOptions) . '"';
        $arrDetails['Project'] = $projects;
        $arrDetails['city'] = '"' . implode(",", $cities) . '"';
        // $arrDetails['locality'] = '"' . implode(",", $localities) . '"';
        $arrDetails['zone'] = $zone;
        $arrDetails['Service Elavator'] = $yes_no;
        $arrDetails['Servant Room'] = $yes_no;
        $arrDetails['Hot'] = $yes_no;
        $arrDetails['Favourite'] = $yes_no;
        $arrDetails['Washrooms'] = $washrooms_type_2;
        $arrDetails['constructed allowed for'] = $constructedallowed;
        // $arrDetails['Pre Leased'] = $yes_no;
        $arrDetails['Availability'] = $availability_status;
        $arrDetails['Age of Property'] = $property_age;
        // $arrDetails['Amenities'] = $yes_no;
        // $arrDetails['Swimming Pool'] = $yes_no;
        // $arrDetails['Club house'] = $yes_no;
        // $arrDetails['Passenger Lift'] = $yes_no;
        // $arrDetails['Garden & Children Play Area'] = $yes_no;
        // $arrDetails['Service Lift'] = $yes_no;
        // $arrDetails['Streature Lift'] = $yes_no;
        // $arrDetails['Central AC'] = $yes_no;
        // $arrDetails['Gym'] = $yes_no;
        $arrDetails['Two Road Corner'] = $yes_no;
        $arrDetails['Owner is'] = $owner_is;
        $arrDetails['NRI'] = $yes_no;
        $arrDetails['Key available at'] = $key_available_at;
        $arrDetails['Available Status 1'] = $unit_available;
        $arrDetails['Furnished Status 1'] = $furnishedStatus;
        // $arrDetails['Available Status 2'] = $unit_available;
        // $arrDetails['Furnished Status 2'] = $furnishedStatus;
        // $arrDetails['Available Status 3'] = $unit_available;
        // $arrDetails['Furnished Status 3'] = $furnishedStatus;

        foreach ($allCells as $key => $value) {
            if (isset($arrDetails[$allFields[$key]])) {
                $validation = $spreadsheet->getActiveSheet()->getcell($value . '1')->getDataValidation();
                $validation->setType(DataValidation::TYPE_LIST);
                $validation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                $validation->setAllowBlank(false);
                $validation->setShowInputMessage(true);
                $validation->setShowErrorMessage(true);
                $validation->setShowDropDown(true);
                $validation->setErrorTitle('Input error');
                $validation->setError('Value is not in list.');
                $validation->setPromptTitle('Pick from list');
                $validation->setPrompt('Please pick a value from the drop-down list.');
                $validation->setFormula1($arrDetails[$allFields[$key]]);
                $validation->setSqref(strval($value . '2:' . $value . '1048576'));
                info($arrDetails[$allFields[$key]]);
            }
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save(public_path('imports/property_sample.xlsx'));
        return redirect(asset('imports/property_sample.xlsx'));
    }
    public function exportProperty(Request $request)
    {
        $properties = "";
        if ($request->category === 'landProp') {
            $properties = Properties::select('*')->with('Projects', 'District', 'Taluka', 'Village')->where('property_category', ['262', '256'])->whereNull('deleted_at')->get();
        } elseif ($request->category === 'indProp') {
            $properties = Properties::select('*')->with('Projects', 'District', 'Taluka', 'Village')->where('property_category', '261')->whereNull('deleted_at')->get();
        } else {
            $properties = Properties::select('*')->with('Projects', 'District', 'Taluka', 'Village')->where('property_category', '!=', ['261', '262', '256'])->whereNull('deleted_at')->get();
        }

        $dropdowns = DropdownSettings::get()->toArray();
        $dropdownsarr = [];
        foreach ($dropdowns as $key => $value) {
            $dropdownsarr[$value['id']] = $value;
        }
        $dropdowns = $dropdownsarr;
        $enqs = [];
        foreach ($properties as $key => $property) {
            $arr = [];
            $arr['Property For'] = '';
            $arr['Property Type'] = '';
            $arr['Property Category'] = '';
            $arr['configuration'] = '';
            $arr['Project Name'] = '';
            $arr['Address'] = '';
            $arr['District'] = '';
            $arr['Taluka'] = '';
            $arr['Village'] = '';
            $arr['Zone'] = '';
            $arr['Storage Centre Height'] = '';
            $arr['Length Of Plot'] = '';
            $arr['Width Of Plot'] = '';
            $arr['Entrance Width'] = '';
            $arr['Ceiling Height'] = '';
            $arr['Total Units In Project'] = '';
            $arr['Total No Of Floor'] = '';
            $arr['Total Units In Tower'] = '';
            $arr['Property On Floors'] = '';
            $arr['No Of Elavators'] = '';
            $arr['No Of Balcony'] = '';
            $arr['Total No Of Units'] = '';
            $arr['No Of Room'] = '';
            $arr['No Of Bathrooms'] = '';
            $arr['No Of Floors Allowed'] = '';
            $arr['Washrooms2 Type'] = '';
            $arr['No Of Side Open'] = '';
            $arr['Front Road Width'] = '';
            $arr['Construction Allowed For'] = '';
            $arr['Fsi'] = '';
            $arr['No Of Borewell'] = '';
            $arr['Availability Status'] = '';
            $arr['Property Age'] = '';
            $arr['Available From'] = '';
            $arr['Two Road Corner'] = '';
            $arr['Survey Number'] = '';
            $arr['Survey Plot Size'] = '';
            $arr['Survey Price'] = '';
            $arr['Tp Number'] = '';
            $arr['Fp Number'] = '';
            $arr['Fp Plot Size'] = '';
            $arr['Fp Plot Price'] = '';
            $arr['Service Elavator'] = '';
            $arr['Servant Room'] = '';
            $arr['Carpet Area'] = '';
            $arr['Salable Area'] = '';
            $arr['Carpet Plot Area'] = '';
            $arr['Salable Plot Area'] = '';
            $arr['Constructed Salable Area'] = '';
            $arr['Constructed Carpet Area'] = '';
            $arr['Constructed Builtup Area'] = '';
            $arr['Builtup Area'] = '';
            $arr['Terrace Carpet Area'] = '';
            $arr['Terrace Salable Area'] = '';
            $arr['Hot Property'] = '';
            $arr['Is Favourite'] = '';
            $arr['Owner Is'] = '';
            $arr['Owner Name'] = '';
            $arr['Owner Contact'] = '';
            $arr['Is Nri'] = '';
            $arr['Owner Email'] = '';
            $arr['Care Taker Name'] = '';
            $arr['Care Taker Contact'] = '';
            $arr['Key Available At'] = '';
            $arr['Fourwheller Parking'] = '';
            $arr['Twowheeler Parking'] = '';
            $arr['Property Source Refrence'] = '';
            $arr['Property Priority'] = '';
            $arr['Source Of Property'] = '';
            $arr['Is Pre Leased'] = '';
            $arr['Pre Leased Remarks'] = '';
            $arr['Location Link'] = '';

            $units = DB::table('land_units')->get();

            $salableArray = explode("_-||-_", $property->salable_area);
            $land_units = $units->where('id', $salableArray[1])->first();

            $carpetArray = explode("_-||-_", $property->carpet_area);
            $carpet_units = $units->where('id', $carpetArray[1])->first();

            $carpet_plotArray = explode("_-||-_", $property->carpet_plot_area);
            $carpet_plot_units = $units->where('id', $carpet_plotArray[1])->first();

            $salable_plotArray = explode("_-||-_", $property->salable_plot_area);
            $salable_plot_units = $units->where('id', $salable_plotArray[1])->first();

            $constructed_salableArray = explode("_-||-_", $property->constructed_salable_area);
            $constructed_salable_units = $units->where('id', $constructed_salableArray[1])->first();

            $constructed_carpetArray = explode("_-||-_", $property->constructed_carpet_area);
            $constructed_carpet_units = $units->where('id', $constructed_carpetArray[1])->first();

            $constructed_builtupArray = explode("_-||-_", $property->constructed_builtup_area);
            $constructed_builtup_units = $units->where('id', $constructed_builtupArray[1])->first();

            $builtupArray = explode("_-||-_", $property->builtup_area);
            $builtup_units = $units->where('id', $builtupArray[1])->first();
            $getBuiltup = $builtupArray[0] . ' ' . $builtup_units->unit_name;
            // dd($builtupArray[0],$builtup_units->unit_name);

            $terrace_carpetArray = explode("_-||-_", $property->terrace_carpet_area);
            $terrace_carpet_units = $units->where('id', $terrace_carpetArray[1])->first();

            $terrace_salableArray = explode("_-||-_", $property->terrace_salable_area);
            $terrace_salable_units = $units->where('id', $terrace_salableArray[1])->first();

            if (!empty($property->property_for)) {
                $arr['Property For'] = $property->property_for ? $property->property_for : '';
            }
            if (!empty($dropdowns[$property->property_type]['name'])) {
                $arr['Property Type'] = isset($dropdowns[$property->property_type]['name']) ? $dropdowns[$property->property_type]['name'] : '';
            }
            if (!empty($dropdowns[$property->property_category]['name'])) {
                $arr['Property Category'] = isset($dropdowns[$property->property_category]['name']) ? $dropdowns[$property->property_category]['name'] : '';
            }
            if (!empty($property->configuration)) {
                $subcategory = FacadesDB::table('dropdown_settings')->select('name')->where('id', '=', $property->configuration)->first();
                $arr['configuration'] = $property->configuration ? $property->configuration : '';
            }
            if (!empty($property->Projects->project_name)) {
                $arr['Project Name'] = $property->Projects != null ? $property->Projects->project_name : '';
            }
            if (!empty($property->Projects->address)) {
                $arr['Address'] = isset($property->Projects->address) ? $property->Projects->address : '';
            }
            if (!empty($property->District->name)) {
                $arr['District'] = isset($property->District->name) ? $property->District->name : '';
            }
            if (!empty($property->Taluka->name)) {
                $arr['Taluka'] = isset($property->Taluka->name) ? $property->Taluka->name : '';
            }
            if (!empty($property->Village->name)) {
                $arr['Village'] = isset($property->Village->name) ? $property->Village->name : '';
            }
            if (!empty($dropdowns[$property->zone]['name'])) {
                $arr['Zone'] = isset($dropdowns[$property->zone]['name']) ? $dropdowns[$property->zone]['name'] : '';
            }
            if (!empty(explode('_-||-_', $property->storage_centre_height)[0]) && !empty(explode('_-||-_', $property->storage_centre_height)[1])) {
                $arr['Storage Centre Height'] = (explode('_-||-_', $property->storage_centre_height)[0] . ' ' . explode('_-||-_', $property->storage_centre_height)[1]);
            }
            if (!empty(explode('_-||-_', $property->length_of_plot)[0]) && !empty(explode('_-||-_', $property->length_of_plot)[1])) {
                $arr['Length Of Plot'] = (explode('_-||-_', $property->length_of_plot)[0] . ' ' . explode('_-||-_', $property->length_of_plot)[1]);
            }
            if (!empty(explode('_-||-_', $property->width_of_plot)[0]) && !empty(explode('_-||-_', $property->width_of_plot)[1])) {
                $arr['Width Of Plot'] = (explode('_-||-_', $property->width_of_plot)[0] . ' ' . explode('_-||-_', $property->width_of_plot)[1]);
            }
            if (!empty(explode('_-||-_', $property->entrance_width)[0]) && !empty(explode('_-||-_', $property->entrance_width)[1])) {
                $arr['Entrance Width'] = (explode('_-||-_', $property->entrance_width)[0] . ' ' . explode('_-||-_', $property->entrance_width)[1]);
            }
            if (!empty(explode('_-||-_', $property->ceiling_height)[0]) && !empty(explode('_-||-_', $property->ceiling_height)[1])) {
                $arr['Ceiling Height'] = (explode('_-||-_', $property->ceiling_height)[0] . ' ' . explode('_-||-_', $property->ceiling_height)[1]);
            }
            if (!empty($property->total_units_in_project)) {
                $arr['Total Units In Project'] = $property->total_units_in_project ? $property->total_units_in_project : '';
            }
            if (!empty($property->total_no_of_floor)) {
                $arr['Total No Of Floor'] = $property->total_no_of_floor ? $property->total_no_of_floor : '';
            }
            if (!empty($property->total_units_in_tower)) {
                $arr['Total Units In Tower'] = $property->total_units_in_tower ? $property->total_units_in_tower : '';
            }
            if (!empty($property->property_on_floors)) {
                $arr['Property On Floors'] = $property->property_on_floors ? $property->property_on_floors : '';
            }
            if (!empty($property->no_of_elavators)) {
                $arr['No Of Elavators'] = $property->no_of_elavators ? $property->no_of_elavators : '';
            }
            if (!empty($property->no_of_balcony)) {
                $arr['No Of Balcony'] = $property->no_of_balcony ? $property->no_of_balcony : '';
            }
            if (!empty($property->total_no_of_units)) {
                $arr['Total No Of Units'] = $property->total_no_of_units ? $property->total_no_of_units : '';
            }
            if (!empty($property->no_of_room)) {
                $arr['No Of Room'] = $property->no_of_room ? $property->no_of_room : '';
            }
            if (!empty($property->no_of_bathrooms)) {
                $arr['No Of Bathrooms'] = $property->no_of_bathrooms ? $property->no_of_bathrooms : '';
            }
            if (!empty($property->no_of_floors_allowed)) {
                $arr['No Of Floors Allowed'] = $property->no_of_floors_allowed ? $property->no_of_floors_allowed : '';
            }
            if (!empty($property->washrooms2_type)) {
                $arr['Washroom Type'] = $property->washrooms2_type ? $property->washrooms2_type : '';
            }
            if (!empty($property->no_of_side_open)) {
                $arr['No Of Side Open'] = $property->no_of_side_open ? $property->no_of_side_open : '';
            }
            if (!empty(explode('_-||-_', $property->front_road_width)[0]) && !empty(explode('_-||-_', $property->front_road_width)[1])) {
                $arr['Front Road Width'] = (explode('_-||-_', $property->front_road_width)[0] . ' ' . explode('_-||-_', $property->front_road_width)[1]);
            }
            if (!empty($property->construction_allowed_for)) {
                $arr['Construction Allowed For'] = $property->construction_allowed_for ? $property->construction_allowed_for : '';
            }
            if (!empty($property->fsi)) {
                $arr['Fsi'] = $property->fsi ? $property->fsi : '';
            }
            if (!empty($property->no_of_borewell)) {
                $arr['No Of Borewell'] = $property->no_of_borewell ? $property->no_of_borewell : '';
            }
            if (!empty($property->availability_status)) {
                $arr['Availability Status'] = $property->availability_status ? $property->availability_status : '';
            }
            if (!empty($property->propertyage)) {
                $arr['Property Age'] = $property->propertyage ? $property->propertyage : '';
            }
            if (!empty($property->available_from)) {
                $arr['Available From'] = $property->available_from ? $property->available_from : '';
            }
            if (!empty($property->two_road_corner)) {
                $arr['Two Road Corner'] = $property->two_road_corner ? 'Yes' : 'No';
            }
            if (!empty($property->survey_number)) {
                $arr['Survey Number'] = $property->survey_number ? $property->survey_number : '';
            }
            if (!empty(explode('_-||-_', $property->survey_plot_size)[0]) && !empty(explode('_-||-_', $property->survey_plot_size)[1])) {
                $arr['Survey Plot Size'] = (explode('_-||-_', $property->survey_plot_size)[0] . ' ' . $dropdowns[explode('_-||-_', $property->survey_plot_size)[1]]['name']);
            }
            if (!empty($property->survey_price)) {
                $arr['Survey Price'] = $property->survey_price ? $property->survey_price : '';
            }
            if (!empty($property->tp_number)) {
                $arr['Tp Number'] = $property->tp_number ? $property->tp_number : '';
            }
            if (!empty($property->fp_number)) {
                $arr['Fp Number'] = $property->fp_number ? $property->fp_number : '';
            }

            if (!empty(explode('_-||-_', $property->fp_plot_size)[0]) && !empty(explode('_-||-_', $property->fp_plot_size)[1])) {
                $arr['Fp Plot Size'] = (explode('_-||-_', $property->fp_plot_size)[0] . ' ' . $dropdowns[explode('_-||-_', $property->fp_plot_size)[1]]['name']);
            }
            if (!empty($property->fp_plot_price)) {
                $arr['Fp Plot Price'] = $property->fp_plot_price ? $property->fp_plot_price : '';
            }
            if (!empty($property->service_elavator)) {
                $arr['Service Elavator'] = $property->service_elavator ? 'Yes' : 'No';
            }
            if (!empty($property->servant_room)) {
                $arr['Servant Room'] = $property->servant_room ? 'Yes' : 'No';
            }
            if (!empty(explode('_-||-_', $property->carpet_area)[0]) && !empty($carpet_units->unit_name)) {
                $arr['Carpet Area'] = (explode('_-||-_', $property->carpet_area)[0] . ' ' . $carpet_units->unit_name);
            }

            if (!empty(explode('_-||-_', $property->salable_area)[0]) && !empty($land_units->unit_name)) {
                $arr['Salable Area'] = (explode('_-||-_', $property->salable_area)[0] . ' ' . $land_units->unit_name);
            }
            if (!empty(explode('_-||-_', $property->carpet_plot_area)[0]) && !empty($carpet_plot_units->unit_name)) {
                $arr['Carpet Plot Area'] = (explode('_-||-_', $property->carpet_plot_area)[0] . ' ' . $carpet_plot_units->unit_name);
            }
            if (!empty(explode('_-||-_', $property->salable_plot_area)[0]) && !empty($salable_plot_units->unit_name)) {
                $arr['Salable Plot Area'] = (explode('_-||-_', $property->salable_plot_area)[0] . ' ' . $salable_plot_units->unit_name);
            }
            if (!empty(explode('_-||-_', $property->constructed_salable_area)[0]) && !empty($constructed_salable_units->unit_name)) {
                $arr['Constructed Salable Area'] = (explode('_-||-_', $property->constructed_salable_area)[0] . ' ' . $constructed_salable_units->unit_name);
            }
            if (!empty(explode('_-||-_', $property->constructed_carpet_area)[0]) && !empty($constructed_carpet_units->unit_name)) {
                $arr['Constructed Carpet Area'] = (explode('_-||-_', $property->constructed_carpet_area)[0] . ' ' . $constructed_carpet_units->unit_name);
            }
            if (!empty(explode('_-||-_', $property->constructed_builtup_area)[0]) && !empty($constructed_builtup_units->unit_name)) {
                $arr['Constructed Builtup Area'] = (explode('_-||-_', $property->constructed_builtup_area)[0] . ' ' . $constructed_builtup_units->unit_name);
            }
            if (!empty(explode('_-||-_', $property->builtup_area)[0]) && !empty($builtup_units->unit_name)) {
                $arr['Builtup Area'] = (explode('_-||-_', $property->builtup_area)[0] . ' ' . $builtup_units->unit_name);
            }
            if (!empty(explode('_-||-_', $property->terrace_carpet_area)[0]) && !empty($property->terrace_carpet_area)) {
                $arr['Terrace Carpet Area'] = (explode('_-||-_', $property->terrace_carpet_area)[0] . ' ' . $dropdowns[explode('_-||-_', $property->terrace_carpet_area)[1]]['name']);
            }
            if (!empty(explode('_-||-_', $property->terrace_salable_area)[0]) && !empty($terrace_salable_units->unit_name)) {
                $arr['Terrace Salable Area'] = (explode('_-||-_', $property->terrace_salable_area)[0] . ' ' . $terrace_salable_units->unit_name);
            }
            if (!empty($property->hot_property)) {
                $arr['Hot Property'] = $property->hot_property ? 'Yes' : 'No';
            }
            if (!empty($property->is_favourite)) {
                $arr['Is Favourite'] = $property->is_favourite ? 'Yes' : 'No';
            }
            if (!empty($dropdowns[$property->owner_is]['name'])) {
                $arr['Owner Is'] = isset($dropdowns[$property->owner_is]['name']) ? $dropdowns[$property->owner_is]['name'] : '';
            }
            if (!empty($property->owner_name)) {
                $arr['Owner Name'] = $property->owner_name ? $property->owner_name : '';
            }
            if (!empty($property->owner_contact)) {
                $arr['Owner Contact'] = $property->owner_contact ? $property->owner_contact : '';
            }
            if (!empty($property->is_nri)) {
                $arr['Is Nri'] = $property->is_nri ? 'Yes' : 'No';
            }
            if (!empty($property->owner_email)) {
                $arr['Owner Email'] = $property->owner_email ? $property->owner_email : '';
            }
            if (!empty($property->care_taker_name)) {
                $arr['Care Taker Name'] = $property->care_taker_name ? $property->care_taker_name : '';
            }
            if (!empty($property->care_taker_contact)) {
                $arr['Care Taker Contact'] = $property->care_taker_contact ? $property->care_taker_contact : '';
            }
            if (!empty($property->key_available_at)) {
                $arr['Key Available At'] = $property->key_available_at ? $property->key_available_at : '';
            }
            if (!empty($property->fourwheller_parking)) {
                $arr['Fourwheller Parking'] = $property->fourwheller_parking ? $property->fourwheller_parking : '';
            }
            if (!empty($property->twowheeler_parking)) {
                $arr['Twowheeler Parking'] = $property->twowheeler_parking ? $property->twowheeler_parking : '';
            }
            if (!empty($property->property_source_refrence)) {
                $arr['Property Source Refrence'] = $property->property_source_refrence ? $property->property_source_refrence : '';
            }
            if (!empty($dropdowns[$property->Property_priority]['name'])) {
                $arr['Property Priority'] = isset($dropdowns[$property->Property_priority]['name']) ? $dropdowns[$property->Property_priority]['name'] : '';
            }
            if (!empty($dropdowns[$property->source_of_property]['name'])) {
                $arr['Source Of Property'] = isset($dropdowns[$property->source_of_property]['name']) ? $dropdowns[$property->source_of_property]['name'] : '';
            }
            if (!empty($property->is_pre_leased)) {
                $arr['Is Pre Leased'] = $property->is_pre_leased ? 'Yes' : 'No';
            }
            if (!empty($property->pre_leased_remarks)) {
                $arr['Pre Leased Remarks'] = $property->pre_leased_remarks ? $property->pre_leased_remarks : '';
            }
            if (!empty($property->location_link)) {
                $arr['Location Link'] = $property->location_link ? $property->location_link : '';
            }

            for ($i = 0; $i < 5; $i++) {
                $arr['Unit ' . ($i + 1)] = '';
            }

            $type = $arr['Property Type'];
            if (!empty(json_decode($property->unit_details)[0])) {
                $units = json_decode($property->unit_details);

                foreach ($units as $key => $value) {
                    if (isset($arr['Unit ' . ($key + 1)])) {
                        $arr['Unit ' . ($key + 1)] = $arr['Unit ' . ($key + 1)] . (isset($value[0]) ? $value[0] : '') . (isset($value[1]) ? $value[1] : '');
                        if (($type == 'Vila,Bunglow' || $type == 'Penthouse' || $type == 'Farmhouse' || $type == 'Storage,industrial') && ($property->property_for == 'Sell' || $property->property_for == 'Both')) {
                            $arr['Unit ' . ($key + 1)] = $arr['Unit ' . ($key + 1)] . ' Price:' . (isset($value[7]) ? $value[7] : '');
                        } elseif (!empty($value[3])) {
                            $arr['Unit ' . ($key + 1)] = $arr['Unit ' . ($key + 1)] . ' Price:' . (isset($value[3]) ? $value[3] : '');
                        }
                        if (!empty($value[4])) {
                            $arr['Unit ' . ($key + 1)] = $arr['Unit ' . ($key + 1)] . ' Rent:' . (isset($value[4]) ? $value[4] : '');
                        }
                        if (!empty($dropdowns[$value[8]]['name'])) {
                            $arr['Unit ' . ($key + 1)] = $arr['Unit ' . ($key + 1)] . ' Furnished:' . $dropdowns[$value[8]]['name'];
                        }
                    }
                }
            }
            array_push($enqs, $arr);
        }

        $time = time() . Session::get('parent_id');
        File::isDirectory(public_path('excel')) or File::makeDirectory(public_path('excel'), 0777, true, true);
        (new FastExcel(collect($enqs)))->export(public_path('excel/' . $time . '_file.xlsx'));

        echo asset('excel/' . $time . '_file.xlsx');
    }
    public function saveProperty(Request $request)
    {
        // dd("reqs:",($request->all()));
        if (!empty($request->id) && $request->id != '') {
            $data = Properties::find($request->id);
            if (empty($data)) {
                $data = new Properties();
            }
        } else {
            $data = new Properties();
        }
        $data->user_id = Session::get('parent_id');
        $data->added_by = Auth::user()->id;

        // project condition start
        $requested_project_id = $request->project_id;
        $searched = Projects::where(function ($query) use ($requested_project_id) {
            $query->where('id', $requested_project_id)
                  ->orWhere('project_name', $requested_project_id);
        })
        ->where('user_id', Auth::user()->id)
        ->first();

        $project_id = null;

        if($searched == null) {
            $new_project = new Projects();
            $new_project->fill([
                'project_name' => $request->project_id,
                'address' => $request->address,
                'user_id' => $data->user_id,
                'area_id' => $request->locality_id,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
                'location_link' => $request->property_link,
                'is_indirectly_store' => 1,
            ])->save();
            $project_id = $new_project->id;
        } else {
            $project_id = $searched->id;
        }

        $data->project_id = $project_id;
        // project condition end

        $surveyprice = 0.0;
        if ($request->survey_price) {
            $surveyprice = str_replace(',', '', $request->survey_price);
        }
        $data->property_for = $request->property_for;
        $data->res_more = $request->res_more;
        $data->property_type = $request->property_type;
        $data->property_category = $request->property_category;
        $data->configuration = $request->configuration;
        $data->city_id = $request->city_id;
        $data->locality_id = $request->locality_id;
        $data->address = $request->address;
        $data->location_link = $request->property_link;
        $data->district_id = $request->district_id;
        $data->taluka_id = $request->taluka_id;
        $data->village_id = $request->village_id;
        $data->res_more = $request->res_more;
        $data->zone_id = $request->zone_id;
        $data->constructed_carpet_area = $request->constructed_carpet_area;
        $data->constructed_salable_area = $request->constructed_salable_area;
        $data->constructed_builtup_area = $request->constructed_builtup_area;
        $data->salable_plot_area = $request->salable_plot_area;
        $data->carpet_plot_area = $request->carpet_plot_area;
        $data->salable_area = $request->salable_area;
        $data->carpet_area = $request->carpet_area;
        $data->storage_centre_height = $request->storage_centre_height;
        $data->length_of_plot = $request->length_of_plot;
        $data->width_of_plot = $request->width_of_plot;
        $data->entrance_width = $request->entrance_width;
        $data->ceiling_height = $request->ceiling_height;
        $data->builtup_area = $request->builtup_area;
        $data->plot_area = $request->plot_area;
        $data->terrace = $request->terrace;
        $data->construction_area = $request->construction_area;
        $data->terrace_carpet_area = $request->terrace_carpet_area;
        $data->terrace_salable_area = $request->terrace_salable_area;
        $data->total_units_in_project = $request->total_units_in_project;
        $data->total_no_of_floor = $request->total_no_of_floor;
        $data->total_units_in_tower = $request->total_units_in_tower;
        $data->property_on_floors = $request->property_on_floors;
        $data->no_of_elavators = $request->no_of_elavators;
        $data->no_of_balcony = $request->no_of_balcony;
        $data->total_no_of_units = $request->total_no_of_units;
        $data->no_of_room = $request->no_of_room;
        $data->no_of_bathrooms = $request->no_of_bathrooms;
        $data->no_of_floors_allowed = $request->no_of_floors_allowed;
        $data->washrooms2_type = $request->washrooms2_type;
        $data->no_of_side_open = $request->no_of_side_open;
        $data->service_elavator = $request->service_elavator;
        $data->servant_room = $request->servant_room;
        $data->hot_property = $request->hot_property;
        $data->week_end_villa = $request->week_end_villa;
        $data->is_favourite = $request->is_favourite;
        $data->front_road_width = $request->front_road_width;
        $data->construction_allowed_for = is_array($request->construction_allowed_for) ? implode(",", $request->construction_allowed_for) : $request->construction_allowed_for;
        $data->construction_documents = is_array($request->construction_documents) ? implode(",", $request->construction_documents) : $request->construction_documents;
        $data->fsi = $request->fsi;
        $data->no_of_borewell = $request->no_of_borewell;
        $data->fourwheller_parking = $request->fourwheller_parking;
        $data->twowheeler_parking = $request->twowheeler_parking;
        $data->is_pre_leased = $request->is_pre_leased;
        $data->is_terrace = $request->is_terrace;
        $data->pre_leased_remarks = $request->pre_leased_remarks;
        $data->Property_priority = $request->Property_priority;
        $data->source_of_property = $request->property_source;
        $data->property_source_refrence = $request->refrence;
        $data->availability_status = $request->availability_status;
        $data->propertyage = $request->propertyage;
        $data->available_from = $request->available_from;
        $data->amenities = $request->amenities;
        $data->other_industrial_fields = $request->other_industrial_fields;
        $data->two_road_corner = $request->two_road_corner;
        $data->unit_details = $request->unit_details;
        $data->survey_number = $request->survey_number;
        $data->survey_plot_size = $request->survey_plot_size;
        $data->survey_price = $surveyprice;
        $data->tp_number = $request->tp_number;
        $data->fp_number = $request->fp_number;
        $data->fp_plot_size = $request->fp_plot_size;
        $data->fp_plot_price = $request->fp_plot_price;
        $data->owner_is = $request->owner_is;
        $data->owner_name = $request->owner_name;
        $data->owner_contact = $request->owner_contact;
        $data->contact_country_code = $request->contact_country_code;
        $data->country_code = $request->country_code;
        $data->owner_email = $request->owner_email;
        $data->owner_nri = $request->owner_nri;
        $data->contact_details = $request->contact_details;
        $data->care_taker_name = $request->care_taker_name;
        $data->care_taker_contact = $request->care_taker_contact;
        $data->key_available_at = $request->key_available_at;
        $data->conference_room = $request->conference_room;
        $data->reception_area = $request->reception_area;
        $data->pantry_type = $request->pantry_type;
        $data->remarks = $request->remarks;
        $data->state_id = $request->state_id;
        $data->other_contact_details = $request->other_contact_details;
        $data->other_name = implode(",", $request->other_name);
        $data->other_contact = implode(",", $request->other_contact);
        $data->position = implode(",", $request->position);
        $data->prop_status = 1;
        $data->save();
        if (!empty($request->carpet_measurement)) {
            Helper::add_default_measuerement($request->carpet_measurement);
        }
        if (!empty($request->super_builtup_measurement)) {
            Helper::add_default_measuerement($request->super_builtup_measurement);
        }
        if (!empty($request->plot_measurement)) {
            Helper::add_default_measuerement($request->plot_measurement);
        }
        if (!empty($request->terrace_measuremnt)) {
            Helper::add_default_measuerement($request->terrace_measuremnt);
        }

        return response()->json(['status' => 'success', 'data' => $data]);
    }

    // shared 2
    public function sharedPropertyIndex(Request $request)
    {
        if ($request->ajax()) {
            $dropdowns = DropdownSettings::get()->toArray();
            $land_units = LandUnit::all();

            $dropdownsarr = [];
            foreach ($dropdowns as $key => $value) {
                $dropdownsarr[$value['id']] = $value;
            }
            $dropdowns = $dropdownsarr;
            // $data = SharedProperty::where('user_id', Auth::user()->id)
            //     ->Where('accepted', '1')
            //     ->with(['Property', 'User'])->get();
            // $data = SharedProperty::with(['Property', 'User'])
            //     // ->where('partner_id', Auth::user()->id)
            //     // ->Where('accepted', '1')
            //     ->get();
            $data = SharedProperty::with('Property', 'User')->where('user_id', Auth::user()->id)->get();

            // dd("SharedProperty", $data, Auth::user()->id);
            return DataTables::of($data)
                ->editColumn('project_name', function ($row) use ($request) {
                    $first = '<td style="vertical-align:top">
						<font size="3"><a href="#" style="font-weight: bold;">' . ((isset($row->Property->Projects->project_name)) ? $row->Property->Projects->project_name : '') . '</a>';
                    $first_middle = '';
                    if (isset($row->Property->Projects->is_prime) && $row->Property->Projects->is_prime) {
                        $first_middle = '<img style="height:24px" src="' . asset('assets/images/primeProperty.png') . '" alt="">';
                    }
                    if ($row->Property->hot_property) {
                        $first_middle = $first_middle . '<img style="height:24px" src="' . asset('assets/images/hotProperty.png') . '" alt="">';
                    }
                    $first_end = '</font>';
                    $second = '<br> <a href="' . $row->Property->location_link . '" target="_blank"> <font size="2" style="font-style:italic">Locality: ' . ((!empty($row->Property->Projects->Area->name)) ? $row->Property->Projects->Area->name : '') . '	</font> </a>';
                    // $third = '<br> <font size="2" style="font-style:italic">Added On: ' . Carbon::parse($row->Property->created_at)->format('d-m-Y') . '</font>';
                    $last = '</td>';

                    '</td>';
                    return $first . $first_middle . $first_end . $second . $last;

                    return '';
                })
                ->editColumn('super_builtup_area', function ($row) use ($dropdowns, $land_units) {
                    $new_array = array('', 'office space', 'Co-working', 'Ground floor', '1st floor', '2nd floor', '3rd floor', 'Warehouse', 'Cold Storage', 'ind. shed', 'Commercial Land', 'Agricultural/Farm Land', 'Industrial Land', '1 rk', '1bhk', '2bhk', '3bhk', '4bhk', '5bhk', '5+bhk', 'Test', 'testw', 'fgfgmf', 'sfbsbsfn', '252626', 'sh');
                    if ($row->Property->property_for == 'Both') {
                        $forr = 'Rent & Sell';
                    } else {
                        $forr = $row->Property->property_for;
                    }

                    $sub_cat = ((!empty($dropdowns[$row->Property->property_category]['name'])) ? ' | ' . $dropdowns[$row->Property->property_category]['name'] : '');
                    if (!is_null($row->Property->configuration)) {
                        $catId = (int) $row->Property->configuration;
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
                    if ($row->Property->property_category == '256') {
                        $fstatus = '';
                    } else {
                        $fstatus = '';
                        if (!empty($row->Property->unit_details) && !empty(json_decode($row->Property->unit_details)[0])) {
                            $vv = json_decode($row->Property->unit_details);
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

                    // $salable_area_print = $this->generateAreaDetails($row->Property, $dropdowns[$row->Property->property_category]['name'], $dropdowns);
                    $salable_area_print = $this->generateAreaUnitDetails($row, $dropdowns[$row->property_category]['name'], $land_units);

                    if (empty($salable_area_print)) {
                        $salable_area_print = "Area Not Available";
                    }
                    try {
                        return '
					<td style="vertical-align:top">
					   ' . ((!empty($forr)) ? $forr : '') . $category . '
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
                ->editColumn('owner_details', function ($row) {
                    $detail = '';
                    if (!empty($row->User)) {
                        $detail = '<td align="center" style="vertical-align:top">
							' . $row->User->first_name . ' ' . $row->User->last_name . ' <br>
							<a href="tel:' . $row->User->office_number . '">' . $row->User->mobile_number . '</a>
							 </td>';
                    };
                    return $detail;
                })
                ->editColumn('units', function ($row) {
                    $all_units = [];
                    if (!empty($row->Property->unit_details) && !empty(json_decode($row->Property->unit_details)[0])) {
                        $vv = json_decode($row->Property->unit_details);
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
                            $vvv = $vvv . ((!empty($value[0])) ? $value[0] . '<br>' : '') . ((!empty($value[1])) ? $value[1] : '');
                        }
                        return $vvv;
                    }

                    return "N/A";
                })
                ->editColumn('price', function ($row) {
                    //$all_units = [];
                    $all_units = [];
                    // dd(($row->Property->unit_details));
                    if (!empty($row->Property->unit_details) && !empty(json_decode($row->Property->unit_details)[0])) {
                        $vv = json_decode($row->Property->unit_details);
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
                ->editColumn('remarks', function ($row) {
                    return $row->Property->remarks;
                })
                ->rawColumns(['project_name', 'super_builtup_area', 'remarks', 'property_unit_no', 'units', 'price', 'owner_details'])
                ->make(true);
        }

        return view('admin.properties.shared_index');
    }
    public function importProperty(Request $request)
    {
        // dd("store prop");
        $file = $request->file('csv_file');
        $name = Str::random(10) . '.xlsx';
        $file->move(storage_path('app'), $name);
        try {
            $collection = (new FastExcel)->import(storage_path('app/' . $name));
        } catch (\Throwable $th) {
            $collection = [];
        }

        unlink(storage_path('app/' . $name));
        // dd("collection",$collection);
        foreach ($collection as $key => $value) {
            // dd("value",$value);
            $project_id = null;
            if (!empty($value['Project'])) {
                $area_name = Areas::where('name', 'like', '%' . $value['Project'])->first();
                // $project = Projects::where('project_name', 'like', '%' . $value['Project'] . '%')->first();
                $projectParts = explode(" - ", $value['Project']);
                $modifiedProjectName = $projectParts[0];
                $project = Projects::where('project_name', 'LIKE', "%$modifiedProjectName%")->first();
                // $project = Projects::where('project_name', 'like', '%' . $value['Project'] . '%')->when($value['Project'] && $area_name->name), function ($query) use ($area_name) {
                //     $query->where('area_id', $area_name->id);
                // })->first();
            }

            if (!empty($project->id) && !empty($value['Project'])) {
                $project_id = $project->id;
            }

            $property_type_id = null;
            $property_type = DropdownSettings::where('name', 'like', '%' . $value['Property Type'] . '%')->first();

            if (!empty($property_type->id) && !empty($value['Property Type'])) {
                $property_type_id = $property_type->id;
            }

            $specific_property_id = null;
            $specific_property = DropdownSettings::where('name', 'like', '%' . $value['Category'] . '%')->first();
            if (!empty($specific_property->id) && !empty($value['Category'])) {
                $specific_property_id = $specific_property->id;
            }

            $Configuration_id = null;
            $Configuration = DropdownSettings::where('name', 'like', "%{$value['Subcategory']}%")->where('dropdown_for', 'property_sub_category')->first();
            if (!empty($Configuration->id) && !empty($value['Subcategory'])) {
                $Configuration_id = $Configuration->user_id;
            }

            $project = Projects::where('project_name', 'LIKE', "%$modifiedProjectName%")->first();

            $carpet_measurement_id = null;
            // $carpet_measurement = DropdownSettings::where('name', 'like', '%' . $value['Carpet Area'] . '%')->first();
            // if (!empty($carpet_measurement->id) && !empty($value['Carpet Area'])) {
            //     $carpet_measurement_id = $carpet_measurement->id;
            // }

            $city_id = null;
            $cities = FacadesDB::table('city')->where('name', 'like', '%' . $value['city'] . '%')->first();
            if (!empty($cities->id) && !empty($value['city'])) {
                $city_id = $cities->id;
            }
            // $super_measurement_id = null;
            // $super_measurement = DropdownSettings::where('name', 'like', '%' . $value['Builtup Area'] . '%')->first();

            // if (!empty($super_measurement->id) && !empty($value['Builtup Area'])) {
            //     $super_measurement_id = $super_measurement->id;
            // }
            $furnished_status_id[] = null;
            $arr = [];
            $array = [1 => 'Furnished Status 1', 2 => 'Furnished Status 2', 3 => 'Furnished Status 3'];
            // foreach($array as $key => $d){
            //     //dd($value['Wing '. $key]);
            //     $dataUnit[]=

            //     [array_push($arr, $value['Wing 1']),
            //     array_push($arr, 'unit:'.$value['Unit '. $key]),
            //     array_push($arr, 'available_status:'.$value['Available Status '. $key]),
            //     array_push($arr, 'price_rent:'.$value['Price Rent '. $key]),
            //     array_push($arr, 'price:'.$value['Price '. $key]),
            //     array_push($arr,'furnished_status:'.$value['Furnished Status '. $key]),
            //     ];
            //     array_push($dataUnit, $arr);
            //     $furnished_status = DropdownSettings::where('name', 'like', '%' . $d . '%')->first();

            //     if (!empty($furnished_status->id) && !empty($d)) {
            //         $furnished_status_id = $furnished_status->id;
            //     }
            //     // $dataUnit = [];
            //     // $arr = [];
            //     // array_push($arr, 'wing:'.$value['Wing '. $key]);
            //     // array_push($arr, 'unit:'.$value['Unit '. $key]);
            //     // array_push($arr, 'available_status:'.$value['Available Status '. $key]);
            //     // array_push($arr, 'price_rent:'.$value['Price Rent '. $key]);
            //     // array_push($arr, 'price:'.$value['Price '. $key]);
            //     // array_push($arr,'furnished_status:'.$value['Furnished Status '. $key]);
            //     // array_push($dataUnit, $arr);
            // }

            $dataUnit = [];
            $arr = [];
            array_push($arr, $value['Wing 1']);
            array_push($arr, $value['Unit 1']);
            array_push($arr, $value['Available Status 1']);
            array_push($arr, $value['Price Rent 1']);
            array_push($arr, $value['Price 1']);
            array_push($arr, $value['Furnished Status 1']);
            array_push($arr, "");
            array_push($arr, "");
            array_push($arr, "");
            array_push($dataUnit, $arr);
            // $arr = [];
            // array_push($arr, $value['Wing 2']);
            // array_push($arr, $value['Unit 2']);
            // array_push($arr, $value['Available Status 2']);
            // array_push($arr, $value['Price Rent 2']);
            // array_push($arr, $value['Price 2']);

            // array_push($arr, $value['Furnished Status 2']);
            // array_push($dataUnit, $arr);
            // $arr = [];
            // array_push($arr, $value['Wing 3']);
            // array_push($arr, $value['Unit 3']);
            // array_push($arr, $value['Available Status 3']);
            // array_push($arr, $value['Price Rent 3']);
            // array_push($arr, $value['Price 3']);
            // array_push($arr, $value['Furnished Status 3']);
            // array_push($dataUnit, $arr);
            // $dataUnit['array2'] = [$dataUnit[1]];
            $unit[] = array_merge($dataUnit[0]);

            $hot_property = 0;
            if ($value['Hot'] == 'Yes') {
                $hot_property = 1;
            }

            $created_at = Carbon::now()->format('Y-m-d H:i:s');
            if (isset($value['CreatedOn']) == false) {
                $created_at = Carbon::parse($created_at)->format('Y-m-d H:i:s');
            }

            $contact_details = [];
            $arr = [];
            array_push($arr, $value['Owner Name']);
            array_push($arr, $value['Contact']);
            array_push($arr, 'Other contact No.');
            array_push($contact_details, $arr);
            $arr = [];
            array_push($arr, $value['Owner Name']);
            array_push($arr, $value['Contact']);
            array_push($arr, 'Other contact No.');
            array_push($contact_details, $arr);
            if (!empty($project_id)) {
                $data = new Properties();
                $pData =   Properties::create([
                    'added_by' => Auth::user()->id,
                    'user_id' => Session::get('parent_id'),
                    'building_id' => $project_id,
                    'project_id' => $project_id,
                    'property_for' => $value['Property For'],
                    'property_type' => $property_type_id,
                    'property_category' => $specific_property_id,
                    'configuration' => $Configuration_id,
                    'city_id' => $city_id,
                    // 'property_wing' => $value['Wing'],
                    // 'property_unit_no' => $value['UnitNo'],
                    'unit_details' => json_encode($unit),
                    'constructed_carpet_area' => !empty($value['Constructed Carpet Area']) ? $value['Constructed Carpet Area'] . '_-||-_1' : '_-||-_1',
                    'constructed_builtup_area' => !empty($value['Constructed Builtup Area']) ? $value['Constructed Builtup Area'] . '_-||-_1' : '_-||-_1',
                    'builtup_area' => !empty($value['Salable Plot Area']) ? $value['Salable Plot Area'] . '_-||-_1' : '',
                    'plot_area' => !empty($value['Plot Area']) ? $value['Plot Area'] . '_-||-_1' : '',
                    'salable_plot_area' => !empty($value['Salable Plot Area']) ? $value['Salable Plot Area'] . '_-||-_1' : '',
                    'carpet_plot_area' => !empty($value['Carpet Area']) ? $value['Carpet Area'] . '_-||-_1' : '',
                    'constructed_salable_area' => !empty($value['Constructed Salable Area']) ? $value['Constructed Salable Area'] . '_-||-_1' :  '_-||-_1',
                    'terrace_carpet_area' => !empty($value['Terrace Carpet Area']) ? $value['Terrace Carpet Area'] . '_-||-_1' :  '_-||-_1',
                    'carpet_measurement' =>  !empty($value['Carpet Measurement']) ? $value['Carpet Measurement'] . '_-||-_1' :  '_-||-_1',
                    'salable_area' => !empty($value['Salable Area']) ? $value['Salable Area'] . '_-||-_1'  :  '_-||-_1',
                    'location_link' => !empty($value['location link']) ? $value['location link']  :  '_-||-_1',
                    'super_builtup_measurement' =>  !empty($value['Super Builtup Measurement']) ? $value['Super Builtup Measurement']  :  '_-||-_1',
                    'hot_property' => $hot_property,
                    'furnished_status' => $furnished_status_id,
                    'construction_area' =>  '_-||-_1',
                    'carpet_area' =>  '_-||-_1',
                    'terrace_salable_area' =>  '_-||-_1',
                    'ceiling_height' =>  '_-||-_1',
                    'remarks' =>  !empty($value['remarks']) ? $value['remarks']  :  'remarks',
                    // 'price' => $value['Price'] . ' ' . $value['Price Unit'],
                    'owner_details' => json_encode($contact_details),
                    'property_remarks' => "",
                    'prop_status' => "1",

                    'created_at' => $created_at,
                ]);
            }
        }
    }
    public function getSpecificProperty(Request $request)
    {
        // for edit selected
        if (!empty($request->id)) {
            $data = Properties::where('id', $request->id)->first();
            return json_encode($data);
        }
    }

    public function destroy(Request $request)
    {
        if (!empty($request->id)) {
            $data = Properties::where('id', $request->id)->delete();
            if ($data) {
                $data = [];
                $data['user_id'] = Session::get('parent_id');
                $data['action_by'] = Auth::User()->id;
                $data['action_on'] = $request->id;
                $data['action'] = 'deleted';
                PropertyReport::create($data);
            }
            return json_encode($data);
        }
        if (!empty($request->allids) && isset(json_decode($request->allids)[0])) {
            $data = Properties::whereIn('id', json_decode($request->allids))->delete();
            if ($data) {
                foreach (json_decode($request->allids) as $key => $value) {
                    $data = [];
                    $data['user_id'] = Session::get('parent_id');
                    $data['action_by'] = Auth::User()->id;
                    $data['action_on'] = $value;
                    $data['action'] = 'deleted';
                    PropertyReport::create($data);
                }
            }
            return json_encode($data);
        }
    }

    public function view($id)
    {
        $property = Properties::with('Projects', 'District', 'Taluka', 'Village')->find(Helper::theDecrypt($id));
        $dropdowns = DropdownSettings::get()->toArray();
        $land_units = LandUnit::all();
        $vv = PropertyViewer::create(['user_id' => Session::get('parent_id'), 'visited_by' => Auth::user()->id, 'property_id' => $property->id]);
        $dropdownsarr = [];
        foreach ($dropdowns as $key => $value) {
            $dropdownsarr[$value['id']] = $value;
        }
        $dropdowns = $dropdownsarr;
        $unitDetails = json_decode($property->unit_details, true);
        $raw_unit_price = !empty($unitDetails[0][4]) ? $unitDetails[0][4] : (!empty($unitDetails[0][7]) ? $unitDetails[0][7] : $unitDetails[0][3]);
        $unit_price = (int)str_replace(',', '', $raw_unit_price); // Convert to integer
        $survey_price = (int)str_replace(',', '', $property->survey_price); // Convert to integer

        $area_parts = explode("_-||-_", $property->salable_area);
        $area_size = str_replace(',', '', $area_parts[0]);
        $area_size_int = (int) str_replace(',', '', $area_parts[0]);
        // $constructed_area_parts = explode("_-||-_", $property->constructed_salable_area);  //nahi user kevanu matching ma kyay
        // $constructed_area = str_replace(',', '', $constructed_area_parts[0]);
        $salable_plot_area_part = explode("_-||-_", $property->salable_plot_area);
        $salable_plot_area = str_replace(',', '', $salable_plot_area_part[0]);
        $length_of_plot_part = explode("_-||-_", $property->length_of_plot);
        $length_of_plot = str_replace(',', '', $length_of_plot_part[0]);
        $length_of_fp_part = explode("_-||-_", $property->fp_plot_size);
        $length_of_fp = str_replace(',', '', $length_of_fp_part[0]);
        $constructed_area_unit = "";
        $area_size_unit = "";
        $length_of_plot_unit = "";
        $salable_plot_area_unit = "";
        $length_of_plot_part_unit = "";
        $fp_part_unit = "";
        // if ($constructed_area !== "") {
        //     $constructed_area_unit = str_replace(',', '', $constructed_area_parts[1]);
        // } else 
        if ($area_size !== "") {
            $area_size_unit = str_replace(',', '', $area_parts[1]);
        } else if ($salable_plot_area_part !== "") {
            $salable_plot_area_unit = str_replace(',', '', $salable_plot_area_part[1]);
        } else if ($length_of_plot_part !== "") {
            $length_of_plot_part_unit = $length_of_plot_part[1];
        }else if($length_of_fp_part !== "") {
            $fp_part_unit = $length_of_fp_part[1];
        } 
        // dd("con",$property->configuration);

        // matching view
        $unit_price =  str_replace(',', '', $unitDetails[0][4]);
        $sell_price = (int) str_replace(',', '', $unitDetails[0][3]);
        $both_price =  str_replace(',', '', $unitDetails[0][7]);
        $enquiries = Enquiries::with('Employee', 'Progress', 'activeProgress')
            ->where('requirement_type', $property->property_type)
            ->where('property_type', $property->property_category)
            ->where('weekend_enq', $property->week_end_villa)
            ->whereJsonContains('configuration', $property->configuration);
        if (($unit_price !== "" && $unit_price !== 0 && $sell_price !== '' && $sell_price !== 0) || ($unit_price !== "" && $unit_price !== 0  && $both_price !== '' && $both_price !== 0)) {
            // dd("tt sell_price",$sell_price,"unit_price",$unit_price,"both_price",$both_price);
            $enquiries = $enquiries->where(function ($q) use ($unit_price, $sell_price, $both_price) {
                $q->where(function ($subQuery) use ($unit_price) {
                    $subQuery->where('budget_from', '<=', (float) $unit_price)
                        ->where('budget_to', '>=', (float) $unit_price);
                })
                    ->orWhere(function ($subQuery) use ($sell_price) {
                        $subQuery->where('budget_from', '<=', $sell_price)
                            ->where('budget_to', '>=', $sell_price);
                    })
                    ->orWhere(function ($subQuery) use ($both_price) {
                        $subQuery->where('budget_from', '<=', $both_price)
                            ->where('budget_to', '>=', $both_price);
                    });
            });
        } else {
            // dd("sell_price",$sell_price,"unit_price",$unit_price,"property->survey_price",$property->survey_price,"both_price",$both_price);
            $enquiries = $enquiries->when(
                $unit_price !== "",
                function ($query) use ($unit_price) {
                    return $query->where('budget_from', '<=', $unit_price)
                        ->where('budget_to', '>=', $unit_price);
                },
                function ($query) use ($property, $sell_price, $both_price) {
                    return $query->when($property->survey_price !== 0.0, function ($query) use ($property) {
                        // dd("property->survey_price dsf", $property->survey_price);
                        return $query->where('budget_from', '<=', $property->survey_price)
                            ->where('budget_to', '>=', $property->survey_price);
                    })->orWhere(function ($subQuery) use ($sell_price) {
                        // dd("sell",$sell_price);
                        $subQuery->where('budget_from', '<=', $sell_price)
                            ->where('budget_to', '>=', $sell_price);
                    })->orWhere(function ($subQuery) use ($both_price) {
                        $subQuery->when($both_price !== "", function ($subQuery) use ($both_price) {
                            $subQuery->where('budget_from', '<=', $both_price)
                                ->where('budget_to', '>=', $both_price);
                        });
                    });
                }
            );
            // function ($query) use ($property, $sell_price, $both_price) {
            //     return $query->where('budget_from', '<=', $property->survey_price)
            //         ->where('budget_to', '>=', $property->survey_price)
            //         ->orWhere(function ($subQuery) use ($sell_price) {
            //             $subQuery->where('budget_from', '<=', $sell_price)
            //                 ->where('budget_to', '>=', $sell_price);
            //         })
            //         ->orWhere(function ($subQuery) use ($both_price) {
            //             $subQuery->where('budget_from', '<=', $both_price)
            //                 ->where('budget_to', '>=', $both_price);
            //         });
            // });
        }

        $enquiries = $enquiries->when($area_size !== "", function ($query) use ($area_parts, $area_size, $area_size_int, $property) {
            if ($property->property_category !== "259" && $property->property_category !== "260" && $property->property_category !== "254") {
                return $query->where('area_from', '<=', $area_size)
                    ->where('area_to', '>=', $area_size)
                    ->where('area_from_measurement', $area_parts[1]);
            } else {
                return $query->where('area_from', '<=', $area_size_int)
                    ->where('area_to', '>=', $area_size_int)
                    ->where('area_from_measurement', $area_parts[1]);
            }
        });

        // dd("property",$property->property_category);
        $enquiries = $enquiries->when($salable_plot_area !== "", function ($query) use ($property, $salable_plot_area, $salable_plot_area_part) {
        
            if ($property->property_category !== '258' && $property->property_category !== '255') {
                return $query->where('area_from', '<=', $salable_plot_area)
                    ->where('area_to', '>=', $salable_plot_area)
                    ->where('area_from_measurement', $salable_plot_area_part[1]);
            } else if ($property->property_category === '255') {
                return $query->where('area_from', '<=', (int) $salable_plot_area)
                    ->where('area_to', '>=', (int) $salable_plot_area)
                    ->where('area_from_measurement', $salable_plot_area_part[1]);
            } else {
                return $query;
            }
        });
        // length_of_fp
        // dd("sd",$property->property_category);
        $enquiries = $enquiries->when(($length_of_fp !== "" && $property->property_category === '262' && $property->property_category !== null), function ($query) use ($length_of_fp, $length_of_fp_part) {
            // dd("11",$length_of_fp_part[1]);
            return $query->where('area_from', '<=', $length_of_fp)
                ->where('area_to', '>=', $length_of_fp)
                ->where('area_from_measurement', $length_of_fp_part[1]);
        });

        $enquiries = $enquiries->when(($length_of_plot !== "" && $property->property_category !== '256' &&  $property->property_category !== '262' && $property->property_category !== null), function ($query) use ($length_of_plot, $length_of_plot_part) {
            // dd("22");
            return $query->where('area_from', '<=', $length_of_plot)
                ->where('area_to', '>=', $length_of_plot)
                ->where('area_from_measurement', $length_of_plot_part[1]);
        });

        // Execute the query
        $enquiries = $enquiries->get();

        // dd("Final results", Auth::user()->id, $property->configuration, $enquiries);

        $prop_type = [];
        foreach ($dropdowns as $key => $value) {
            if (($value['name'] == 'Commercial' || $value['name'] == 'Residential') && str_contains($value['dropdown_for'], 'property_')) {
                array_push($prop_type, $value['id']);
            }
        }
        //subcategory View
        if (!empty($property->configuration) && !empty(config('constant.property_configuration')[$property->configuration])) {
            $configuration_name = config('constant.property_configuration')[$property->configuration];
        } else {
            $configuration_name = "";
        }

        $visits = QuickSiteVisit::with('Enquiry')->where('property_list', 'like', '%"' . $property->id . '"%')->whereNotNull('visit_status')->orderBy('id', 'DESC')->get();

        $projects = Projects::where('user_id', Auth::user()->id)->get();
        $areas = Areas::where('user_id', Auth::user()->id)->get();
        $shared = ShareProperty::where('property_id', $property->id)->get();

        $multiple_image = LandImages::where('pro_id', $property->id)->get();
        $construction_docs_list = LandImages::where('pro_id', $property->id)
            ->whereNotNull('construction_documents')
            ->get();

        if (request()->has('download_zip')) {
            $selectedImages = request('selectedImages', []);
            return $this->downloadImagesZip($selectedImages);
        }

        return view('admin.properties.view', compact('property', 'shared', 'configuration_name', 'multiple_image', 'construction_docs_list', 'dropdowns', 'land_units', 'configuration_name', 'enquiries', 'visits', 'prop_type', 'projects', 'areas'));
    }

    public function downloadZip($type, $prop)
    {
        $selectedFiles = $this->getSelectedFiles($type, $prop);
        // dd("selectedFiles",$selectedFiles,$type);
        if (count($selectedFiles) === 1) {
            $file = reset($selectedFiles); // Get the first element of the array
            if ($type === 'images' || $type === 'documents') {
                $path = public_path('upload/land_images/' . $file->image);
            } else {
                $path = public_path('upload/construction_images/' . $file->construction_documents);
            }
            if (file_exists($path)) {
                return response()->download($path)->deleteFileAfterSend(true);
            } else {
                return response('File not found', 404);
            }
        } else {
            $zipFileName = 'bromi_' . $type . '_files.zip';
            $zip = new ZipArchive();
            if ($zip->open($zipFileName, ZipArchive::CREATE) !== true) {
                return response('Error opening the ZIP file', 500);
            }
            foreach ($selectedFiles as $file) {
                if ($type === 'images' || $type === 'documents') {
                    $path = public_path('upload/land_images/' . $file->image);
                } else {
                    $path = public_path('upload/construction_images/' . $file->construction_documents);
                }
                if (file_exists($path)) {
                    $zip->addFile($path, $file->image);
                } else {
                    return response('File not found: ' . $path, 404);
                }
                if (file_exists($path)) {
                    $zip->addFile($path, $file->construction_documents);
                } else {
                    return response('File not found: ' . $path, 404);
                }
            }
            $zip->close();
            return response()->download($zipFileName)->deleteFileAfterSend(true);
        }
    }


    // public function downloadZip($type, $prop)
    // {
    //     // Construct the ZIP file name
    //     $zipFileName = 'bromi_' . $type . '_files.zip';
    //     // $zipFileName = storage_path('app/public/bromi_' . $type . '_files.zip');


    //     $zip = new ZipArchive();

    //     if ($zip->open($zipFileName, ZipArchive::CREATE) !== true) {
    //         return response('Error opening the ZIP file', 500);
    //     }

    //     $selectedFiles = $this->getSelectedFiles($type, $prop);

    //     foreach ($selectedFiles as $file) {
    //         $path = public_path('upload/land_images/' . $file->image);
    //         if (file_exists($path)) {
    //             $zip->addFile($path, $file->image);
    //         } else {
    //             return response('File not found: ' . $path, 404);
    //         }
    //     }

    //     $zip->close();

    //     // Create a BinaryFileResponse to send the ZIP file.
    //     return response()->download($zipFileName)->deleteFileAfterSend(true);
    // }


    private function getSelectedFiles($type, $prop)
    {
        $propertyId = $prop;
        $files = LandImages::where('pro_id', $propertyId)->get();
        $selectedFiles = [];

        foreach ($files as $file) {
            $path = pathinfo($file->image, PATHINFO_EXTENSION);

            if (($type === 'images' && in_array($path, ['jpg', 'jpeg', 'png'])) || ($type === 'construction_land_images' && in_array($path, ['jpg', 'jpeg', 'png'])) || ($type === 'documents' && !in_array($path, ['jpg', 'jpeg', 'png']))
            ) {
                $selectedFiles[] = $file;
            }
        }

        return $selectedFiles;
    }


    public function changeFormType(Request $request)
    {
        switch ($request->type) {
            case 'industrial':
                $form_data['projects'] = Projects::orderBy('project_name')->get();
                $form_data['areas'] = Areas::orderBy('name')->get();
                $form_data['cities'] = City::orderBy('name')->get();
                $form_data['states'] = State::orderBy('name')->get();
                $property_configuration_settings = DropdownSettings::get()->toArray();
                $prop_type = [];
                foreach ($property_configuration_settings as $key => $value) {
                    if (($value['name'] == 'Industrial') && str_contains($value['dropdown_for'], 'property_')) {
                        array_push($prop_type, $value['id']);
                    }
                }
                $form_data['prop_type'] = $prop_type;
                $form_data['property_configuration_settings'] = $property_configuration_settings;
                $view = view('admin.properties.add_industrial_property', $form_data)->render();
                break;
            case 'land':

                $form_data['projects'] = Projects::orderBy('project_name')->get();
                $form_data['areas'] = Areas::orderBy('name')->get();
                $form_data['cities'] = City::orderBy('name')->get();
                $form_data['states'] = State::orderBy('name')->get();
                $form_data['districts'] = District::orderBy('name')->get();
                $form_data['talukas'] = Taluka::orderBy('name')->get();
                $form_data['villages'] = Village::orderBy('name')->get();
                $property_configuration_settings = DropdownSettings::get()->toArray();
                $prop_type = [];
                foreach ($property_configuration_settings as $key => $value) {
                    if (($value['name'] == 'Industrial') && str_contains($value['dropdown_for'], 'property_')) {
                        array_push($prop_type, $value['id']);
                    }
                }
                $form_data['prop_type'] = $prop_type;
                $form_data['property_configuration_settings'] = $property_configuration_settings;
                $view = view('admin.properties.add_land_property_form', $form_data)->render();
                break;
            default:

                $form_data['projects'] = Projects::all();
                $form_data['areas'] = Areas::all();
                $conatcts_numbers = [];
                $contacts = Enquiries::get();

                foreach ($contacts as $key => $value) {
                    if (!empty($value->client_mobile) && !empty($value->client_name)) {
                        $arr = [];
                        $arr['name'] = $value->client_name;
                        $arr['number'] = $value->client_mobile;
                        array_push($conatcts_numbers, $arr);
                    }
                    if (!empty($value->other_contacts)) {
                        $val = json_decode($value->other_contacts);
                        foreach ($val as $key1 => $value1) {
                            $arr = [];
                            $arr['name'] = $value1[0];
                            $arr['number'] = $value1[1];
                            array_push($conatcts_numbers, $arr);
                        }
                    }
                }
                $form_data['conatcts_numbers'] = $conatcts_numbers;
                $property_configuration_settings = DropdownSettings::get()->toArray();
                $prop_type = [];
                foreach ($property_configuration_settings as $key => $value) {
                    if (($value['name'] == 'Commercial' || $value['name'] == 'Residential') && str_contains($value['dropdown_for'], 'property_')) {
                        array_push($prop_type, $value['id']);
                    }
                }
                $form_data['prop_type'] = $prop_type;
                $form_data['property_configuration_settings'] = $property_configuration_settings;
                $view = view('admin.properties.add_property_form', $form_data)->render();
                break;
        }
        return response()->json(['content' => $view], 200);
    }

    public function editProperty(Request $request)
    {
        $data['projects'] = Projects::where('user_id', Auth::user()->id)->whereNotNull('project_name')->get();        // $data['areas']         = Areas::all();
        $conatcts_numbers = [];
        $data['contacts'] = Enquiries::get();
        // $data['cities'] = City::orderBy('name')->get();
        // $data['states'] = State::orderBy('name')->get();
        $data['cities'] = City::orderBy('name')->where('user_id', Auth::user()->id)->get();
        $data['states'] = State::orderBy('name')->where('user_id', Auth::user()->id)->get();

        $data['areas'] = Areas::orderBy('name')
            ->where('user_id', Auth::user()->id)
            ->where('status', 1)
            ->get();
        $data['districts'] = District::orderBy('name')->where('user_id', Auth::user()->id)->get();
        $data['talukas'] = Taluka::orderBy('name')->where('user_id', Auth::user()->id)->get();
        $data['villages'] = Village::orderBy('name')->where('user_id', Auth::user()->id)->get();
        $data['current_id'] = $request->id;
        $data['property_configuration_settings'] = DropdownSettings::get()->toArray();
        $prop_type = [];
        foreach ($data['property_configuration_settings'] as $key => $value) {
            if (($value['name'] == 'Commercial' || $value['name'] == 'Residential') && str_contains($value['dropdown_for'], 'property_')) {
                array_push($prop_type, $value['id']);
            }
        }
        $parent_id = Session::get('parent_id');
        $amenities = DropdownSettings::where('user_id', $parent_id)->where('dropdown_for', 'property_amenities')->get()->toArray();
        $data['amenities'] = $amenities;
        $data['prop_type'] = $prop_type;
        $edit_configuration = Properties::where('id', $request->id)->pluck('configuration');
        $edit_category = Properties::where('id', $request->id)->pluck('property_category');
        $data['property_const_docs'] = PropertyConstructionDocs::all();
        $data['land_units'] = FacadesDB::table('land_units')->get();
        $data['country_codes']  = DB::table('countries')->get();

        $data['first_state'] = State::where('user_id',Auth::user()->id)->first();
        $data['first_city'] = City::where('user_id',Auth::user()->id)->first();
        $data['first_district'] = District::where('user_id',Auth::user()->id)->first();

        return view('admin.properties.add_property', $data, compact('edit_category', 'edit_configuration'));
    }

    public function addProperty(Request $request)
    {
        $data['projects'] = Projects::where('user_id', Auth::user()->id)->whereNotNull('project_name')->get();        // $data['areas']         = Areas::all();
        $conatcts_numbers = [];
        $data['contacts'] = Enquiries::get();
        // $data['cities'] = City::orderBy('name')->get();
        // $data['states'] = State::orderBy('name')->get();

        $data['cities'] = City::orderBy('name')->where('user_id', Auth::user()->id)->get();
        $data['states'] = State::orderBy('name')->where('user_id', Auth::user()->id)->get();
        $data['areas'] = Areas::orderBy('name')
            ->where('user_id', Auth::user()->id)
            ->where('status', 1)
            ->get();
        $data['districts'] = District::orderBy('name')->where('user_id', Auth::user()->id)->get();
        $data['talukas'] = Taluka::orderBy('name')->where('user_id', Auth::user()->id)->get();
        $data['villages'] = Village::orderBy('name')->where('user_id', Auth::user()->id)->get();
        $parent_id = Session::get('parent_id');
        $amenities = DropdownSettings::where('user_id', $parent_id)->where('dropdown_for', 'property_amenities')->get()->toArray();
        foreach ($data['contacts'] as $key => $value) {
            if (!empty($value->client_mobile) && !empty($value->client_name)) {
                $arr = [];
                $arr['name'] = $value->client_name;
                $arr['number'] = $value->client_mobile;
                array_push($conatcts_numbers, $arr);
            }
            if (!empty($value->other_contacts)) {
                $val = json_decode($value->other_contacts);
                foreach ($val as $key1 => $value1) {
                    $arr = [];
                    $arr['name'] = $value1[0];
                    $arr['number'] = $value1[1];
                    array_push($conatcts_numbers, $arr);
                }
            }
        }

        $data['conatcts_numbers'] = $conatcts_numbers;
        $data['property_configuration_settings'] = DropdownSettings::get()->toArray();
        $prop_type = [];
        foreach ($data['property_configuration_settings'] as $key => $value) {
            if (($value['name'] == 'Commercial' || $value['name'] == 'Residential') && str_contains($value['dropdown_for'], 'property_')) {
                array_push($prop_type, $value['id']);
            }
        }
        $data['prop_type'] = $prop_type;
        $data['amenities'] = $amenities;
        $data['property_const_docs'] = PropertyConstructionDocs::all();
        $data['land_units'] = FacadesDB::table('land_units')->get();
        $data['country_codes']  = DB::table('countries')->get();

        $data['first_state'] = State::where('user_id',Auth::user()->id)->first();
        $data['first_city'] = City::where('user_id',Auth::user()->id)->first();
        $data['first_district'] = District::where('user_id',Auth::user()->id)->first();

        return view('admin.properties.add_property', $data);
    }

    // invoice form view
    public function createInvoice()
    {
        return view('admin.invoice.create');
    }

    // invoice create
    public function invoice(Request $request)
    {
        $user = Auth::user();
        $data = [];
        $totalSum = 0;
        foreach ($request->property_name as $key => $value) {
            $data[] = [
                "property_name" => $request->property_name[$key],
                "property_description" => $request->description[$key],
                "property_total" => $request->property_total[$key],
            ];
            $totalSum += $request->property_total[$key];
        }
        $pdf = PDF::loadView('admin.invoice.invoice', compact('user', 'request', 'data', 'totalSum'));
        return $pdf->download('invoice.pdf');
    }

    public function state(Request $request)
    {
        $data['states'] = City::select('name', 'id')->where("state_id", $request->state_id)
            ->get(["name", "id"]);
        return response()->json($data);
    }

    public function getPropertyCategory(Request $request)
	{
		$propID = $request->query('id');
		$property = Properties::find($propID);
		$ppropertyCategory = $property->pluck('configuration')->first();
		return response()->json($property);
	}

    public function getPropertyConfiguration(Request $request)
    {
        $selectedCategory = $request->query('selectedCategory');
        $filteredKeys = [];
        $filteredConfig = [];
        if ($selectedCategory === 'Flat' || $selectedCategory === 'Penthouse') {
            $filteredKeys = ['13', '14', '15', '16', '17', '18'];
        }
        if ($selectedCategory === 'Vila/Bunglow') {
            // $filteredKeys = ['21', '22', '23', '24', '25'];
            $filteredKeys = ['14', '15', '16', '17', '18'];
        }
        if ($selectedCategory === 'Land') {
            $filteredKeys = ['10', '11'];
        }
        if ($selectedCategory === 'Farmhouse') {
            $filteredKeys = [];
        }
        if ($selectedCategory === 'Office') {
            $filteredKeys = ['1', '2'];
        }
        if ($selectedCategory === 'Retail') {
            $filteredKeys = ['3', '4', '5', '6'];
        }
        if ($selectedCategory === 'Storage/industrial') {
            $filteredKeys = ['7', '8', '9', '20'];
        }
        $propertyConfiguration = config('constant.property_configuration');
        foreach ($filteredKeys as $key) {
            if (isset($propertyConfiguration[$key])) {
                $filteredConfig[$key] = $propertyConfiguration[$key];
            }
        }
        return response()->json($filteredConfig);
    }
}
