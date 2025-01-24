<?php

namespace App\Helpers;

use App\Models\Areas;
use DOMDocument;
use App\Models\User;
use App\Models\Branches;
use App\Models\Builders;
use App\Models\City;
use App\Models\Subcategory;
use App\Models\DefaultMeasurement;
use App\Models\DropdownSettings;
use App\Models\DropdownTemplate;
use App\Models\Enquiries;
use App\Models\Projects;
use App\Models\Properties;
use App\Models\State;
use App\Models\UserNotifications;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class Helper
{
	public static function assets($path, $secure = null)
	{
		if (config('app.env') == "local") {
			return app('url')->asset($path, $secure);
		} else if (config('app.env') == "staging") {
			return app('url')->asset($path, $secure);
		} else if (config('app.env') == "production") {
			return app('url')->asset($path, $secure);
		}
		return app('url')->asset("public/" . $path, $secure);
	}

	public static function images($path, $secure = null)
	{
		if (config('app.env') == "local") {
			return app('url')->asset($path, $secure);
		} else if (config('app.env') == "staging") {
			return app('url')->asset($path, $secure);
		} else if (config('app.env') == "production") {
			return app('url')->asset($path, $secure);
		}
		return app('url')->asset("public/" . $path, $secure);
	}

	public static function uploadPDFFile($path, $filename)
	{
		if (config('app.env') == "local") {
			return public_path() . $path . $filename;
		} else if (config('app.env') == "staging") {
			return public_path() . $path . $filename;
		} else if (config('app.env') == "production") {
			return public_path() . $path . $filename;
		}
		return public_path() . $path . $filename;
	}

	public static function uploadFile($fileData = Null, $path = Null, $filename = Null, $oldfilename = null)
	{
		if (!is_null($fileData)) {
			if (config('app.env') == "local") {
				$fileData->move(public_path() . $path, $filename);

				if (!is_null($oldfilename) && file_exists(public_path() . $path . $oldfilename)) {
					unlink(public_path() . $path . $oldfilename);
				}
			} else if (config('app.env') == "staging") {
				$fileData->move(public_path() . $path, $filename);

				if (!is_null($oldfilename) && file_exists(public_path() . $path . $oldfilename)) {
					unlink(public_path() . $path . $oldfilename);
				}
			} else if (config('app.env') == "production") {
				$fileData->move(public_path() . $path, $filename);

				if (!is_null($oldfilename) && file_exists(public_path() . $path . $oldfilename)) {
					unlink(public_path() . $path . $oldfilename);
				}
			}
			return self::assets($path . $filename);
		}
		return false;
	}

	// Delete a File
	public static function deleteFile($path = Null, $filename = Null)
	{
		if (!is_null($filename) && !empty($filename)) {
			if (config('app.env') == "local") {
				if (file_exists(public_path() . $path . $filename)) {
					unlink(public_path() . $path . $filename);
				}
			} else if (config('app.env') == "staging") {
				if (file_exists(public_path() . $path . $filename)) {
					unlink(public_path() . $path . $filename);
				}
			} else if (config('app.env') == "production") {
				if (file_exists(public_path() . $path . $filename)) {
					unlink(public_path() . $path . $filename);
				}
			}
		}
		return true;
	}

	// Delete a File
	public static function deleteDirectory($path = Null, $user_id = null)
	{
		if (!is_null($path)) {
			if (config('app.env') == "local") {
				if (is_dir(public_path() . $path)) {
					File::deleteDirectory(public_path() . $path);
				}
			} else if (config('app.env') == "staging") {
				if (is_dir(public_path() . $path)) {
					File::deleteDirectory(public_path() . $path);
				}
			} else if (config('app.env') == "production") {
				if (is_dir(public_path() . $path)) {
					File::deleteDirectory(public_path() . $path);
				}
			}
		}
		return true;
	}

	// Check file exists or not - return absolute path (Full path like - var/wwww/html/priject/public) with filename
	public static function checkFileExists($path, $filename)
	{
		if (config('app.env') == "local") {
			if (file_exists(public_path() . $path . $filename)) {
				return public_path() . $path . $filename;
			}
		} else if (config('app.env') == "staging") {
			if (file_exists(public_path() . $path . $filename)) {
				return public_path() . $path . $filename;
			}
		} else if (config('app.env') == "production") {
			if (file_exists(public_path() . $path . $filename)) {
				return public_path() . $path . $filename;
			}
		}
		return "";
	}

	// Copy file from one location to another location
	public static function copyFile($sourcefilepath = Null, $destinationfilepath = null, $filename = null, $is_delete_source_file = true)
	{
		if (!is_null($sourcefilepath) && !is_null($destinationfilepath) && !is_null($filename)) {
			if (config('app.env') == "local") {
				if (file_exists(public_path() . $sourcefilepath . $filename)) {
					copy(public_path() . $sourcefilepath . $filename, public_path() . $destinationfilepath . $filename);
					if ($is_delete_source_file) {
						unlink(public_path() . $sourcefilepath . $filename);
					}
				}
			} else if (config('app.env') == "staging") {
				if (file_exists(public_path() . $sourcefilepath . $filename)) {
					copy(public_path() . $sourcefilepath . $filename, public_path() . $destinationfilepath . $filename);
					if ($is_delete_source_file) {
						unlink(public_path() . $sourcefilepath . $filename);
					}
				}
			} else if (config('app.env') == "production") {
				if (file_exists(public_path() . $sourcefilepath . $filename)) {
					copy(public_path() . $sourcefilepath . $filename, public_path() . $destinationfilepath . $filename);
					if ($is_delete_source_file) {
						unlink(public_path() . $sourcefilepath . $filename);
					}
				}
			}
		}
		return true;
	}

	public static function getHumanReadableFormat($datetime, $format = "")
	{
		$datetime = \Carbon\Carbon::createFromTimeStamp(strtotime($datetime));
		if ($format != "") {
			return $datetime->format($format);
		}
		if ($datetime->isToday()) {
			return 'Today';
		} else if ($datetime->isYesterday()) {
			return 'Yesterday';
		} else if ($datetime->diffInDays(\Carbon\Carbon::now()) < 7) {
			return $datetime->diffForHumans();
		}
		return $datetime->format('d/m/Y');
	}

	public static function replaceImagePath($text = "", $path)
	{
		$htmlDom = new DOMDocument();
		$htmlDom->loadHTML($text);
		$imageTags = $htmlDom->getElementsByTagName('img');
		$extractedImages = array();
		if (!empty($imageTags)) {
			foreach ($imageTags as $imageTag) {
				$imgSrc = $imageTag->getAttribute('src');
				$file = pathinfo($imgSrc);
				$filename = $file['basename'];
				self::copyFile(config('constant.temp_file_url'), $path, $filename);
			}
			$text = str_replace(config('constant.temp_file_url'), $path, $text);
		}

		return $text;
	}

	public static function convertInHtml($msg = "")
	{
		$url = '@(http(s)?)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
		$msg = preg_replace($url, '<a href="http$2://$4" target="_blank">$0</a>', $msg);
		$msg = str_ireplace(array("\r\n\t", '\r\n\t', "\r\n", '\r\n', "\n", '\n', "\t", '\t'), '<br/>', $msg);
		return $msg;
	}

	public static function add_city($name)
	{
		$data = new City();
		$data->user_id = Session::get('parent_id');
		$data->name = $name;
		$data->save();
		return $data->id;
	}
	public static function add_builder($name)
	{
		$data = new Builders();
		$data->user_id = Session::get('parent_id');
		$data->name = $name;
		$data->save();
		return $data->id;
	}

	public static function add_state($name)
	{
		$data = new State();
		$data->user_id = Session::get('parent_id');
		$data->name = $name;
		$data->save();
		return $data->id;
	}

	public static function add_area($name, $city_id, $state_id)
	{
		$data =  new Areas();
		$data->user_id = Session::get('parent_id');
		$data->name =  $name;
		$data->city_id = $city_id;
		$data->state_id = $state_id;
		$data->status = 1;
		$data->save();
		return $data->id;
	}

	public static function check_if_area_exists($arr, $val)
	{
		foreach ($arr as $key => $value) {
			if (strtolower($value['name']) == strtolower($val)) {
				return 'true';
			}
		}
		return 'false';
	}

	public static function get_drop_variables()
	{
		try {
			$data['drop_projects'] = Projects::all();
			$data['drop_configuration_settings'] = DropdownSettings::get()->toArray();
			$data['drop_cities'] = City::all();
			$data['drop_branches'] = Branches::all();
			$data['drop_areas'] = Areas::all();
			$data['drop_employees'] = User::where('parent_id', Session::get('parent_id'))->get();
			return $data;
		} catch (\Throwable $th) {
			return '';
		}
	}

	public static function get_notifications()
	{
		try {
			$count = UserNotifications::where('user_id', Auth::User()->id)->where('seen', 0)->count();
			$notifications = UserNotifications::where('user_id', Auth::User()->id)->orderBy('id', 'DESC')->get()->toArray();
			foreach ($notifications as $key => $value) {
				$notifications[$key]['created_at'] = Carbon::parse($value['created_at'])->format('d-m-Y | h:i A');
			}
			$arr['noticount'] = $count;
			$arr['notification'] = $notifications;
			return $arr;
		} catch (\Throwable $th) {
			return '';
		}
	}
	
	public static function enquiry_counts()
	{
        $arr['new_counts'] = Enquiries::with('Employee', 'Progress', 'activeProgress')->doesntHave('Progress')->count();
        $arr['miss_counts'] = Enquiries::with('Employee', 'Progress', 'activeProgress')->whereDate('created_at', '<', Carbon::now()->format('Y-m-d'))->count();

		$arr['today_counts'] = Enquiries::with('Employee', 'Progress', 'activeProgress')->whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->count();

		$arr['tomo_counts'] = Enquiries::with('Employee', 'Progress', 'activeProgress')->whereHas('activeProgress', function ($query) {
			$query->whereDate('nfd', '=', Carbon::tomorrow()->format('y-m-d'));
		})->count();

		$arr['yes_counts'] = Enquiries::with('Employee', 'Progress', 'activeProgress')->whereHas('activeProgress', function ($query) {
			$query->whereDate('nfd', '=', Carbon::yesterday()->format('y-m-d'));
		})->count();

		$arr['due_counts'] = Enquiries::with('Employee', 'Progress', 'activeProgress')->whereHas('activeProgress', function ($query) {
			$query->whereDate('nfd', '<=', Carbon::now()->format('y-m-d'));
		})->count();

		$arr['week_counts'] = Enquiries::with('Employee', 'Progress', 'activeProgress')->whereHas('activeProgress', function ($query) {
			$query->whereDate('nfd', '<=', Carbon::now()->endOfWeek())->whereDate('nfd', '>=', Carbon::now()->endOfWeek()->subDay());
		})->count();
		
		$arr['miss_counts'] = Enquiries::with('Employee', 'Progress', 'activeProgress')->whereDate('created_at', '<', Carbon::now()->format('Y-m-d'))->count();

		return $arr;
	}

	public static function c_to_n($amount)
	{
		return str_replace(',', '', $amount);
	}

	public static function set_default_measuerement()
	{
		$def = DefaultMeasurement::where('userid', Auth::user()->id)->first();
		if (!empty($def->measure_id)) {
			Session::put('default_measurement', $def->measure_id);
		}
	}

	public static function add_default_measuerement($id)
	{
		$def = DefaultMeasurement::where('userid', Auth::user()->id)->first();
		if (!empty($def->userid)) {
			$def->measure_id = $id;
			$def->save();
		} else {
			$arr['userid'] = Auth::user()->id;
			$arr['measure_id'] = $id;
			DefaultMeasurement::create($arr);
		}
		Helper::set_default_measuerement();
	}


	public static function get_property_units_helper()
	{
		$prooops = [];
		$properties  = Properties::with('Projects')->get();
		foreach ($properties as $key => $value) {

			if (empty($value->Projects->project_name)) {
				continue;
			}

			$wing1 = $value->property_wing;
			$uni1 = $value->property_unit_no;
			if (!empty($wing1) && !empty($uni1)) {
				array_push($prooops, $value->id . ' - ' . $value->Projects->project_name . ' - ' . $wing1 . ' - ' . $uni1);
			}

			if (!empty($value->unit_details) && isset(json_decode($value->unit_details)[0])) {
				foreach (json_decode($value->unit_details) as $key => $value1) {
					if (!empty($value[0]) && !empty($value1[1])) {
						array_push($prooops, $value->id . ' - ' . $value->Projects->project_name . ' - ' . $value1[0] . ' - ' . $value1[1]);
					}
				}
			}
		}
		return $prooops;
	}

	public static function setDroddownConfigurations($id)
	{
		$dropdowns = DropdownTemplate::get()->toArray();
		$dropdowns2 = [];
		foreach ($dropdowns as $key => $value) {
			$dropdowns2[$value['id']] = $value;
		}
		foreach ($dropdowns2 as $key => $value) {
			if (empty($value['parent_id'])) {
				DropdownSettings::create(['user_id' => $id, 'dropdown_for' => $value['dropdown_for'], 'name' => $value['name'], 'parent_id' => $value['parent_id']]);
			}
		}
		foreach ($dropdowns2 as $key => $value) {
			if (!empty($value['parent_id']) && $value['dropdown_for'] != 'enquiry_sales_comment') {
				$vv = DropdownSettings::where('name', $dropdowns2[$value['parent_id']]['name'])->first();
				DropdownSettings::create(['user_id' => $id, 'dropdown_for' => $value['dropdown_for'], 'name' => $value['name'], 'parent_id' => $vv->id]);
			} else if (!empty($value['parent_id'])) {
				DropdownSettings::create(['user_id' => $id, 'dropdown_for' => $value['dropdown_for'], 'name' => $value['name'], 'parent_id' => $value['parent_id']]);
			}
		}
	}
	public static function convertTOYear($sum)
	{
		$convert = $sum; // days you want to convert

		$years = ($convert / 365); // days / 365 days
		$years = floor($years); // Remove all decimals

		$month = ($convert % 365) / 30.5; // I choose 30.5 for Month (30,31) ;)
		$month = floor($month); // Remove all decimals

		$days = ($convert % 365) % 30.5; // the rest of days

		$data['year'] = $years;
		$data['month'] = $month;
		$data['day'] = $days;
		return  $data;
	}

	public static function searchForId($id, $array)
	{
		foreach ($array as $key => $val) {
			if ($val['id'] == $id) {
				return $val['name'];
			}
		}
		return null;
	}

	public static function theDecrypt($stt)
	{
		try {
			return decrypt($stt);
		} catch (\Throwable $th) {
			return '';
		}
	}

	public static function cleanString($string)
	{
		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

		return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}
	public static function getsubcategory($id)
	{
		$def = Subcategory::where('id', $id)->first();
		if (!empty($def['name'])) {
			return $def['name'];
		} else {
			return NULL;
		}
	}
	
    public static function formatPhoneNumber($phoneNumber)
    {
        if (empty($phoneNumber)) {
            return 1234567890;
        }

        // Remove any non-numeric characters from the phone number
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        // Check if the phone number has exactly 10 digits
        if (strlen($phoneNumber) === 10) {
            return $phoneNumber; // Return the original phone number
        } elseif (strlen($phoneNumber) < 10) {
            // Pad the phone number with leading zeros until it has 10 digits
            return str_pad($phoneNumber, 10, '1', STR_PAD_LEFT);
        } else {
            // If the phone number has more than 10 digits, trim it to 10 digits
            return substr($phoneNumber, 0, 10);
        }
    }
    
    public static function calculatePlanPrice($currentPrice)
    {
        $user = Auth::user();
        if (empty($user->plan_expire_on)) {
            return $currentPrice;
        } else {
            $planExpiry = Carbon::parse($user->plan_expire_on);
            $currentDate = Carbon::parse(now()->toDateString());
            // if the plan has expired..return the full price (current price).
            if ($currentDate->gt($planExpiry)) {
                return $currentPrice;
            } else {
                // load current plan
                $user->load('plan');
                $existingPlan = $user->plan;
                $perDayPrice = intval(($existingPlan->price/12)/30);

                // now check how many days the existing plan has been used for
                $existingPlanSubscribedOn = $planExpiry->subYear(1);
                $existingPlanUsedForDays = $currentDate->diffInDays($existingPlanSubscribedOn);
                $existingPlanUsedPriceTillDate = $existingPlanUsedForDays * $perDayPrice;

                # in gujrat 
                # cgst = 9, sgst = 9, total gst = 18 % 
                # igst = 18 %, Overall gst is 18 % 
                $gst = 0.18;
                # chargable price after upgrade plan
                $amoutWillBeDeductedFromCurrentPlanPrice =  $existingPlan->price - $existingPlanUsedPriceTillDate;
                // include gst to the deductable price
                $gstAmount = $amoutWillBeDeductedFromCurrentPlanPrice * $gst;
                $amoutWillBeDeductedFromCurrentPlanPrice += $gstAmount; 
                $price =  $currentPrice - $amoutWillBeDeductedFromCurrentPlanPrice;
                if ($price <= 0) {
                    return $currentPrice;
                }
                return $price;
            }
        }
    }

	public static function applyOnlyTeamRecordQuery(Builder $query):Builder
	{
		/**
		 * @var App\Models\User $authUser
		 */
		$authUser = Auth::user();
		
		return $query->whereIn('user_id', $authUser->teamUsers()->pluck('id')->toArray());
	}
}
