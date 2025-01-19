<?php

namespace App\Http\Controllers\Superadmin;

use App\Constants\Constants;
use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use App\Models\Areas;
use App\Models\Branches;
use App\Models\BromiEnquiry;
use App\Models\DropdownSettings;
use App\Models\LeadAssignHistory;
use App\Models\LeadProgress;
use App\Models\Projects;
use App\Models\State;
use App\Models\Subplans;
use App\Models\SuperAreas;
use App\Models\SuperCity;
use App\Models\User;
use App\Models\UserNotifications;
use App\Traits\HelperFn;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class BromiEnquiryController extends Controller
{

    use HelperFn;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();
            $data = BromiEnquiry::where('user_id', $user->id)->get();
            return DataTables::of($data)
            ->editColumn('created_at', function ($row) {
                if (!empty($row->created_at)) {
                    return date('d M, Y', strtotime($row->created_at));
                }
            })
            ->editColumn('status', function ($row) {
                if (!empty($row->status)) {
                    if ($row->status == 'pending') {
                        return '<span class="bg-warning rounded-pill px-2 py-1">' . $row->status . '</span>';
                    } else {
                        return '<span class="bg-success rounded-pill px-2 py-1">' . $row->status . '</span>';
                    }
                }
            })

            ->editColumn('Actions', function ($row) {
                $buttons = '';
                $buttons =  $buttons . '<i data-id="' . $row->id . '" onclick=getBromiEnq(this) class="fs-22 py-2 mx-2 fa-pencil pointer fa" type="button"></i>';
                return $buttons;
            })
            ->rawColumns(['status', 'Actions'])
            ->make(true);
        }
        return view('superadmin.requests.index');
    }

    public function superadminList(Request $request)
    {
        if ($request->ajax()) {

            $data = [];

            if(Auth::user()->id == 6 ) {
                $data = BromiEnquiry::with('User', 'LeadProgress', 'activeProgress', 'state', 'city', 'planInterested')->orderBy('id', 'desc')->get();
            } else {
                $lead_id = LeadAssignHistory::where('member_id', Auth::user()->id)->pluck('lead_id');
                
                $data = BromiEnquiry::with('User', 'LeadProgress', 'activeProgress', 'state', 'city', 'planInterested')
                    ->whereIn('id', $lead_id)
                    ->orWhere('user_id',Auth::user()->id)
                    ->orderBy('id', 'desc')
                    ->get();
            }

            return DataTables::of($data)
                ->editColumn('user_name', function ($row) /* use ($dropdownsarr) */ {

                    $lead_type = '';
                    $pro = Statuses::NEW_LEAD;
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


                    $first = '<td align="center" style="vertical-align:top"><b><a href="javascript::void(0);"> ' . $row->user_name . '</a></b>' . $lead_type . ' <br><a href="tel:' . $row->mobile . '">' . $row->mobile . '</a>';


                    $s_1 = 'border-bottom:10px solid #1d2848 !important';
                    $title = $pro;

                    if ($pro == Statuses::Lead_CONFIRMED) {
                        $s_1 = 'border-bottom:10px solid #ff7e00 !important';
                    } elseif ($pro == Statuses::DEMO_SCHEDULED) {
                        $s_1 = 'border-bottom:10px solid #a200ff !important';
                    } elseif ($pro == Statuses::DEMO_COMPLETED) {
                        $s_1 = 'border-bottom:10px solid #fff600 !important';                   
                    } elseif ($pro == Statuses::DUE_FOLLOWUP) {
                        $s_1 = 'border-bottom:10px solid #aa0600 !important';                   
                    } elseif ($pro == Statuses::DISCUSSION) {
                        $s_1 = 'border-bottom:10px solid #00f0ff !important';
                    } elseif ($pro == Statuses::BOOKED) {
                        $s_1 = 'border-bottom:10px solid #0d8c07 !important';
                    } elseif ($pro == Statuses::LOST) {
                        $s_1 = 'border-bottom:10px solid #ff2a75 !important';
                    } else {
                        $title = Statuses::NEW_LEAD;
                    }


                    $second = '<div><div class="row mx-0 align-items-center"><div data-bs-content="' . $title . '" data-bs-original-title="" data-bs-trigger="hover" data-container="body" data-bs-toggle="popover" data-bs-placement="bottom" style="' . $s_1 . '" class="py-0 px-0 d-block col-8"></div> <div class="col-2"><i class="fa fa-info-circle cursor-pointer color-code-popover" data-container="body"  data-bs-content="&nbsp;" data-bs-trigger="hover focus"></i></div></div></div>';
                    $end = '</td>';

                    return $first . $second . $end;
                })
                ->editColumn('followup_date', function ($row) {
                    $remark_data = $row->enquiry;
                    if (isset($row->activeProgress)) {
                        $pro = $row->activeProgress;
                        if (!empty($pro->remarks)) {
                            $remark_data = $pro->remarks;
                        }
                        return Carbon::parse($pro->nfd)->format('d-m-Y \| H:i') . '<br>' . $remark_data;
                    }
                    return Carbon::parse($row->followup_date)->format('d-m-Y \| H:i') . '<br>' . $remark_data;
                })
                ->editColumn('select_checkbox', function ($row) {
                    $abc = '<div class="form-check checkbox checkbox-primary mb-0">
					<input class="form-check-input table_checkbox" data-id="' . $row->id . '" name="select_row[]" id="checkbox-primary-' . $row->id . '" type="checkbox">
					<label class="form-check-label" for="checkbox-primary-' . $row->id . '"></label>
				  	</div>';
                    return $abc;
                })
                ->editColumn('state', function ($row) {
                    return $row->state->name ?? '-';
                })
                ->editColumn('city', function ($row) {
                    return $row->city->name ?? '-'; 
                })
                ->editColumn('plan', function ($row) {
                    return $row->planInterested->name ?? '-'; 
                })
                ->editColumn('added_by', function ($row) {
                    return $row->User->first_name ? $row->User->first_name .' '. @$row->User->last_name : '-';
                })
                ->editColumn('Actions', function ($row) {
                    $buttons = '';
                    
                    if(Auth::user()->id == $row->user_id ) {
                        $buttons .= '<span data-id="' . $row->id . '" onclick=getBromiEnq(this) style="cursor:pointer"><i class="fa fa-pencil fs-5"></i></span>';
                    }

                    $buttons .= '&nbsp;&nbsp;<span title="Delete" data-id="' . $row->id . '" onclick=deleteEnquiry(this) class="pointer text-danger" type="button"><i class="fs-5 fa fa-trash"></i></span>';
                    $buttons .= '<span class="ms-3" data-id="' . $row->id . '" onclick=showProgress(this) style="cursor:pointer"><i class="fa fa-bars fs-5 text-warning"></i></span>';
                    
                    if(Auth::user()->id == 6 ) {
                        $buttons .= '<span class="ms-3" data-id="' . $row->id . '" onclick=showAssignForm(this) style="cursor:pointer"><i class="fa fa-slideshare fs-5 text-primary"></i></span>';  
                    }
                    
                    return $buttons;
                })
                ->rawColumns(['select_checkbox', 'user_name', 'Actions', 'followup_date', 'state', 'city', 'plan', 'added_by'])
                ->make(true);
        }
        $states = State::with(['cities'])->where('user_id', Auth::user()->id)->get();
        
        return view('superadmin.requests.super-admin-index')->with([
            'plans' => Subplans::all(),
            'states' => $states,
            'members' => User::where('role_id', '3')->where('id','!=',6)->get(),
        ]);
    }

    public function getProgress(Request $request)
    {
        $progress = LeadProgress::with('User', 'Lead.planInterested', 'Lead.city', 'Lead.state')->where('lead_id', $request->id)->orderBy('id', 'DESC')->get()->toArray();
        foreach ($progress as $key => $value) {
            $value['created_at'] = Carbon::parse($value['created_at'])->format('d-m-Y');
            $value['nfd'] = Carbon::parse($value['nfd'])->format('d-m-Y g:i A');
            $progress[$key] = $value;
        }
        return json_encode($progress);
    }

    /**
     * change enquiry status.
     */
    public function saveProgress(Request $request)
    {
        $bromi_enquiry = BromiEnquiry::find($request->id);
        $leadProgress = LeadProgress::where('lead_id', $request->id)->where('status', 1)->first();
        if ($leadProgress) {
            $leadProgress->update(['status' => 0]);
        }

        $dateTime = $request->followup_date . ' ' . $request->time . ':00';

        $nfDate = Carbon::parse($dateTime)->format('Y-m-d H:i:s');
        $user = Auth::user();
        $message = "There an update on a lead for `$bromi_enquiry->user_name`.  The next follow up date is " . Carbon::parse($nfDate)->format('d-m-Y');

        LeadProgress::create([
            'lead_id' => $request->id,
            'user_id' => $user->id,
            'progress' => $request->status,
            'lead_type' => $request->lead_type,
            'nfd' => $nfDate,
            'remarks' => $request->enquiry,
        ]);

        if ($request->status == 'Lead Confirmed') {
            $notifType = Constants::LEAD_CONFIRMED;
        } elseif ($request->status == 'Discussion') {
            $notifType = Constants::LEAD_DISCUSSION;
        } elseif ($request->status == 'Demo Scheduled') {
            $notifType = Constants::LEAD_DEMO_SCHEDULED;
        } elseif ($request->status == 'Demo Completed') {
            $notifType = Constants::LEAD_DEMO_COMPLETED;
        } elseif ($request->status == 'Due Followup') {
            $notifType = Constants::LEAD_DUE_FOLLOWUP;
        } elseif ($request->status == 'Booked') {
            $notifType = Constants::LEAD_BOOKED;
        } elseif ($request->status == 'Lost') {
            $notifType = Constants::LEAD_LOST;
        }

        // On each and every lead-prgress,
        // notify logged in user for next follow up date
        UserNotifications::create([
            "user_id" => (int) $user->id,
            "notification" => $message,
            "notification_type" => $notifType,
            'lead_id' => $bromi_enquiry->id,
            'schedule_date' => $nfDate,
        ]);

        // send if user has onesignal id
        if (!empty($user->onesignal_token)) {
            HelperFn::sendPushNotification($user->onesignal_token, $message);
        }

        $bromi_enquiry->fill([
            'status' => $request->status,
            'followup_date' => $nfDate,
            // 'enquiry' => $request->enquiry,
        ])->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bromi_enquiry = BromiEnquiry::find($request->id) ?? new BromiEnquiry();

        $bromi_enquiry->fill([
            'user_id' => Auth::user()->id,
            'super_admin_id' => Auth::user()->parent_id,
            'user_name' => $request->user_name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'company' => $request->company,
            'email' => $request->email,
            'plan_interested_in' => $request->plan_interested_in,
            'enquiry' => $request->enquiry,
            'state_id' => $request->state,
            'city_id' => $request->city,
            'locality' => $request->locality,
        ])->save();

        // $dateTime = $request->followup_date . ' ' . $request->time . ':00';
        /* LeadProgress::create([
            'lead_id' => $request->id,
            'user_id' => Auth::user()->id,
            'progress' => $request->status,
            'lead_type' => $request->lead_type,
            'nfd' => Carbon::parse($dateTime)->format('Y-m-d H:i:s'),
            'remarks' => $request->enquiry,
        ]); */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BromiEnquiry  $bromiEnquiry
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if (!empty($request->id)) {

            $bromEnq = BromiEnquiry::with('LeadProgress', 'city', 'state', 'planInterested')->where('id', $request->id)->first()->toArray();
            $data = [
                'brom_enq' => $bromEnq,
            ];

            return response()->json($data);
        }
    }

    public function destroyLead(Request $request) {
        if (!empty($request->id)) {
            $data = BromiEnquiry::where('id', $request->id)->delete();
            LeadProgress::where('lead_id', $request->id)->delete();
            return json_encode($data);
        }
        if (!empty($request->allids) && isset(json_decode($request->allids)[0])) {
            $data = BromiEnquiry::whereIn('id', json_decode($request->allids))->delete();
            LeadProgress::whereIn('lead_id', json_decode($request->allids))->delete();
            return json_encode($data);
        }
    }

    public function getSuperArea(Request $request) {
        $superAreas = SuperAreas::where('super_city_id', $request->id)->get();
        return response()->json($superAreas);
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
			$arr = [];
			$events = [];
			$type_array = [];
			if ($request->newe) {
				$ar = [];
				$newenq = BromiEnquiry::when($request->month, function ($query) use ($request) {
					return $query->whereMonth('followup_date', '=', $request->month);
				})->when($request->year, function ($query) use ($request) {
					return $query->whereYear('followup_date', '=', $request->year);
				})
					// ->where('enq_status', 1)
					->get();
				foreach ($newenq as $key => $value) {
					array_push($ar, Carbon::parse($value->followup_date)->format('Y-m-d'));
				}
				$arr['new_enquiry'] = array_count_values($ar);
				$type_array[] = 'new_enquiry';
			}
			// Lead Confirm
			if ($request->leadConf) {
				$ar = [];
				$lead_conf = LeadProgress::whereHas('Lead')->where('status', 1)->where('progress', '=', Statuses::Lead_CONFIRMED)->when($request->month, function ($query) use ($request) {
					return $query->whereMonth('nfd', '=', $request->month);
				})->when($request->year, function ($query) use ($request) {
					return $query->whereYear('nfd', '=', $request->year);
				})->get();

				foreach ($lead_conf as $key => $value) {
					array_push($ar, Carbon::parse($value->nfd)->format('Y-m-d'));
				}
				$arr['leadConf'] = array_count_values($ar);
				$type_array[] = 'leadConf';
			}
			// Demo Scheduled
			if ($request->sitecomp) {
				$ar = [];
				$sitevisit = LeadProgress::whereHas('Lead')->where('status', 1)->where('progress', '=', Statuses::DEMO_SCHEDULED)->whereNotNull('nfd')->when($request->month, function ($query) use ($request) {
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

			// Demo Completed
			if ($request->sitecomp) {
				$ar = [];
				$sitecomp = LeadProgress::whereHas('Lead')->where('status', 1)->where('progress', '=', Statuses::DEMO_COMPLETED)->whereNotNull('nfd')->when($request->month, function ($query) use ($request) {
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
			// Due Followup
			if ($request->dueFollowup) {
				$ar = [];
				$sitecomp = LeadProgress::whereHas('Lead')->where('status', 1)->where('progress', '=', Statuses::DUE_FOLLOWUP)->whereNotNull('nfd')->when($request->month, function ($query) use ($request) {
					return $query->whereMonth('nfd', '=', $request->month);
				})->when($request->year, function ($query) use ($request) {
					return $query->whereYear('nfd', '=', $request->year);
				})->get();

				foreach ($sitecomp as $key => $value) {
					array_push($ar, Carbon::parse($value->nfd)->format('Y-m-d'));
				}
				$arr['due_followup'] = array_count_values($ar);
				$type_array[] = 'due_followup';
				// dd($arr['due_followup'], "arr");
			}
			// discussion
			if ($request->dis) {
				$ar = [];
				$sitevisit = LeadProgress::whereHas('Lead')->where('status', 1)->where('progress', '=', Statuses::DISCUSSION)->whereNotNull('nfd')->when($request->month, function ($query) use ($request) {
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
				$sitevisit = LeadProgress::whereHas('Lead')->where('status', 1)->where('progress', '=', Statuses::BOOKED)->when($request->month, function ($query) use ($request) {
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
				$sitevisit = LeadProgress::whereHas('Lead')->where('status', 1)->where('progress', '=', Statuses::LOST)->when($request->month, function ($query) use ($request) {
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
				'new_enquiry' => ['name' => 'New Lead', 'class' => 'event-type-new-enquiry'],
				'leadConf' => ['name' => 'Lead Confirmed', 'class' => 'event-type-lead-confirmed'],
				'site_visit_scheduled' => ['name' => 'Demo Scheduled', 'class' => 'event-type-site-visit-scheduled'],
				'site_visit_completed' => ['name' => 'Demo Completed', 'class' => 'event-type-site-visit-completed'],
				'due_followup' => ['name' => 'Due Followup', 'class' => 'event-type-due-followup'],
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
					$event['url'] = route('superadmin.enquiries.calendar.view') . '?date=' . $key2 . '&type=' . $types;

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
		return view('superadmin.calendar.index', compact('employees'));
	}

    public function calenderDetail(Request $request)
    {
        // dd("view enq cal details");
        // calendar 
        // click to edit cal
        $type = explode(',', $request->type);
        if (in_array('new_enquiry', $type)) {
            // $data['new_enquiry'] = Enquiries::whereDate('created_at', $request->date)->get();
            $data['new_enquiry'] = BromiEnquiry::with('state', 'city', 'LeadProgress', 'planInterested' )->whereDate('created_at', $request->date)->get();
        }
        if (in_array('leadConf', $type)) {
            $data['leadConf'] = LeadProgress::with('Lead')
            ->where('status', 1)
            ->where('progress', '=', 'Lead Confirmed')
            ->whereNotNull('nfd')
            ->whereDate('nfd', '=', $request->date)
            ->get();
        }
        if (in_array('site_visit_scheduled', $type)) {
            $data['site_visit_scheduled'] = LeadProgress::with('Lead')
            ->where('status', 1)
            ->where('progress', '=', 'Demo Scheduled')
            ->whereNotNull('nfd')
            ->whereDate('nfd', '=', $request->date)
            ->get();
        }
        // site_visit_completed
        if (in_array('site_visit_completed', $type)) {
            $data['site_visit_completed'] = LeadProgress::with('Lead')
            ->where('status', 1)
            ->where( 'progress', '=', 'Demo Completed')
            ->whereNotNull('nfd')
            ->whereDate('nfd', '=', $request->date)
            ->get();
            // dd($data['site_visit_completed'], "site_visit_completedsite_visit_completed");
        }
        // due_followup
        if (in_array('due_followup', $type)) {
            $data['due_followup'] = LeadProgress::with('Lead')
            ->where('status', 1)
            ->where( 'progress', '=', Statuses::DUE_FOLLOWUP)
            ->whereNotNull('nfd')
            ->whereDate('nfd', '=', $request->date)
            ->get();
            // dd($data['due_followup'], "site_visit_completedsite_visit_completed");
        }
        if (in_array('discussion_schedule', $type)) {
            $data['discussion_schedule'] = LeadProgress::with('Lead')
            ->where('status', 1)
            ->where('progress', '=', 'Discussion')
            ->whereNotNull('nfd')
            ->whereDate('nfd', '=', $request->date)
            ->get();
        }
        if (in_array('booked', $type)) {
            $data['booked'] = LeadProgress::with('Lead')
            ->where('status', 1)
            ->where('progress', '=', 'Booked')
            ->whereDate('nfd', '=', $request->date)
            ->get();
        }
        if (in_array('lost', $type)) {
            $data['lost'] = LeadProgress::with('Lead')
            ->where('status', 1)
            ->where('progress', '=', 'Lost')
            ->whereDate('nfd', '=', $request->date)
            ->get();
        }

        $areas = SuperAreas::get();
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
        $cities = SuperCity::orderBy('name')->get();
        $data['cities'] = $cities;
        $branches = Branches::orderBy('name')->get();
        $data['branches'] = $branches;
        $employees = User::where('parent_id', Session::get('parent_id'))->orWhere('id', Session::get('parent_id'))->get();
        $data['employees'] = $employees;
        // dd($data, "Data");

        return view('superadmin.calendar.view', $data);
    }

    public function getLeadHistory(Request $request)
    {
        $lead = BromiEnquiry::with(['LeadHistory'])->where('id',$request->id)->first();

        $lead_history = [];

        foreach ($lead->LeadHistory as $key => $value) {
            $member = User::find($value['member_id']);

            $date = Carbon::parse($value->assign_at);
            $formattedDate = $date->format('d/m/Y');

            $obj = [
                'member_name' => $member->first_name. ' ' .$member->last_name,   
                'assign_date' => $formattedDate,
            ];

            array_push($lead_history, $obj);
        }

        return response()->json($lead_history);
    }

    public function assignLead(Request $request)
    {
        $check_history =  LeadAssignHistory::where('lead_id', $request->id)->where('member_id' , $request->member_id)->get();

        if(count($check_history) > 0) {
            return response()->json([
                'error' => [
                    'message' => 'This lead already assign to this member.',
                    'status_code' => 422,
                ],
            ], 422);
        } else {
            $histroy = new LeadAssignHistory();

            $histroy->fill([
                'lead_id' => $request->id,
                'member_id' => $request->member_id,
                'assign_at' => now(),
            ])->save();
        }
    }
}
