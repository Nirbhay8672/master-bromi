<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Constants\Constants;
use App\Models\City;
use App\Models\User;
use App\Models\Areas;
use App\Models\Taluka;
use App\Helpers\Helper;
use App\Models\Village;
use App\Models\Branches;
use App\Models\District;
use App\Models\Projects;
use App\Models\Enquiries;
use App\Models\Properties;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AssignHistory;
use App\Models\QuickSiteVisit;
use App\Models\EnquiryComments;
use App\Models\EnquiryProgress;
use App\Models\DropdownSettings;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB as FacadesDB;
use App\Http\Controllers\Controller;
use App\Models\UserNotifications;
use App\Traits\HelperFn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use Illuminate\Support\Facades\DB;


class EnquiriesController extends Controller
{
	use HelperFn;

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Request $request)
	{
		if ($request->ajax()) {
			$dropdowns = DropdownSettings::get()->toArray();
			// $land_units = DB::table('land_units')->get();

			$dropdownsarr = [];
			foreach ($dropdowns as $key => $value) {
				$dropdownsarr[$value['id']] = $value;
			}
			$dropdowns = $dropdownsarr;
			$areas = Areas::where('user_id', Auth::user()->id)->get()->toArray();
			$areaarr = [];
			foreach ($areas as $key => $value) {
				$areaarr[$value['id']] = $value;
			}
			$areas = $areaarr;
			$pro = '';
			if (!empty($request->search_enq)) {
				$pro = Properties::find($request->search_enq);
			}
			$user = User::with(['roles', 'roles.permissions'])->where('id', Auth::user()->id)->first();
			$new = array_filter($user->roles[0]['permissions']->toArray(), function ($var) {
				return ($var['name'] == 'only-assigned');
			});

			$is_sub_admin = User::where('id', Auth::id())->whereNotNull('parent_id')->first();

			if($is_sub_admin) {
				$enTypeArray = null;
				$enSpecArray = null;

				if (($is_sub_admin->enquiry_type)) {
					$en_types = str_replace("'", '"', $is_sub_admin->enquiry_type);
					$enTypeArray = json_decode($en_types, true);
				}
				if (($is_sub_admin->specific_enquiry)) {
					$en_spec_str = str_replace("'", '"', $is_sub_admin->specific_enquiry);
					$enSpecArray = json_decode($en_spec_str, true);
				}

				$data = Enquiries::with(['Employee', 'Progress', 'activeProgress']);

				if($is_sub_admin->enquiry_permission) {
					if ($is_sub_admin->enquiry_permission == 'only_assigned') {
						$data->whereHas('AssignHistory', function ($subQuery) {
							$subQuery->where('assign_id', '=', Auth::user()->id)
								->where('status', '=', 0);
						});

						$data->orWhere(function ($subQuery) {
							$subQuery->whereIn('added_by', [Auth::user()->id])
								->orWhere('employee_id', [Auth::user()->id]);
						});
					}
					if($is_sub_admin->enquiry_permission == 'all') {
						$data->where(function ($query) {
							$query->whereHas('AssignHistory', function ($subQuery) {
								$subQuery->where('assign_id', '=', Auth::user()->id);
							})
							->orWhere(function ($subQuery) {
								$subQuery->whereIn('added_by', [Auth::user()->id , Auth::user()->parent_id])->orWhere('employee_id', [Auth::user()->id]);
							});
						});
					}
				} else {
					$data->whereIn('added_by', [Auth::user()->id]);
				}

				if($is_sub_admin->enquiry_for_id) {
					$data->where('enquiry_for', $is_sub_admin->enquiry_for_id);
				}

				if (count($enTypeArray) > 0) {
					$data->whereIn('requirement_type', $enTypeArray);
				} else {
					$data->whereIn('requirement_type', ["85", "87"]);
				}

				if (count($enSpecArray) > 0) {
					$data->whereIn('property_type', $enSpecArray);
				}

				if($request->filter_apply == 1) {

					if ($request->filled('filter_property_type')) {
                        $data->where('requirement_type', $request->input('filter_property_type'));
                    }

                    if ($request->filled('filter_specific_type') && count(json_decode($request->filter_specific_type)) > 0) {
						$data->whereIn('property_type', json_decode($request->filter_specific_type));
                    }

					if ($request->filled('filter_enquiry_for')) {
						$data->where('enquiry_for', $request->filter_enquiry_for);
					}

					$data->when($request->filter_by, function ($query) use ($request) {
						if ($request->filter_by == 'new') {
							return $query->doesntHave('Progress');
						} elseif ($request->filter_by == 'today') {
							return $query->whereDate('created_at', '=', Carbon::now()->format('Y-m-d'));
						} elseif ($request->filter_by == 'tomorrow') {
							return $query->whereHas('activeProgress', function ($query) {
								$query->whereDate('nfd', '=', Carbon::tomorrow()->format('Y-m-d'));
							});
						} elseif ($request->filter_by == 'yesterday') {
							return $query->whereHas('activeProgress', function ($query) {
								$query->whereDate('nfd', '=', Carbon::yesterday()->format('Y-m-d'));
							});
						} elseif ($request->filter_by == 'due') {
							return $query->whereHas('activeProgress', function ($query) {
								$query->whereDate('nfd', '<=', Carbon::now()->format('Y-m-d'));
							});
						} elseif ($request->filter_by == 'weekend') {
							return $query->whereHas('activeProgress', function ($query) {
								$query->whereDate('nfd', '<=', Carbon::now()->endOfWeek())->whereDate('nfd', '>=', Carbon::now()->endOfWeek()->subDay());
							});
						} elseif ($request->filter_by == 'missed') {
							return $query->whereDate('created_at', '<', Carbon::now()->format('Y-m-d'));
						}
					});
					
					$data->when($request->calendar_date && $request->calendar_type, function ($query) use ($request) {
						if ($request->calendar_type == 'New Enquiry') {
							return $query->whereDate('created_at', $request->calendar_date);
						} else {
							return $query->whereHas('activeProgress', function ($query) use ($request) {
								$query->whereDate('created_at', '=', $request->calendar_date)->where('progress', $request->calendar_type);
							});
						}
					})
					->when($request->filter_city_id, function ($query) use ($request) {
						return $query->where('enquiry_city_id', $request->filter_city_id);
					})
					->when($request->filter_enquiry_branch_id, function ($query) use ($request) {
						return $query->where('enquiry_branch_id', $request->filter_enquiry_branch_id);
					})
					->when($request->filter_employee_id, function ($query) use ($request) {
						return $query->where('employee_id', $request->filter_employee_id);
					})

					->when($request->filter_configuration, function ($query) use ($request) {
						return $query->whereJsonContains('configuration', $request->filter_configuration);
					})

					->when($request->filter_area_id, function ($query) use ($request) {
						$query->where(function ($query) use ($request) {
							$types = json_decode($request->filter_area_id);
							if (isset($types[0])) {
								foreach ($types as $key => $value) {
									$query->orWhere('area_ids', 'like', '%' . $value . '%');
								}
							}
						});
					})
					->when($request->filter_enquiry_source, function ($query) use ($request) {
						return $query->where('enquiry_source', $request->filter_enquiry_source);
					})
					->when($request->filter_enquiry_progress, function ($query) use ($request) {
						return $query->whereHas('activeProgress', function ($query) use ($request) {
							$query->where('progress', $request->filter_enquiry_progress);
						});
					})
					->when($request->filter_enquiry_status, function ($query) use ($request) {
						return $query->where('enquiry_status', $request->filter_enquiry_status);
					})
					->when($request->filter_sales_comment, function ($query) use ($request) {
						return $query->whereHas('activeProgress', function ($query) use ($request) {
							$query->where('sales_comment_id', $request->filter_sales_comment);
						});
					})
					->when($request->filter_from_area, function ($query) use ($request) {
						return $query->where('area_from', '>=', $request->filter_from_area);
					})
					->when($request->filter_to_area, function ($query) use ($request) {
						return $query->where('area_to', '<=', $request->filter_to_area);
					})
					->when($request->filter_lead_type, function ($query) use ($request) {
						return $query->whereHas('activeProgress', function ($query) use ($request) {
							$query->where('lead_type', $request->filter_lead_type);
						});
					})
					->when($request->filter_purpose, function ($query) use ($request) {
						return $query->where('purpose', $request->filter_purpose);
					})
					->when($request->filter_nfd_from, function ($query) use ($request) {
						return $query->whereHas('activeProgress', function ($query) use ($request) {
							$query->whereDate('nfd', '>=', $request->filter_nfd_from);
						});
					})
					->when($request->filter_nfd_to, function ($query) use ($request) {
						return $query->whereHas('activeProgress', function ($query) use ($request) {
							$query->whereDate('nfd', '>=', $request->filter_nfd_to);
						});
					})
					->when($request->filter_from_date, function ($query) use ($request) {
						return $query->whereDate('created_at', '>=', $request->filter_from_date);
					})
					->when($request->filter_to_date, function ($query) use ($request) {
						return $query->whereDate('created_at', '<=', $request->filter_to_date);
					})
					->when($request->filter_favourite, function ($query) use ($request) {
						return $query->where('is_favourite', $request->filter_favourite);
					})
					->when($request->filter_new_enquiry, function ($query) use ($request) {
						return $query->doesntHave('activeProgress');
					})
					->when($request->week_end_enq, function ($query) use ($request) {
						return $query->where('weekend_enq', $request->week_end_enq);
					})
	
					->when($request->filter_draft, function ($query) use ($request) {
						return $query->whereDate('created_at', '<=', $request->filter_draft);
					})
					->when($request->filter_prospect, function ($query) use ($request) {
						return $query->whereDate('created_at', '<=', $request->filter_prospect);
					});
				} else {
					$data->when(!empty($request->search_enq), function ($query) use ($request, $pro) {
						if (!empty($pro)) {
							if ($request->match_property_type) {
								$query->where('requirement_type',   $pro->property_type);
							}
	
							if ($request->match_specific_type) {
								$query->where('property_type',   $pro->property_category);
							}
	
							if ($request->match_enquiry_weekend && ($pro->week_end_villa == '1')) {
								$query->where('weekend_enq',   $pro->week_end_villa);
							}
	
							if ($request->match_specific_sub_type) {
								if ($pro->property_category !== '258' && $pro->property_category !== '256') {
									$query->whereJsonContains('configuration', ($pro->configuration));
								} else if ($pro->property_category === '258') {
									$query->whereJsonContains('configuration', ('0'));
								}
							}
	
							// Property For = Enquiry for
							if ($request->match_enquiry_for) {
								$enquiry_for = ($pro->property_for == 'Sell') ? 'Buy' : $pro->property_for;
								if ($enquiry_for !== 'Both') {
									$query->where('enquiry_for', $enquiry_for);
								}
							}
	
							// price multi units details 
							if ($request->match_budget_from_type) {
								$survey_price = (int) $pro->survey_price; // Cast to integer
								$fp_price =  $pro->fp_plot_price; // Cast to integer
								$unitDetails = json_decode($pro->unit_details, true);
								$query->where(function ($q) use ($unitDetails, $survey_price, $fp_price, $pro) {
									foreach ($unitDetails as $unit) {
										$unit_price =  str_replace(',', '', $unit[4]); // Assuming the price is at index 4
										$sell_price = (int) str_replace(',', '', $unit[3]); // Assuming the sell price is at index 3
										$both_price =  str_replace(',', '', $unit[7]); // Assuming the both price is at index 7
										$fpPrice =  str_replace(',', '', $fp_price); // Assuming the both price is at index 7
	
										if (($unit_price !== 0 && $sell_price !== 0) || ($unit_price !== 0 && $both_price !== 0) || ($unit_price !== 0 && $sell_price !== 0)) {
											$q->orWhere(function ($subQuery) use ($unit_price, $survey_price, $sell_price, $both_price, $fpPrice) {
												$subQuery->where(function ($subSubQuery) use ($unit_price) {
													$subSubQuery->where('budget_from', '<=', $unit_price)
														->where('budget_to', '>=', $unit_price);
												})
													->orWhere(function ($subSubQuery) use ($sell_price) {
														$subSubQuery->where('budget_from', '<=', $sell_price)
															->where('budget_to', '>=', $sell_price);
													})
													->orWhere(function ($subSubQuery) use ($both_price) {
														$subSubQuery->where('budget_from', '<=', $both_price)
															->where('budget_to', '>=', $both_price);
													})
													->orWhere(function ($subSubQuery) use ($fpPrice) {
														$subSubQuery->where('budget_from', '<=', $fpPrice)
															->where('budget_to', '>=', $fpPrice);
													})->orWhere(function ($subSubQuery) use ($survey_price) {
														$subSubQuery->where('budget_from', '<=', $survey_price)
															->where('budget_to', '>=', $survey_price);
													});
											});
										} else if ($survey_price !== 0) {
											$q->orWhere(function ($subQuery) use ($survey_price) {
												$subQuery->where('budget_from', '<=', $survey_price)
													->where('budget_to', '>=', $survey_price)
													->orWhere('rent_price', '<=', $survey_price)
													->where('sell_price', '>=', $survey_price);
											});
										} else if ($unit_price !== 0) {
	
											$q->orWhere(function ($subQuery) use ($unit_price, $unit, $pro) {
												$subQuery->where('budget_from', '<=', $unit_price)
													->where('budget_to', '>=', $unit_price)
													->orWhere(function ($subSubQuery) use ($unit, $pro) {
														if ($pro->property_category !== '259') {
															$subSubQuery->where('rent_price', '=', $unit[4])
																->where('sell_price', '=', $unit[3]);
														}
													});
											});
										} else if ($sell_price !== 0 && !in_array($pro->property_category, ["260", "261", "256", "254"])) {
											$q->orWhere(function ($subQuery) use ($sell_price) {
												$subQuery->where('budget_from', '<=', $sell_price)
													->where('budget_to', '>=', $sell_price);
											});
										} else if ($sell_price !== 0 && $pro->property_category !== "259" && $pro->property_category === "260") {
											$sell_price = (int) str_replace(',', '', $unit[3]);
											$q->orWhere(function ($subQuery) use ($sell_price) {
												$subQuery->where('budget_from', '<=', $sell_price)
													->where('budget_to', '>=', $sell_price);
											});
										}
									}
								});
							}
	
	
							if ($request->match_enquiry_size) {
								$parts = explode("_-||-_", $pro->salable_area);
								$result = $parts[0];
								$result_unit = $parts[1];
								$area_size_from = str_replace(',', '', $result);
								$area_size_to = str_replace(',', '', $result);
	
								$fpparts = explode("_-||-_", $pro->fp_plot_size);
								$fp = $fpparts[0];
								$fp_unit = $fpparts[1];
								$fp_size_from = str_replace(',', '', $fp);
								$fp_size_to = str_replace(',', '', $fp);
	
								$parts3 = explode("_-||-_", $pro->salable_plot_area);
								$result3 = $parts3[0];
								$result3_unit = $parts3[1];

								if ($area_size_from != '' && $area_size_to != '' && $result_unit !== "" && $pro->property_category !== "259" && $pro->property_category !== "260"  && $pro->property_category !== "254" && $pro->property_category !== "256") {
									$query->where('area_from', '<=', $area_size_from)
										->where('area_to', '>=', $area_size_to);
								} else if ($area_size_from != '' && $area_size_to != '' && $result_unit !== "" && $pro->property_category === "259" || $pro->property_category === "256" || $pro->property_category === "260" || $pro->property_category == "254") {
									$area_from_int = (int) $area_size_from;
									$area_to_int = (int) $area_size_to;
									$query->where('area_from', '<=', $area_from_int)
										->where('area_to', '>=', $area_to_int);
								}

								if ($fp_size_from != '' && $fp_size_to != '' && $result_unit !== "") {
									$query->where('area_from', '<=', '1900')
										->where('area_to', '>=', '1900');
								}
								if ($result && $result_unit) {
									$query->where('area_from_measurement', '=', $result_unit)
										->where('area_to_measurement', '>=', $result_unit);
								} else if ($result3 && $result3_unit) {
									$query->where('area_from_measurement', '=', $result3_unit)
										->where('area_to_measurement', '>=', $result3_unit);
								}
	
								if ($fp && $fp_unit) {
									$query->where('area_from_measurement', '=', $fp_unit)
										->where('area_to_measurement', '=', $fp_unit);
								}
							}
						}
					});
				}

				$data->orderByRaw('CASE
				WHEN enquiries.enq_status = 1 THEN 1
				ELSE 2
				END,  enquiries.id DESC');

			} else {
				$data = Enquiries::with('Employee', 'Progress', 'activeProgress')->where('user_id', Auth::user()->id)
				->when($request->filter_by, function ($query) use ($request) {
					if ($request->filter_by == 'new') {
						return $query->doesntHave('Progress');
					} elseif ($request->filter_by == 'today') {
						return $query->whereDate('created_at', '=', Carbon::now()->format('Y-m-d'));
					} elseif ($request->filter_by == 'tomorrow') {
						return $query->whereHas('activeProgress', function ($query) {
							$query->whereDate('nfd', '=', Carbon::tomorrow()->format('Y-m-d'));
						});
					} elseif ($request->filter_by == 'yesterday') {
						return $query->whereHas('activeProgress', function ($query) {
							$query->whereDate('nfd', '=', Carbon::yesterday()->format('Y-m-d'));
						});
					} elseif ($request->filter_by == 'due') {
						return $query->whereHas('activeProgress', function ($query) {
							$query->whereDate('nfd', '<=', Carbon::now()->format('Y-m-d'));
						});
					} elseif ($request->filter_by == 'weekend') {
						return $query->whereHas('activeProgress', function ($query) {
							$query->whereDate('nfd', '<=', Carbon::now()->endOfWeek())->whereDate('nfd', '>=', Carbon::now()->endOfWeek()->subDay());
						});
					} elseif ($request->filter_by == 'missed') {
						return $query->whereDate('created_at', '<', Carbon::now()->format('Y-m-d'));
					}
				})
				->when($request->calendar_date && $request->calendar_type, function ($query) use ($request) {
					if ($request->calendar_type == 'New Enquiry') {
						return $query->whereDate('created_at', $request->calendar_date);
					} else {
						return $query->whereHas('activeProgress', function ($query) use ($request) {
							$query->whereDate('created_at', '=', $request->calendar_date)->where('progress', $request->calendar_type);
						});
					}
				})
				->when($request->filter_city_id, function ($query) use ($request) {
					return $query->where('enquiry_city_id', $request->filter_city_id);
				})
				->when($request->filter_enquiry_branch_id, function ($query) use ($request) {
					return $query->where('enquiry_branch_id', $request->filter_enquiry_branch_id);
				})
				->when($request->filter_employee_id, function ($query) use ($request) {
					return $query->where('employee_id', $request->filter_employee_id);
				})
				->when($request->filter_property_type, function ($query) use ($request) {
					return $query->where('requirement_type', $request->filter_property_type);
				})
				->when($request->filter_specific_type, function ($query) use ($request) {
					$query->where(function ($query) use ($request) {
						$types = json_decode($request->filter_specific_type);
						if (isset($types[0])) {
							foreach ($types as $key => $value) {
								$query->orWhere('property_type', 'like', '%' . $value . '%');
							}
						}
					});
				})
				->when($request->filter_configuration, function ($query) use ($request) {
					return $query->whereJsonContains('configuration', $request->filter_configuration);
				})

				->when($request->filter_area_id, function ($query) use ($request) {
					$query->where(function ($query) use ($request) {
						$types = json_decode($request->filter_area_id);
						if (isset($types[0])) {
							foreach ($types as $key => $value) {
								$query->orWhere('area_ids', 'like', '%' . $value . '%');
							}
						}
					});
				})
				->when($request->filter_enquiry_for, function ($query) use ($request) {
					return $query->where('enquiry_for', $request->filter_enquiry_for);
				})
				->when($request->filter_enquiry_source, function ($query) use ($request) {
					return $query->where('enquiry_source', $request->filter_enquiry_source);
				})
				->when($request->filter_enquiry_progress, function ($query) use ($request) {
					return $query->whereHas('activeProgress', function ($query) use ($request) {
						$query->where('progress', $request->filter_enquiry_progress);
					});
				})
				->when($request->filter_enquiry_status, function ($query) use ($request) {
					return $query->where('enquiry_status', $request->filter_enquiry_status);
				})
				->when($request->filter_sales_comment, function ($query) use ($request) {
					return $query->whereHas('activeProgress', function ($query) use ($request) {
						$query->where('sales_comment_id', $request->filter_sales_comment);
					});
				})
				->when($request->filter_from_area, function ($query) use ($request) {
					return $query->where('area_from', '>=', $request->filter_from_area);
				})
				->when($request->filter_to_area, function ($query) use ($request) {
					return $query->where('area_to', '<=', $request->filter_to_area);
				})
				->when($request->filter_lead_type, function ($query) use ($request) {
					return $query->whereHas('activeProgress', function ($query) use ($request) {
						$query->where('lead_type', $request->filter_lead_type);
					});
				})
				->when($request->filter_purpose, function ($query) use ($request) {
					return $query->where('purpose', $request->filter_purpose);
				})
				->when($request->filter_nfd_from, function ($query) use ($request) {
					return $query->whereHas('activeProgress', function ($query) use ($request) {
						$query->whereDate('nfd', '>=', $request->filter_nfd_from);
					});
				})
				->when($request->filter_nfd_to, function ($query) use ($request) {
					return $query->whereHas('activeProgress', function ($query) use ($request) {
						$query->whereDate('nfd', '>=', $request->filter_nfd_to);
					});
				})
				->when($request->filter_from_date, function ($query) use ($request) {
					return $query->whereDate('created_at', '>=', $request->filter_from_date);
				})
				->when($request->filter_to_date, function ($query) use ($request) {
					return $query->whereDate('created_at', '<=', $request->filter_to_date);
				})
				->when($request->filter_favourite, function ($query) use ($request) {
					return $query->where('is_favourite', $request->filter_favourite);
				})
				->when($request->filter_new_enquiry, function ($query) use ($request) {
					return $query->doesntHave('activeProgress');
				})
				->when($request->week_end_enq, function ($query) use ($request) {
					return $query->where('weekend_enq', $request->week_end_enq);
				})

				->when($request->filter_draft, function ($query) use ($request) {
					return $query->whereDate('created_at', '<=', $request->filter_draft);
				})
				->when($request->filter_prospect, function ($query) use ($request) {
					return $query->whereDate('created_at', '<=', $request->filter_prospect);
				})
				//Matching Enquiry
				->when(!empty($request->search_enq), function ($query) use ($request, $pro) {
					if (!empty($pro)) {
						// prop type = enq type req type
						if ($request->match_property_type) {
							// dd("requirement_type", $pro->property_type, "..", $request->match_property_type);
							$query->where('requirement_type',   $pro->property_type);
						}

						//prop category = enq category
						if ($request->match_specific_type) {
							// dd("property_type", $request->match_specific_type, "..", $pro->property_category);
							$query->where('property_type',   $pro->property_category);
						}

						if ($request->match_enquiry_weekend && ($pro->week_end_villa == '1')) {
							// dd("pro->week_end_villa",$pro->week_end_villa);
							$query->where('weekend_enq',   $pro->week_end_villa);
						}

						if ($request->match_specific_sub_type) {
							// dd("property_sub_type", $request->match_specific_sub_type, ".Conf.", $pro->configuration,$pro->property_category);
							if ($pro->property_category !== '258' && $pro->property_category !== '256') {
								$query->whereJsonContains('configuration', ($pro->configuration));
							} else if ($pro->property_category === '258') {
								$query->whereJsonContains('configuration', ('0'));
							} else if ($pro->property_category == '256') {
								// $query->whereJsonContains('configuration', '');
							}
						}

						// Property For = Enquiry for
						if ($request->match_enquiry_for) {
							// dd("enquiry_for .. ",$pro->property_for,$request->match_enquiry_for);
							$enquiry_for = ($pro->property_for == 'Sell') ? 'Buy' : $pro->property_for;
							if ($enquiry_for !== 'Both') {
								$query->where('enquiry_for', $enquiry_for);
							}
						}

						// price multi units details 
						if ($request->match_budget_from_type) {
							$survey_price = (int) $pro->survey_price; // Cast to integer
							$fp_price =  $pro->fp_plot_price; // Cast to integer
							// dd("fp_price",$survey_price);
							$unitDetails = json_decode($pro->unit_details, true);
							$query->where(function ($q) use ($unitDetails, $survey_price, $fp_price, $pro) {
								foreach ($unitDetails as $unit) {
									$unit_price =  str_replace(',', '', $unit[4]); // Assuming the price is at index 4
									$sell_price = (int) str_replace(',', '', $unit[3]); // Assuming the sell price is at index 3
									$both_price =  str_replace(',', '', $unit[7]); // Assuming the both price is at index 7
									$fpPrice =  str_replace(',', '', $fp_price); // Assuming the both price is at index 7

									if (($unit_price !== 0 && $sell_price !== 0) || ($unit_price !== 0 && $both_price !== 0) || ($unit_price !== 0 && $sell_price !== 0)) {
										// dd("11");
										$q->orWhere(function ($subQuery) use ($unit_price, $survey_price, $sell_price, $both_price, $fpPrice) {
											$subQuery->where(function ($subSubQuery) use ($unit_price) {
												$subSubQuery->where('budget_from', '<=', $unit_price)
													->where('budget_to', '>=', $unit_price);
											})
												->orWhere(function ($subSubQuery) use ($sell_price) {
													$subSubQuery->where('budget_from', '<=', $sell_price)
														->where('budget_to', '>=', $sell_price);
												})
												->orWhere(function ($subSubQuery) use ($both_price) {
													$subSubQuery->where('budget_from', '<=', $both_price)
														->where('budget_to', '>=', $both_price);
												})
												->orWhere(function ($subSubQuery) use ($fpPrice) {
													$subSubQuery->where('budget_from', '<=', $fpPrice)
														->where('budget_to', '>=', $fpPrice);
												})->orWhere(function ($subSubQuery) use ($survey_price) {
													$subSubQuery->where('budget_from', '<=', $survey_price)
														->where('budget_to', '>=', $survey_price);
												});
										});
									} else if ($survey_price !== 0) {
										// dd("112");

										$q->orWhere(function ($subQuery) use ($survey_price) {
											$subQuery->where('budget_from', '<=', $survey_price)
												->where('budget_to', '>=', $survey_price)
												->orWhere('rent_price', '<=', $survey_price)
												->where('sell_price', '>=', $survey_price);
										});
									} else if ($unit_price !== 0) {
										// dd("113");

										$q->orWhere(function ($subQuery) use ($unit_price, $unit, $pro) {
											$subQuery->where('budget_from', '<=', $unit_price)
												->where('budget_to', '>=', $unit_price)
												->orWhere(function ($subSubQuery) use ($unit, $pro) {
													if ($pro->property_category !== '259') {
														$subSubQuery->where('rent_price', '=', $unit[4])
															->where('sell_price', '=', $unit[3]);
													}
												});
										});
									} else if ($sell_price !== 0 && !in_array($pro->property_category, ["260", "261", "256", "254"])) {
										// dd("114");

										$q->orWhere(function ($subQuery) use ($sell_price) {
											$subQuery->where('budget_from', '<=', $sell_price)
												->where('budget_to', '>=', $sell_price);
										});
									} else if ($sell_price !== 0 && $pro->property_category !== "259" && $pro->property_category === "260") {
										// dd("115");

										$sell_price = (int) str_replace(',', '', $unit[3]);
										$q->orWhere(function ($subQuery) use ($sell_price) {
											$subQuery->where('budget_from', '<=', $sell_price)
												->where('budget_to', '>=', $sell_price);
										});
									}
								}
							});

							// Add additional conditions if needed
						}


						// size range = prop salable area
						if ($request->match_enquiry_size) {
							// dd("match_enquiry_size ==>", $request->match_enquiry_size, '==',$pro->salable_plot_area,".1.", $pro->salable_area, ".2.", $pro->constructed_salable_area,".3.",$pro->fp_plot_size,".4.",$pro->survey_plot_size);
							$parts = explode("_-||-_", $pro->salable_area);
							$result = $parts[0];
							$result_unit = $parts[1];
							$area_size_from = str_replace(',', '', $result);
							$area_size_to = str_replace(',', '', $result);

							$fpparts = explode("_-||-_", $pro->fp_plot_size);
							$fp = $fpparts[0];
							$fp_unit = $fpparts[1];
							$fp_size_from = str_replace(',', '', $fp);
							$fp_size_to = str_replace(',', '', $fp);
							// $parts = explode("_-||-_", $pro->constructed_salable_area);
							// $result2 = $parts[0];
							// $result2_unit = $parts[1];
							// $area_from = str_replace(',', '', $result2);
							// $area_to = str_replace(',', '', $result2);

							$parts3 = explode("_-||-_", $pro->salable_plot_area);
							$result3 = $parts3[0];
							$result3_unit = $parts3[1];
							$area_from3 = str_replace(',', '', $result3);
							$area_to3 = str_replace(',', '', $result3);


							// dd("area_size_from",$area_size_from,"area_size_to",$area_size_to,"pro->property_category",$pro->property_category,"salable_plot_area",$pro->salable_plot_area);
							// salable
							if ($area_size_from != '' && $area_size_to != '' && $result_unit !== "" && $pro->property_category !== "259" && $pro->property_category !== "260"  && $pro->property_category !== "254" && $pro->property_category !== "256") {
								// dd("inn",$pro->property_category,$area_size_from,"--",$area_size_to);
								$query->where('area_from', '<=', $area_size_from)
									->where('area_to', '>=', $area_size_to);
							} else if ($area_size_from != '' && $area_size_to != '' && $result_unit !== "" && $pro->property_category === "259" || $pro->property_category === "256" || $pro->property_category === "260" || $pro->property_category == "254") {
								// dd("outt");
								$area_from_int = (int) $area_size_from;
								$area_to_int = (int) $area_size_to;
								// dd("out",$area_from_int,$area_to_int);
								$query->where('area_from', '<=', $area_from_int)
									->where('area_to', '>=', $area_to_int);
							}

							// fp
							if ($fp_size_from != '' && $fp_size_to != '' && $result_unit !== "") {
								// dd("inn",$fp_size_from,"---",$fp_size_to);
								$query->where('area_from', '<=', '1900')
									->where('area_to', '>=', '1900');
							}


							// if ($area_from != '' && $area_to != '' && $result2_unit !== "") {
							// 	// dd("12");
							// 	$query->where('area_from', '<=', $area_from)
							// 		->where('area_to', '>=', $area_to);
							// } else if ($area_from3 != '' && $area_to3 != '' && $result3_unit !== "") {
							// 	// dd("area_from3",$area_from3,$area_to3);
							// 	$query->where('area_from', '<=', $area_from3)
							// 		->where('area_to', '>=', $area_from3);
							// }
							if ($result && $result_unit) {
								// dd("12");
								$query->where('area_from_measurement', '=', $result_unit)
									->where('area_to_measurement', '>=', $result_unit);
							} else if ($result3 && $result3_unit) {
								// dd('result3_unit', $result3_unit);
								$query->where('area_from_measurement', '=', $result3_unit)
									->where('area_to_measurement', '>=', $result3_unit);
							}

							if ($fp && $fp_unit) {
								$query->where('area_from_measurement', '=', $fp_unit)
									->where('area_to_measurement', '=', $fp_unit);
							}
						}
					}
				})
				->orderByRaw('CASE
				WHEN enquiries.enq_status = 1 THEN 1
				ELSE 2
				END,  enquiries.id DESC');
			}

			$parts = explode('?', $request->location);

			if (count($parts) > 1) {
				$value = $parts[1];
				$value = trim($value);

				if (strpos($value, 'data_id') !== false) {
					$value_part = explode('=', $value);
					if ($value_part[1] > 0) {
						$data->where('id', $value_part[1]);
					}
				}
			}

			$data = $data->orderBy('id', 'desc')->get();

			if($request->filled('filter_from_budget') && $request->filled('filter_to_budget')) {
				$data = $data->filter(function ($value) use ($request) {
					if (!empty($request->filter_from_budget) && !empty($value->budget_from) && !(Helper::c_to_n($value->budget_from) >= Helper::c_to_n($request->filter_from_budget))) {
						return false;
					}
	
					if (!empty($request->filter_to_budget) && !empty($value->budget_to) && !(Helper::c_to_n($value->budget_to) <= Helper::c_to_n($request->filter_to_budget))) {
						return false;
					}
	
					return true;
				});
			}

		return DataTables::of($data)
			->editColumn('client_name', function ($row) use ($dropdownsarr) {
				$lead_type = '';
				$pro = 'New Lead';
				if (isset($row->activeProgress)) {
					$pro1 = $row->activeProgress;
					$pro = $pro1->progress;
					if (!empty($pro1->lead_type)) {
						if (str_contains(strtolower($pro1->lead_type), 'warm')) {
							$leadd = 'warm';
						} elseif (str_contains(strtolower($pro1->lead_type), 'cold')) {
							$leadd = 'cold';
						} else {
							$leadd = 'hot';
						}
						$lead_type = '<img style="height:24px" src="' . asset('assets/images/' . $leadd . '-lead.png') . '" alt="">';
					}
				}

				$first = '<td align="center" style="vertical-align:top"><b><a href="' . route('admin.view.enquiry', encrypt($row->id)) . '"> ' . $row->client_name . '</a></b>' . $lead_type . ' <br><a href="tel:' . $row->client_mobile . '">' . $row->client_mobile . '</a>';

				$s_1 = 'border-bottom:10px solid #1d2848 !important';
				$title = $pro;
				if (isset($dropdownsarr[$pro])) {
					$s_1 = 'border-bottom:10px solid ' . (isset(explode('___', $dropdownsarr[$pro]['name'])[1]) ? explode('___', $dropdownsarr[$pro]['name'])[1] : "") . ' !important';
					$title = (isset(explode('___', $dropdownsarr[$pro]['name'])[0]) ? explode('___', $dropdownsarr[$pro]['name'])[0] : "");
				}
				if ($pro == 'Lead Confirmed') {
					$s_1 = 'border-bottom:10px solid #ff7e00 !important';
				} elseif ($pro == 'Site Visit Scheduled') {
					$s_1 = 'border-bottom:10px solid #a200ff !important';
				} elseif ($pro == 'Site Visit Completed') {
					$s_1 = 'border-bottom:10px solid #fff600 !important';
				} elseif ($pro == 'Discussion') {
					$s_1 = 'border-bottom:10px solid #00f0ff !important';
				} elseif ($pro == 'Booked') {
					$s_1 = 'border-bottom:10px solid #0d8c07 !important';
				} elseif ($pro == 'Lost') {
					$s_1 = 'border-bottom:10px solid #ff2a75 !important';
				} else {
					$title = "New Lead";
				}

				$second = '<div><div class="row mx-0 align-items-center"><div data-bs-content="' . $title . '" data-bs-original-title="" data-bs-trigger="hover" data-container="body" data-bs-toggle="popover" data-bs-placement="bottom" style="' . $s_1 . '" class="py-0 px-0 d-block col-8"></div> <div class="col-2"><i class="fa fa-info-circle cursor-pointer color-code-popover" data-container="body"  data-bs-content="&nbsp;" data-bs-trigger="hover focus"></i></div></div></div>';
				$end = '</td>';

				return $first . $second . $end;
			})
			->editColumn('client_requirement', function ($row) use ($dropdowns, $areas) {
				$area_name = '';
				$other_areas = '';
				$configuration_names = [];
				$category = '';
				$configuration_display = '';

				$configurationArray = json_decode($row->configuration);
				if (!empty($configurationArray) && isset($configurationArray[0])) {
					foreach ($configurationArray as $configurationKey) {
						if (!empty(config('constant.property_configuration')[$configurationKey])) {
							$configuration_names[] = config('constant.property_configuration')[$configurationKey];
						} else {
							$configuration_names[] = "Null";
						}
					}
					$configuration_display = implode(', ', $configuration_names);
				} else {
					$configuration_display = (!empty($dropdowns[$row->property_type]['name'])) ? ' | ' . $dropdowns[$row->property_type]['name'] : '';
				}

				if ($row->requirement_type === '87') {
					$category =  (!empty($dropdowns[$row->property_type]['name'])) ?  $dropdowns[$row->property_type]['name'] . ' | ' : '';
				}

				if (!empty($row->area_ids)) {
					$area_ids = json_decode($row->area_ids);
					foreach ($area_ids as $key => $value) {
						$area = !empty($areas[$value]['name']) ? $areas[$value]['name'] : '';
						if ($key < 2) {
							$area_name .= ($key > 0 ? ', ' : '') . $area;
						} else {
							$other_areas .= (!empty($other_areas) ? ', ' : '') . $area;
						}
					}
				}

				$area_title = !empty($other_areas) ? ' <i class="fa fa-info-circle cursor-pointer" data-bs-content="' . $other_areas . '" data-bs-original-title="" data-bs-trigger="hover" data-container="body" data-bs-toggle="popover" data-bs-placement="bottom"></i>' : '';

				$area_form_m = '';
				$land_units = DB::table('land_units')->get();
				if (!empty($row->area_from_measurement)) {
					$unit = $land_units->firstWhere('id', $row->area_from_measurement);
					$area_form_m = $unit ? $unit->unit_name : null;
				}

				if ($row->property_type == '256') {
					$fstatus  = '';
				} else {
					$fstatus  = '';
					if (!empty($row->furnished_status) && !empty(json_decode($row->furnished_status))) {
						$vv = json_decode($row->furnished_status);
						if (isset($vv[0])) {
							if (!empty($vv[0])) {
								if ($vv[0] == "106" || $vv[0] == "34") {
									$fstatus = 'Furnished';
								} elseif ($vv[0] == "107" || $vv[0] == "35") {
									$fstatus = 'Semi Furnished';
								} elseif ($vv[0] == "108" || $vv[0] == "36") {
									$fstatus = 'Unfurnished';
								} else {
									$fstatus = 'Can Furnished';
								}
							}
						}
					}
				}

				$req = '<div class="mb-1">' . $row->enquiry_for . ((!empty($row->enquiry_for) && !empty($configuration_display)) ? ' | ' : $configuration_display) . $category . $configuration_display . '</div>';
				// $req .= '<div class="mb-1 fw-bold">' . ((!empty($dropdowns[$row->requirement_type]['name'])) ? $dropdowns[$row->requirement_type]['name'] : '') . '</div>';
				$req .= '<div class="mb-1">' . ((!empty($row->area_from) && !empty($row->area_to)) ? $row->area_from . " - " . $row->area_to . " " . $area_form_m : "") . '</div>';
				$req .= '<div class="mb-1"><small style="font-style:italic; font-size:89% !important"></small></div>';
				$req .= $fstatus;
				if (!empty($area_name)) {
					$req .= '<div class="mb-1"><small style="font-style:italic; font-size:89% !important"><i class="fa fa-map-marker"></i> ' . $area_name . $area_title . '</small></div>';
				}

				return $req;
			})
			->editColumn('budget', function ($row) {
				$bud = '';
				$row->budget_from = trim($row->budget_from);
				$row->budget_to = trim($row->budget_to);
				$row->rent_price = trim($row->rent_price);
				$row->sell_price = trim($row->sell_price);
				$budget_from_formatted = HelperFn::formatIndianCurrency($row->budget_from);
				$budget_to_formatted = HelperFn::formatIndianCurrency($row->budget_to);
				$rent_price_formatted = HelperFn::formatIndianCurrency($row->rent_price);
				$sell_price_formatted = HelperFn::formatIndianCurrency($row->sell_price);
				if ((!empty($row->budget_from) || !empty($row->budget_to)) && $row->enquiry_for !== 'Both') {
					$bud = '<td style="vertical-align:top">
						' . ((!empty($row->budget_from)) ? '₹ ' . $budget_from_formatted . ' to ₹ ' : ' upto ') . $budget_to_formatted . '
					</td>';
				} else {
					$bud = '<td style="vertical-align:top">
						' . ((!empty($row->rent_price)) ? 'R: ₹ ' . $rent_price_formatted . ' to S: ₹ ' : ' ')  . $sell_price_formatted . '
					</td>';
				}
				return $bud;
			})
			->editColumn('telephonic_discussion', function ($row) {
				if (isset($row->activeProgress)) {
					$pro = $row->activeProgress;
					$remark_data = "";
					if (!empty($pro->remarks)) {
						$remark_data = $pro->remarks;
					}
					return Carbon::parse($pro->nfd)->format('d-m-Y \| H:i') . '<br>' . $remark_data;
				}
				if ($row->telephonic_discussion == null) {
					return " ";
				}
				return $row->telephonic_discussion;
			})
			->editColumn('assigned_to', function ($row) {
				if (!empty($row->Employee)) {
					return '<td align="center" style="vertical-align:top">
				' . $row->Employee->first_name . ' ' . $row->Employee->last_name . ' <br>
				' . Carbon::parse($row->transfer_date)->format('d-m-Y') .  '</td>';
				};
			})
			->editColumn('status_change', function ($row) {
				$ischecked = $row->enquiry_status;
				$status =
					'<div class="d-flex align-items-center mb-3 col-md-2">
					<div class="form-group">
						<label class="switch mb-0">
							<input type="checkbox" class="changeTheStatus"  data-id="' . $row->id . '" ' . (($ischecked) ? 'checked' : '') . ' ><span class="switch-state"></span>
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
			->editColumn('Actions2', function ($row) {
				$buttons = '';
				$user = User::with(['roles', 'roles.permissions'])
					->where('id', Auth::user()->id)
					->first();

				$permissions = $user->roles[0]['permissions']->pluck('name')->toArray();

				if (in_array('enquiry-edit', $permissions)) {
					$buttons =  $buttons . '<a href="' . route('admin.enquiry.edit', $row->id) . '"><i role="button" title="Edit" data-id="' . $row->id . '"  class="fs-22 py-2 mx-2 fa-pencil pointer fa  " type="button"></i></a>';
				}
				if (in_array('enquiry-delete', $permissions)) {
					$buttons =  $buttons . '<i role="button" title="Delete" data-id="' . $row->id . '" onclick=deleteEnquiry(this) class="fs-22 py-2 mx-2 fa-trash pointer fa text-danger" type="button"></i>';
				}
				$buttons =  $buttons . '<i title="Matching Property" data-id="' . $row->id . '" onclick=matchingProperty(this) class="fa fs-22 py-2 mx-2 fa-plane text-info"></i>';
				if (in_array('delete-enquiry-progress', $permissions)) {
					$buttons =  $buttons . '<i title="Progress" data-id="' . $row->id . '" onclick=showProgress(this) class="fa fs-22 py-2 mx-2 fa-bars text-warning"></i><br>';
				}
				if (in_array('bulk-enquiry-transfer', $permissions)) {
					$buttons =  $buttons . '<i  title="Transfer Enqiry" data-employee="' . $row->employee_id . '"  data-id="' . $row->id . '" onclick=transferEnquiry(this) class="pointer fa fs-22 py-2 mx-2 fa-long-arrow-right text-dark"></i>';
				}
				$buttons =  $buttons . '<i title="Contact List" data-id="' . $row->id . '" onclick=contactList(this) class="fa fs-22 py-2 mx-2 fa-database text-blue"></i>';
				$buttons =  $buttons . '<i title="Schedule Visit" data-employee="' . $row->employee_id . '" data-id="' . $row->id . '" onclick=showScheduleVisit(this) class="fa fs-22 py-2 mx-2 fa-map text-success"></i>';
				return $buttons;
			})
			->rawColumns(['select_checkbox', 'telephonic_discussion', 'client_name', 'client_requirement', 'budget', 'assigned_to', 'Actions', 'Actions2', 'status_change'])
			->make(true);
		}

		$prop_list = Helper::get_property_units_helper();
		$projects = Properties::with('Projects')->get();
		$configuration_settings = DropdownSettings::get()->toArray();

		$prop_type = [];
		foreach ($configuration_settings as $key => $value) {
			if (($value['name'] == 'Commercial' || $value['name'] == 'Residential') && str_contains($value['dropdown_for'], 'property_')) {
				array_push($prop_type, $value['id']);
			}
		}


		$cities = City::orderBy('name')->where('user_id', '=', Auth::user()->id)->get();
		$branches = Branches::orderBy('name')->get();
		$areas = Areas::where('user_id', Auth::user()->id)->orderBy('name')->get();
		$employees = User::where('parent_id', Session::get('parent_id'))->orWhere('id', Session::get('parent_id'))->get();


		return view('admin.enquiries.index', compact('projects', 'prop_type', 'branches', 'cities', 'areas', 'configuration_settings', 'employees', 'prop_list'));
	}

	public function changeEnquiryStatus(Request $request)
	{
		if ($request->ajax()) {
			if (isset($request->id)) {
				$vv = Enquiries::find($request->id);
				$vv->enquiry_status = $request->status;
				$vv->save();
			}
		}
	}

	public function saveComments(Request $request)
	{
		if ($request->ajax()) {
			if (isset($request->id) && !empty($request->comment)) {
				$vv = new EnquiryComments();
				$vv->comment = $request->comment;
				$vv->user_id = Auth::User()->id;
				$vv->enquiry_id = $request->id;
				$vv->save();
			}
		}
	}

	public function getComments(Request $request)
	{
		$comments = EnquiryComments::with('User')->where('enquiry_id', $request->id)->orderBy('id', 'DESC')->get()->toArray();
		foreach ($comments as $key => $value) {
			$value['created_at'] = Carbon::parse($value['created_at'])->format('d-m-Y');
			$comments[$key] = $value;
		}
		return json_encode($comments);
	}

	public function importEnquiryTemplate(Request $request)
	{
		// dd("impor enq");
		$spreadsheet = new Spreadsheet;

		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', "ClientName");
		$sheet->setCellValue('B1', "Mobile");
		$sheet->setCellValue('C1', "Email");
		$sheet->setCellValue('D1', "EnquiryFor");
		$sheet->setCellValue('E1', "RequirementType");
		$sheet->setCellValue('F1', "SpecificPropertyType");
		$sheet->setCellValue('G1', "Configuration");
		// $sheet->setCellValue('H1', "Configuration2");
		$sheet->setCellValue('I1', "Enquiry Source");
		$sheet->setCellValue('J1', "AreaFrom");
		$sheet->setCellValue('K1', "AreaTo");
		$sheet->setCellValue('L1', "AssingedTo");
		$sheet->setCellValue('M1', "Remarks");
		$sheet->setCellValue('N1', "Created On");
		$sheet->setCellValue('O1', "Status");
		$sheet->setCellValue('P1', "Enquiry Progress");
		$sheet->setCellValue('Q1', "BudgetFrom");
		$sheet->setCellValue('R1', "BudgetTo");

		$type = "Flat";
		if (!empty($request->type)) {
			$type = $request->type;
		}

		$vvells = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R'];
		foreach ($vvells as $key => $value) {
			$spreadsheet->getActiveSheet()->getColumnDimension($value)->setWidth(15);
		}

		$dd2 = User::where('parent_id', Session::get('parent_id'))->orWhere('id', Session::get('parent_id'))->get()->toArray();
		$users = [];
		foreach ($dd2 as $key => $value) {
			$users[] = $value['first_name'] . ' ' . $value['last_name'];
		}
		$users = '"' . implode(",", $users) . '"';

		$dropdowns = DropdownSettings::get()->toArray();
		$dropdownsarr = [];
		foreach ($dropdowns as $key => $value) {
			$dropdownsarr[$value['dropdown_for']][] = $value['name'];
		}

		$property_configuration = [];
		foreach (config('constant.property_configuration') as $key => $value) {
			array_push($property_configuration, $value);
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



		$enquiryFor = '"Rent, Buy,Both"';
		// $PropertyType = '"' . implode(",", $dropdownsarr['property_construction_type']) . '"';
		$PropertyType = '"' . implode(",", $propertyTypeOptions) . '"';
		// $specificType = '"' . implode(",", $dropdownsarr['property_specific_type']) . '"';
		$specificType = '"' . implode(",", $categoryOptions) . '"';
		// $planType = '"' . implode(",", $property_configuration) . '"';
		$planType = '"' . implode(",", $subcategoryOptions) . '"';
		// dd("...",$enquiryFor,$PropertyType,$specificType,$planType);
		$enquirySource = '"' . implode(",", $dropdownsarr['property_source']) . '"';
		$progress = '"Lead Confirmed,Site Visit Scheduled,Site Visit Completed,Discussion,Booked,Lost"';
		$propertyStatus = '"Active,In Active"';
		$arrr = [];
		$arrr['vals'] = [$enquiryFor, $PropertyType, $specificType, $planType, $enquirySource, $users, $propertyStatus, $progress];
		$arrr['sheetcell'] = ['D1', 'E1', 'F1', 'G1', 'H1', 'I1',  'L1', 'O1'];
		$arrr['setsqref'] = ['D2:D1048576', 'E2:E1048576', 'F2:F1048576', 'G2:G1048576', 'H2:H1048576', 'I2:I1048576',  'L2:L1048576', 'O2:O1048576', 'P2:P1048576'];
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
		$writer->save(public_path('imports/enquiry_sample.xlsx'));
		return redirect(asset('imports/enquiry_sample.xlsx'));
	}

	public function exportEnquiry(Request $request)
	{
		$dropdowns = DropdownSettings::get()->toArray();
		$dropdownsarr = [];
		foreach ($dropdowns as $key => $value) {
			$dropdownsarr[$value['id']] = $value;
		}
		$dropdowns = $dropdownsarr;

		$enqs = [];
		$data = Enquiries::with('Employee', 'activeProgress')->get()->toArray();
		foreach ($data as $key => $value) {

			$arr = [];
			$prop_type = [];
			$area_name = [];
			if (!empty($value['property_type']) && !empty($dropdowns[$value['property_type']]['name'])) {
				$prop_type = $dropdowns[$value['property_type']]['name'];
			}

			$areas = Areas::where('user_id', Auth::user()->id)->get()->toArray();
			$areaarr = [];
			foreach ($areas as $key3 => $value2) {
				$areaarr[$value2['id']] = $value2;
			}
			$areas = $areaarr;

			if (!empty($value['area_ids']) && !empty(json_decode($value['area_ids']))) {
				foreach (json_decode($value['area_ids']) as $key1 => $value1) {
					$area = FacadesDB::table('areas')
						->where('id', $value1)->first();
					array_push($area_name, $area->name);
				}
			}
			$progress = '';
			$nfd = '';
			$remarks = $value['telephonic_discussion'];
			if (!empty($value['active_progress'])) {
				$pro = $value['active_progress'];
				$progress = $pro['progress'];
				if (!empty($pro['remarks'])) {
					$remarks = $pro['remarks'];
				}
				if (!empty($pro['nfd'])) {
					$nfd = Carbon::parse($pro['nfd'])->format('d-m-Y');;
				}
			}

			$arr['Client Name'] = $value['client_name'];
			$arr['Mobile'] = $value['client_mobile'];
			$arr['Email'] = $value['client_email'];
			$arr['Enquiry For'] = $value['enquiry_for'];
			if (!empty($prop_type)) {
				$arr['Property Type'] =  $prop_type;
			} else {
				$arr['Property Type'] = "";
			}
			$arr['Assigned To'] = ((!empty($value['employee'])) ? $value['employee']['first_name'] . ' ' . $value['employee']['last_name'] : '');
			$arr['Created Date'] = Carbon::parse($value['created_at'])->format('d-m-Y');
			$arr['Enquiry Progress'] = $progress;
			$arr['Budget'] = $value['budget_to'];
			$arr['NFD'] = $nfd;
			$arr['Remarks'] = $remarks;
			$arr['Favourite'] = (($value['is_favourite']) ? 'Yes' : 'No');
			$arr['Area'] = implode('/', $area_name);
			array_push($enqs, $arr);
		}
		$time = time() . Session::get('parent_id');
		File::isDirectory(public_path('excel')) or File::makeDirectory(public_path('excel'), 0777, true, true);
		(new FastExcel(collect($enqs)))->export(public_path('excel/' . $time . '_file.xlsx'));

		echo asset('excel/' . $time . '_file.xlsx');
	}

	public function saveProgress(Request $request)
	{
		// dd("saveProgress", $request->all());
		$previous = EnquiryProgress::where('enquiry_id', $request->enquiry_id)->where('status', 1)->first();
		EnquiryProgress::where('enquiry_id', $request->enquiry_id)->where('status', 1)->update(['status' => 0]);
		$data =  new EnquiryProgress();
		$data->enquiry_id = $request->enquiry_id;
		$data->user_id = Auth::user()->id;
		$data->progress = $request->progress;
		$data->lead_type = $request->lead_type;
		if (empty($request->progress)  && !empty($previous->progress)) {
			$data->progress = $previous->progress;
		}
		if (empty($request->lead_type) && !empty($previous->lead_type)) {
			$data->lead_type = $previous->lead_type;
		}
		$data->sales_comment_id = $request->sales_comment_id;
		if (!empty($request->nfd)) {
			$date = Carbon::parse($request->nfd)->format('Y-m-d H:i:s');
			$data->nfd = $date;
		}
		$data->remarks = $request->remarks;
		$data->save();


		// create notification for new user
		$enq = Enquiries::find($request->enquiry_id);
		$notif = UserNotifications::where(['notification_type' => Constants::ENQUIRY_ASSIGNED, 'enquiry_id' => $request->enquiry_id])
			->orderBy('id', 'desc')->first();
		if (empty($notif)) {
			$notif = UserNotifications::where(['notification_type' => Constants::ENQUIRY_FOLLOWUP, 'enquiry_id' => $request->enquiry_id])
				->orderBy('id', 'desc')->first();
		}
		$user = Auth::user();
		$nfDate = Carbon::parse($request->nfd)->format('Y-m-d H:i:s');
		$message = "There an update on enquiry for the client `$enq->client_name`: The next follow up date is " . Carbon::parse($nfDate)->format('d-m-Y');

		if (!empty($notif)) {
			// notify user for next follow up date
			$userNotification = UserNotifications::create([
				"user_id" => @$notif->by_user,
				"notification" => $message,
				"notification_type" => Constants::ENQUIRY_FOLLOWUP,
				'enquiry_id' => $request->enquiry_id,
				'schedule_date' => $nfDate,
				'by_user' => (int) $user->id
			]);
			// if notificaton creation failed.
			if (!$userNotification) {
				Log::error('Unable to create user notification');
			}
			// send if user has onesignal id
			if (!empty($user->onesignal_token)) {
				HelperFn::sendPushNotification($user->onesignal_token, $message);
			}

			// notify logged in user for next follow up date
			UserNotifications::create([
				"user_id" => (int) $user->id,
				"notification" => $message,
				"notification_type" => Constants::ENQUIRY_FOLLOWUP,
				'enquiry_id' => $request->enquiry_id,
				'by_user' => @$notif->by_user
			]);
			$otherUser = User::where('id', $notif->by_user)->first();
			// send if user has onesignal id
			if (!empty($otherUser->onesignal_token)) {
				HelperFn::sendPushNotification($otherUser->onesignal_token, $message);
			}
		}
	}

	public function saveSchedule(Request $request)
	{
		// bhrt
		$previous = QuickSiteVisit::where('enquiry_id', $request->enquiry_id)->where('status', 1)->first();
		QuickSiteVisit::where('enquiry_id', $request->enquiry_id)->where('status', 1)->update(['status' => 0]);
		$data =  new QuickSiteVisit();
		$data->enquiry_id = $request->enquiry_id;
		$data->assigned_by = Auth::user()->id;
		$data->assigned_to = $request->assigned_to;
		$data->visit_status = $request->visit_status;
		$data->schedule_remind = $request->time_before;
		$data->email_reminder = $request->email_reminder;
		$data->sms_reminder = $request->sms_reminder;
		$data->property_list = $request->property_list;
		if (!empty($request->visit_date)) {
			$date = Carbon::parse($request->visit_date)->format('Y-m-d H:i:s');
			$data->visit_date = $date;
		} else {
			$data->visit_date = $previous->visit_date;
		}
		$data->description = $request->description;
		$data->save();

		if ($request->visit_status == 'Confirmed' || $request->visit_status == 'Completed') {
			if ($request->visit_status == 'Confirmed') {
				$the_progress = 'Site Visit Scheduled';
			} else {
				$the_progress = 'Site Visit Completed';
			}
			$enq = Enquiries::find($request->enquiry_id);
			$previous = EnquiryProgress::where('enquiry_id', $request->enquiry_id)->where('status', 1)->first();
			EnquiryProgress::where('enquiry_id', $request->enquiry_id)->where('status', 1)->update(['status' => 0]);
			$data =  new EnquiryProgress();
			$data->enquiry_id = $request->enquiry_id;
			$data->user_id = Auth::user()->id;
			$data->progress = $the_progress;
			$data->lead_type = $request->lead_type;

			// $data->lead_type = $previous->lead_type;
			$data->nfd = $request->visit_date;
			$data->remarks = $request->description;
			$data->save();

			// if same notification already exist for the same user...then delete it.
			UserNotifications::where(['notification_type' => Constants::SCHEDULE_VISIT, 'enquiry_id' => $request->enquiry_id])->delete();

			$notif = UserNotifications::where(['notification_type' => Constants::ENQUIRY_ASSIGNED, 'enquiry_id' => $request->enquiry_id])
				->orderBy('id', 'desc')->first();
			if (!$notif) {
				Log::error('User notifcation with ' . $request->enquiry_id . ' id and enquiry_assigned status not found');
			}
			$user = Auth::user();

			// notify user for next schedule visit date
			$message = $the_progress . ' for client ' . $enq->client_name . ' at ' . Carbon::parse($request->visit_date)->format('d-m-Y');
			if (!empty($notif)) {
				$userNotification = UserNotifications::create([
					"user_id" => (int) $notif->user_id,
					"notification" => $message,
					"notification_type" => Constants::SCHEDULE_VISIT,
					'enquiry_id' => $request->enquiry_id,
					'by_user' => (int) $user->id,
					'schedule_date' => $request->visit_date
				]);
				// if notificaton creation failed.
				if (!$userNotification) {
					Log::error('Save Schedule Visit: Unable to create user notification');
				}
			}
		}
	}
	public function enquiryCalendar(Request $request)
	{
		// calendar bhrt
		if ($request->ajax()) {
			if (empty($request->month)) {
				$request->month = Carbon::now()->month;
			}
			if (empty($request->year)) {
				$request->year = Carbon::now()->year;
			}
			// dd("request",$request->all());
			$arr = [];
			$events = [];
			$type_array = [];
			if ($request->newe) {
				$ar = [];
				$newenq = Enquiries::when($request->month, function ($query) use ($request) {
					return $query->whereMonth('created_at', '=', $request->month);
				})->when($request->year, function ($query) use ($request) {
					return $query->whereYear('created_at', '=', $request->year);
				})
					->where('enq_status', 1)
					->get();
				foreach ($newenq as $key => $value) {
					array_push($ar, Carbon::parse($value->created_at)->format('Y-m-d'));
				}
				$arr['new_enquiry'] = array_count_values($ar);
				$type_array[] = 'new_enquiry';
			}
			// Lead Confirm
			if ($request->leadConf) {
				$ar = [];
				$lead_conf = EnquiryProgress::whereHas('Enquiry')->where('status', 1)->where('progress', '=', 'Lead Confirmed')->when($request->month, function ($query) use ($request) {
					return $query->whereMonth('created_at', '=', $request->month);
				})->when($request->year, function ($query) use ($request) {
					return $query->whereYear('created_at', '=', $request->year);
				})->get();

				foreach ($lead_conf as $key => $value) {
					array_push($ar, Carbon::parse($value->nfd)->format('Y-m-d'));
				}
				$arr['leadConf'] = array_count_values($ar);
				$type_array[] = 'leadConf';
			}
			// Site Visit
			if ($request->sitecomp) {
				$ar = [];
				$sitevisit = EnquiryProgress::whereHas('enquiry')->where('status', 1)->where('progress', '=', 'Site Visit Scheduled')->whereNotNull('nfd')->when($request->month, function ($query) use ($request) {
					return $query->whereMonth('nfd', '=', $request->month);
				})->when($request->year, function ($query) use ($request) {
					return $query->whereYear('nfd', '=', $request->year);
				})->get();

				foreach ($sitevisit as $key => $value) {
					array_push($ar, Carbon::parse($value->nfd)->format('Y-m-d'));
				}
				$arr['site_visit_scheduled'] = array_count_values($ar);
				$type_array[] = 'site_visit_scheduled';
				// dd($arr['site_visit_scheduled'], "arr1");
			}

			// Site Completed
			if ($request->sitecomp) {
				$ar = [];
				$sitecomp = EnquiryProgress::whereHas('Enquiry')->where('status', 1)->where('progress', '=', 'Site Visit Completed')->whereNotNull('nfd')->when($request->month, function ($query) use ($request) {
					return $query->whereMonth('nfd', '=', $request->month);
				})->when($request->year, function ($query) use ($request) {
					return $query->whereYear('nfd', '=', $request->year);
				})->get();

				foreach ($sitecomp as $key => $value) {
					array_push($ar, Carbon::parse($value->nfd)->format('Y-m-d'));
				}
				$arr['site_visit_completed'] = array_count_values($ar);
				$type_array[] = 'site_visit_completed';
				// dd($arr['site_visit_completed'], "arr");
			}
			// discussion
			if ($request->dis) {
				$ar = [];
				$sitevisit = EnquiryProgress::whereHas('Enquiry')->where('status', 1)->where('progress', '=', 'Discussion')->whereNotNull('nfd')->when($request->month, function ($query) use ($request) {
					return $query->whereMonth('nfd', '=', $request->month);
				})->when($request->year, function ($query) use ($request) {
					return $query->whereYear('nfd', '=', $request->year);
				})->get();

				foreach ($sitevisit as $key => $value) {
					array_push($ar, Carbon::parse($value->nfd)->format('Y-m-d'));
				}
				$arr['discussion_schedule'] = array_count_values($ar);
				$type_array[] = 'discussion_schedule';
			}
			// Booked
			if ($request->done) {
				$ar = [];
				$sitevisit = EnquiryProgress::whereHas('Enquiry')->where('status', 1)->where('progress', '=', 'Booked')->when($request->month, function ($query) use ($request) {
					return $query->whereMonth('created_at', '=', $request->month);
				})->when($request->year, function ($query) use ($request) {
					return $query->whereYear('created_at', '=', $request->year);
				})->get();

				foreach ($sitevisit as $key => $value) {
					array_push($ar, Carbon::parse($value->nfd)->format('Y-m-d'));
				}
				$arr['booked'] = array_count_values($ar);
				$type_array[] = 'booked';
			}
			// Lost
			if ($request->lost) {
				$ar = [];
				$sitevisit = EnquiryProgress::whereHas('Enquiry')->where('status', 1)->where('progress', '=', 'Lost')->when($request->month, function ($query) use ($request) {
					return $query->whereMonth('created_at', '=', $request->month);
				})->when($request->year, function ($query) use ($request) {
					return $query->whereYear('created_at', '=', $request->year);
				})->get();

				foreach ($sitevisit as $key => $value) {
					array_push($ar, Carbon::parse($value->nfd)->format('Y-m-d'));
				}
				$arr['lost'] = array_count_values($ar);
				$type_array[] = 'lost';
			}
			$custom_calender_array = [];

			// Fetch the names associated with each type
			$type_names = [
				'new_enquiry' => ['name' => 'New Enquiry', 'class' => 'event-type-new-enquiry'],
				'leadConf' => ['name' => 'Lead Confirmed', 'class' => 'event-type-lead-confirmed'],
				'site_visit_scheduled' => ['name' => 'Site Visit Scheduled', 'class' => 'event-type-site-visit-scheduled'],
				'site_visit_completed' => ['name' => 'Site Visit Completed', 'class' => 'event-type-site-visit-completed'],
				'discussion_schedule' => ['name' => 'Discussion', 'class' => 'event-type-discussion'],
				'booked' => ['name' => 'Booked', 'class' => 'event-type-booked'],
				'lost' => ['name' => 'Lost', 'class' => 'event-type-lost'],
			];
			foreach ($arr as $key => $value) {
				foreach ($value as $key2 => $value2) {
					$date = Carbon::parse($key2)->format('Y-m-d 00:00:00');
					if (isset($custom_calender_array[$date])) {
						continue;
					}
					$custom_calender_array[$date] = $type_array;

					$event['start'] = $date;
					$types = implode(",", $type_array);
					$event['url'] = route('admin.enquiries.calendar.view') . '?date=' . $key2 . '&type=' . $types;

					$title = "";
					$classes = []; // Initialize the classes array for each event
					foreach ($type_array as $type) {
						if (isset($type_names[$type])) {
							$count = isset($arr[$type][$key2]) ? $arr[$type][$key2] : 0;
							if ($count > 0) {
								$title .= $type_names[$type]['name'] . ' (' . $count . ")\n";
								$classes[] = $type_names[$type]['class']; // Add the CSS class to the classes array
							}
						}
					}

					$event['title'] = $title;
					$event['id'] = 'event-' . $key . '-' . $key2;
					$event['classname'] = implode(' ', $classes); // Combine all CSS classes into a single string

					array_push($events, $event);
				}
			}
			// dd($events);
			return json_encode($events);
		}
		$employees = User::where('parent_id', Session::get('parent_id'))->orWhere('id', Session::get('parent_id'))->get();
		return view('admin.calendar.index', compact('employees'));
	}


	public function getProgress(Request $request)
	{
		$progress = EnquiryProgress::with('User', 'Dropdowns')->where('enquiry_id', $request->id)->orderBy('id', 'DESC')->get()->toArray();
		foreach ($progress as $key => $value) {
			$value['created_at'] = Carbon::parse($value['created_at'])->format('d-m-Y');
			$value['nfd'] = Carbon::parse($value['nfd'])->format('d-m-Y g:i A');
			$progress[$key] = $value;
		}
		return json_encode($progress);
	}

	public function getSchedule(Request $request)
	{
		$progress = QuickSiteVisit::with('AssignedTo', 'AssignedBy')->where('enquiry_id', $request->id)->orderBy('id', 'DESC')->get()->toArray();
		foreach ($progress as $key => $value) {
			$value['created_at'] = Carbon::parse($value['created_at'])->format('d-m-Y');
			$value['visit_date'] = Carbon::parse($value['visit_date'])->format('d-m-Y g:i A');
			$progress[$key] = $value;
		}
		return json_encode($progress);
	}

	public function saveEnquiry(Request $request)
	{
		if (!empty($request->id) && $request->id != '') {
			$data = Enquiries::find($request->id);
			if (empty($data)) {
				$data =  new Enquiries();
			}
		} else {
			$data =  new Enquiries();
			$data->transfer_date = date('Y-m-d');
		}
		$budget_from = str_replace(',', '', $request->budget_from);
		$budget_to = str_replace(',', '', $request->budget_to);

		$data->added_by = Auth::user()->id;
		$data->user_id = Session::get('parent_id');
		$data->client_name = $request->client_name;
		$data->client_mobile = $request->client_mobile;
		$data->country_id = $request->country_code;
		$data->client_email = $request->client_email;
		$data->is_nri = $request->is_nri;
		$data->enquiry_for = $request->enquiry_for;
		$data->requirement_type = $request->requirement_type;
		$data->property_type = $request->property_type;
		$data->configuration = json_encode($request->configuration);
		$data->area_from = $request->area_from;
		$data->area_to = $request->area_to;
		$data->enquiry_source_refrence = $request->refrence;
		$data->area_from_measurement = $request->area_from_measurement;
		$data->area_to_measurement = $request->area_to_measurement;
		$data->enquiry_source = $request->enquiry_source;
		$data->furnished_status = $request->furnished_status;
		$data->budget_from = $budget_from;
		$data->budget_to = $budget_to;
		$data->rent_price = $request->rent_price;
		$data->sell_price = $request->sell_price;
		$data->purpose = $request->purpose;
		$data->building_id = $request->building_id;
		$data->enquiry_status = $request->enquiry_status;
		$data->project_status = $request->project_status;
		$data->area_ids = $request->area_ids;
		$data->is_preleased = $request->is_preleased;
		$data->weekend_enq = $request->weekend_enq;
		$data->other_contacts = $request->other_contacts;
		$data->telephonic_discussion = $request->telephonic_discussion;
		$data->highlights = $request->highlights;
		$data->enquiry_city_id = $request->enquiry_city_id;
		$data->enquiry_branch_id = $request->enquiry_branch_id;
		$data->employee_id = $request->employee_id;
		$data->is_favourite = $request->is_favourite;
		$data->district_id = $request->district_id;
		$data->taluka_id = $request->taluka_id;
		$data->village_id = json_encode($request->village_id);
		$data->zone_id    = isset($request->zone) ? $request->zone : NULL;
		$data->save();
		if (!empty($request->area_measurement)) {
			Helper::add_default_measuerement($request->area_measurement);
		}
	}

	public function importEnquiry(Request $request)
	{
		// dd("store enq ");
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

			// $user_id = NULL;
			// if (!empty($value['AssingedTo'])) {
			// 	$user = User::where('parent_id', Session::get('parent_id'))->where('first_name', 'like', '%' . explode(' ', $value['AssingedTo'])[0])->where('last_name', 'like', '%' . explode(' ', $value['AssingedTo'])[1])->first();
			// }


			// if (!empty($user->id) && !empty($value['AssingedTo'])) {
			// 	$user_id = $user->id;
			// }

			$property_type_id = NULL;
			$property_type = DropdownSettings::where('name', 'like', '%' . $value['RequirementType'] . '%')->first();
			if (!empty($property_type->id) && !empty($value['RequirementType'])) {
				$property_type_id = $property_type->id;
			}

			$specific_property_id = NULL;
			$specific_property = DropdownSettings::where('name', 'like', '%' . $value['SpecificPropertyType'] . '%')->first();
			if (!empty($specific_property->id) && !empty($value['SpecificPropertyType'])) {
				$specific_property_id = $specific_property->id;
			}

			$Configuration_id = NULL;
			$Configuration = DropdownSettings::where('name', 'like', '%' . $value['Configuration'] . '%')->where('dropdown_for', 'property_sub_category')->first();
			if (!empty($Configuration->user_id) && !empty($value['Configuration'])) {
				$Configuration_id = $Configuration->user_id;
			}


			// $Configuration_id2 = NULL;
			// $Configuration2 = DropdownSettings::where('name', 'like', '%' . $value['Configuration2'] . '%')->where('dropdown_for','property_sub_category')->first();
			// if (!empty($Configuration2->user_id) && !empty($value['Configuration2'])) {
			// 	$Configuration_id2 = $Configuration2->user_id;
			// }

			// dd("val",$property_type_id,$specific_property_id,$Configuration_id,$Configuration_id2,$value);


			$enquiry_source_id = NULL;
			$enquiry_source = DropdownSettings::where('name', 'like', '%' . $value['Enquiry Source'] . '%')->first();
			// dd("Enquiry Source",$enquiry_source);
			if (!empty($enquiry_source->id) && !empty($value['Enquiry Source'])) {
				$enquiry_source_id = $enquiry_source->id;
			}

			$telephonic = "";
			if (empty($value['Enquiry Progress'])) {
				$telephonic = $value['Remarks'];
			}
			// dd("value", $value, $enquiry_source_id);

			if (!empty($value['ClientName'])) {
				$data =  new Enquiries();
				$data->added_by = Auth::user()->id;
				$data->user_id = Session::get('parent_id');
				$data->client_name = $value['ClientName'];
				$data->client_mobile = $value['Mobile'];
				$data->client_email = $value['Email'];
				$data->enquiry_for = $value['EnquiryFor'];
				$data->requirement_type = json_encode([$property_type_id]);
				$data->property_type =  json_encode([$specific_property_id]);
				$data->configuration = json_encode([$Configuration_id]);
				$data->enquiry_source = $enquiry_source_id;
				$data->budget_from = $value['BudgetFrom'];
				$data->budget_to = $value['BudgetTo'];
				$data->budget_to = $value['BudgetTo'];
				$data->area_from = $value['AreaFrom'];
				$data->area_to = $value['AreaTo'];
				// $data->employee_id = $user_id;
				$data->enquiry_status = $value['Status'];
				$data->telephonic_discussion = $telephonic;
				$data->save();
			}

			if (!empty($value['Enquiry Progress'])) {
				EnquiryProgress::create(['user_id' => ((!empty($user_id)) ? $user_id : Session::get('parent_id')), 'progress' => $value['Enquiry Progress'], 'remarks' => $value['Remarks'], 'enquiry_id' => $data->id]);
			}
		}
	}

	public function transferNow(Request $request)
	{
		if (!empty($request->employee) && !empty($request->enquiry_id)) {
			Enquiries::where('added_by', Auth::user()->id)
				->update([
					'added_by' => 0,
				]);
			$dataEnq = Enquiries::where('id', $request->enquiry_id)->update([
				'employee_id' => $request->employee,
				'transfer_date' => Carbon::now()->format('Y-m-d H:i:s')
			]);

			$assignHistories = AssignHistory::where('enquiry_id', $request->enquiry_id)
				->where('user_id', Auth::user()->id)
				->get();
			if ($assignHistories->isNotEmpty()) {
				AssignHistory::where('enquiry_id', $request->enquiry_id)
					->where('user_id', Auth::user()->id)
					->where('status', 0)
					->update(['status' => 1]);
				// AssignHistory::create(['enquiry_id' => $request->enquiry_id, 'user_id' => Auth::user()->id, 'assign_id' => $request->employee, 'status' => 1]);
			}
			/* Stored Assign Enquiry History */
			AssignHistory::create(['enquiry_id' => $request->enquiry_id, 'user_id' => Auth::user()->id, 'assign_id' => $request->employee]);

			// create notification for new user
			UserNotifications::where(['user_id' => $request->employee, 'notification_type' => Constants::ENQUIRY_ASSIGNED, 'enquiry_id' => $request->enquiry_id])
				->delete();
			$enq = Enquiries::find($request->enquiry_id);
			$msg = Auth::user()->first_name . " has assigned you enquiry. The client Name is: $enq->client_name";
			$userNotification = UserNotifications::create([
				"user_id" => (int) $request->employee,
				"notification" => $msg,
				"notification_type" => Constants::ENQUIRY_ASSIGNED,
				'enquiry_id' => $request->enquiry_id,
				'by_user' => Auth::user()->id
			]);
			// if notificaton creation failed.
			if (!$userNotification) {
				Log::error('Unable to create user notification');
			}
			$user = User::where('id', $request->employee)->first();
			// send if user has onesignal id
			if (!empty($user->onesignal_token)) {
				HelperFn::sendPushNotification($user->onesignal_token, $msg);
			}
		}
	}

	public function getContacts(Request $request)
	{
		if (!empty($request->enquiry_id)) {
			return Enquiries::find($request->enquiry_id)->other_contacts;
		}
	}

	public function saveContacts(Request $request)
	{
		if (!empty($request->contacts) && !empty($request->enquiry_id)) {
			Enquiries::where('id', $request->enquiry_id)->update(['other_contacts' => $request->contacts]);
		}
	}


	public function getSpecificEnquiry(Request $request)
	{

		if (!empty($request->id)) {
			$data = Enquiries::where('id', $request->id)->first()->toArray();
			return json_encode($data);
		}
	}

	public function destroy(Request $request)
	{
		if (!empty($request->id)) {
			$data = Enquiries::where('id', $request->id)->delete();
			return json_encode($data);
		}
		if (!empty($request->allids) && isset(json_decode($request->allids)[0])) {
			$data = Enquiries::whereIn('id', json_decode($request->allids))->delete();
			return json_encode($data);
		}
	}

	public function enqueryAssignHistory(Request $request)
	{
		return view('admin.enquiries.assign_history');
	}

	public function getEnquiryHistory(Request $request)
	{
		$data['assign_history'] = AssignHistory::where('enquiry_id', $request->id)->orderBy('id', 'desc')->get();
		$view = view('admin.enquiries.assign_history_table', $data)->render();
		return response()->json(['status' => 200, 'html' => $view]);
	}

	public function viewEnquiry(Request $request, $id)
	{
		$dropdowns = DropdownSettings::get()->toArray();
		$data = Enquiries::with('Employee', 'Progress.Dropdowns', 'Visits', 'Comments', 'Progress.User', 'Progress.Dropdowns', 'activeProgress', 'AssignHistory')->find(decrypt($id));

		$city = '';
		$employee = '';
		if (!empty($data->enquiry_city_id)) {
			$city = City::find($data->enquiry_city_id);
		}


		if (!empty($data->employee_id)) {
			$employee = User::find($data->employee_id);
		}

		$dropdownsarr = [];
		foreach ($dropdowns as $key => $value) {
			$dropdownsarr[$value['id']] = $value;
		}
		$dropdowns = $dropdownsarr;

		$areas = Areas::where('user_id', Auth::user()->id)->get()->toArray();
		$areaarr = [];
		foreach ($areas as $key => $value) {
			$areaarr[$value['id']] = $value;
		}
		$areas = $areaarr;
		$area_name = '';
		if (!empty($data->area_ids)) {
			foreach (json_decode($data->area_ids) as $key => $value) {
				if (isset($areas[$value]['name'])) {
					if ($key > 0) {
						$area_name .= ', ' . $areas[$value]['name'];
					} else {
						$area_name .= $areas[$value]['name'];
					}
				}
			}
		}

		$builds = Projects::get()->toArray();
		$buildarr = [];
		foreach ($builds as $key => $value) {
			$buildarr[$value['id']] = $value;
		}
		$builds = $buildarr;
		$project_name = '';
		if (!empty($data->building_id) && isset(json_decode($data->building_id)[0])) {
			foreach (json_decode($data->building_id) as $key => $value) {
				if (isset($builds[$value]['project_name'])) {
					if ($key > 0) {
						$project_name .= ', ' . $builds[$value]['project_name'];
					} else {
						$project_name .= $builds[$value]['project_name'];
					}
				}
			}
		}

		$prop_type = '';
		$configuration_name = '';
		$requiretype_name = '';
		$furnished = '';
		if (!empty($data->property_type) && !empty($dropdowns[$data->property_type]['name'])) {
			$prop_type = $dropdowns[$data->property_type]['name'];
		}

		$dataConfiguration = json_decode($data->configuration);

		if (!empty($dataConfiguration) && is_array($dataConfiguration)) {
			$configuration = config('constant.property_configuration');
			$configuration_name = [];

			foreach ($dataConfiguration as $id) {
				if (isset($configuration[$id])) {
					$configuration_name[] = $configuration[$id];
				}
			}
		}


		if (!empty($data->requirement_type) && !empty($dropdowns[$data->requirement_type]['name'])) {
			$requiretype_name = $dropdowns[$data->requirement_type]['name'];
		}

		if (!empty($data->furnished_status) && isset(json_decode($data->furnished_status)[0])) {
			foreach (json_decode($data->furnished_status) as $key => $value) {
				if (isset($dropdowns[$value]['name'])) {
					if ($key > 0) {
						$furnished .= ', ' . $dropdowns[$value]['name'];
					} else {
						$furnished .= $dropdowns[$value]['name'];
					}
				}
			}
		}




		$land_units = DB::table('land_units')->get();
		// match query
		$property_for = ($data->enquiry_for == 'Buy') ? 'Sell' : $data->enquiry_for;
		$budgetFrom = str_replace(',', '', $data->budget_from);
		$budgetTo = str_replace(',', '', $data->budget_to);
		$areaFrom = $data->area_from;
		$areaTo = $data->area_to;
		$area_from_to_unit = $land_units->where('id', $data->area_from_measurement)->first();

		$configurations = is_string($data->configuration) ? json_decode($data->configuration, true) : $data->configuration;

		if (!is_array($configurations)) {
			$configurations = [$configurations];
		}
		// dd("property_for",$property_for,"cat",$data->property_type);
		$configurations = array_map('intval', $configurations);
		$properties = Properties::where('properties.property_type', $data->requirement_type)
			// ->where('properties.property_for', $property_for)
			->where(function ($query) use ($property_for, $data) {
				$property_for = ($data->enquiry_for == 'Buy') ? 'Sell' : $data->enquiry_for;
				if ($property_for === 'Rent') {
					// dd("re",$property_for);
					// $query->whereIn('properties.property_for', ['Rent']);
					$query->whereIn('property_for', ['Rent','Both']);
				} elseif ($property_for === 'Sell') {
					// dd("sell",$property_for);
					// $query->whereIn('properties.property_for', ['Sell']);
					$query->whereIn('property_for', ['Sell','Both']);
				}
			})
			->where('properties.property_category', $data->property_type)
			->where('properties.week_end_villa', $data->weekend_enq)
			->where(function ($query) use ($configurations, $data, $property_for) {
				// dd($data->property_type,"configurations",$configurations,$property_for);
				if ($data->property_type !== '256') {
					foreach ($configurations as $config) {
						$query->orWhereJsonContains('configuration', $config);
					}
				}
			})
			->where(function ($query) use ($budgetFrom, $budgetTo, $areaFrom, $areaTo, $area_from_to_unit, $data) {
				// dd("sadas",$budgetFrom, $budgetTo);

				$query->where(function ($query) use ($budgetFrom, $budgetTo) {
					$query->where('properties.survey_price', '>=', $budgetFrom)
						->where('properties.survey_price', '<=', $budgetTo)
						->orWhere('properties.fp_plot_price', '>=', $budgetFrom)
						->where('properties.fp_plot_price', '<=', $budgetTo);
				})
					->orWhere(function ($query) use ($budgetFrom, $budgetTo, $data) {
						if ($data->enquiry_for == 'Rent') {
							for ($i = 0; $i < 2; $i++) { // Loop through the JSON array
								$query->orWhereRaw('CAST(REPLACE(REPLACE(JSON_EXTRACT(properties.unit_details, "$[' . $i . '][4]"), ",", ""), "\"", "") AS UNSIGNED) >= ?', $budgetFrom)
									->whereRaw('CAST(REPLACE(REPLACE(JSON_EXTRACT(properties.unit_details, "$[' . $i . '][4]"), ",", ""), "\"", "") AS UNSIGNED) <= ?', $budgetTo);
							}
						}
					})
					->orWhere(function ($query) use ($budgetFrom, $budgetTo, $data) {
						if ($data->enquiry_for == 'Buy') {
							for ($i = 0; $i < 2; $i++) { // Loop through the JSON array
								$query->orWhereRaw('CAST(REPLACE(REPLACE(JSON_EXTRACT(properties.unit_details, "$[' . $i . '][3]"), ",", ""), "\"", "") AS UNSIGNED) >= ?', $budgetFrom)
									->whereRaw('CAST(REPLACE(REPLACE(JSON_EXTRACT(properties.unit_details, "$[' . $i . '][3]"), ",", ""), "\"", "") AS UNSIGNED) <= ?', $budgetTo);
							}
						}
					})
					->orWhere(function ($query) use ($budgetFrom, $budgetTo) {
						for ($i = 0; $i < 2; $i++) { // Loop through the JSON array
							$query->orWhereRaw('CAST(REPLACE(REPLACE(JSON_EXTRACT(properties.unit_details, "$[' . $i . '][7]"), ",", ""), "\"", "") AS UNSIGNED) >= ?', $budgetFrom)
								->whereRaw('CAST(REPLACE(REPLACE(JSON_EXTRACT(properties.unit_details, "$[' . $i . '][7]"), ",", ""), "\"", "") AS UNSIGNED) <= ?', $budgetTo);
						}
					})
					->where(function ($query) use ($areaFrom, $areaTo, $area_from_to_unit) {
						// dd("area_from_to_unit",$area_from_to_unit,$areaFrom, $areaTo);
						$query->where(function ($query) use ($areaFrom, $areaTo, $area_from_to_unit) {
							$query->whereRaw("SUBSTRING_INDEX(properties.salable_area, '_-||-_', 1) BETWEEN ? AND ?", [$areaFrom, $areaTo])
								->whereRaw("SUBSTRING_INDEX(properties.salable_area, '_-||-_', -1) = ?", [$area_from_to_unit->id]);
						})
							->orWhere(function ($query) use ($areaFrom, $areaTo, $area_from_to_unit) {
								$query->whereRaw("SUBSTRING_INDEX(properties.constructed_salable_area, '_-||-_', 1) BETWEEN ? AND ?", [$areaFrom, $areaTo])
									->whereRaw("SUBSTRING_INDEX(properties.constructed_salable_area, '_-||-_', -1) = ?", [$area_from_to_unit->id]);
							})
							->orWhere(function ($query) use ($areaFrom, $areaTo, $area_from_to_unit) {
								$query->whereRaw("SUBSTRING_INDEX(properties.salable_plot_area, '_-||-_', 1) BETWEEN ? AND ?", [$areaFrom, $areaTo])
									->whereRaw("SUBSTRING_INDEX(properties.salable_plot_area, '_-||-_', -1) = ?", [$area_from_to_unit->id]);
							})
							->orWhere(function ($query) use ($areaFrom, $areaTo, $area_from_to_unit) {
								$query->whereRaw("SUBSTRING_INDEX(properties.fp_plot_size, '_-||-_', 1) BETWEEN ? AND ?", [$areaFrom, $areaTo])
									->whereRaw("SUBSTRING_INDEX(properties.fp_plot_size, '_-||-_', -1) = ?", [$area_from_to_unit->id]);
							})
							->orWhere(function ($query) use ($areaFrom, $areaTo, $area_from_to_unit) {
								$query->whereRaw("SUBSTRING_INDEX(properties.survey_plot_size, '_-||-_', 1) BETWEEN ? AND ?", [$areaFrom, $areaTo])
									->whereRaw("SUBSTRING_INDEX(properties.survey_plot_size, '_-||-_', -1) = ?", [$area_from_to_unit->id]);
							});
					});
			})
			->get();

		// dd("propertiessssssssssss", Auth::user()->id, $configurations, $properties);
		$configurationArray = json_decode($data->configuration);

		$sub_cat = ((!empty($dropdowns[$data->property_type]['name'])) ?  $dropdowns[$data->property_type]['name'] : '');
		$configurationArray = json_decode($data->configuration);
		$configuration_display = '';
		if (!empty($configurationArray) && isset($configurationArray[0])) {
			$configuration_names = []; // Initialize an empty array to store configuration names

			foreach ($configurationArray as $configurationKey) {
				if (!empty(config('constant.property_configuration')[$configurationKey])) {
					$configuration_names[] = config('constant.property_configuration')[$configurationKey];
				} else {
					$configuration_names[] = "Null";
				}
			}

			$configuration_display = implode(', ', $configuration_names); // Join configuration names with a comma and space
		} else {
			$category = $sub_cat;
		}

		$category = $sub_cat;

		$employees = User::where('parent_id', Session::get('parent_id'))->get();
		$configuration_settings = DropdownSettings::get()->toArray();
		$projects = Projects::orderBy('project_name')->get();
		$cities = City::orderBy('name')->get();
		$branches = Branches::orderBy('name')->get();
		$areas = Areas::where('user_id', Auth::user()->id)->orderBy('name')->get();
		$prop_list = Helper::get_property_units_helper();
		return view('admin.enquiries.view', compact('areas', 'category', 'requiretype_name', 'employees', 'data', 'prop_type', 'configuration_name', 'requiretype_name', 'area_name', 'city', 'branches', 'cities', 'project_name', 'employee', 'dropdowns', 'furnished', 'configuration_settings', 'projects', 'properties', 'prop_list'));
	}


	public function calenderDetail(Request $request)
	{
		// dd("view enq cal details");
		// calendar 
		// click to edit cal
		$type = explode(',', $request->type);
		if (in_array('new_enquiry', $type)) {
			// $data['new_enquiry'] = Enquiries::whereDate('created_at', $request->date)->get();
			$data['new_enquiry'] = Enquiries::where('enq_status', 1)->whereDate('created_at', $request->date)->get();
		}
		if (in_array('leadConf', $type)) {
			$data['leadConf'] = EnquiryProgress::with('Enquiry')
				->where('status', 1)
				->where('progress', '=', 'Lead Confirmed')
				->whereNotNull('nfd')
				->whereDate('nfd', '=', $request->date)
				->get();
		}
		if (in_array('site_visit_scheduled', $type)) {
			$data['site_visit_scheduled'] = EnquiryProgress::with('Enquiry')
				->where('status', 1)
				->where('progress', '=', 'Site Visit Scheduled')
				->whereNotNull('nfd')
				->whereDate('nfd', '=', $request->date)
				->get();
		}
		// site_visit_completed
		if (in_array('site_visit_completed', $type)) {
			$data['site_visit_completed'] = EnquiryProgress::with('Enquiry')
				->where('status', 1)
				->where(
					'progress',
					'=',
					'Site Visit Completed'
				)
				->whereNotNull('nfd')
				->whereDate('nfd', '=', $request->date)
				->get();
			// dd($data['site_visit_completed'], "site_visit_completedsite_visit_completed");
		}
		if (in_array('discussion_schedule', $type)) {
			$data['discussion_schedule'] = EnquiryProgress::with('Enquiry')
				->where('status', 1)
				->where('progress', '=', 'Discussion')
				->whereNotNull('nfd')
				->whereDate('nfd', '=', $request->date)
				->get();
		}
		if (in_array('booked', $type)) {
			$data['booked'] = EnquiryProgress::with('Enquiry')
				->where('status', 1)
				->where('progress', '=', 'Booked')
				->whereDate('nfd', '=', $request->date)
				->get();
		}
		if (in_array('lost', $type)) {
			$data['lost'] = EnquiryProgress::with('Enquiry')
				->where('status', 1)
				->where('progress', '=', 'Lost')
				->whereDate('nfd', '=', $request->date)
				->get();
		}

		$areas = Areas::where('user_id', Auth::user()->id)->get();
		$areaarr = [];
		foreach ($areas as $key => $value) {
			$areaarr[$value['id']] = $value;
		}
		$data['areas'] = $areaarr;

		$builds = Projects::orderBy('project_name')->get();
		$buildarr = [];
		foreach ($builds as $key => $value) {
			$buildarr[$value['id']] = $value;
		}
		$data['builds'] = $buildarr;
		$data['projects'] = $buildarr;

		$dropdowns = DropdownSettings::get()->toArray();
		$dropdownsarr = [];
		foreach ($dropdowns as $key => $value) {
			$dropdownsarr[$value['id']] = $value;
		}
		$data['dropdowns'] = $dropdownsarr;

		$configuration_settings = DropdownSettings::get()->toArray();
		$data['configuration_settings'] = $configuration_settings;
		$cities = City::orderBy('name')->get();
		$data['cities'] = $cities;
		$branches = Branches::orderBy('name')->get();
		$data['branches'] = $branches;
		$employees = User::where('parent_id', Session::get('parent_id'))->orWhere('id', Session::get('parent_id'))->get();
		$data['employees'] = $employees;
		// dd($data, "Data");

		return view('admin.calendar.view', $data);
	}
	public function addEnquiry(Request $request)
	{
		$prop_list = Helper::get_property_units_helper();
		$projects = Projects::orderBy('project_name')->where('user_id', Auth::user()->id)->get();
		$configuration_settings = DropdownSettings::get()->toArray();
		$enquiry_list = ['Commercial', 'Office'];
		$prop_type = [];
		foreach ($configuration_settings as $key => $value) {
			if (($value['name'] == 'Commercial' || $value['name'] == 'Residential') && str_contains($value['dropdown_for'], 'property_')) {
				array_push($prop_type, $value['id']);
			}
		}
		$cities = City::orderBy('name')->get();
		$branches = Branches::orderBy('name')->get();
		$areas = Areas::where('user_id', Auth::user()->id)->orderBy('name')->get();
		// dd("area",$areas);
		$employees = User::where('parent_id', Session::get('parent_id'))->orWhere('id', Session::get('parent_id'))->get();
		$districts = District::orderBy('name')->where('user_id', Auth::user()->id)->get();
		$talukas   = Taluka::orderBy('name')->get();
		$villages  = Village::orderBy('name')->get();
		$land_units = DB::table('land_units')->get();
		$country_codes  = DB::table('countries')->get();
		$user = User::with(['roles', 'roles.permissions'])->where('id', Auth::user()->id)->first();
			
		$permissions = $user->roles[0]['permissions']->pluck('name')->toArray();


		return view('admin.properties.add_enquiry', compact('permissions','country_codes', 'enquiry_list', 'land_units', 'prop_type', 'projects', 'branches', 'cities', 'areas', 'configuration_settings', 'employees', 'prop_list', 'districts', 'talukas', 'villages'));
	}

	public function editEnquiry(Request $request)
	{

		$prop_list = Helper::get_property_units_helper();
		$projects = Projects::orderBy('project_name')->where('user_id', Auth::user()->id)->get();
		$enquiry_list = Enquiries::where('id', $request->id)->get();
		$configuration_settings = DropdownSettings::get()->toArray();
		$prop_type = [];
		foreach ($configuration_settings as $key => $value) {
			if (($value['name'] == 'Commercial' || $value['name'] == 'Residential') && str_contains($value['dropdown_for'], 'property_')) {
				array_push($prop_type, $value['id']);
			}
		}

		$cities = City::orderBy('name')->get();
		$branches = Branches::orderBy('name')->get();
		$areas = Areas::where('user_id', Auth::user()->id)->orderBy('name')->get();
		$employees = User::where('parent_id', Session::get('parent_id'))->orWhere('id', Session::get('parent_id'))->get();
		$current_id = $request->id;

		$districts = District::orderBy('name')->get();
		$talukas   = Taluka::orderBy('name')->get();
		$villages  = Village::orderBy('name')->get();

		$edit_configuration = Enquiries::where('id', $request->id)->pluck('configuration');
		$edit_category = Enquiries::where('id', $request->id)->pluck('property_type');
		$land_units = DB::table('land_units')->get();
		$country_codes  = DB::table('countries')->get();
		$user = User::with(['roles', 'roles.permissions'])->where('id', Auth::user()->id)->first();
			
		$permissions = $user->roles[0]['permissions']->pluck('name')->toArray();

		return view('admin.properties.add_enquiry', compact('permissions','country_codes', 'edit_configuration', 'land_units', 'edit_category', 'enquiry_list', 'prop_type', 'projects', 'branches', 'cities', 'areas', 'configuration_settings', 'employees', 'prop_list', 'current_id', 'districts', 'talukas', 'villages'));
	}
	// public function getEnquiryConfiguration(Request $request)
	// {
	// 	$selectedCategory = $request->query('selectedCategory');
	// 	$filteredConfig = [];
	// 	if ($selectedCategory === 'Flat' || $selectedCategory === 'Penthouse') {
	// 		$filteredKeys = ['13', '14', '15', '16', '17', '18'];
	// 	}
	// 	if ($selectedCategory === 'Vila/Bunglow') {
	// 		// $filteredKeys = ['21', '22', '23', '24', '25'];
	// 		$filteredKeys = ['14', '15', '16', '17', '18'];
	// 	}
	// 	if ($selectedCategory === 'Plot' || $selectedCategory === 'Land') {
	// 		$filteredKeys = ['10', '11', '12'];
	// 	}
	// 	if ($selectedCategory === 'Farmhouse') {
	// 		$filteredKeys = [];
	// 	}
	// 	if ($selectedCategory === 'Office') {
	// 		$filteredKeys = ['1', '2'];
	// 	}
	// 	if ($selectedCategory === 'Retail') {
	// 		$filteredKeys = ['3', '4', '5', '6'];
	// 	}
	// 	if ($selectedCategory === 'Storage/industrial') {
	// 		$filteredKeys = ['7', '8', '9', '20'];
	// 	}
	// 	$propertyConfiguration = config('constant.property_configuration');
	// 	foreach ($filteredKeys as $key) {
	// 		if (isset($propertyConfiguration[$key])) {
	// 			$filteredConfig[$key] = $propertyConfiguration[$key];
	// 		}
	// 	}
	// 	return response()->json($filteredConfig);
	// }


	public function getEnquiryConfiguration(Request $request)
	{
		$selectedCategories = json_decode($request->query('selectedCategories'), true);
		$filteredConfig = [];

		foreach ($selectedCategories as $selectedCategory) {
			switch ($selectedCategory) {
				case 'Flat':
				case 'Penthouse':
					$filteredConfig = array_merge($filteredConfig, ['13' => '1 rk', '14' => '1bhk', '15' => '2bhk', '16' => '3bhk', '17' => '4bhk', '18' => '5bhk']);
					break;
				case 'Vila/Bunglow':
					$filteredConfig = array_merge($filteredConfig, ['14' => '1bhk', '15' => '2bhk', '16' => '3bhk', '17' => '4bhk', '18' => '5bhk']);
					break;
				case 'Plot':
				case 'Land':
					$filteredConfig = array_merge($filteredConfig, ['10' => 'Commercial Land', '11' => 'Agricultural/Farm Land', '12' => 'Industrial Land']);
					break;
				case 'Farmhouse':
					break;
				case 'Office':
					$filteredConfig = array_merge($filteredConfig, ['1' => 'office space', '2' => 'Co-working']);
					break;
				case 'Retail':
					$filteredConfig = array_merge($filteredConfig, ['3' => 'Ground floor', '4' => '1st floor', '5' => '2nd floor', '6' => '3rd floor']);
					break;
				case 'Storage/industrial':
					$filteredConfig = array_merge($filteredConfig, ['7' => 'Warehouse', '8' => 'Cold Storage', '9' => 'ind. shed', '20' => 'Plotting']);
					break;
				default:
					break;
			}
		}

		return response()->json($filteredConfig);
	}
	public function deleteRecord($id)
	{
		$record = EnquiryProgress::find($id);

		if ($record) {
			$record->delete();
			return response()->json(['message' => 'Record deleted successfully']);
		} else {
			return response()->json(['message' => 'Record not found'], 404);
		}
	}


	public function updateEnquiryStatus(Request $request)
	{

		$enquiry = Enquiries::find($request->id);
		if ($enquiry) {
			$enquiry->enq_status = $enquiry->enq_status == 1 ? 0 : 1;
			$enquiry->save();
		}
		if (isset($request->flag)) {
			// dd(333);
			return redirect()->back();
		}
		return redirect('admin/Enquiries');
	}
	public function getEnquiryCategory(Request $request)
	{
		$enquiryID = $request->query('id');
		$enquiry = Enquiries::find($enquiryID);
		$penquiryCategory = $enquiry->pluck('requirement_type')->first();
		return response()->json($enquiry);
	}
}
