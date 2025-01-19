<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Models\IndustrialProperty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Areas;
use App\Models\City;
use App\Models\DropdownSettings;
use App\Models\Projects;
use App\Models\Enquiries;
use App\Models\LandUnit;
use App\Models\Properties;
use App\Models\State;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Rap2hpoutre\FastExcel\FastExcel;

class IndustrialPropertyController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Request $request)
	{
		// $dropdowns = DropdownSettings::get()->toArray();
		// 	$land_units = LandUnit::all();
		// 	$dropdownsarr = [];
		// 	$enq = '';
		// 	if (!empty($request->search_enq)) {
		// 		$enq = Enquiries::find($request->search_enq);
		// 	}

		// 	foreach ($dropdowns as $key => $value) {
		// 		$dropdownsarr[$value['id']] = $value;
		// 	}
		// 	$dropdowns = $dropdownsarr;
		// 	$indId = '';
		// 	foreach ($dropdowns as $key => $value) {
		// 		if ($value['name'] == 'Storage/industrial') {
		// 			$indId = $key;
		// 		}
		// 	}

		// dd($indId ,Auth::user()->id);

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
			$dropdowns = DropdownSettings::get()->toArray();
			$land_units = LandUnit::all();
			$dropdownsarr = [];
			$enq = '';
			if (!empty($request->search_enq)) {
				$enq = Enquiries::find($request->search_enq);
			}

			foreach ($dropdowns as $key => $value) {
				$dropdownsarr[$value['id']] = $value;
			}
			$dropdowns = $dropdownsarr;
			$indId = '';
			foreach ($dropdowns as $key => $value) {
				if ($value['name'] == 'Storage/industrial') {
					$indId = $key;
				}
			}
			$data = Properties::with('Projects', 'Locality')->where('property_category', $indId)
				->when($request->filter_building_id, function ($query) use ($request) {
					return $query->whereIn('properties.project_id', ($request->filter_building_id));
				})
				->when($request->filter_property_for && empty(Auth::user()->property_for_id), function ($query) use ($request) {
					// dd($request->filter_property_type,"...",Auth::user()->property_type);
					return $query->where(function ($query) use ($request) {
						$query->where('properties.property_for', $request->filter_property_for)->orWhere('property_for', 'Both');
					});
				})
				->when($request->filter_specific_type && empty(Auth::user()->property_category), function ($query) use ($request) {
					// dd($request->filter_specific_type,"...",Auth::user()->property_category);
					return $query->where(function ($query) use ($request) {
						$query->where('properties.property_category', $request->filter_specific_type);
					});
				})
				->when($request->filter_configuration && empty(Auth::user()->configuration), function ($query) use ($request) {
					// dd($request->filter_configuration,"...",Auth::user()->configuration);
					return $query->where(function ($query) use ($request) {
						$query->where('properties.configuration', $request->filter_configuration);
					});
				})
				// ->when(($request->filter_area_id), function ($query) use ($request) {
				// 	// dd($request->filter_area_id);
				// 	return $query->whereIn('projects.area_id', '3812');
				// })
				->when(($request->filter_area_id), function ($query) use ($request) {
					// Assuming $request->filter_area_id is a string
					return $query->where('projects.area_id', '3812');
				})

				->when($request->filter_source_of_property && empty(Auth::user()->source_of_property), function ($query) use ($request) {
					// dd($request->filter_source_of_property,"...",Auth::user()->source_of_property);
					return $query->where(function ($query) use ($request) {
						$query->where('properties.source_of_property', $request->filter_source_of_property);
					});
				})
				->when(!empty($request->search_enq), function ($query) use ($request, $enq) {
					if (!empty($enq)) {
						// property for
						// if ($request->match_enquiry_for) {
						// 	$property_for = ($enq->enquiry_for == 'Buy') ? 'Sell' : $enq->enquiry_for;
						// 	dd("match_enquiry_for", $enq->enquiry_for, "..", $property_for);
						// 	$query->where('properties.property_for', $property_for);
						// }
						if ($request->match_enquiry_for) {
							$property_for = ($enq->enquiry_for == 'Buy') ? 'Sell' : $enq->enquiry_for;
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
						// property Sub Category
						if ($request->match_specific_sub_type && !empty($enq->configuration)) {
							// dd("match_specific_sub_type", $enq->configuration, "..", $request->match_specific_sub_type);
							$query->where('properties.configuration', json_decode($enq->configuration));
						}
						//property price & unit_price
						if ($request->match_budget_from_type) {
							$budgetFrom = str_replace(',', '', $enq->budget_from);
							$budgetTo = str_replace(',', '', $enq->budget_to);
							$query->where(function ($query) use ($budgetFrom, $budgetTo) {
								$query->where(function ($query) use ($budgetFrom, $budgetTo) {
									$query->where('properties.survey_price', '>=', $budgetFrom)
										->where('properties.survey_price', '<=', $budgetTo);
								})->orWhere(function ($query) use ($budgetFrom, $budgetTo) {
									$query->whereRaw('CAST(REPLACE(REPLACE(JSON_EXTRACT(properties.unit_details, "$[0][4]"), ",", ""), "\"", "") AS UNSIGNED) >= ?', $budgetFrom)
										->whereRaw('CAST(REPLACE(REPLACE(JSON_EXTRACT(properties.unit_details, "$[0][4]"), ",", ""), "\"", "") AS UNSIGNED) <= ?', $budgetTo);
								})->orWhere(function ($query) use ($budgetFrom, $budgetTo) {
									$query->whereRaw('CAST(REPLACE(REPLACE(JSON_EXTRACT(properties.unit_details, "$[0][3]"), ",", ""), "\"", "") AS UNSIGNED) >= ?', $budgetFrom)
										->whereRaw('CAST(REPLACE(REPLACE(JSON_EXTRACT(properties.unit_details, "$[0][3]"), ",", ""), "\"", "") AS UNSIGNED) <= ?', $budgetTo);
								})->orWhere(function ($query) use ($budgetFrom, $budgetTo) {
									$query->whereRaw('CAST(REPLACE(REPLACE(JSON_EXTRACT(properties.unit_details, "$[0][7]"), ",", ""), "\"", "") AS UNSIGNED) >= ?', $budgetFrom)
										->whereRaw('CAST(REPLACE(REPLACE(JSON_EXTRACT(properties.unit_details, "$[0][7]"), ",", ""), "\"", "") AS UNSIGNED) <= ?', $budgetTo);
								});
							});
						}
						

						if ($request->match_enquiry_size) {
							$query->where(function ($query) use ($enq) {
								$query->whereRaw("SUBSTRING_INDEX(properties.salable_area, '_-||-_', 1) BETWEEN ? AND ?", [$enq->area_from, $enq->area_to])
									->orWhereRaw("SUBSTRING_INDEX(properties.constructed_salable_area, '_-||-_', 1) BETWEEN ? AND ?", [$enq->area_from, $enq->area_to])
									->orWhereRaw("SUBSTRING_INDEX(properties.salable_plot_area, '_-||-_', 1) BETWEEN ? AND ?", [$enq->area_from, $enq->area_to])
									->orWhereRaw("SUBSTRING_INDEX(properties.survey_plot_size, '_-||-_', 1) BETWEEN ? AND ?", [$enq->area_from, $enq->area_to]);
							});
						}
					}
				})
				->orderBy('id', 'desc')->get();

			return DataTables::of($data)
				->editColumn('project_id', function ($row) use ($request) {
					if (isset($row->Projects->project_name)) {
						$first =  '<td style="vertical-align:top">																				
					<font size="3"><a href="' . route('admin.project.view', encrypt($row->id)) . '" style="font-weight: bold;">' . (!empty($row->Projects->project_name) ? $row->Projects->project_name : $row->Village->name) . '</a>';
					} else {
						$first = '';
					}
					$first_middle = '';
					if (isset($row->Projects->is_prime) && $row->Projects->is_prime) {
						$first_middle = '<img style="height:24px" src="' . asset('assets/images/primeProperty.png') . '" alt="">';
					}
					if (isset($row->hot_property) && $row->hot_property) {
						$first_middle = $first_middle . '<img style="height:24px" src="' . asset('assets/images/hotProperty.png') . '" alt="">';
					} else {
						$row->hot_property = '';
					}
					$first_end = '</font>';
					// $second = '<br> <a href="' . $row->location_link . '" target="_blank"> <font size="2" style="font-style:italic">Locality: ' . ((!empty($row->Projects->Area->name)) ? $row->Projects->Area->name : 'Null') . '    </font> </a>';
					$second = '<br>Locality: ' . ((!empty($row->Projects->Area->name)) ? $row->Projects->Area->name : 'Null') . '	</font>';
					$third = (!empty($row->location_link) ? '<br> <a href="' . $row->location_link . '" target="_blank"><i class="fa fa-map-marker fa-1x cursor-pointer color-code-popover" data-bs-trigger="hover focus">  check on map  </i></a>' : "");
					// 	$third = '<br> <font size="2" style="font-style:italic">Added On: ' . Carbon::parse($row->created_at)->format('d-m-Y') . '</font>';
					$last = '</td>';
					'</td>';
					return
						$first .
						$first_middle .
						$first_end .
						$second .
						$third .
						$last;

					return '';
				})
				->editColumn('property_for', function ($row) use ($dropdowns, $land_units) {
					// $new_array = array('', 'office space', 'Co-working', 'Ground floor', '1st floor', '2nd floor', '3rd floor', 'Warehouse', 'Cold Storage', 'ind. shed', 'Commercial Land', 'Agricultural/Farm Land', 'Industrial Land', '1 rk', '1bhk', '2bhk', '3bhk', '4bhk', '4+bhk');
					$new_array = array('', 'office space', 'Co-working', 'Ground floor', '1st floor', '2nd floor', '3rd floor', 'Warehouse', 'Cold Storage', 'ind. shed', 'Commercial Land', 'Agricultural/Farm Land', 'Industrial Land', '1 rk', '1bhk', '2bhk', '3bhk', '4bhk', '5bhk', '5+bhk', 'Plotting', 'Test', 'testw');

					if ($row->property_for == 'Both') {
						$forr = 'Rent & Sell';
					} else {
						$forr = $row->property_for;
					}
					$sub_cat = ((!empty($dropdowns[$row->property_category]['name'])) ? ' | ' . $dropdowns[$row->property_category]['name'] : '');

					if (!is_null($row->configuration)) {
						$catId = (int) $row->configuration;
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
						$fstatus = '';
					} else {
						$fstatus = '';
						if (!empty($row->unit_details) && !empty(json_decode($row->unit_details)[0])) {
							$vv = json_decode($row->unit_details);
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
						$salable_area_print = "";
					}

					if ($row->Property_priority == "91") {
                        $row->image_path = '<img style="height:24px;float: right;bottom: 38px;right:17px;position:relative;" src="' . asset('assets/prop_images/Blue-Star.png') . '" alt="">';
                    } else if ($row->Property_priority == "90") {
                        $row->image_path = '<img style="height:24px;float: right;bottom: 38px;right:17px;position:relative;" src="' . asset('assets/prop_images/Yellow-Star.png') . '" alt="">';
                    } else if ($row->Property_priority == "17") {
                        $row->image_path = '<img style="height:24px;float: right;bottom: 38px;right:17px;position:relative;" src="' . asset('assets/prop_images/Red-Star.png') . '" alt="">';
                    }

					try {
						return '
						<td style="vertical-align:top">
						' . ((!empty($forr)) ? $forr : '') . $category . '
						<font size="2" style="font-style:italic">
						<br>
						' . $salable_area_print . '
						</font>
						<br>' . $row->image_path . '
						<br>' . $fstatus . '
						</td>';
					} catch (\Throwable $th) {
						dd($th);
					}
				})

				->editColumn('unit_details', function ($row) {
					// dd($row->property_for);
					$all_units = [];
					if (!empty($row->unit_details) && !empty(json_decode($row->unit_details)[0])) {
						$vv = json_decode($row->unit_details);
						// dd($vv,"unit_details");
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
					return;
				})

				->editColumn('select_checkbox', function ($row) {
					$abc = '<div class="form-check checkbox checkbox-primary mb-0">
					<input class="form-check-input table_checkbox" data-id="' . $row->id . '" name="select_row[]" id="checkbox-primary-' . $row->id . '" type="checkbox">
					<label class="form-check-label" for="checkbox-primary-' . $row->id . '"></label>
					  </div>';
					return $abc;
				})
				->editColumn('contact_details', function ($row) {
					$detail = '';
					if (!empty($row->other_contact_details)) {
						$contacts = json_decode($row->other_contact_details);
						foreach ($contacts as $key => $value) {
							if (!empty($value[0]) && !empty($value[1])) {
								$detail =  '<td align="center" style="vertical-align:top">
								' . $value[0] . ' <br>
								<a href="tel:' . $value[1] . '">' . $value[1] . '</a>
				 				</td>';
								break;
							}
						}
					};
					return $detail;
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
				->addColumn('actions', function ($row) use ($land_units) {
					$buttons = '';
					$building_name = '';
					$area = '';
					$config = '';
					$vvv = '';
					$user = User::with(['roles', 'roles.permissions'])
						->where('id', Auth::user()->id)
						->first();
					$permissions = $user->roles[0]['permissions']->pluck('name')->toArray();

					if (isset($row->Projects->project_name)) {
						$building_name = $row->Projects->project_name;
					}
					if (isset($row->Projects->Area->name)) {
						$area = $row->Projects->Area->name;
					}
					if (isset($dropdowns[$row->property_category]['name'])) {
						$config = $dropdowns[$row->property_category]['name'];
					}

					$building_name = urlencode($building_name);
					$area = urlencode($area);
					$config = urlencode($config);
					$price = urlencode($row->price);
					$property_for = urlencode(($row->property_for == 'Both') ? 'Rent & Sell' : '');
					$details = urlencode($this->generateAreaUnitDetails($row, $config, $land_units));
					$location_link = urlencode($row->location_link);
					$message = "$building_name | $area \n $config | $details | $price \n Available For : $property_for\n\n | Link: $location_link";
					$sharestring = 'https://api.whatsapp.com/send?phone=the_phone_number_to_send&text=' . $message;

					if (in_array('industrial-property-edit', $permissions)) {
						$buttons =  $buttons . '<a href="' . route('admin.property.edit', $row->id) . '"><i role="button" title="Edit" data-id="' . $row->id . '"  class="fs-22 py-2 mx-2 fa-pencil pointer fa  " type="button"></i></a>';
					}


					if (in_array('industrial-property-delete', $permissions)) {
						$buttons =  $buttons . '<i role="button" title="Delete" data-id="' . $row->id . '" onclick=deleteProperty(this) class="fa-trash pointer fa fs-22 py-2 mx-2 text-danger" type="button"></i>';
					}


					$buttons = $buttons . '<i title="Send On Whatsapp" data-share_string="' . $sharestring . '"  onclick=openwamodel(this)  class="fa fs-22 py-2 mx-2 fa-whatsapp text-success"></i><br>';
					$buttons = $buttons . '<i title="Matching Enquiry" data-id="' . $row->id . '" onclick=matchingEnquiry(this) class="fa fs-22 py-2 mx-2 fa-plane text-info"></i>';

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

					$other_details = "";
					if ($row->owner_contact) {
						$other_details = $owner_type . ' - ' . $row->owner_name . ' - ' . $row->owner_contact;
					}
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
				->rawColumns(['project_id', 'contact_details', 'price', 'property_for', 'unit_details', 'actions', 'select_checkbox'])
				->make(true);
		}
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
		$projects = Projects::orderBy('project_name')->where('user_id', Auth::user()->id)->get();
		$areas = Areas::where('user_id', Auth::user()->id)->orderBy('name')->get();
		$cities = City::orderBy('name')->get();
		$states = State::orderBy('name')->get();
		$property_configuration_settings = DropdownSettings::get()->toArray();
		$prop_type = [];
		foreach ($property_configuration_settings as $key => $value) {
			// if (($value['name'] == 'Industrial') && str_contains($value['dropdown_for'], 'property_')) {
			// 	array_push($prop_type, $value['id']);
			// }
			if (($value['name'] == 'Commercial' || $value['name'] == 'Residential') && str_contains($value['dropdown_for'], 'property_')) {
				array_push($prop_type, $value['id']);
			}
		}
		return view('admin.properties.industrial_index', compact('projects', 'conatcts_numbers', 'property_configuration_settings', 'areas', 'cities', 'states', 'prop_type'));
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
			if (!empty($salable) && (!empty($constructed))) {
				$area = "P:" . $salable . ' - C: ' . $constructed;
			} else {
				$area = "";
			}
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


	public function saveProperty(Request $request)
	{
		if (!empty($request->id) && $request->id != '') {

			$data = IndustrialProperty::find($request->id);
			if (empty($data)) {
				$data =  new IndustrialProperty();
			}
		} else {
			$data =  new IndustrialProperty();
		}
		$data->user_id = Session::get('parent_id');
		$data->added_by = Auth::user()->id;
		$data->property_for = $request->property_for;
		$data->building_id = $request->building_id;
		$data->address = $request->address;
		$data->area_id = $request->area_id;
		$data->city_id = $request->city_id;
		$data->state_id = $request->state_id;
		$data->specific_type = $request->specific_type;
		$data->configuration = $request->configuration;
		$data->zone = $request->zone;
		$data->property_wing = $request->property_wing;
		$data->property_unit_no = $request->property_unit_no;
		$data->property_status = $request->property_status;
		$data->plot_area = $request->plot_area;
		$data->plot_measurement = $request->plot_measurement;
		$data->construction_area = $request->construction_area;
		$data->construction_measurement = $request->construction_measurement;
		$data->hot_property = $request->hot_property;
		$data->Property_priority = $request->Property_priority;
		$data->pre_leased = $request->is_pre_leased;
		$data->property_description = $request->property_description;
		$data->commission = $request->commision;
		$data->source_of_property = $request->source_of_property;
		$data->price = $request->price;
		$data->price_remarks = $request->price_remarks;
		$data->remarks = $request->property_remarks;
		$data->owner_details = $request->owner_details;
		$data->gpcb = $request->gpcb;
		$data->gpcb_remarks = $request->gpcb_remarks;
		$data->ec_noc = $request->ec_noc;
		$data->ec_noc_remarks = $request->ec_noc_remark;
		$data->bail = $request->bail;
		$data->bail_remarks = $request->bail_remark;
		$data->gujrat_gas = $request->gujrat_gas;
		$data->gujrat_gas_remarks = $request->gujrat_gas_remark;
		$data->discharge = $request->discharge;
		$data->discharge_remarks = $request->discharge_remarks;
		$data->power = $request->power;
		$data->power_remarks = $request->power_remark;
		$data->water = $request->water;
		$data->water_remarks = $request->water_remark;
		$data->machinery = $request->machinery;
		$data->machinery_remarks = $request->machinery_remark;
		$data->etl_necpt = $request->etl_necpt;
		$data->etl_necpt_remarks = $request->etl_necpt_remark;
		$data->save();
		if (!empty($request->plot_measurement)) {
			Helper::add_default_measuerement($request->plot_measurement);
		}
		if (!empty($request->construction_measurement)) {
			Helper::add_default_measuerement($request->construction_measurement);
		}
	}

	public function importProperty(Request $request)
	{
		$file = $request->file('csv_file');
		$name = Str::random(10) . '.xlsx';
		$file->move(storage_path('app'), $name);
		try {
			$collection = (new FastExcel)->import(storage_path('app/' . $name));
		} catch (\Throwable $th) {
			$collection = [];
		}
		unlink(storage_path('app/' . $name));
		foreach ($collection as $key => $value) {

			$building_id = NULL;
			$area_name = Areas::where('name', 'like', '%' . explode('-', $value['Project Name'])[1])->first();
			$building = Projects::where('project_name', 'like', '%' . trim(explode('-', $value['Project Name'])[0]) . '%')->when(!empty(explode('-', $value['Project Name'])[1] && !empty($area_name->name)), function ($query) use ($area_name) {
				$query->where('area_id', $area_name->id);
			})->first();
			if (!empty($building->id) && !empty($value['Project Name'])) {
				$building_id = $building->id;
			}
			$area_id = NULL;
			$area = Areas::where('name', 'like', '%' . $value['Area'])->first();
			if (!empty($area->id) && !empty($value['Area'])) {
				$area_id = $area->id;
			}


			$specific_property_id = NULL;
			$specific_property = DropdownSettings::where('name', 'like', '%' . $value['Specific Property'] . '%')->first();
			if (!empty($specific_property->id) && !empty($value['Specific Property'])) {
				$specific_property_id = $specific_property->id;
			}

			$Configuration_id = NULL;
			$Configuration = DropdownSettings::where('name', 'like', '%' . $value['Configuration'] . '%')->first();
			if (!empty($Configuration->id) && !empty($value['Configuration'])) {
				$Configuration_id = $Configuration->id;
			}

			$plot_measurement_id = NULL;
			$plot_measurement = DropdownSettings::where('name', 'like', '%' . $value['Plot Measurment'] . '%')->first();
			if (!empty($plot_measurement->id) && !empty($value['Plot Measurment'])) {
				$plot_measurement_id = $plot_measurement->id;
			}

			$construction_measurement_id = NULL;
			$construction_measurement = DropdownSettings::where('name', 'like', '%' . $value['Construction Measurment'] . '%')->first();
			if (!empty($construction_measurement->id) && !empty($value['Construction Measurment'])) {
				$construction_measurement_id = $construction_measurement->id;
			}

			$property_source_id = NULL;
			$property_source = DropdownSettings::where('name', 'like', '%' . $value['Source Of Property'] . '%')->first();
			if (!empty($property_source->id) && !empty($value['Source Of Property'])) {
				$property_source_id = $property_source->id;
			}

			$hot_property = 0;
			if ($value['Hot Property'] == 'Yes') {
				$hot_property = 1;
			}
			$pre_leased = 0;
			if ($value['Preleased'] == 'Yes') {
				$pre_leased = 1;
			}

			$gpcb = 0;
			$ecnoc = 0;
			$bail = 0;
			$discharge = 0;
			$gujrat = 0;
			$power = 0;
			$water = 0;
			$etl = 0;
			$machine = 0;

			if ($value['GPCB'] == 'Yes') {
				$gpcb = 1;
			}
			if ($value['ECNoc'] == 'Yes') {
				$ecnoc = 1;
			}
			if ($value['BAIL Membership'] == 'Yes') {
				$bail = 1;
			}
			if ($value['Discharge'] == 'Yes') {
				$discharge = 1;
			}
			if ($value['GujaratGas'] == 'Yes') {
				$gujrat = 1;
			}
			if ($value['Power'] == 'Yes') {
				$power = 1;
			}
			if ($value['Water'] == 'Yes') {
				$water = 1;
			}
			if ($value['ETL_CEPT_NLTL'] == 'Yes') {
				$etl = 1;
			}
			if ($value['List Of Machinary'] == 'Yes') {
				$machine = 1;
			}

			$contact_details = [];
			$arr = [];
			array_push($arr, $value['Property Owner Name1']);
			array_push($arr, $value['Property Owner ContactNo 1']);
			array_push($arr, 'Contactable');
			array_push($contact_details, $arr);
			$arr = [];
			array_push($arr, $value['Property Owner Name2']);
			array_push($arr, $value['Property Owner ContactNo 2']);
			array_push($arr, 'Contactable');
			array_push($contact_details, $arr);
			if ($value['Property For']) {
				$data =  new IndustrialProperty();
				$data->user_id = Session::get('parent_id');
				$data->added_by = Auth::user()->id;
				$data->property_for = $value['Property For'];
				$data->building_id = $building_id;
				$data->address = $value['Address'];
				$data->area_id = $area_id;
				$data->specific_type = $specific_property_id;
				$data->configuration = $Configuration_id;
				$data->zone = $value['Industrial Zone'];
				$data->property_wing = $value['Wing'];
				$data->property_unit_no = $value['UnitNo'];
				$data->property_status = $value['Status'];
				$data->plot_area = $value['Plot Area'];
				$data->plot_measurement = $plot_measurement_id;
				$data->construction_area = $value['Construction Area'];
				$data->construction_measurement = $construction_measurement_id;
				$data->hot_property = $hot_property;
				$data->pre_leased = $pre_leased;
				$data->property_description = $value['Property Description'];
				$data->source_of_property = $property_source_id;
				$data->price = $value['Price'] . ' ' . $value['Price Unit'];
				$data->commission = $value['Commision'];
				$data->price_remarks = $value['Price Remarks'];
				$data->remarks = $value['Remarks'];
				$data->owner_details = json_encode($contact_details);
				$data->gpcb = $gpcb;
				$data->gpcb_remarks = $value['GPCB Remarks'];
				$data->ec_noc = $ecnoc;
				$data->ec_noc_remarks = $value['ECNoc Remarks'];
				$data->bail = $bail;
				$data->bail_remarks = $value['BAIL Membership Remarks'];
				$data->gujrat_gas = $gujrat;
				$data->gujrat_gas_remarks = $value['GujaratGas Remarks'];
				$data->discharge = $discharge;
				$data->discharge_remarks = $value['Discharge Remarks'];
				$data->power = $power;
				$data->power_remarks = $value['Power Remarks'];
				$data->water = $water;
				$data->water_remarks = $value['Water Remarks'];
				$data->machinery = $machine;
				$data->machinery_remarks = $value['List Of Machinary Remarks'];
				$data->etl_necpt = $etl;
				$data->etl_necpt_remarks = $value['ETL_CEPT_NLTLRemarks'];
				$data->save();
			}
		}
	}

	public function importPropertyTemplate()
	{
		$spreadsheet = new Spreadsheet;

		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Property For');
		$sheet->setCellValue('B1', 'Specific Property');
		$sheet->setCellValue('C1', 'Configuration');
		$sheet->setCellValue('D1', 'Price');
		$sheet->setCellValue('E1', 'Price Unit');
		$sheet->setCellValue('F1', 'Status');
		$sheet->setCellValue('G1', 'Property Owner Name1');
		$sheet->setCellValue('H1', 'Property Owner ContactNo 1');
		$sheet->setCellValue('I1', 'Property Owner Name2');
		$sheet->setCellValue('J1', 'Property Owner ContactNo 2');
		$sheet->setCellValue('K1', 'Project Name');
		$sheet->setCellValue('L1', 'Address');
		$sheet->setCellValue('M1', 'Area');
		$sheet->setCellValue('N1', 'Industrial Zone');
		$sheet->setCellValue('O1', 'Wing');
		$sheet->setCellValue('P1', 'UnitNo');
		$sheet->setCellValue('Q1', 'Plot Area');
		$sheet->setCellValue('R1', 'Plot Measurment');
		$sheet->setCellValue('S1', 'Construction Area');
		$sheet->setCellValue('T1', 'Construction Measurment');
		$sheet->setCellValue('U1', 'Source Of Property');
		$sheet->setCellValue('V1', 'Commision');
		$sheet->setCellValue('W1', 'Price Remarks');
		$sheet->setCellValue('X1', 'Remarks');
		$sheet->setCellValue('Y1', 'Hot Property');
		$sheet->setCellValue('Z1', 'Preleased');
		$sheet->setCellValue('AA1', 'Property Description');
		$sheet->setCellValue('AB1', 'GPCB');
		$sheet->setCellValue('AC1', 'GPCB Remarks');
		$sheet->setCellValue('AD1', 'ECNoc');
		$sheet->setCellValue('AE1', 'ECNoc Remarks');
		$sheet->setCellValue('AF1', 'BAIL Membership');
		$sheet->setCellValue('AG1', 'BAIL Membership Remarks');
		$sheet->setCellValue('AH1', 'Discharge');
		$sheet->setCellValue('AI1', 'Discharge Remarks');
		$sheet->setCellValue('AJ1', 'GujaratGas');
		$sheet->setCellValue('AK1', 'GujaratGas Remarks');
		$sheet->setCellValue('AL1', 'Power');
		$sheet->setCellValue('AM1', 'Power Remarks');
		$sheet->setCellValue('AN1', 'Water');
		$sheet->setCellValue('AO1', 'Water Remarks');
		$sheet->setCellValue('AP1', 'ETL_CEPT_NLTL');
		$sheet->setCellValue('AQ1', 'ETL_CEPT_NLTLRemarks');
		$sheet->setCellValue('AR1', 'List Of Machinary');
		$sheet->setCellValue('AS1', 'List Of Machinary Remarks');


		$vvells = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS'];
		foreach ($vvells as $key => $value) {
			$spreadsheet->getActiveSheet()->getColumnDimension($value)->setWidth(15);
		}

		$dd1 = Projects::with('Area')->get()->toArray();
		$projects = [];
		foreach ($dd1 as $key => $value) {
			$projects[] = $value['project_name'] . ' - ' . ((isset($value['area']['name'])) ? $value['area']['name'] : '');
		}
		$projects = '"' . implode(",", $projects) . '"';

		$dd2 = Areas::get()->toArray();
		$areas = [];
		foreach ($dd2 as $key => $value) {
			$areas[] = $value['name'];
		}
		$areas = '"' . implode(",", $areas) . '"';

		$dropdowns = DropdownSettings::get()->toArray();
		$dropdownsarr = [];
		foreach ($dropdowns as $key => $value) {
			$dropdownsarr[$value['dropdown_for']][] = $value['name'];
		}

		$propertyFor = '"Rent, Sell"';
		$status = '" Available,SoldOut"';
		$specificType = '"' . implode(",", $dropdownsarr['property_specific_type']) . '"';
		$planType = '"' . implode(",", $dropdownsarr['property_plan_type']) . '"';
		$measurement = '"' . implode(",", $dropdownsarr['property_measurement_type']) . '"';
		$propertySource = '"' . implode(",", $dropdownsarr['property_source']) . '"';
		$priceUnit = '" Thousand, Lac, Crore"';
		$yesNo = '"Yes,No"';
		$arrr = [];
		$zone = '"textline, plastic,engineering,chemical"';
		$arrr['vals'] = [$propertyFor, $specificType, $planType, $priceUnit, $status, $projects, $areas, $zone, $measurement, $measurement, $propertySource, $yesNo, $yesNo, $yesNo, $yesNo, $yesNo, $yesNo, $yesNo, $yesNo, $yesNo, $yesNo, $yesNo];
		$arrr['sheetcell'] = ['A1', 'B1', 'C1', 'E1', 'F1', 'K1', 'M1', 'N1', 'R1', 'T1', 'U1', 'Y1', 'Z1', 'AB1', 'AD1', 'AF1', 'AH1', 'AJ1', 'AL1', 'AN1', 'AP1', 'AR1'];
		$arrr['setsqref'] = ['A2:A1048576', 'B2:B1048576', 'C2:C1048576', 'E2:E1048576', 'F2:F1048576', 'K2:K1048576', 'M2:M1048576', 'N2:N1048576', 'R2:R1048576', 'T2:T1048576', 'U2:U1048576', 'Y2:Y1048576', 'Z2:Z1048576', 'AB2:AB1048576', 'AD2:AD1048576', 'AF2:AF1048576', 'AH2:AH1048576', 'AJ2:AJ1048576', 'AL2:AL1048576', 'AN2:AN1048576', 'AP2:AP1048576', 'AR2:AR1048576'];;

		foreach ($arrr['sheetcell'] as $key => $value) {
			$validation = $spreadsheet->getActiveSheet()->getcell($value)->getDataValidation();
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
			$validation->setFormula1($arrr['vals'][$key]);
			$validation->setSqref($arrr['setsqref'][$key]);
		}

		$writer = new Xlsx($spreadsheet);
		$writer->save(public_path('imports/IndustrialProperty_sample.xlsx'));
		return redirect(asset('imports/IndustrialProperty_sample.xlsx'));
	}

	public function getSpecificProperty(Request $request)
	{
		if (!empty($request->id)) {
			$data = IndustrialProperty::where('id', $request->id)->first()->toArray();
			return json_encode($data);
		}
	}

	public function destroy(Request $request)
	{
		if (!empty($request->id)) {
			$data = IndustrialProperty::where('id', $request->id)->delete();
			return json_encode($data);
		}

		if (!empty($request->allids) && isset(json_decode($request->allids)[0])) {
			$data = IndustrialProperty::whereIn('id', json_decode($request->allids))->delete();
		}
	}
}
