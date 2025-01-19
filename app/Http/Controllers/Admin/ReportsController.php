<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiries;
use App\Models\EnquiryProgress;
use App\Models\LoggedIn;
use App\Models\Properties;
use App\Models\PropertyReport;
use App\Models\PropertyViewer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class ReportsController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function sourceViseEnquiryPage(Request $request)
	{
		return view('admin.reports.source_enquiry');
	}

	public function sourceViseEnquiry()
	{
		$second_chart_query = Enquiries::select([
			'dropdown_settings.name AS enquiry_source_case',
			'enquiries.enquiry_source',
			'enquiries.id',
		])
		->join('dropdown_settings', 'enquiries.enquiry_source','dropdown_settings.id')
		->where('enquiries.enquiry_source','!=',null)
		->where('enquiries.user_id', Auth::user()->id)
		->get();

		$second_chart_group = $second_chart_query->groupBy('enquiry_source_case');

		$second_chart = [];

		foreach ($second_chart_group as $key_name => $enqs) {
			array_push($second_chart ,[
				'enquiry_source_case' => $key_name,
				'total_enquiry' => count($enqs),
			]);
		}

        return DataTables::of($second_chart)
            ->make(true);
	}
	
	public function assignedViseEnquiryPage(Request $request)
	{
		return view('admin.reports.assigned_enquiry');
	}

	public function assignedViseEnquiry()
	{
		$inquiryCounts = Enquiries::select(
			'enquiries.employee_id',
			DB::raw("CONCAT(users.first_name,  users.last_name) as person_name"),
		)
		->join('users', 'enquiries.employee_id','users.id')
		->where('employee_id', '!=', null)
		->get();

		$new = $inquiryCounts->groupBy('person_name');

		$new_array = [];

		foreach($new->toArray() as $key => $data) {
			array_push($new_array,[
				'user_name' => $key,
				'total_inquiries' => count($data), 
			]);	
		}

        return DataTables::of($new_array)
            ->make(true);
	}
	
	public function activeSourceEnquiryPage(Request $request)
	{
		return view('admin.reports.active_source_enquiry');
	}

	public function activeSourceEnquiry()
	{
		$total_active_leads = Enquiries::select([
			'enquiries.enquiry_source',
			'dropdown_settings.name AS enquiry_source_case',
		])->join('dropdown_settings', 'enquiries.enquiry_source','dropdown_settings.id')
		->withCount(['Progress' => function($query) {
			$query->where('progress','Discussion');
		}])->where('enquiries.enquiry_source', '!=', null)->get();

		$array = [];

		foreach($total_active_leads->groupBy('enquiry_source_case')->toArray() as $element) {
			$total = 0;
			
			foreach($element as $i) {
				$total += $i['progress_count'];
			}

			array_push($array,[
				'source_type' => $element[0]['enquiry_source_case'],
				'total_enquiry' => $total,
			]);
		};
		
        return DataTables::of($array)
            ->make(true);
	}
	
	public function lostSourceEnquiryPage(Request $request)
	{
		return view('admin.reports.lost_source_enquiry');
	}

	public function lostSourceEnquiry()
	{
		$total_active_leads = Enquiries::select([
			'enquiries.enquiry_source',
			'dropdown_settings.name AS enquiry_source_case',
		])->join('dropdown_settings', 'enquiries.enquiry_source','dropdown_settings.id')
		->withCount(['Progress' => function($query) {
			$query->where('progress','Lost');
		} ])->where('enquiries.enquiry_source', '!=', null)->get();

		$array = [];

		foreach($total_active_leads->groupBy('enquiry_source_case')->toArray() as $element) {
			$total = 0;
			
			foreach($element as $i) {
				$total += $i['progress_count'];
			}

			array_push($array,[
				'source_type' => $element[0]['enquiry_source_case'],
				'total_enquiry' => $total,
			]);
		};
		
        return DataTables::of($array)
            ->make(true);
	}

	public function stageViseEnquiryPage(Request $request)
	{
		return view('admin.reports.stage_enquiry');
	}

	public function stageViseEnquiry()
	{
		$groupedData = EnquiryProgress::select([
			'progress',	
			DB::raw('count(*) as total_enquiry'),
		])
		->where('progress','!=',null)
		->groupBy('progress')
		->get();

        return DataTables::of($groupedData)
            ->make(true);
	}
	
	public function stageAndPersonViseEnquiryPage(Request $request)
	{
		return view('admin.reports.stage_and_person_enquiry');
	}

	public function stageAndPersonViseEnquiry()
	{
		$userEnquiryStatusCounts = EnquiryProgress::select('user_id', 'progress', DB::raw('count(*) as enquiry_count'))
			->groupBy('user_id', 'progress')
			->orderBy('user_id')
			->get();

        return DataTables::of($userEnquiryStatusCounts)
            ->make(true);
	}
	
	public function personViseEnquiryPage(Request $request)
	{
		return view('admin.reports.person_enquiry');
	}

	public function personViseEnquiry()
	{
		$groupedData = Enquiries::select([
				'enquiries.employee_id',
				DB::raw("COUNT(*) as total_inquiries"),
				DB::raw("CONCAT(users.first_name,  users.last_name) as person_name"),
			])
			->leftjoin('users', 'enquiries.employee_id','users.id')
			->groupBy('employee_id')
			->where('employee_id', '!=', null)
			->where('users.parent_id', Session::get('parent_id'))
			->get();

        return DataTables::of($groupedData->toArray())
            ->make(true);
	}
	
	public function personDateViseEnquiryPage(Request $request)
	{
		return view('admin.reports.person_date_enquiry');
	}

	public function personDateViseEnquiry()
	{
	    
	  $inquiryCounts = Enquiries::select(
				'enquiries.employee_id',
				DB::raw("CONCAT(users.first_name,  users.last_name) as person_name"),
				DB::raw("DATE_FORMAT(enquiries.created_at, '%d/%m/%Y') as date_format"),
			)
			->join('users', 'enquiries.employee_id','users.id')
			->where('employee_id', '!=', null)
			->get();

		$new = $inquiryCounts->groupBy('date_format');

		$new_array = [];

		foreach($new->toArray() as $key => $data) {
			array_push($new_array,[
				'date_format' => $key,
				'person_name' => $data[0]['person_name'],
				'total' => count($data), 
			]);	
		}

        return DataTables::of($new_array)
            ->make(true);
	}

	public function EmployeeByEnquiry(Request $request)
	{
		if ($request->ajax()) {
			$employees = User::where('parent_id', Session::get('parent_id'))->get();
			return DataTables::of($employees)
				->addColumn('employee', function ($row) {
					return $row->first_name . ' ' . $row->last_name;
				})
				->addColumn('new_enquiry', function ($row) {
					return Enquiries::doesntHave('Progress')->where('employee_id', $row->id)->count();
				})
				->addColumn('confirmed_enquiry', function ($row) {
					return Enquiries::where('employee_id', $row->id)->whereHas('activeProgress', function ($query) {
						$query->where('progress', '=', 'Lead Confirmed');
					})->count();
				})
				->addColumn('site_visit_scheduled', function ($row) {
					return Enquiries::where('employee_id', $row->id)->whereHas('activeProgress', function ($query) {
						$query->where('progress', '=', 'Site Visit Scheduled');
					})->count();
				})
				->addColumn('site_visit_completed', function ($row) {
					return Enquiries::where('employee_id', $row->id)->whereHas('activeProgress', function ($query) {
						$query->where('progress', '=', 'Site Visit Completed');
					})->count();
				})
				->addColumn('discussion', function ($row) {
					return Enquiries::where('employee_id', $row->id)->whereHas('activeProgress', function ($query) {
						$query->where('progress', '=', 'Discussion');
					})->count();
				})
				->addColumn('booked', function ($row) {
					return Enquiries::where('employee_id', $row->id)->whereHas('activeProgress', function ($query) {
						$query->where('progress', '=', 'Booked');
					})->count();
				})
				->addColumn('lost', function ($row) {
					return Enquiries::where('employee_id', $row->id)->whereHas('activeProgress', function ($query) {
						$query->where('progress', '=', 'Lost');
					})->count();
				})
				->make(true);

			// $employees = User::where('parent_id', Session::get('parent_id'))->get();
		}
		return view('admin.reports.employee_enquiry');
	}

	public function ReportPage(){
		return view('admin.reports.report_page');
	}

	public function getWeeks($datee)
	{

		$date = $datee->copy()->firstOfMonth()->startOfDay();
		$eom = $datee->copy()->endOfMonth()->startOfDay();
		$dates = [];

		for ($i = 0; $date->lte($eom); $i++) {
			$dates[$i]['start'] = clone $date->startOfWeek(Carbon::SUNDAY);
			$dates[$i]['end'] = clone $date->endOfWeek(Carbon::SATURDAY);
			$date->addDays(1);
		}

		$dates2 = [];
		foreach ($dates as $key => $value) {
			if ($key == 0) {
				$dates2[$key]['start'] = $datee->firstOfMonth()->format('Y-m-d');
				$dates2[$key]['end'] = $value['end']->format('Y-m-d');
			}elseif($key == (count($dates)-1)){
				$dates2[$key]['start'] = $value['start']->format('Y-m-d');
				$dates2[$key]['end'] = $datee->endOfMonth()->format('Y-m-d');
			}
			else{
				$dates2[$key]['start'] = $value['start']->format('Y-m-d');
				$dates2[$key]['end'] = $value['end']->format('Y-m-d');
			}
		}
		// dd($dates2);
		return $dates2;
	}



	public function EnquiryPeriod(Request $request)
	{
		if ($request->ajax()) {

			$year = Carbon::now()->format('Y');
			$month = Carbon::now()->format('m');
			if (!empty($request->month_id)) {
				$month = $request->month_id;
			}
			if (!empty($request->year_id)) {
				$year = $request->year_id;
			}
			$vv = $this->getWeeks(Carbon::parse('1-' . $month . '-' . $year));

			return DataTables::of($vv)
				->addColumn('period', function ($row) {
					return Carbon::parse($row['start'])->format('d-m-Y') . ' - ' . Carbon::parse($row['end'])->format('d-m-Y');
				})
				->addColumn('new_enquiry', function ($row) {
					return Enquiries::doesntHave('Progress')->whereDate('created_at', '<=', $row['end'])->whereDate('created_at', '>=', $row['start'])->count();
				})

				->addColumn('confirmed_enquiry', function ($row) {
					return Enquiries::whereHas('activeProgress', function ($query) use ($row) {
						$query->where('progress', '=', 'Lead Confirmed')->whereDate('nfd', '<=', $row['end'])->whereDate('nfd', '>=', $row['start']);
					})->count();
				})
				->addColumn('site_visit_scheduled', function ($row) {
					return Enquiries::whereHas('activeProgress', function ($query) use ($row) {
						$query->where('progress', '=', 'Site Visit Scheduled')->whereDate('nfd', '<=', $row['end'])->whereDate('nfd', '>=', $row['start']);
					})->count();
				})
				->addColumn('site_visit_completed', function ($row) {
					return Enquiries::whereHas('activeProgress', function ($query) use ($row) {
						$query->where('progress', '=', 'Site Visit Completed')->whereDate('nfd', '<=', $row['end'])->whereDate('nfd', '>=', $row['start']);
					})->count();
				})
				->addColumn('discussion', function ($row) {
					return Enquiries::whereHas('activeProgress', function ($query) use ($row) {
						$query->where('progress', '=', 'Discussion')->whereDate('created_at', '<=', $row['end'])->whereDate('created_at', '>=', $row['start']);
					})->count();
				})
				->addColumn('booked', function ($row) {
					return Enquiries::whereHas('activeProgress', function ($query) use ($row) {
						$query->where('progress', '=', 'Booked')->whereDate('created_at', '<=', $row['end'])->whereDate('created_at', '>=', $row['start']);
					})->count();
				})
				->addColumn('lost', function ($row) {
					return Enquiries::whereHas('activeProgress', function ($query) use ($row) {
						$query->where('progress', '=', 'Lost')->whereDate('created_at', '<=', $row['end'])->whereDate('created_at', '>=', $row['start']);
					})->count();
				})
				->make(true);

			// $employees = User::where('parent_id', Session::get('parent_id'))->get();
		}
		return view('admin.reports.enquiry_period');
	}

	public function EmployeeLogged(Request $request)
	{
		if ($request->ajax()) {

			$data = LoggedIn::with('User')->OrderBy('id', 'DESC')->get();
			return DataTables::of($data)
				->editColumn('employee_id', function ($row) {
					if (isset($row->User->first_name)) {
						return $row->User->first_name . ' ' . $row->User->last_name;
					}
					return '';
				})
				->addColumn('email', function ($row) {
					if (isset($row->User->email)) {
						return $row->User->email;
					}
					return '';
				})
				->editColumn('created_at', function ($row) {
					return Carbon::parse($row->created_at)->format('d-m-Y H:i:s');
				})
				->editColumn('succeed', function ($row) {
					if ($row->succeed) {
						return 'Yes';
					}
					return 'No';
				})

				->make(true);
		}
		$employees = User::where('parent_id', Session::get('parent_id'))->get();
		return view('admin.reports.logged');
	}

	public function EmployeeAuditLog(Request $request)
	{
		if ($request->ajax()) {

			$data = PropertyReport::whereHas('ActionBy')->with('ActionBy')->select(DB::raw('action_by'))->groupBy('action_by')->when($request->employee_id, function ($query) use ($request) {
				return $query->where('action_by', $request->employee_id);
			})->get();
			return DataTables::of($data)
				->editColumn('action_by', function ($row) {
					if (isset($row->ActionBy->first_name)) {
						return $row->ActionBy->first_name . ' ' . $row->ActionBy->last_name;
					}
					return '';
				})
				->addColumn('added', function ($row) use ($request) {
					return PropertyReport::where('action', 'created')->where('action_by', $row->action_by)->when($request->filter_date_from, function ($query) use ($request) {
						return $query->whereDate('created_at', '>=', $request->filter_date_from);
					})->when($request->filter_date_to, function ($query) use ($request) {
						return $query->whereDate('created_at', '<=', $request->filter_date_to);
					})->when($request->filter_prime, function ($query) use ($request) {
						$query->whereHas('Property.Building', function ($query) {
							$query->where('is_prime', 1);
						});
					})->when($request->filter_hot, function ($query) use ($request) {
						$query->whereHas('Property', function ($query) {
							$query->where('hot_property', 1);
						});
					})->count();
				})
				->addColumn('updated', function ($row) use ($request) {
					return PropertyReport::where('action', 'updated')->where('action_by', $row->action_by)->when($request->filter_date_from, function ($query) use ($request) {
						return $query->whereDate('created_at', '>=', $request->filter_date_from);
					})->when($request->filter_date_to, function ($query) use ($request) {
						return $query->whereDate('created_at', '<=', $request->filter_date_to);
					})->when($request->filter_prime, function ($query) use ($request) {
						$query->whereHas('Property.Building', function ($query) {
							$query->where('is_prime', 1);
						});
					})->when($request->filter_hot, function ($query) use ($request) {
						$query->whereHas('Property', function ($query) {
							$query->where('hot_property', 1);
						});
					})->count();
				})
				->addColumn('deleted', function ($row) {
					return PropertyReport::where('action', 'deleted')->where('action_by', $row->action_by)->count();
				})
				->make(true);
		}
		$employees = User::where('parent_id', Session::get('parent_id'))->get();
		return view('admin.reports.audit_log', compact('employees'));
	}

	public function EnquiryRemarks(Request $request)
	{
		if ($request->ajax()) {

			$data = Enquiries::with('activeProgress', 'Employee')->whereHas('activeProgress', function ($query) {
				$query->whereNotNull('remarks');
			})->get();
			return DataTables::of($data)
				->editColumn('employee_id', function ($row) {
					if (isset($row->Employee->first_name)) {
						return $row->Employee->first_name . ' ' . $row->Employee->last_name;
					}
					return '';
				})
				->editColumn('created_at', function ($row) {
					return Carbon::parse($row->activeProgress->created_at)->format('d-m-Y');
				})
				->addColumn('the_progess', function ($row) {
					return $row->activeProgress->progress;
				})
				->addColumn('the_remarks', function ($row) {
					return $row->activeProgress->remarks;
				})
				->make(true);
		}
		return view('admin.reports.enquiry_remaks');
	}

	public function PropertyViewer(Request $request)
	{
		if ($request->ajax()) {

			$data = PropertyViewer::with('Property.Projects.Area', 'Employee')->orderBy('id','Desc')->get();
			return DataTables::of($data)
				->editColumn('visited_by', function ($row) {
					if (isset($row->Employee->first_name)) {
						return $row->Employee->first_name . ' ' . $row->Employee->last_name;
					}
					return '';
				})
				->editColumn('created_at', function ($row) {
					return Carbon::parse($row->created_at)->format('d-m-Y H:i:s');
				})
				->addColumn('area', function ($row) {
					if (isset($row->Property->Projects->Area->name)) {
						return $row->Property->Projects->Area->name;
					}
					return '';
				})
				->addColumn('building', function ($row) {
					if (isset($row->Property->Projects->project_name)) {
						return $row->Property->Projects->project_name;
					}
					return '';
				})
				->addColumn('wing', function ($row) {
					if (isset($row->Property->property_wing)) {
						return $row->Property->property_wing . ' , ' . $row->Property->property_unit_no;
					}
					return '';
				})
				->addColumn('propertyfor', function ($row) {
					if (isset($row->Property->property_for)) {
						return $row->Property->property_for;
					}
					return '';
				})
				->addColumn('property_status', function ($row) {
					if (isset($row->Property->property_status)) {
						return $row->Property->property_status;
					}
					return '';
				})
				->make(true);
		}
		return view('admin.reports.property_viewer');
	}

	public function PropertySold(Request $request)
	{
		if ($request->ajax()) {

			$data = Enquiries::with('activeProgress', 'Employee', 'Projects.Area')->whereHas('activeProgress', function ($query) {
				$query->where('progress', '=', 'Booked');
			})->get();

			return DataTables::of($data)
				->editColumn('employee_id', function ($row) {
					if (isset($row->Employee->first_name)) {
						return $row->Employee->first_name . ' ' . $row->Employee->last_name;
					}
					return '';
				})
				->editColumn('building_id', function ($row) {
					if (isset($row->Projects->project_name)) {
						return $row->Projects->project_name;
					}
					return '';
				})
				->addColumn('areas', function ($row) {
					if (isset($row->Projects->Area->name)) {
						return $row->Projects->Area->name;
					}
					return '';
				})
				->editColumn('enquiry_for', function ($row) {
					if ($row->enquiry_for == 'Rent') {
						return 'Rent Out';
					} elseif ($row->enquiry_for == 'Buy') {
						return 'Sold Out';
					}
					return '';
				})
				->editColumn('created_at', function ($row) {
					return Carbon::parse($row->created_at)->format('d-m-Y');
				})
				->addColumn('closure_date', function ($row) {
					return Carbon::parse($row->activeProgress->created_at)->format('d-m-Y');
				})
				->addColumn('closure_days', function ($row) {
					return Carbon::parse($row->created_at)->diff($row->activeProgress->created_at)->days;
				})
				->make(true);
		}
		return view('admin.reports.sold');
	}

	public function employeePerformance(Request $request){
		if ($request->ajax()) {
			$data = User::select('id','first_name','last_name')->get();
			return DataTables::of($data)
				->editColumn('full_name', function ($row) {
					return $row->first_name . ' ' . $row->last_name;
				})
				->editColumn('total_property', function ($row) {
					$properties = Properties::where('added_by',$row->id)->count('id');
					return $properties;
				})
				->editColumn('total_enquiry', function ($row) {
					$enquiries = Enquiries::where('added_by',$row->id)->count('id');
					return $enquiries;
				})
				->make(true);
		}
		return view('admin.reports.employee_performance');
	}
}
