<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Imports\ImportCity;
use App\Models\Api\Areas;
use App\Models\Builders;
use App\Models\City;
use App\Models\Api\CompanyDetails;
use App\Models\District;
use App\Models\DropdownSettings;
use App\Models\Subcategory;
use App\Models\State;
use App\Models\Taluka;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Rap2hpoutre\FastExcel\FastExcel;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class SettingsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}


	public function getstate()
    {
        try {
            $state=State::where('user_id', Auth::user()->id)->get();;
       return response()->json(["status"=> 200,
                        "message"=>"State List",
                        "data"=> $state]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e,
                'data' => $e,
            ], 500);
        }
       
    }

    public function getcity(Request $request)
    {
         $state_id = $request->input('126');

        try {
            $cities = City::where([['user_id', Auth::user()->id],['state_id', $state_id]])->get();
            return response()->json([
                "status" => 200,
                "message" => "City List",
                "data" => $cities
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e,
                'data' => $e,
            ], 500);
        }
    }
    
	public function addState(Request $request)
    {
		
		try {
			if(!empty($request->input('id'))){
				$id = $request->input('id');
				$state=State::find($id);
				$message="State Updated successfully";
			}else{

				$state=new State();
				$message="State added successfully";
			}
			$state->name=$request->input('124');
			$state->user_id=Auth::user()->id;
			$state->save();
            return response()->json([
                "status" => 200,
                "message" => $message
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e,
                'data' => $e,
            ], 500);
        }
    }
	public function addCity(Request $request)
    {
        try {
			if(!empty($request->input('id'))){
				$id = $request->input('id');
				$city=City::find($id);
				$message="City Update successfully";
			}else{

				$city=new City();
				$message="City added successfully";
			}
			$city->name=$request->input('125');
			$city->state_id=$request->input('126');
			$city->user_id=Auth::user()->id;
			$city->save();
            return response()->json([
                "status" => 200,
                "message" => $message
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e,
                'data' => $e,
            ], 500);
        }
    }
	public function destroyState(Request $request)
    {

        try {
			$id=$request->input('149');
			$state=State::find($id);
			if(!empty($state)){
				State::destroy($id);
			}else{
				return response()->json([
					"status" => 200,
					"message" => "Provided Id Not found"
				]);
			}
            return response()->json([
                "status" => 200,
                "message" => "State Deleted successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e,
                'data' => $e,
            ], 500);
        }
    }
	public function destroyCity(Request $request)
    {
        try {
			$id=$request->input('150');
			$City=City::find($id);
			if(!empty($City)){
				City::destroy($id);
			}else{
				return response()->json([
					"status" => 200,
					"message" => "Provided Id Not found"
				]);
			}
            return response()->json([
                "status" => 200,
                "message" => "City Deleted successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e,
                'data' => $e,
            ], 500);
        }
    }

	public function cities_import(Request $request)
	{
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        $file = $request->file('file');

        Excel::import(new ImportCity, $file);

        return response()->json(['message' => 'City imported successfully']);
    }
	public function areaList(Request $request)
	{
		try {
			$areas = Areas::where('user_id', Auth::user()->id)->get();
            return response()->json([
                "status" => 200,
                "message" => "Areas List",
                "data" => $areas
            ]);
		} catch (\Exception $e) {
			return response()->json([
                'status' => 'error',
                'message' => $e,
                'data' => $e,
            ], 500);
		}
	}
	public function areaAdd(Request $request)
	{
		try {
			if(!empty($request->input('151'))){
				$id=$request->input('151');
				$area=Areas::find($id);
				$message="Area Updated successfully";
			}else{
				$area=new Areas();
				$message="Area added successfully";
			}
			$area->state_id=$request->input('127');
			$area->city_id=$request->input('128');
			$area->name=$request->input('129');
			$area->pincode=$request->input('130');
			$area->user_id=Auth::user()->id;
			$area->save();
			return response()->json(['message' => $message]);


		} catch (\Exception $e) {
			return response()->json([
                'status' => 'error',
                'message' => $e,
                'data' => $e,
            ], 500);
		}
	}
	public function areaDestroy(Request $request)
	{
        try {
			$id=$request->input('151');
			$Areas=Areas::find($id);
			if(!empty($Areas)){
				Areas::destroy($id);
			}else{
				return response()->json([
					"status" => 200,
					"message" => "Provided Id Not found"
				]);
			}
            return response()->json([
                "status" => 200,
                "message" => "Areas Deleted successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e,
                'data' => $e,
            ], 500);
        }
    }

	public function districtList(Request $request)
	{
		try {
			$District = District::where('user_id', Auth::user()->id)->get();
            return response()->json([
                "status" => 200,
                "message" => "District List",
                "data" => $District
            ]);
		} catch (\Exception $e) {
			return response()->json([
                'status' => 'error',
                'message' => $e,
                'data' => $e,
            ], 500);
		}
	}
	public function districtAdd(Request $request)
	{
		try {
			if(!empty($request->input('152'))){
				$id=$request->input('152');
				$District=District::find($id);
				$message="District updated successfully";
			}else{
				$District=new District();
				$message="District added successfully";
			}
			$District->name=$request->input('131');
			$District->user_id=Auth::user()->id;
			$District->save();
			return response()->json(['message' => $message]);


		} catch (\Exception $e) {
			
			return response()->json([
                'status' => 'error',
                'message' => $e,
                'data' => $e,
            ], 500);
		}
	}
	public function districtDestroy(Request $request)
	{
        try {
			$id=$request->input('152');
			$District=District::find($id);
			if(!empty($District)){
				District::destroy($id);
			}else{
				return response()->json([
					"status" => 200,
					"message" => "Provided Id Not found"
				]);
			}
            return response()->json([
                "status" => 200,
                "message" => "District Deleted successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e,
                'data' => $e,
            ], 500);
        }
    }

	public function talukaList(Request $request)
	{
		try {
			$Taluka = Taluka::where('user_id', Auth::user()->id)->get();
            return response()->json([
                "status" => 200,
                "message" => "Taluka List",
                "data" => $Taluka
            ]);
		} catch (\Exception $e) {
			return response()->json([
                'status' => 'error',
                'message' => $e,
                'data' => $e,
            ], 500);
		}
	}
	public function talukaAdd(Request $request)
	{
		try {
			if(!empty($request->input('153'))){
				$id=$request->input('153');
				$Taluka=Taluka::find($id);
				$message="Taluka updated successfully";
			}else{
				$Taluka=new Taluka();
				$message="Taluka added successfully";
			}
			$Taluka->district_id=$request->input('133');
			$Taluka->name=$request->input('132');
			$Taluka->user_id=Auth::user()->id;
			$Taluka->save();
			return response()->json(['message' => $message]);


		} catch (\Exception $e) {
			return response()->json([
                'status' => 'error',
                'message' => $e,
                'data' => $e,
            ], 500);
		}
	}
	public function talukaDestroy(Request $request)
	{
        try {
			$id=$request->input('153');
			$Taluka=Taluka::find($id);
			if(!empty($Taluka)){
				Taluka::destroy($id);
			}else{
				return response()->json([
					"status" => 200,
					"message" => "Provided Id Not found"
				]);
			}
            return response()->json([
                "status" => 200,
                "message" => "Taluka Deleted successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e,
                'data' => $e,
            ], 500);
        }
    }
	public function villageList(Request $request)
	{
		try {
			$District = District::where('user_id', Auth::user()->id)->get();
            return response()->json([
                "status" => 200,
                "message" => "District List",
                "data" => $District
            ]);
		} catch (\Exception $e) {
			return response()->json([
                'status' => 'error',
                'message' => $e,
                'data' => $e,
            ], 500);
		}
	}
	public function villageAdd(Request $request)
	{
		try {
			if(!empty($request->input('153'))){
				$id=$request->input('153');
				$area=Areas::find($id);
			}else{
				$area=new Areas();
			}
			$area->state_id=$request->input('127');
			$area->city_id=$request->input('128');
			$area->name=$request->input('129');
			$area->pincode=$request->input('130');
			$area->save();
			return response()->json(['message' => 'areas Added successfully']);


		} catch (\Exception $e) {
			return response()->json([
                'status' => 'error',
                'message' => $e,
                'data' => $e,
            ], 500);
		}
	}
	public function villageDestroy(Request $request)
	{
        try {
			$id=$request->input('154');
			$District=District::find($id);
			if(!empty($District)){
				District::destroy($id);
			}else{
				return response()->json([
					"status" => 200,
					"message" => "Provided Id Not found"
				]);
			}
            return response()->json([
                "status" => 200,
                "message" => "District Deleted successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e,
                'data' => $e,
            ], 500);
        }
    }
	

	public function builder_import(Request $request)
	{
		$file = $request->file('csv_file');
		$name = Str::random(10) . '.csv';
		$file->move(storage_path('app'), $name);
		try {
			$collection = (new FastExcel)->import(storage_path('app/' . $name));
		} catch (\Throwable $th) {
			$collection = [];
		}
		unlink(storage_path('app/' . $name));
		$builders = Builders::all()->pluck('name')->all();
		$builders = array_map('strtolower', $builders);
		foreach ($collection as $key => $value) {
			if (!in_array(strtolower($value['name']), $builders)) {
				Helper::add_builder($value['name']);
			}
		}
	}

	public function state_import(Request $request)
	{
		$file = $request->file('csv_file');
		$name = Str::random(10) . '.csv';
		$file->move(storage_path('app'), $name);
		try {
			$collection = (new FastExcel)->import(storage_path('app/' . $name));
		} catch (\Throwable $th) {
			$collection = [];
		}
		unlink(storage_path('app/' . $name));
		$states = State::all()->pluck('name')->all();
		$states = array_map('strtolower', $states);
		foreach ($collection as $key => $value) {
			if (!in_array(strtolower($value['name']), $states)) {
				Helper::add_state($value['name']);
			}
		}
	}

	public function states_index(Request $request)
	{
		if ($request->ajax()) {
			$data = State::orderBy('id', 'desc')->where('user_id',Auth::user()->id)->get();
			return DataTables::of($data)
				->editColumn('Actions', function ($row) {
					$buttons = '';
					$buttons =  $buttons . '<i role="button" data-id="' . $row->id . '" title="Edit" onclick=getState(this) class="fa-pencil pointer fa fs-22 py-2 mx-2  " type="button"></i>';
					$buttons =  $buttons . '<i role="button" data-id="' . $row->id . '" title="Delete" onclick=deleteState(this) class="fa-trash pointer fa fs-22 py-2 mx-2 text-danger" type="button"></i>';
					return $buttons;
				})
				->rawColumns(['Actions'])
				->make(true);
		}
		return view('admin.settings.state_index');
	}

	public function get_state(Request $request)
	{
		if (!empty($request->id)) {
			$data =  State::where('id', $request->id)->first()->toArray();
			return json_encode($data);
		}
	}

	public function states_destroy(Request $request)
	{
		if (!empty($request->id)) {
			$data = State::where('id', $request->id)->delete();
		}
	}

	public function states_store(Request $request)
	{
		if (!empty($request->id) && $request->id != '') {
			$data = State::find($request->id);
			if (empty($data)) {
				$data =  new State();
			}
		} else {
			$data =  new State();
		}
		$data->user_id = Session::get('parent_id');
		$data->name = $request->name;
		$data->save();
	}

	public function enquiry_configuration(Request $request)
	{
		

		try {
			$enquiry_sales_comment = DropdownSettings::where('dropdown_for', 'enquiry_sales_comment')
			->distinct()
			->pluck('name');
			$enquiry_progress = DropdownSettings::where('dropdown_for', 'enquiry_progress')
			->distinct()
			->pluck('name');
			
			$data=['Sales Comment'=>$enquiry_sales_comment,
			'Enquiry Progress'=>$enquiry_progress

		];
            return response()->json([
                "status" => 200,
                "message" => "Building Configuration",
                "data" => $data
            ]);
		} catch (\Exception $e) {
			return response()->json([
                'status' => 'error',
                'message' => $e,
                'data' => $e,
            ], 500);
		}


	}

	public function building_configuration(Request $request)
	{
		

		try {
			$building_restriction = DropdownSettings::where('dropdown_for', 'building_restriction')
			->distinct()
			->pluck('name');
			$building_progress = DropdownSettings::where('dropdown_for', 'building_progress')
			->distinct()
			->pluck('name');
			$building_architecture_type = DropdownSettings::where('dropdown_for', 'building_architecture_type')
			->distinct()
			->pluck('name');
			
			$data=['Building Restriction'=>$building_restriction,
			'Building Progress'=>$building_progress,
			'Building Architecture Type'=>$building_architecture_type

		];
            return response()->json([
                "status" => 200,
                "message" => "Building Configuration",
                "data" => $data
            ]);
		} catch (\Exception $e) {
			return response()->json([
                'status' => 'error',
                'message' => $e,
                'data' => $e,
            ], 500);
		}


	}

	public function property_configuration(Request $request)
	{
		

		try {
			$property_configuration = DropdownSettings::where('dropdown_for', 'property_construction_type')
			->distinct()
			->pluck('name');
			$property_specific_type = DropdownSettings::where('dropdown_for', 'property_specific_type')
			->distinct()
			->pluck('name');
			$property_plan_type = DropdownSettings::where('dropdown_for', 'property_plan_type')
			->distinct()
			->pluck('name');
			$property_furniture_type = DropdownSettings::where('dropdown_for', 'property_furniture_type')
			->distinct()
			->pluck('name');
			$property_zone = DropdownSettings::where('dropdown_for', 'property_zone')
			->distinct()
			->pluck('name');
			$property_priority_type = DropdownSettings::where('dropdown_for', 'property_priority_type')
			->distinct()
			->pluck('name');
			$property_source = DropdownSettings::where('dropdown_for', 'property_source')
			->distinct()
			->pluck('name');
			$property_owner_type = DropdownSettings::where('dropdown_for', 'property_owner_type')
			->distinct()
			->pluck('name');
			$property_measurement_type = DropdownSettings::where('dropdown_for', 'property_measurement_type')
			->distinct()
			->pluck('name');
			$data=['Property Configuration'=>$property_configuration,
			'Category'=>$property_specific_type,
			'Sub Category'=>$property_plan_type,
			'Furniture Type'=>$property_furniture_type,
			'Property Zone'=>$property_zone,
			'Priority Type'=>$property_priority_type,
			'Property Source'=>$property_source,
			'Owner Type'=>$property_owner_type,
			'Mesurement Type'=>$property_measurement_type,
			'Amenities'=>[
				'Swimming Pool',
				'Club house',
				'Passenger Lift',
				'Garden & Children Play Area',
				'Service Lift',
				'Streature Lift',
				'Central AC',
				'Gym'
			]

		];
            return response()->json([
                "status" => 200,
                "message" => "Property Configuration",
                "data" => $data
            ]);
		} catch (\Exception $e) {
			return response()->json([
                'status' => 'error',
                'message' => $e,
                'data' => $e,
            ], 500);
		}



		
	}
	public function add_configuration(Request $request,$value)
	{
		
		try {
			if(!empty($request->input('220'))){
				$id=$request->input('220');
				$property=DropdownSettings::find($id);
				$message="Configration Updated Successfully";
			}else{
				$property=new DropdownSettings();
				$message="Configration Added Successfully";
			}
			$property->user_id=Auth::user()->id;
			$property->dropdown_for=$value;
			$property->name=$request->input('219');
			$property->save();
			return response()->json([
                "status" => 200,
                "message" => $message,
            ]);
		} catch (\Exception $e) {
			return response()->json([
                'status' => 'error',
                'message' => $e,
                'data' => $e,
            ], 500);
		}

	}

	public function delete_configuration(Request $request)
	{
		

		try {
			if($request->input('220') != null){
				$data = DropdownSettings::where('id', $request->input('220'))->delete();
			
			if($data){
				return response()->json([
					"status" => 200,
					"message" => " configration Deleted successfully"
				]);
			
			}else{
				return response()->json([
					"status" => 200,
					"message" => "provider Id not found"
				]);
			}
			}
			 
		} catch (\Exception $e) {
			return response()->json([
                'status' => 'error',
                'message' => $e,
                'data' => $e,
            ], 500);
		}



		// $property_configuration = DropdownSettings::where('dropdown_for', 'property_construction_type')
		// 	->distinct()
		// 	->pluck('name');
		// 	dd($property_configuration);
		// return view('admin.settings.property_dropdown_settings', compact('type'));
	}


	public function save_settings_configuration(Request $request)
	{
		if (!empty($request->name) && !empty($request->dropdown_for)) {
			if (!empty($request->id)) {
				$data = DropdownSettings::find($request->id);
			} else {
				$data = new DropdownSettings();
			}
			$data->parent_id = $request->parent_id;
			$data->name = $request->name;
			$data->user_id = Session::get('parent_id');
			$data->dropdown_for = $request->dropdown_for;
			$data->save();
		}
	}

	public function save_settings_configuration1(Request $request)
	{
		if (!empty($request->name) && !empty($request->dropdown_for)) {
			if (!empty($request->id)) {
				$data = Subcategory::find($request->id);
			} else {
				$data = new Subcategory();
			}
			$data->cat_id = $request->parent_id;
			$data->name = $request->name;
			$data->user_id = Session::get('parent_id');
			//$data->dropdown_for = $request->dropdown_for;
			$data->save();
		}
	}
	public function get_settings_configuration(Request $request)
	{
		if (!empty($request->type)) {
			$type = $request->type . '_';
			$datas = DropdownSettings::where('dropdown_for', 'like', '%' . $type . '%')->get()->toArray();
			foreach ($datas as $key => $value) {
				if (substr($value['dropdown_for'], 0, strlen($type)) != $type) {
					unset($datas[$key]);
				}
			}
			if (!empty($datas)) {
				return json_encode($datas);
			}
			return '';
		}
	}
	public function get_subcategory(Request $request)
	{
		if (!empty($request->type)) {
			$datas = Subcategory::get()->toArray();
			$datas1 = DB::select("select * from `subcategory` where `user_id` is null");
			$data = array_merge($datas, $datas1);
			if (!empty($data)) {
				return json_encode($data);
			}
			return '';
		}
	}

	public function delete_settings_configuration(Request $request)
	{
		if (!empty($request->id)) {
			$datas = DropdownSettings::find($request->id);
			if (!empty($datas)) {
				$datas->delete();
			}
		}
	}
	public function delete_settings_configuration1(Request $request)
	{
		if (!empty($request->id)) {
			$datas = Subcategory::find($request->id);
			if (!empty($datas)) {
				$datas->delete();
			}
		}
	}
	public function addInvoice(Request $request)
	{
		$properties = $request->input('property');
		$total = 0;
		foreach ($properties as $property) {
			$total += (float)$property['property_total'];
		}
		$user=User::where('id',Auth::user()->id)->first();
		$currentDate = now()->toDateString(); // YYYY-MM-DD
		$data= 
		[
			"issued_date" => $currentDate,
			"name" => $user->first_name." ".$request->middle_name ." ".$request->last_name,
			"email" => $user->email,
			"address" => $user->address,
			"To" => [
			  "land_mark" =>  $request->land_mark,
			  "street" =>  $request->street,
			  "city" =>  $request->city,
			  "email" =>  $request->email,
			],
			"property" =>$properties,
			"total" => $total,
			"terms" => $request->terms,
		];
		return response()->json([
			"status" => 200,
			"message" => "Invoice",
			"data" => $data
		]);
	}
	public function Cards(Request $request){
		$user=User::where('id',Auth::user()->id)->first();
		$user_id=Auth::user()->id;//Get Admin Data
		$company=CompanyDetails::where('user_id',$user_id)->first();
		$logo=null;
		if($company !=null){
			$logo=$company->company_logo;
		}
		
		$data=[
			"name" => $user->first_name." ".$request->middle_name ." ".$request->last_name,
			"email" => $user->email,
			"mobile" => $user->mobile_number,
			"address" => $user->address,
			"logo"=>$logo
		];
		return response()->json([
			"status" => 200,
			"message" => "Invoice",
			"data" => $data
		]);
	}
}