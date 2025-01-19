<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\InvoiceEmail;
use App\Mail\SendOtpMail;
use App\Models\Api\Properties as ApiProperties;
use App\Models\Areas;
use App\Models\AssignHistory;
use App\Models\Branches;
use App\Models\Builders;
use App\Models\City;
use App\Models\CompanyDetails;
use App\Models\Coupons;
use App\Models\District;
use App\Models\DropdownSettings;
use App\Models\Enquiries;
use App\Models\EnquiryProgress;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Projects;
use App\Models\Properties;
use App\Models\ShareProperty;
use App\Models\State;
use App\Models\Subplans;
use App\Models\SuperCity;
use App\Models\Taluka;
use App\Models\Village;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;
use Throwable;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    protected $cashfreeBaseUrl;
    protected $cashfreeKey;
    protected $cashfreeSecret;
    protected $apiVersion;
    
	public function __construct()
	{
		$this->middleware('auth');
		
		$this->cashfreeBaseUrl = config('cashfree.test');
        $this->cashfreeKey = config('cashfree.api_key');
        $this->cashfreeSecret = config('cashfree.api_secret');
        $this->apiVersion = '2022-01-01';
	}


	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
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
		
		try {
		    
			if (Auth::check()) {
				
				if (empty(Session::get('plan_id'))) {
					Session::put('plan_id', Auth::user()->id);
				}

				$start_date = null;
				$end_date = Carbon::now()->format('Y-m-d 23:59:59');

				if($request->filled('date_range')){
					if($request->date_range == 'last_month' || $request->date_range == 'this_month'){
						$start_date = Carbon::now()->startOfMonth()->subMonth()->format('Y-m-d 00:00:00');
					}elseif($request->date_range == '6month'){
						$start_date = Carbon::now()->startOfMonth()->subMonth(6)->format('Y-m-d 00:00:00');
					}elseif($request->date_range == '3month'){
						$start_date = Carbon::now()->startOfMonth()->subMonth(3)->format('Y-m-d 00:00:00');
					}elseif($request->date_range == 'yearly'){
						$start_date = Carbon::now()->startOfMonth()->subMonth(12)->format('Y-m-d 00:00:00');
					}elseif($request->date_range == 'today'){
						$start_date = Carbon::now()->format('Y-m-d 00:00:00');
					}elseif($request->date_range == 'yesterday'){
						$start_date = Carbon::now()->subDay()->format('Y-m-d 00:00:00');
					}elseif($request->date_range == 'this_week'){
						$start_date = Carbon::now()->subDays(7)->format('Y-m-d 00:00:00');
					}
				}
				
				if($request->filled('from_date') && $request->filled('to_date')){
					$start_date = Carbon::parse($request->from_date)->format('Y-m-d 00:00:00');
					$end_date = Carbon::parse($request->to_date)->format('Y-m-d 00:00:00');
				}

				$totalsales = Enquiries::whereHas('activeProgress', function ($query) {
					$query->where('progress', '=', 'Booked');
				})->where('user_id', Auth::user()->id)->count();

				$assign_property_id = ShareProperty::where('partner_id', Auth::user()->id)->get()->pluck('property_id');
				$total_property = Properties::select('id','user_id')
					->where('user_id', Auth::user()->id)
					->orWhere(function ($query) use ($assign_property_id) {
						$query->whereIn('id', $assign_property_id);
					});
		
				$assign_leads_ids = AssignHistory::where('assign_id',Auth::user()->id)->get()->pluck('enquiry_id');
				$total_enquiry = Enquiries::select('id')
					->where('user_id', Auth::user()->id)
					->orWhere(function ($query) use ($assign_leads_ids) {
						$query->whereIn('id', $assign_leads_ids);
					});
					
				$total_project = Projects::select('id')->where('user_id', Auth::user()->id);

				$total_active_leads = Enquiries::select('id')->whereHas('Progress', function($q){
					$q->whereNotIn('progress', ['Lost', 'Booked' ,'New Lead']);
				})->where('user_id', Auth::user()->id);

				$total_lost = Enquiries::select('id')->whereHas('Progress', function($q){
					$q->where('progress','Lost');
				})->where('user_id', Auth::user()->id);

				$total_win = Enquiries::select('id')->whereHas('Progress', function($q){
					$q->where('progress','Booked');
				})->where('user_id', Auth::user()->id);

				if(!is_null($start_date)){
					$total_project = $total_project->whereBetween('created_at',[$start_date,$end_date]);
					$total_enquiry = $total_enquiry->whereBetween('created_at',[$start_date,$end_date]);
					$total_property = $total_property->whereBetween('created_at',[$start_date,$end_date]);
					$total_lost = $total_lost->whereBetween('created_at',[$start_date,$end_date]);
					$total_win = $total_win->whereBetween('created_at',[$start_date,$end_date]);
					$total_active_leads = $total_active_leads->whereBetween('created_at',[$start_date,$end_date]);
				} else {
					$total_project = $total_project->whereBetween('created_at',[Carbon::now()->startOfMonth()->subMonth()->format('Y-m-d 00:00:00'),$end_date]);
					$total_enquiry = $total_enquiry->whereBetween('created_at',[Carbon::now()->startOfMonth()->subMonth()->format('Y-m-d 00:00:00'),$end_date]);
					$total_property = $total_property->whereBetween('created_at',[Carbon::now()->startOfMonth()->subMonth()->format('Y-m-d 00:00:00'),$end_date]);
					$total_lost = $total_lost->whereBetween('created_at',[Carbon::now()->startOfMonth()->subMonth()->format('Y-m-d 00:00:00'),$end_date]);
					$total_win = $total_win->whereBetween('created_at',[Carbon::now()->startOfMonth()->subMonth()->format('Y-m-d 00:00:00'),$end_date]);
					$total_active_leads = $total_active_leads->whereBetween('created_at',[Carbon::now()->startOfMonth()->subMonth()->format('Y-m-d 00:00:00'),$end_date]);
				}

				$total_property = $total_property->count('id');
				$total_enquiry = $total_enquiry->count('id');
				$total_project = $total_project->count('id');
				$total_lost = $total_lost->count('id');
				$total_win = $total_win->count('id');
				$total_active_leads = $total_active_leads->count('id');

				$properties_tyeps_enquries = DropdownSettings::where('dropdown_for', 'property_construction_type')->pluck('id', 'name')->toArray();

				$enqs = Enquiries::select(DB::raw('count(*) as total,requirement_type'))->groupBy('requirement_type');
				if(!is_null($start_date)){
					$enqs = $enqs->whereBetween('created_at',[$start_date,$end_date]);
				}
				$enqs = $enqs->get()->toArray();
				if (isset($enqs[0])) {
					$arr = [];
					foreach ($enqs as $key => $value) {
						$arr[$value['requirement_type']] = $value['total'];
					}
					$enqs = $arr;
				}

				$props = Properties::select(DB::raw('count(*) as total,property_type'))->groupBy('property_type');
				if(!is_null($start_date)){
					$props = $props->whereBetween('created_at',[$start_date,$end_date]);
				}
				$props = $props->get()->toArray();
				if (isset($props[0])) {
					$arr = [];
					foreach ($props as $key => $value) {
						$arr[$value['property_type']] = $value['total'];
					}
					$props = $arr;
				}
				$progess = EnquiryProgress::select(DB::raw('count(*) as total,lead_type'))->where('status',1)->whereIn('lead_type', ['hot', 'warm', 'cold'])->groupBy('lead_type');
				if(!is_null($start_date)){
					$progess = $progess->whereBetween('created_at',[$start_date,$end_date]);
				}
				$progess = $progess->get()->toArray();
				if (isset($progess[0])) {
					$arr = [];
					foreach ($progess as $key => $value) {
						$arr[$value['lead_type']] = $value['total'];
					}
					$progess = $arr;
				}
				$todayEnquiry = Enquiries::where('created_at', Carbon::today())->where('user_id', Auth::user()->id)->get();
				$disschedule = EnquiryProgress::where('progress', 'Discussion')->where('status',1)->where('user_id', Auth::user()->id)->where('nfd', Carbon::today())->count();
				$sitevisit = EnquiryProgress::where('progress', 'Site Visit Scheduled')->where('status',1)->where('user_id', Auth::user()->id)->where('nfd', Carbon::today())->count();

				$recentproperty = Properties::with('Projects.Area')->where('user_id', Auth::user()->id)->OrderBy('created_at', 'DESC')->limit(10)->get();

				$enqchart = Enquiries::whereNotNull('requirement_type')
					->select(DB::raw('count(*) as total,requirement_type,MONTH(created_at) month'))
					->where('user_id', Auth::user()->id)
					->groupBy('requirement_type', 'month')
					->whereBetween('created_at',[$start_date ?? Carbon::now()->startOfMonth()->subMonth()->format('Y-m-d 00:00:00'),$end_date])
					->get()
					->toArray();

				$chart1data = [];
				foreach ($enqchart as $key => $value) {
					$enqchart[$key]['requirement_type'] = array_search($value['requirement_type'], $properties_tyeps_enquries);
					if (isset($chart1data[$enqchart[$key]['requirement_type']])) {
						$chart1data[$enqchart[$key]['requirement_type']]['data'][$enqchart[$key]['month']] = $enqchart[$key]['total'];
					} else {
						$chart1data[$enqchart[$key]['requirement_type']] = [];
						$chart1data[$enqchart[$key]['requirement_type']]['name'] = $enqchart[$key]['requirement_type'];
						$chart1data[$enqchart[$key]['requirement_type']]['data'] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
						$chart1data[$enqchart[$key]['requirement_type']]['data'][$enqchart[$key]['month']] = $enqchart[$key]['total'];
					}
				}
				$arr = [];
				foreach ($chart1data as $key => $value) {
					unset($value['data'][0]);
					$value['data'] = array_values($value['data']);
					array_push($arr, $value);
				}
				$chart1data = json_encode($arr);

				$propchart = Properties::whereNotNull('property_type')->select(DB::raw('count(*) as total,property_type,MONTH(created_at) month'))->groupBy('property_type', 'month')->where('property_for', 'Rent')->whereDate('created_at', '>=', Carbon::now()->subMonths(5)->startOfMonth())->get()->toArray();

				$chart2data = [];
				foreach ($propchart as $key => $value) {
					$propchart[$key]['property_type'] = array_search($value['property_type'], $properties_tyeps_enquries);
					if (isset($chart2data[$propchart[$key]['property_type']])) {
						$chart2data[$propchart[$key]['property_type']]['data'][$propchart[$key]['month']] = $propchart[$key]['total'];
					} else {
						$chart2data[$propchart[$key]['property_type']] = [];
						$chart2data[$propchart[$key]['property_type']]['name'] = $propchart[$key]['property_type'];
						$chart2data[$propchart[$key]['property_type']]['data'] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
						$chart2data[$propchart[$key]['property_type']]['data'][$propchart[$key]['month']] = $propchart[$key]['total'];
					}
				}
				$arr = [];
				foreach ($chart2data as $key => $value) {
					unset($value['data'][0]);
					$value['data'] = array_values($value['data']);
					array_push($arr, $value);
				}
				$prop_added_for_rent = json_encode($arr);

				$propchart = Properties::whereNotNull('property_type')->select(DB::raw('count(*) as total,property_type,MONTH(created_at) month'))->groupBy('property_type', 'month')->where('property_for', 'Sell')->whereDate('created_at', '>=', Carbon::now()->subMonths(5)->startOfMonth())->get()->toArray();

				$chart2data = [];
				foreach ($propchart as $key => $value) {
					$propchart[$key]['property_type'] = array_search($value['property_type'], $properties_tyeps_enquries);
					if (isset($chart2data[$propchart[$key]['property_type']])) {
						$chart2data[$propchart[$key]['property_type']]['data'][$propchart[$key]['month']] = $propchart[$key]['total'];
					} else {
						$chart2data[$propchart[$key]['property_type']] = [];
						$chart2data[$propchart[$key]['property_type']]['name'] = $propchart[$key]['property_type'];
						$chart2data[$propchart[$key]['property_type']]['data'] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
						$chart2data[$propchart[$key]['property_type']]['data'][$propchart[$key]['month']] = $propchart[$key]['total'];
					}
				}
				$arr = [];
				foreach ($chart2data as $key => $value) {
					unset($value['data'][0]);
					$value['data'] = array_values($value['data']);
					array_push($arr, $value);
				}
				$prop_added_for_sell = json_encode($arr);

				//deal completed chart

				$propchart = Enquiries::whereNotNull('requirement_type')->whereHas('activeProgress', function ($query) {
					$query->where('progress', '=', 'Booked');
				})->select(DB::raw('count(*) as total,requirement_type,MONTH(created_at) month'))->groupBy('requirement_type', 'month')->where('enquiry_for', 'Rent')->whereDate('created_at', '>=', Carbon::now()->subMonths(5)->startOfMonth())->get()->toArray();

				$chart2data = [];
				foreach ($propchart as $key => $value) {
					$propchart[$key]['requirement_type'] = array_search($value['requirement_type'], $properties_tyeps_enquries);
					if (isset($chart2data[$propchart[$key]['requirement_type']])) {
						$chart2data[$propchart[$key]['requirement_type']]['data'][$propchart[$key]['month']] = $propchart[$key]['total'];
					} else {
						$chart2data[$propchart[$key]['requirement_type']] = [];
						$chart2data[$propchart[$key]['requirement_type']]['name'] = $propchart[$key]['requirement_type'];
						$chart2data[$propchart[$key]['requirement_type']]['data'] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
						$chart2data[$propchart[$key]['requirement_type']]['data'][$propchart[$key]['month']] = $propchart[$key]['total'];
					}
				}
				$arr = [];
				foreach ($chart2data as $key => $value) {
					unset($value['data'][0]);
					$value['data'] = array_values($value['data']);
					array_push($arr, $value);
				}
				$prop_rented = json_encode($arr);

				$propchart = Enquiries::whereNotNull('requirement_type')->whereHas('Progress', function ($query) {
					$query->where('status', '=', '1')->where('progress', '=', 'Booked');
				})->select(DB::raw('count(*) as total,requirement_type,MONTH(created_at) month'))->groupBy('requirement_type', 'month')->where('enquiry_for', 'Buy')->whereDate('created_at', '>=', Carbon::now()->subMonths(5)->startOfMonth())->get()->toArray();

				$chart2data = [];
				foreach ($propchart as $key => $value) {
					$propchart[$key]['requirement_type'] = array_search($value['requirement_type'], $properties_tyeps_enquries);
					if (isset($chart2data[$propchart[$key]['requirement_type']])) {
						$chart2data[$propchart[$key]['requirement_type']]['data'][$propchart[$key]['month']] = $propchart[$key]['total'];
					} else {
						$chart2data[$propchart[$key]['requirement_type']] = [];
						$chart2data[$propchart[$key]['requirement_type']]['name'] = $propchart[$key]['requirement_type'];
						$chart2data[$propchart[$key]['requirement_type']]['data'] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
						$chart2data[$propchart[$key]['requirement_type']]['data'][$propchart[$key]['month']] = $propchart[$key]['total'];
					}
				}
				$arr = [];
				foreach ($chart2data as $key => $value) {
					unset($value['data'][0]);
					$value['data'] = array_values($value['data']);
					array_push($arr, $value);
				}
				$prop_sold = json_encode($arr);



				$totalSource = [];
				$dropdowns = DropdownSettings::get()->toArray();
				$dropdownsarr = [];
				foreach ($dropdowns as $key => $value) {
					$dropdownsarr[$value['id']] = $value;
					if ($value['dropdown_for'] == 'property_source') {
						$totalSource[$value['id']] = [];
						$totalSource[$value['id']]['total'] = 0;
						$totalSource[$value['id']]['id'] = $value['id'];
						$totalSource[$value['id']]['name'] = $value['name'];
					}
				}


				$propertySource = Properties::whereNotNull('source_of_property')->select(DB::raw('count(*) as total,source_of_property'))->groupBy('source_of_property')->get()->toArray();
				$enquirySource = Enquiries::whereNotNull('enquiry_source')->select(DB::raw('count(*) as total,enquiry_source'))->groupBy('enquiry_source')->get()->toArray();

				$totalSourceCount = 0;
				foreach ($propertySource as $key => $value) {
					if (isset($value['source_of_property']) && $value['total'] > 0) {
						$totalSource[$value['source_of_property']]['total'] = $totalSource[$value['source_of_property']]['total'] + $value['total'];
						$totalSourceCount = $totalSourceCount + $value['total'];
					}
				}

				foreach ($enquirySource as $key => $value) {
					if (isset($value['enquiry_source']) && $value['total'] > 0) {
						$totalSource[$value['enquiry_source']]['total'] = $totalSource[$value['enquiry_source']]['total'] + $value['total'];
						$totalSourceCount = $totalSourceCount + $value['total'];
					}
				}
				foreach ($totalSource as $key => $value) {
					if ($value['total'] < 1 || $totalSourceCount < 1) {
						$totalSource[$key]['percent'] = 0;
					}else{
						$totalSource[$key]['percent'] = round(($value['total']*100)/$totalSourceCount);
					}
				}
				$totalSource = array_values($totalSource);
				$enqlatest = Enquiries::with('Employee')->OrderBy('created_at', 'DESC')->limit(10)->get();
				
				$dashboard_widget_positions = [];
				
				$firstChartfromMonth = now()->subMonths(12)->startOfMonth();
        		$firstCharttoMonth = now()->addDay();


				// chart code start

				$new_leads = Enquiries::select(DB::raw("(COUNT(*)) as count"),DB::raw("CONCAT(MONTHNAME(created_at), ' ', YEAR(created_at)) as month_year"))
					->whereBetween('created_at',[$start_date ?? Carbon::now()->startOfMonth()->subMonth()->format('Y-m-d 00:00:00'),$end_date])
					->where('user_id', Auth::user()->id)
					->groupBy('month_year')
					->get();

				$firstChartperiod = new DatePeriod(
					new DateTime($firstChartfromMonth->addMonth()),
					new DateInterval('P1M'),
					new DateTime($firstCharttoMonth)
				);

				$first_chart = [];
				foreach ($firstChartperiod as $key => $value) {
					$first_chart[$value->format('F')." ". $value->format('Y')] = 0;
				}
 
				foreach ($new_leads as $new_lead) {
					if(array_key_exists($new_lead->month_year, $first_chart)) {
						$first_chart[$new_lead->month_year] = $new_lead->count;
					}
				}
				
				$second_chart_query = Enquiries::select([
					'dropdown_settings.name AS enquiry_source_case',
					'enquiries.enquiry_source',
					'enquiries.id',
				])
				->join('dropdown_settings', 'enquiries.enquiry_source','dropdown_settings.id')
				->where('enquiries.enquiry_source','!=',null)
				->where('enquiries.user_id', Auth::user()->id)
				->whereBetween('enquiries.created_at',[$start_date ?? Carbon::now()->startOfMonth()->subMonth()->format('Y-m-d 00:00:00'),$end_date])
				->get();

				$second_chart_group = $second_chart_query->groupBy('enquiry_source_case');

				$second_chart = [];

				foreach ($second_chart_group as $key_name => $enqs) {
					array_push($second_chart ,[
						'enquiry_source_case' => $key_name,
						'total_enquiry' => count($enqs),
					]);
				}
				
				$inquiryCounts = Enquiries::select(
					'enquiries.employee_id',
					DB::raw("CONCAT(users.first_name,  users.last_name) as person_name"),
				)
				->join('users', 'enquiries.employee_id','users.id')
				->where('employee_id', '!=', null)
				->whereBetween('enquiries.created_at',[$start_date ?? Carbon::now()->startOfMonth()->subMonth()->format('Y-m-d 00:00:00'),$end_date])
				->where('user_id', Auth::user()->id)
				->get();
		
				$new = $inquiryCounts->groupBy('person_name');
		
				$third_chart = [];
		
				foreach($new->toArray() as $key => $data) {
					array_push($third_chart,[
						'user_name' => $key,
						'total_inquiries' => count($data),
					]);
				}
				
				$total_lost_leads = Enquiries::select([
					'enquiries.enquiry_source',
					'dropdown_settings.name AS enquiry_source_case',
				])
				->join('dropdown_settings', 'enquiries.enquiry_source','dropdown_settings.id')
				->withCount(['Progress' => function($query) {
					$query->where('progress','Lost');
				}])->where('enquiries.enquiry_source', '!=', null)->where('enquiries.user_id', Auth::user()->id)
				->whereBetween('enquiries.created_at',[$start_date ?? Carbon::now()->startOfMonth()->subMonth()->format('Y-m-d 00:00:00'),$end_date])
				->get();
		
				$fifth_chart = [];
		
				foreach($total_lost_leads->groupBy('enquiry_source_case')->toArray() as $element) {
					$total = 0;
					
					foreach($element as $i) {
						$total += $i['progress_count'];
					}
		
					array_push($fifth_chart,[
						'source_type' => $element[0]['enquiry_source_case'],
						'total_enquiry' => $total,
					]);
				};

				// stage wise total leads

				$seventh_chart = [
					[
						'progress' => 'New Lead',
						'total_enquiry' => 0,
					],
					[
						'progress' => 'Lead Confirmed',
						'total_enquiry' => 0,
					],
					[
						'progress' => 'Discussion',
						'total_enquiry' => 0,
					],
					[
						'progress' => 'Booked',
						'total_enquiry' => 0,
					],
					[
						'progress' => 'Lost',
						'total_enquiry' => 0,
					],
				];

				foreach ($seventh_chart as $index => $progress_type)
				{
					$seventh_chart[$index]['total_enquiry'] = EnquiryProgress::where('progress', $progress_type['progress'])->get()->count();
				}

				$total_prop_for_sell = ApiProperties::where('property_for','Sell')
					->where('user_id',Auth::user()->id)
					->whereNull('deleted_at')
					->whereBetween('created_at',[$start_date ?? Carbon::now()->startOfMonth()->subMonth()->format('Y-m-d 00:00:00'),$end_date])
					->count();
				
				$total_prop_for_rent = ApiProperties::where('property_for','Rent')
					->where('user_id',Auth::user()->id)
					->whereNull('deleted_at')
					->whereBetween('created_at',[$start_date ?? Carbon::now()->startOfMonth()->subMonth()->format('Y-m-d 00:00:00'),$end_date])
					->count();

				$total_prop_for_both = ApiProperties::where('property_for','Both')
					->where('user_id',Auth::user()->id)
					->whereNull('deleted_at')
					->whereBetween('created_at',[$start_date ?? Carbon::now()->startOfMonth()->subMonth()->format('Y-m-d 00:00:00'),$end_date])
					->count();

				$total_prop_for_comm = ApiProperties::where('property_type',85)
					->where('user_id',Auth::user()->id)
					->whereNull('deleted_at')
					->whereBetween('created_at',[$start_date ?? Carbon::now()->startOfMonth()->subMonth()->format('Y-m-d 00:00:00'),$end_date])
					->count();
				
				$total_prop_for_rec = ApiProperties::where('property_type',87)
					->where('user_id',Auth::user()->id)
					->whereNull('deleted_at')
					->whereBetween('created_at',[$start_date ?? Carbon::now()->startOfMonth()->subMonth()->format('Y-m-d 00:00:00'),$end_date])
					->count();

				$filter_value = $request->date_range ?? 'this_month';
				
				return view('admin.dashboard', compact('filter_value','total_property','total_prop_for_both', 'total_prop_for_sell','total_prop_for_rent','total_prop_for_comm','total_prop_for_rec','total_enquiry','first_chart','second_chart','third_chart','fifth_chart','seventh_chart','properties_tyeps_enquries','enqs','props','progess','todayEnquiry','disschedule','sitevisit','recentproperty','enqchart','chart1data','dropdownsarr','enqlatest','prop_added_for_rent','prop_added_for_sell','prop_rented','prop_sold','totalSource','total_project','total_win','total_lost','total_active_leads','totalsales','dashboard_widget_positions'));
			}
			return redirect()->route('admin.login');

		} catch (Exception $e) {
			dd($e->getMessage());
			return $e->getMessage();
		}
	}

    public function applyCoupuonCode(Request $request) {
        try {
            $currentDate = Carbon::now()->toDateString();
            $validCoupon = Coupons::where('code', $request->coupon_code)
                ->where('date_from', '<=', $currentDate)
                ->where('date_to', '>=', $currentDate)
                ->where('status', '1')
                ->first();
            if (!$validCoupon || null == $validCoupon) {
                throw new Exception("Invalide coupon Code.", 400);
            }
            // check if user has already used the code
            $usedCoupon = Payment::where('coupon_applied', $request->coupon_code)
            ->where('user_id', $request->user()->id)
            ->first();
            if ($usedCoupon) {
                throw new Exception("Coupon Code alreay used.", 400);
            }
            if (empty($request->payment_for)) {
                // get plan and give discount price
                $planPrice = Subplans::find($request->plan_id)->price; 
            } else {
                $planPrice = $request->amount;
            }
            if ($validCoupon->discount_type == 1) {
                $percent = (((int) $validCoupon->amount_off) /100);
                $discount = $planPrice*$percent;
            } else {
                // flat discount
                $discount = $validCoupon->amount_off;
            }
            $priceAfterDiscount = $planPrice - $discount;

            $gstType = Auth::user()->state->gst_type;
            $gst = $priceAfterDiscount * 0.18;

            return response()->json([
                'error' => false,
                'message' => 'Coupon applied successfully.',
                'data' => [
                    'acutal_price' => $planPrice,
                    'discount' => $discount,
                    'price_after_discount' => $priceAfterDiscount,
                    'gst_type' => $gstType,
                    'gst' => $gst,
                ]
            ]);
        } catch (\Throwable $th) {
            $msg = $th->getCode() == 400 ? $th->getMessage() : 'Something went wrong.';
            return response()->json([
                'error' => true,
                'message' => $msg,
                'error_details' => $th->getMessage(),
                'data' => null
            ]);
        }
    }
    
	public function getCities(Request $request)
	{
		if ($request->ajax()) {
			$data = City::all();
			return DataTables::of($data)->make(true);
		}
		$states = State::orderBy('name')->get()->toArray();
		return view('admin.city.index',compact('states'));
	}

	public function importCity(Request $request)
	{
		if(!empty($request->state_id)){
			$allcity = SuperCity::whereIn('id',$request->city_array)->get();
			foreach ($allcity as $key => $value) {
				$exist = City::where('name',$value->name)->where('state_id',$value->state_id)->first();
				if (empty($exist->id)) {
					$state = State::find($value->state_id);
					$current_user_state = State::where('user_id',Auth::user()->id)->where('name', $state->name)->first();

					$new_state_id = $state->id;
					    
					if(!$current_user_state) {
						$new_state = new State();
						$new_state->fill([
							'name' => $state->name,
							'user_id' => Auth::user()->id,
							'gst_type' => $state->gst_type,
						])->save();
						
						$new_state_id = $new_state->id;
					} else {
						$new_state_id = $current_user_state->id;
					}
					
					$current_user_city = City::where('user_id',Auth::user()->id)->where('name', $value->name)->first();

					if(!$current_user_city) {
						$city = new City();
						$city->user_id = Auth::user()->id;
						$city->name = $value->name;
						$city->state_id = $new_state_id;
						$city->save();
					}
				}
			}
		}
	}

	public function getActivityLogs(Request $request)
	{
		if ($request->ajax()) {
			$data = Activity::where('user_id', Session::get('parent_id'))->with('causer')->get();
			return DataTables::of($data)
				->editColumn('new', function ($row) {
					$properties = json_decode($row->properties, true);
					$mega_desc_new = '';
					if (isset($properties['attributes'])) {
						foreach ($properties['attributes'] as $key => $value) {
							$mega_desc_new = $mega_desc_new . $key . ' : ' . $value . ' , ';
						}
					}
					return $mega_desc_new;
				})
				->editColumn('old', function ($row) {
					$properties = json_decode($row->properties, true);
					$mega_desc_old = '';
					if (isset($properties['old'])) {
						foreach ($properties['old'] as $key => $value) {
							$mega_desc_old = $mega_desc_old . $key . ' : ' . $value . ' , ';
						}
					}
					return $mega_desc_old;
				})
				->editColumn('subject', function ($row) {
					return str_replace('AppModels', '', str_replace('\\', '', $row->subject_type));
				})
				->editColumn('activity', function ($row) {
					return $row->description;
				})
				->editColumn('user', function ($row) {
					if (!empty($row->causer->first_name)) {
						return $row->causer->first_name . ' ' . $row->causer->last_name;
					}
				})
				->editColumn('created_at', function ($row) {
					return Carbon::parse($row->created_at)->format('d-m-Y H:i:s');
				})
				->make(true);
		}
		return view('admin.logs.index');
	}

	public function plan_index(Request $request)
	{
	    $transactionGoal = Session::get('trans_action'); // this will set on checkPlanExpiry middleware check
        
        if (!empty($transactionGoal)) {
            Session::put('transaction_goal', $transactionGoal);
        } else {
            Session::put('transaction_goal', 'upgrade');
        }
		
		$plans = Subplans::orderBy('price', 'asc')->get();

		$current_plan = Subplans::find(Auth::user()->plan_id)->toArray();

		$display_button = false;

		if(Auth::user()->plan_expire_on) {

			$today = new DateTime(); // This defaults to today's date
			$databaseDate = new DateTime(Auth::user()->plan_expire_on);
			$display_button = $databaseDate < $today ? false : true;
		}

		return view('admin.userplans.index', compact('plans','current_plan' ,'display_button'));
	}
	
    public function priceCalculator(Request $request)
	{
        try {
            $mainPrice = $request->truePrice; // this will set on checkPlanExpiry middleware check
            $calculatedPrice = Helper::calculatePlanPrice($mainPrice);
            $upgradeDiscount = $mainPrice - $calculatedPrice;
            return response()->json([
                'error' => false,
                'message' => 'success',
                'data' => [
                    'mainPrice' => $mainPrice,
                    'calculatedPrice' => $calculatedPrice,
                    'upgradeDiscount' => $upgradeDiscount
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'message' => $th->getMessage(),
            ]) ;
        }
	}

	public function search(Request $request)
	{
		if ($request->ajax() && !empty($request->search)) {
			$enquiries  = Enquiries::where('client_name', 'LIKE', "%{$request->search}%")->get()->toArray();
			$projects  = Projects::where('project_name', 'LIKE', "%{$request->search}%")->get()->toArray();
			$users  = User::where('parent_id',Session::get('parent_id'))  ->where(function($query) use ($request){
				$query->where('first_name', 'LIKE', "%{$request->search}%")->orWhere('last_name', 'LIKE', "%{$request->search}%");
			})->get()->toArray();
			$builders  = Builders::where('name', 'LIKE', "%{$request->search}%")->get()->toArray();
			$areas  = Areas::where('name', 'LIKE', "%{$request->search}%")->get()->toArray();

			$properties = Properties::where('owner_name', 'LIKE', "%{$request->search}%")->get()->toArray();

			$data['enquiries'] = $enquiries;
			$data['projects'] = $projects;
			$data['users'] = $users;
			$data['areas'] = $areas;
			$data['properties'] = $properties;
			
			return json_encode($data);
		}
	}

	/*public function plan_save(Request $request)
	{
		Subplans::get();
		
		$plan_detail = Subplans::find(intval($request->plan_id));

		User::where('id', Session::get('parent_id'))->update([
			'plan_id' => $request->plan_id,
			'total_user_limit' => $plan_detail->user_limit,
			'subscribed_on' => Carbon::now()->format('Y-m-d')
		]);

		Session::put('plan_id', $request->plan_id);
		
		return redirect()->route('admin');
	}*/
	
	public function increaseUserLimit(Request $request)
    {
        try {
            $user  = Auth::user();
            $transaction_goal = $request->transaction_goal;
            $planPrice = ($request->users_limit_price + $request->gst_amt);

			$planDetails = Subplans::find($user->plan_id);

            $usersLimit = $request->users_limit;
			$free_users = $planDetails->free_user;

            $total_paid_users = $usersLimit - 1;

            if( $free_users > 0 ) {
                $total_paid_users = $usersLimit - $free_users;
            }
            $couponCode = null;
            $discount = 0;
            if (!empty($request->discounted_price)) {
                $planPrice = $request->discounted_price;
                $couponCode = $request->coupon_code;
                $discount = $request->discount;
            }
            
            if (empty($planPrice) || $planPrice <= 0) {
                Session::put('message', 'Amount is required.');
                return redirect()->back();
            }
            
            // process payment
            $url = $this->cashfreeBaseUrl . "/orders";

            $headers = array(
                "Content-Type: application/json",
                'Accept: application/json',
                "x-api-version: " . $this->apiVersion,
                "x-client-id: " . $this->cashfreeKey,
                "x-client-secret: " . $this->cashfreeSecret,
            );
            $userPhone = Helper::formatPhoneNumber($user->mobile_number);

            $data = json_encode([
                'order_id' =>  'order_' . time(),
                'order_amount' => $planPrice,
                "order_currency" => "INR",
                "customer_details" => [
                    "customer_id" => 'USER_' . $user->id,
                    "customer_name" => $user->first_name . ' ' . $user->last_name,
                    "customer_email" => $user->email,
                    "customer_phone" => $userPhone,
                ],
                "order_tags" => [
                    "plan_id" => "$user->plan_id",
                    "user_limit" => "$usersLimit",
                    "user_id" => "$user->id",
                    "transaction_goal" => "$transaction_goal",
                    "couponCode" => "$couponCode",
                    "order_amount" => "$request->users_limit_price",
                    "discount" => "$discount",
                    "gst_amt" => "$request->gst_amt",
                    "gst_type" => "$request->gst_amt_type",
					"free_users" => "$free_users",
                    "paid_users" => "$total_paid_users",
                ],
                "order_meta" => [
                    "return_url" => route('admin.paymentSuccess') . '?order_id={order_id}&order_token={order_token}'
                ]
            ]);

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL,
                $url
            );
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl,
                CURLOPT_POSTFIELDS,
                $data
            );

            $resp = curl_exec($curl);
            if (curl_errno($curl)) {
                $error_msg = curl_error($curl);
                Session::put('message', $error_msg);
                return redirect()->route('admin.plans');
                // dd($error_msg);
            }
            curl_close($curl);

            return redirect()->to(json_decode($resp)->payment_link);
        } catch (\Throwable $th) {
            //throw $th;
            // dd($th);
            Session::put('message', $th->getMessage());
            return redirect()->route('admin.profile.details');
        }
    }
	
	public function plan_save(Request $request)
    {
        try {
            $transaction_goal = Session::get('transaction_goal') ?? 'new_subscription';

            $planDetails = Subplans::find($request->plan_id);
            
			if (!$planDetails) {
                Session::put('message', 'Invalid Plan.');
                return redirect('/admin');
            }

            $user  = Auth::user();

            $usersLimit = $planDetails->user_limit ?? 1;
            $free_users = $planDetails->free_user;

            $total_paid_users = $usersLimit - 1;

            if( $free_users > 0 ) {
                $total_paid_users = $usersLimit - $free_users;
            }

            $amountToPay = $planDetails->price;

            $couponCode = null;

            $discount = 0;

            if (!empty($request->discounted_price)) {
                $amountToPay = $request->discounted_price;
                $couponCode = $request->coupon_code;
                $discount = $request->discount;
            } else {
                // in case of no coupon just add gst to plan price.
                $amountToPay += $request->gst_amt; 
            }
            $planPrice = Helper::calculatePlanPrice($amountToPay);

            // process payment
            $url = $this->cashfreeBaseUrl . "/orders";

            $headers = array(
                "Content-Type: application/json",
                'Accept: application/json',
                "x-api-version: " . $this->apiVersion,
                "x-client-id: " . $this->cashfreeKey,
                "x-client-secret: " . $this->cashfreeSecret,
            );
            $userPhone = Helper::formatPhoneNumber($user->mobile_number);

            $data = json_encode([
                'order_id' =>  'order_' . time(),
                'order_amount' => $planPrice,
                "order_currency" => "INR",
                "customer_details" => [
                    "customer_id" => 'USER_' . $user->id,
                    "customer_name" => $user->first_name . ' ' . $user->last_name,
                    "customer_email" => $user->email,
                    "customer_phone" => $userPhone,
                ],
                "order_tags" => [
                    "plan_id" => "$planDetails->id",
                    "plan_type" => "$planDetails->plan_type",
                    "user_limit" => "$planDetails->user_limit",
                    "user_id" => "$user->id",
                    "transaction_goal" => "$transaction_goal",
                    "couponCode" => "$couponCode",
                    "order_amount" => "$planDetails->price",
                    "discount" => "$discount",
                    "gst_amt" => "$request->gst_amt",
                    "gst_type" => "$request->gst_amt_type",
					"free_users" => "$free_users",
                    "paid_users" => "$total_paid_users",
                ],
                "order_meta" => [
                    "return_url" => route('admin.paymentSuccess') . '?order_id={order_id}&order_token={order_token}'
                ]
            ]);

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            $resp = curl_exec($curl);
            if (curl_errno($curl)) {
                $error_msg = curl_error($curl);
                Session::put('message', $error_msg);
                return redirect()->route('admin.plans');
                // dd('order_create', $error_msg);
            }
            curl_close($curl);

            return redirect()->to(json_decode($resp)->payment_link);
        } catch (\Throwable $th) {
            //throw $th;
            // dd($th);
            Session::put('message', $th->getMessage());
            return redirect()->route('admin.plans');
        }
    }

    public function payment_success(Request $request)
    {
        try {

            # process payment
            $headers = array(
                "Content-Type" => "application/json",
                "x-api-version" => $this->apiVersion,
                "x-client-id" => $this->cashfreeKey,
                "x-client-secret" => $this->cashfreeSecret,
            );
            // get payment
            $client = new \GuzzleHttp\Client();
            $url = $this->cashfreeBaseUrl . '/orders/' . $request->order_id . '/payments';
            $response = $client->request('GET', $url, ["headers" => $headers]);
            $paymentInstance = json_decode($response->getBody(), true)[0];

            // get order details
            $url = $this->cashfreeBaseUrl . "/orders/" . $paymentInstance['order_id'];
            $orderInstance = $client->request('GET', $url, ["headers" => $headers]);
            $order = json_decode($orderInstance->getBody(), true);
            // #bc0
            $orderTags =  $order['order_tags'];

            // remove unwanted keys
            unset(
                $paymentInstance['auth_id'],
                $paymentInstance['authorization'],
                $paymentInstance['bank_reference'],
                $paymentInstance['payment_offers'],
            );

            $paymentInstance['error_details'] = !empty($paymentInstance['error_details']) ? json_encode($paymentInstance['error_details']) : null;
            $paymentInstance['payment_method'] = !empty($paymentInstance['payment_method']) ? json_encode($paymentInstance['payment_method']) : null;

            // prepare data
            $paymentDetails['cf_payment_id'] = $paymentInstance['cf_payment_id'];
            $paymentDetails['user_id'] = $orderTags['user_id'];
            $paymentDetails['plan_id'] = $orderTags['plan_id'];
            $paymentDetails['entity'] = $paymentInstance['entity'];
            $paymentDetails['error_details'] = $paymentInstance['error_details'];
            $paymentDetails['is_captured'] = $paymentInstance['is_captured'];
            $paymentDetails['order_amount'] = $orderTags['order_amount'];
            $paymentDetails['order_id'] = $paymentInstance['order_id'];
            $paymentDetails['payment_amount'] = $paymentInstance['payment_amount'];
            $paymentDetails['payment_completion_time'] = Carbon::parse($paymentInstance['payment_completion_time'])->format('Y-m-d h:i:s');
            $paymentDetails['payment_currency'] = $paymentInstance['payment_currency'];
            $paymentDetails['payment_group'] = $paymentInstance['payment_group'];
            $paymentDetails['payment_message'] = $paymentInstance['payment_message'];
            $paymentDetails['payment_method'] = $paymentInstance['payment_method'];
            $paymentDetails['payment_status'] = $paymentInstance['payment_status'];
            $paymentDetails['payment_time'] = Carbon::parse($paymentInstance['payment_time'])->format('Y-m-d h:i:s');
            $paymentDetails['transaction_goal'] = $orderTags['transaction_goal'] ?? Null;

            if ($orderTags['gst_type'] == 'intra_state') {
                $paymentDetails['cgst'] = $orderTags['gst_amt']/2;
                $paymentDetails['sgst'] = $orderTags['gst_amt']/2;
            } else {
                $paymentDetails['igst'] = $orderTags['gst_amt'];
            }

            // check record
            $paymentInDb = Payment::where('cf_payment_id', $paymentInstance['cf_payment_id'])->first();
            if (empty($paymentInDb->id)) {
                $paymentInDb = Payment::create($paymentDetails);
            } else {
                Log::error("Payment for user id: " . $orderTags['user_id'] . " already exist in the DB.");
                Log::error("Payment id: " . $paymentInDb->cf_payment_id);
                // $paymentInDb->update($paymentDetails);
            }

            // save payment details in 'payments' table
            if ($paymentInstance['is_captured'] && $paymentInstance['payment_status'] == 'SUCCESS') {
                // on successfull payment update user for selected plan
                $user = User::find($orderTags['user_id']);

                switch ($orderTags['transaction_goal']) {
                    case 'renew_subscription':
                    case 'upgrade':
                    case 'add_user':
                        $lastPaymentId = $user->payment_id;
                        break;
                    default:
                        $lastPaymentId = null;
                }

               /*  // desciption for email template.
                switch ($orderTags['transaction_goal']) {
                    case 'renew_subscription':
                        $description = "Plan Renewed.";
                        break;
                    case 'upgrade':
                        $description = "Plan Upgraded.";
                        break;
                    case 'add_user':
                        $description = "More User Added.";
                        break;
                    default:
                        $description = "New Subscription.";
                } */

                // record last payment id in the payments table.
                $paymentInDb->update(['subscription_payment_id' => $lastPaymentId]);
                
                // adjust coupon details
                if (!empty($orderTags['couponCode']) && !empty($orderTags['discount'])) {
                    $paymentInDb->update([
                        'coupon_applied' => $orderTags['couponCode'],
                        'discount' => $orderTags['discount']
                    ]);
                    $usedCoupon = Coupons::where('code', $orderTags['couponCode'])->first();
                    if ($usedCoupon) {
                        if (!empty($usedCoupon->one_time_use) && $usedCoupon->one_time_use != '0') {
                            $usedCoupon->status = '0';
                            $usedCoupon->save();
                        }
                    } else {
                        Log::info("Coupon Code not found: Admin\HomeController: Line: 1057" . $orderTags['couponCode']);
                    }
                    
                }
                
                $planExpiry = today()->addYear(1)->subDay();

                $allowedCases = ['new_subscription', 'renew_subscription', 'upgrade'];
                // if user purchases new subscription or user renew/upgrade a subscription
                // then only update in the users table of that user record.
                if (in_array($orderTags['transaction_goal'], $allowedCases)) {
                    $user->fill([
                        'plan_id' => $orderTags['plan_id'],
                        'plan_type' => $orderTags['plan_type'],
                        'plan_expire_on' => $planExpiry,
                        'payment_id' => $paymentInDb->id,
                        'total_user_limit' => $orderTags['user_limit'],
                        'subscribed_on' => Carbon::now()->format('Y-m-d'),
						'total_free_user' => $orderTags['free_users'],
                        'total_paid_user' => $orderTags['paid_users'],
                    ])->save();
                    
                } else {
                    // add more users template
                    $extraUsers = $user->total_extra_users_added ?? 0;
                    $freeUsersAdded = $user->total_free_user ?? 0;
                    $totalPaidUsers = $user->total_paid_user ?? 0;
                    $user->fill([
                        'total_free_user' => $freeUsersAdded + $orderTags['user_limit'],
                        'total_paid_user' => $totalPaidUsers - $orderTags['user_limit'],
                    ])->save();
                    $paymentInDb->update(['extra_users_added' => $orderTags['user_limit']]);
                }
                // send invoice over user email
                $user->load('Plan');
                // Generate the invoice number before creating the invoice record
                $companyInitials = 'BR'; // Bromi initials
                $invoiceCount = Invoice::count() + 1;
                if ($invoiceCount < 100) {
                    # if number is less than 100 then pad it left side with '00'
                    $futureInvoiceNumber = $companyInitials . '-' . $user->id . '-' . str_pad($invoiceCount, 3, '0', STR_PAD_LEFT);
                } else {
                    $futureInvoiceNumber = $companyInitials . '-' . $user->id . '-' . $invoiceCount;
                }

                if (in_array($orderTags['transaction_goal'], $allowedCases)) {
                    # code...
                    $eTemplate = view('emails.invoiceTemplate', [
                        'user' => $user,
                        'sequence' => $futureInvoiceNumber,
                        // 'description' => $description,
                        'discount' =>  $orderTags['discount'],
                        'gst_type' => $orderTags['gst_type'],
                        'gst' => $orderTags['gst_amt'],
                    ])->render();
                } else {
                    // add more users template
                    // $eTemplate = view('emails.extraUsersTemplate', [
                    $eTemplate = view('emails.invoiceTemplate', [
                        'user' => $user,
                        'sequence' => $futureInvoiceNumber,
                        // 'description' => $description,
                        'extraUserAdded' => $orderTags['user_limit'],
                        'extraUserPrice' => $paymentInDb->order_amount,
                        'gst_type' => $orderTags['gst_type'],
                        'gst' => $orderTags['gst_amt'],
                    ])->render();
                    // dd('add more users.');
                }

                // create invoice record
                Invoice::create([
                    'user_id' => $user->id,
                    'payment_id' => $paymentInDb->id,
                    'invoice_number' => $futureInvoiceNumber,
                    'invoice_template' => $eTemplate
                ]);
                if (!empty(config('mail.mailers.smtp.password'))) {
                    # code...
                    Mail::to('admin@test.test')->send(new InvoiceEmail($eTemplate));
                }
                Session::put('plan_id', $orderTags['plan_id']);
                return redirect('/admin');
            } else {
                // dd('paymetsudd');
                Session::put('message', 'Payment failed.');
                return redirect()->route('admin.plans');
            }
        } catch (\Throwable $th) {
            // dd($th);
            Session::put('message', $th->getMessage());
            return redirect()->route('admin.plans');
        }
    }

	public function upgrade_plan(Request $request)
	{
		Subplans::get();
		
		$plan_detail = Subplans::find(intval($request->plan_id));

		$user = User::find(Auth::user()->id);
		$user_limit = intval($user->total_user_limit) + intval($plan_detail->user_limit);

		$user->fill([
			'plan_id' => $request->plan_id,
			'total_user_limit' => $user_limit,
			'subscribed_on' => Carbon::now()->format('Y-m-d'),
		])->save();

		Session::put('plan_id', $request->plan_id);
		
		return redirect()->back();
	}

	public function upgrade_user_limit(Request $request)
	{
		$user = User::find(Auth::user()->id);
		$user_limit = intval($user->total_user_limit) + intval($request->user_limit); 
		
		$user->fill([
			'total_user_limit' => $user_limit
		])->save();

		return response()->json('success');
	}
    
	public function ProfileDetails(){
		$login_user = Auth::user();

		$plans = Subplans::get();

		if($login_user->parent_id) {
			$user = User::with('Branch','State','city')->where('id',$login_user->id)->first();
			$user->city_name = @$user->city->name;
		} else {
			$user = User::with('Branch','State','superCity')->where('id',$login_user->id)->first();
			$user->city_name = $user->superCity->name;
		}

		$user_count =  User::where('parent_id',Auth::User()->id)->orWhere('id',Auth::User()->id)->get()->count();
		$cities = City::orderBy('name')->get()->toArray();
		$states = State::orderBy('name')->get()->toArray();

		$assign_property_id = ShareProperty::where('partner_id', Auth::user()->id)->get()->pluck('property_id');
		$total_property = Properties::select('id','user_id')
			->where('user_id', Auth::user()->id)
			->orWhere(function ($query) use ($assign_property_id) {
				$query->whereIn('id', $assign_property_id);
			})
			->count();

		$assign_leads_ids = AssignHistory::where('assign_id',Auth::user()->id)->get()->pluck('enquiry_id');
		$total_enquiry = Enquiries::select('id')
			->where('user_id', Auth::user()->id)
			->orWhere(function ($query) use ($assign_leads_ids) {
				$query->whereIn('id', $assign_leads_ids);
			})
			->count();

		$total_project = Projects::select('id')->where('user_id', Auth::user()->id)->count();

		$transactions = DB::table('payments')
			->join('subplans','subplans.id','payments.plan_id')
			->select([
				'payments.*',
				'subplans.name AS plan_name',
			])->where('payments.user_id',Auth::user()->id)->orderBy('id', 'DESC')->get();
// dd($transactions);
		$tickets = DB::table('tickets')
			->join('categories','categories.id','tickets.category_id')
			->select([
				'tickets.*',
				'categories.name AS category_name',
			])->where('tickets.user_id',Auth::user()->id)
			->where('tickets.status', 'Open')
			->orderBy('tickets.created_at', 'asc')
			->take(10)
			->get();

		return view('admin.users.profile_details',compact('user','tickets','transactions','plans','user_count','cities','states','total_property','total_enquiry','total_project'));
	}

	public function Settings(Request $request){

		if (Auth::check()) {
            $status = Auth::user()->status;
			if($status == 0) {
				Auth::logout();
				Session::flush();
				Session::flash('inactive_user', 'Oops .. Your account is inactive.');
				return redirect('admin/login');
			}
        }
		
		$city =  City::get()->where('user_id',Auth::user()->id)->count();
		$state =  State::get()->where('user_id',Auth::user()->id)->count();
		$area =  Areas::get()->where('user_id',Auth::user()->id)->count();
		$total_district = District::get()->where('user_id',Auth::user()->id)->count();
		$total_taluka = Taluka::get()->where('user_id',Auth::user()->id)->count();
		$total_village = Village::get()->where('user_id',Auth::user()->id)->count();

		$builder =  Builders::get()->where('user_id', Auth::user()->id)->count();
		$branch =  Branches::get()->where('user_id', Auth::user()->id)->count();
		$user =  User::where('parent_id',Auth::User()->id)->orWhere('id',Auth::User()->id)->get()->count();
		$role = Role::where('user_id', Session::get('parent_id'))->get()->count();
		$enquiry = DropdownSettings::where('dropdown_for', 'LIKE', "%enquiry_%")->get()->count();
		$building = DropdownSettings::where('dropdown_for', 'LIKE', "%building_%")->get()->count();
		$property = DropdownSettings::where('dropdown_for', 'LIKE', "%property_%")->get()->count();

		return view('admin.settings.settings_index',compact('city','state','builder','branch','area','user','role','enquiry','building','property','total_district','total_taluka','total_village'));
	}
    
	public function chnagePassword(Request $request)
	{
		$params = $request->all();
		$user_id =  Auth::user()->id;
		$user = User::select('id','email','password')->where('id',$user_id)->first();
		if(!$user)
		{
			return response(['false' => true,'message' => 'Something went wrong'], 200);

		}
		if(!Hash::check($params['oldPwd'],$user->password)) {
			return response(['false' => true,'message' => 'old password is wrong'], 200);
		}
	    $user->update(['password' => Hash::make($params['newPwd'])]);
		return response(['success' => true,'message' => 'Password change successfully!!'], 200);
	}

	public function storeFile(UploadedFile $file)
    {
        $path = "company_".time().(string) random_int(0,5).'.'.$file->getClientOriginalExtension();
        $file->storeAs("public/file_image/",$path);
        return $path;
    }
    
	public function chnageProfile(Request $request){
		$params = $request->all();
		$user_id =  Auth::user()->id;

		$user = User::select('id','email','password')->where('id',$user_id)->first();
		if(!$user)
		{
			return response(['false' => true,'message' => 'Something went wrong'], 200);

		}
		$profile_details = array(
			'first_name'    =>  $params['firstname'],
			'last_name'     =>  $params['lastname'],   
			'mobile_number' =>  $params['mobile_number'],   
			'company_name'  =>  $params['company_name'],
			'address'  =>  $params['address'],
			'rera'  =>  $params['rera'],
			'gst'  =>  $params['gst'],
		);

		if($request->profile_image) {
			$profile_details['company_logo'] = $this->storeFile($request->profile_image); 
		}
		
	    $user->update($profile_details);
		return response(['success' => true,'message' => 'Profile change successfully!!'], 200);
	}

	/* Visiting
	 Card 
	 Function
	*/
	public function VisitingCard(){
		$user_id=Auth::user()->id;//Get Admin Data
		$company=CompanyDetails::where('user_id',$user_id)->first();
		return view('admin.visitingcard.card',compact('company'));
	}
	public function savecompany(Request $request)
	{
		$user_id=Auth::user()->id;
		$company=CompanyDetails::find($request->id);
		$company->user_id= $user_id;
		$company->company_name=$request->company_name;
		$company->company_email=$request->company_email;
		$company->company_site=$request->company_site;
		$company->company_contact=$request->company_contact;
		$company->position=$request->company_position;
		$company->company_logo=$request->company_logo;
		$company->company_gst=$request->company_gst;
		$company->save();
		return response()->json(['status'=>'success']);
		// return redirect('/VisitingCard');
	}

    public function showVerifyForm(Request $request) {
        $user = Auth::user();

        // Check if email is not verified
        if (!$user->email_verified) {
            // Generate random 4-digit OTP
            $otp = mt_rand(10000, 99999);

            // Send OTP via email
            Mail::to($user->email)->send(new SendOtpMail($otp));

            // Store OTP in user session
            $request->session()->put('otp', $otp);

            // Redirect user to OTP verification page
            return view('admin.auth.verifyOtp');
        }
    }

    public function verifyEmailOtp(Request $request)
    {
        $otp = $request->input('otp');
        $user = Auth::user();

        if ($otp == $request->session()->get('otp')) {
            // OTP matched, update email_verified column in the database
            $user->email_verified = true;
            $user->update();

            // Clear OTP from session
            $request->session()->forget('otp');

            return redirect()->route('admin')->with('success', 'Email verified successfully.');
        } else {
            return back()->with('error', 'Invalid OTP. Please try again.');
        }
    }
}
