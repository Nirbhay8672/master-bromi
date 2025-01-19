<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Rap2hpoutre\FastExcel\FastExcel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use Illuminate\Support\Arr;


class EnquiriesController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(Request $request)
	{
		$perPage = $request->input('per_page', 10);
        $Enquiry = Enquiries::where('user_id',Auth::user()->id)->get();
		$EnquiryData=[];
		foreach ($Enquiry as $key => $value) {
			$EnquiryData[]=[
				"id"=> $value->id,
				"client_name"=> $value->client_name,
				"enquiry_for"=> $value->enquiry_for,
				"budget_from"=> $value->budget_from,
				"budget_to"=> $value->budget_to,
				"requirement"=> $value->requirement,
				"created_at"=> $value->created_at,
				"updated_at"=> $value->updated_at,
			];
			
		}
		
  
		$response = [
			'message' => 'Enquiry list has been fetched successfully.',
			'current_page' => 0, // Set the current page number here
			'total_records' => $Enquiry->count(), // Set the total number of records here
			'limit' => $perPage, // Set the limit per page here
			'data' => $EnquiryData,
		];
		return response()->json($response, 200);
	}

	public function step3(Request $request)
	{
		try {
			$data = null;
	
			if (!empty($request->id) && $request->id != '') {
				$data = Enquiries::find($request->id);
				$message = 'Enquiry Updated Successfully';
			} else {
				$message = 'Enquiry Added Successfully';
				$data = new Enquiries();
			}
	
			if ($request->input('67')) {
				$data->is_nri = $request->input('67');
			}
			
			if ($request->input('68')) {
				$data->requirement_type = $request->input('68');
			}
			
			if ($request->input('69')) {
				$data->property_type = $request->input('69');
			}
	
			$inputData = $request->input('70');
	
			if (is_string($inputData)) {
				$dataArray = json_decode($inputData, true);
	
				if (is_array($dataArray)) {
					$resultArray = array_slice($dataArray, 0, 3);
					$resultArray = array_map('strval', $resultArray);
				}
			}
	
			if ($request->input('70')) {
				$data->configuration = json_encode($resultArray);
			}
			if($request->input('71')){
				$data->area_from=$request->input('71');
			}
			if($request->input('72')){
				$data->area_to=$request->input('72');
			}
			if($request->input('73')){
				$data->area_to_measurement=$request->input('73');
			}
			if($request->input('74')){
				$data->enquiry_source=$request->input('74');
			}
			
			$builderData = $request->input('79');
	
			if (is_string($builderData)) {
				$builderArray = json_decode($builderData, true);
	
				if (is_array($builderArray)) {
					$builderArray = array_slice($builderArray, 0, 3);
					$builderArray = array_map('strval', $builderArray);
				}
			}
	
			$areaData = $request->input('82');
	
			if (is_string($areaData)) {
				$areaArray = json_decode($areaData, true);
	
				if (is_array($areaArray)) {
					$areaArray = array_slice($areaArray, 0, 3);
					$areaArray = array_map('strval', $areaArray);
				}
			}
	
			
	
			$contacts = [];
			$contactData = $request->input('98');
	
			if (is_array($contactData)) {
				foreach ($contactData as $contactItem) {
					if (is_array($contactItem)) {
						// Convert the numeric keys to strings
						$contacts[] = [
							 strval($contactItem['83']),
							strval($contactItem['84']),
							strval($contactItem['85']),
						];
					}
				}
			}
	
			// Store the contacts as JSON
			$data->other_contacts = json_encode($contacts);
	
		$furnitureData = $request->input('75');

        if (is_string($furnitureData)) {
            $furnitureArray = json_decode($furnitureData, true);

            if (is_array($furnitureArray)) {
                $furnitureArray = array_slice($furnitureArray, 0, 3);
                $furnitureArray = array_map('strval', $furnitureArray);
            } else {
                // Handle the case where $furnitureData is not an array
                $furnitureArray = [$furnitureData];
            }
        }

        if ($request->input('75')) {
            // Make sure $data is an instance of Enquiries
            if (!($data instanceof Enquiries)) {
                $data = new Enquiries();
            }

            $data->furnished_status = json_encode($furnitureArray);
        }


			$buildingData = $request->input('79');

        if (is_string($buildingData)) {
            $buildingArray = json_decode($buildingData, true);

            if (is_array($buildingArray)) {
                $buildingArray = array_slice($buildingArray, 0, 3);
                $buildingArray = array_map('strval', $buildingArray);
            } else {
                // Handle the case where $buildingData is not an array
                $buildingArray = [$buildingData];
            }
        }

        if ($request->input('79')) {
            // Make sure $data is an instance of Enquiries
            if (!($data instanceof Enquiries)) {
                $data = new Enquiries();
            }

            $data->building_id = json_encode($buildingArray);
        }


		$area_idsData = $request->input('82');

        if (is_string($area_idsData)) {
            $area_idsArray = json_decode($area_idsData, true);

            if (is_array($area_idsArray)) {
                $area_idsArray = array_slice($area_idsArray, 0, 3);
                $area_idsArray = array_map('strval', $area_idsArray);
            } else {
                // Handle the case where $area_idsData is not an array
                $area_idsArray = [$area_idsData];
            }
        }

        if ($request->input('82')) {
            // Make sure $data is an instance of Enquiries
            if (!($data instanceof Enquiries)) {
                $data = new Enquiries();
            }

            $data->area_ids = json_encode($area_idsArray);
        }
			if($request->input('76')){
				$data->budget_from=$request->input('76');
			}
			if($request->input('77')){
				$data->budget_to=$request->input('77');
			}
			if($request->input('78')){
				$data->Purpose=$request->input('78');
			}
		
			if($request->input('80')){
				$data->project_status=$request->input('80');
			}
			if($request->input('81')){
				$data->zone_id=$request->input('81');
			}
			
			if($request->input('83')){
				$data->is_preleased=$request->input('83');
			}
			if($request->input('86')){
				$data->NRI=$request->input('86');
			}
			if($request->input('87')){
				$data->telephonic_discussion=$request->input('87');
			}
			if($request->input('88')){
				$data->enquiry_city_id=$request->input('88');
			}
			if($request->input('89')){
				$data->enquiry_branch_id=$request->input('89');
			}
			if($request->input('90')){
				$data->employee_id=$request->input('90');
			}
			if($request->input('91')){
				$data->district_id=$request->input('91');
			}
			if($request->input('92')){
				$data->taluka_id=$request->input('92');
			}
			if($request->input('93')){
				$data->village_id=$request->input('93');
			}
			if($request->input('94')){
				$data->client_name=$request->input('94');
			}
			if($request->input('95')){
				$data->client_mobile=$request->input('95');
			}
			if($request->input('96')){
				$data->client_email=$request->input('96');
			}
			if($request->input('97')){
				$data->enquiry_for=$request->input('97');
			}
	
			$data->added_by = Auth::user()->id;
			$data->user_id = Auth::user()->id;
			// dd($data);
			$data->save();
			if (!empty($request->area_measurement)) {
				Helper::add_default_measuerement($request->area_measurement);
			}
			return response()->json(['status' => '200','message' => $message]);
		} catch (\Exception $e) {
			dd($e);
		}
		
	}


	public function step1(Request $request)
    {
        try {
        //  dd($request);
            return response()->json(['status' => '200', 'message' => 'Step 1 completed','data'=>$request->all()]);
        } catch (\Exception $e) {
            return response()->json(['status' => '500', 'error' => $e->getMessage()]);
        }
    }

    public function step2(Request $request)
    {
        try {
			// dd($request);
            return response()->json(['status' => '200', 'message' => 'Step 2 completed','data'=>$request->all()]);
        } catch (\Exception $e) {
			
            return response()->json(['status' => '500', 'error' => $e->getMessage()]);
        }
    }

    public function matchingEnquiry(Request $requestdata)
    {
		$enquiry=Enquiries::find($requestdata->input(154));//get data by id
		
		$request['enquiry_for']=$requestdata->input(97);
		$request['requirement_type']=$requestdata->input(68);
		$request['category']=$requestdata->input(69);
		$request['configration']=$requestdata->input(70);
		$request['budget']=$requestdata->input(76);
		$request['size']=$requestdata->size;
		$request['enquiry_source']=$requestdata->input(74);
		
		$query=Properties::query();
		$query->where('user_id',Auth::user()->id);
		if ($request['enquiry_for'] || $request['requirement_type'] || $request['category'] || $request['configration'] || $request['budget'] || $request['size'] || $request['enquiry_source']) {
			$query->where(function ($query) use ($enquiry,$request) {
				if ($request['enquiry_for']) {
					$query->where('property_for', $enquiry->enquiry_for);
				}
				if ($request['requirement_type']) {
					$query->where('property_type', $enquiry->requirement_type);
				}
				if ($request['category']) {
					$query->where('property_category', $enquiry->category);
				}
				if ($request['configration']) {
					$query->where('configration', $enquiry->configration);
				}
				// if ($request['budget']) {
				// 	$query->whereBetween('budget', [$enquiry->budget_from, $enquiry->budget_to]);
				// }
				// if ($request['size']) {
				// 	$query->whereBetween('size', [$enquiry->size_from, $enquiry->size_to]);
				// }
				// if ($request['enquiry_source']) {
				// 	$query->where('enquiry_source', $enquiry->enquiry_source);
				// }
			});
		}
		$EnquiryData=$query->get();
		$perPage = $requestdata->input('per_page', 10);
		$response = [
			'message' => 'Match enquiry data found.',
			'current_page' => 0, // Set the current page number here
			'total_records' => $query->count(), // Set the total number of records here
			'limit' => $perPage, // Set the limit per page here
			'data' => $EnquiryData,
		];
		return $response;
		
	   
    }
	public function listPrograss(Request $request){
		// dd(Auth::user()->id,$request->id);
		 $enquiry=EnquiryProgress::where('enquiry_id',$request->input('154'))->where('user_id',Auth::user()->id)->get();
		//$enquiry=EnquiryProgress::where('enquiry_id','13')->where('user_id','39')->get();

		// $perPage = $requestdata->input('per_page', 10);
		$response = [
			'message' => 'Match enquiry data found.',
			'current_page' => 0, // Set the current page number here
			'total_records' => $enquiry->count(), // Set the total number of records here
			'limit' => 10, // Set the limit per page here
			'data' => $enquiry,
		];
		return $response;
	}
	public function transferEnquiry(Request $request){

		$transfer=AssignHistory::create([
			'enquiry_id'=>$request->input('154'),
			'user_id'=>Auth::user()->id,
			'assign_id'=>$request->input('90')
		]);

		
		// $perPage = $requestdata->input('per_page', 10);
		$response = [
			'message' => ' transfer Enquiry Added Successfully'
		];
		return $response;
	}
	public function listTransferEnquiry(Request $request){

		$enquiry=AssignHistory::where('enquiry_id',$request->input('154'))->where('user_id',Auth::user()->id)->get();
		$response = [
			'code'=>'200',
			'message' => 'List Transfer Enquiry.',
			'data' => $enquiry,
		];
		return $response;
	}
	
	public function saveContacts(Request $request)
	{
		$id=$request->input('154');
		$contacts = [];
			$contactData = $request->input('98');
	
			if (is_array($contactData)) {
				foreach ($contactData as $contactItem) {
					if (is_array($contactItem)) {
						// Convert the numeric keys to strings
						$contacts[] = [
							 strval($contactItem['83']),
							strval($contactItem['84']),
							strval($contactItem['85']),
						];
					}
				}
			}
	
			// Store the contacts as JSON
			// $data->other_contacts = json_encode($contacts);
		if (!empty($request->input('98')) && !empty($id)) {
		
			Enquiries::where('id', $id)->update(['other_contacts' => json_encode($contacts)]);
		}
		$response = [
			'message' => ' Contact Enquiry Added Successfully'
		];
		return $response;
	}
	public function getContacts(Request $request)
	{$id=$request->input('154');
		if (!empty($id)) {
			$list= Enquiries::find($id);
			// dd($list);
			$response = [
				'code'=>'200',
				'message' => 'Contact Enquiry list Successfully.',
				'data' => $list,
			];
			return $response;
		}else{
			$response = [
				'code'=>'500',
				'message' => 'Provided Id Not Found.'
			];
		}
		
	}
	
	public function filterEnquiry(Request $request){
		dd($request);
/*
$request->filter_by=$request->;
$request->filter_city_id=$request->88;
$request->filter_enquiry_branch_id=$request->89;
$request->filter_employee_id=$request->90;
$request->filter_property_type=$request->68;
$request->filter_specific_type=$request->97;
$request->filter_configuration=$request->70;
$request->filter_area_id=$request->82;
$request->filter_enquiry_for=$request->;
$request->filter_enquiry_source=$request->74;
$request->filter_enquiry_progress=$request->;
$request->filter_enquiry_status=$request->;
$request->filter_sales_comment=$request->;
$request->filter_lead_type=$request->;
$request->filter_purpose=$request->;
$request->filter_nfd_from=$request->;
$request->filter_nfd_to=$request->;
$request->filter_from_date=$request->;
$request->filter_to_date=$request->;
$request->filter_favourite=$request->;
$request->filter_new_enquiry=$request->;
$request->filter_draft=$request->;
$request->filter_prospect=$request->;
$request->filter_from_budget=$request->;
$request->filter_to_budget=$request->;*/

		$data = Enquiries::with('Employee', 'Progress', 'activeProgress')
				->when($request->filter_by, function ($query) use ($request) {
					if ($request->filter_by == 'new') {
						return $query->doesntHave('Progress');
					} elseif ($request->filter_by == 'today') {
						return $query->whereHas('activeProgress', function ($query) {
							$query->whereDate('nfd', '=', Carbon::now()->format('y-m-d'));
						});
					} elseif ($request->filter_by == 'tomorrow') {
						return $query->whereHas('activeProgress', function ($query) {
							$query->whereDate('nfd', '=', Carbon::tomorrow()->format('y-m-d'));
						});
					} elseif ($request->filter_by == 'yesterday') {
						return $query->whereHas('activeProgress', function ($query) {
							$query->whereDate('nfd', '=', Carbon::yesterday()->format('y-m-d'));
						});
					} elseif ($request->filter_by == 'due') {
						return $query->whereHas('activeProgress', function ($query) {
							$query->whereDate('nfd', '<=', Carbon::now()->format('y-m-d'));
						});
					} elseif ($request->filter_by == 'weekend') {
						return $query->whereHas('activeProgress', function ($query) {
							$query->whereDate('nfd', '<=', Carbon::now()->endOfWeek())->whereDate('nfd', '>=', Carbon::now()->endOfWeek()->subDay());;
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
					// return $query->where('requirement_type', 'like', '%"' . $request->filter_property_type . '"%');
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
					return  $query->where('configuration', 'like', '%"' . $request->filter_configuration . '"%');
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
				->when($request->filter_draft, function ($query) use ($request) {
					return $query->whereDate('created_at', '<=', $request->filter_draft);
				})
				->when($request->filter_prospect, function ($query) use ($request) {
					return $query->whereDate('created_at', '<=', $request->filter_prospect);
				});
				foreach ($data as $key => $value) {
					if (!empty($request->filter_from_budget)) {
						if (empty($value->budget_from)) {
							unset($data[$key]);
						}
						if (!(Helper::c_to_n($value->budget_from) >= Helper::c_to_n($request->filter_from_budget))) {
							unset($data[$key]);
						}
					}
					if (!empty($request->filter_to_budget)) {
						if (empty($value->budget_to)) {
							unset($data[$key]);
						}
						if (!(Helper::c_to_n($value->budget_to) <= Helper::c_to_n($request->filter_to_budget))) {
							unset($data[$key]);
						}
					}
				}
	}
	public function importEnquiry(Request $request)
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

			$user_id = NULL;
			if (!empty($value['AssingedTo'])) {
				$user = User::where('parent_id', Auth::user()->id)->where('first_name', 'like', '%' . explode(' ', $value['AssingedTo'])[0])->where('last_name', 'like', '%' . explode(' ', $value['AssingedTo'])[1])->first();
			}


			if (!empty($user->id) && !empty($value['AssingedTo'])) {
				$user_id = $user->id;
			}

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
			$Configuration = DropdownSettings::where('name', 'like', '%' . $value['Configuration1'] . '%')->first();
			if (!empty($Configuration->id) && !empty($value['Configuration1'])) {
				$Configuration_id = $Configuration->id;
			}

			$Configuration_id2 = NULL;
			$Configuration2 = DropdownSettings::where('name', 'like', '%' . $value['Configuration2'] . '%')->first();
			if (!empty($Configuration2->id) && !empty($value['Configuration2'])) {
				$Configuration_id2 = $Configuration2->id;
			}


			$enquiry_source_id = NULL;
			$enquiry_source = DropdownSettings::where('name', 'like', '%' . $value['Enquiry Source'] . '%')->first();
			if (!empty($enquiry_source->id) && !empty($value['Enquiry Source'])) {
				$enquiry_source_id = $enquiry_source->id;
			}

			$telephonic = NULL;
			if (empty($value['Enquiry Progress'])) {
				$telephonic = $value['Remarks'];
			}

			if (!empty($value['ClientName'])) {
				$data =  new Enquiries();
				$data->added_by = Auth::user()->id;
				$data->user_id = Auth::user()->id;
				$data->client_name = $value['ClientName'];
				$data->client_mobile = $value['Mobile'];
				$data->client_email = $value['Email'];
				$data->enquiry_for = $value['EnquiryFor'];
				$data->requirement_type = json_encode([$property_type_id]);
				$data->property_type =  json_encode([$specific_property_id]);
				$data->configuration = json_encode([$Configuration_id, $Configuration_id2]);
				$data->enquiry_source = $enquiry_source_id;
				$data->budget_from = $value['BudgetFrom'];
				$data->budget_to = $value['BudgetTo'];
				$data->employee_id = $user_id;
				$data->enquiry_status = $value['Status'];
				$data->telephonic_discussion = $telephonic;
				$data->save();
			}

			if (!empty($value['Enquiry Progress'])) {
				EnquiryProgress::create(['user_id' => ((!empty($user_id)) ? $user_id : Auth::user()->id), 'progress' => $value['Enquiry Progress'], 'remarks' => $value['Remarks'], 'enquiry_id' => $data->id]);
			}
		}
		return response()->json(['message' => 'Enquiry Imported successfully']);
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

			$areas = Areas::get()->toArray();
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
		$time = time() . Auth::user()->id;
		File::isDirectory(public_path('excel')) or File::makeDirectory(public_path('excel'), 0777, true, true);
		(new FastExcel(collect($enqs)))->export(public_path('excel/' . $time . '_file.xlsx'));

		return response()->json(["status"=> 200,
		"message"=>"Enquiry Exported ",
		"data"=> asset('excel/' . $time . '_file.xlsx')]);
		// echo asset('excel/' . $time . '_file.xlsx');
	}
	public function stepOne(Request $request)
{
    // Validate and process data for step one
    $validatedData = $request->validate([
        'field_one' => 'required',
    ]);

    // You can save the data or perform any necessary actions for step one

    return response()->json(['message' => 'Step one completed']);
}

public function stepTwo(Request $request)
{
    // Validate and process data for step two
    $validatedData = $request->validate([
        'field_two' => 'required',
    ]);
    // You can access data from step one if needed
    $stepOneData = $request->session()->get('step_one_data');
    // You can save the data or perform any necessary actions for step two
    return response()->json(['message' => 'Step two completed']);
}

public function stepThree(Request $request)
{
    // Validate and process data for step three
    $validatedData = $request->validate([
        'field_three' => 'required',
    ]);

    // Access data from step one and step two if needed
    $stepOneData = $request->session()->get('step_one_data');
    $stepTwoData = $request->session()->get('step_two_data');

    // Combine all data into a single array
    $allData = array_merge($stepOneData, $stepTwoData, $validatedData);

    // Optionally, you can clear the previous steps' data
    // $request->session()->forget(['step_one_data', 'step_two_data']);

    return response()->json(['all_data' => $allData, 'message' => 'Step three completed']);
}

	public function show(Request $request)
	{
		$id=$request->input('154');
		$Enquiries = Enquiries::where([['id',$id],['user_id',Auth::user()->id]])->first();
		if($Enquiries != null){
			$Enquiries = Enquiries::find($id);
			$Enquiries['configuration']=json_decode($Enquiries['configuration']);
			$Enquiries['furnished_status']=json_decode($Enquiries['furnished_status']);
			$Enquiries['building_id']=json_decode($Enquiries['building_id']);
			$Enquiries['other_contacts']=json_decode($Enquiries['other_contacts']);
			$Enquiries['area_ids']=json_decode($Enquiries['area_ids']);
			
			return response()->json(['status' => '200','message' => 'Enquirie Details ', 'data' => $Enquiries]);
		}
		return response()->json(['status' => '500','message' => 'Provided Id is Incorrect']);
      

	}
	public function destory(Request $request)
	{
		$id=$request->input('154');
		$Enquiries = Enquiries::where([['id',$id],['user_id',Auth::user()->id]])->first();
		if($Enquiries != null){
			Enquiries::destroy($id);
			return response()->json(['status' => '200','message' => 'Enquirie Deleted Successfully ']);

		}
		return response()->json(['status' => '500','message' => 'Something is wrong']);

	}
	
}
