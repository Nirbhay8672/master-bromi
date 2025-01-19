<?php

namespace App\Http\Controllers\Superadmin;

use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Mailers\AppMailer;
use Carbon\Carbon;
use Str;
use Yajra\DataTables\Facades\DataTables;

class TicketsController extends Controller
{
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

			$data = Ticket::with(['user.city', 'category'])->orderBy('updated_at', 'DESC');

			if($request->filter_category !='') {
                $data->where('category_id', $request->filter_category);
			}

            if($request->filter_status !='') {
                $data->where('status', $request->filter_status);
			}

			return DataTables::of($data->get())
				->editColumn('category_name', function ($row) {
					if (isset($row['category']['name'])) {
						return $row['category']['name'];
					}
					return '';
				})
				->editColumn('title', function ($row) {
					if (isset($row['title'])) {
						return $row['title'];
					}
					return '';
				})
				->editColumn('ticket_status', function ($row) {
					if ($row['status'] == 'Open') {
						return '<span class="label label-success p-1" style="border-radius: 5px;">'. $row->status .'</span>';
					} else {
                        return '<span class="label label-danger p-1" style="border-radius: 5px;">'. $row->status .'</span>';
                    }
					return '';
				})
                ->editColumn('user_name', function ($row) {
					return $row['user']['first_name']. '' . $row['user']['last_name'];
				})
                ->editColumn('city_name', function ($row) {
					return $row->user->city->name;
				})
                ->editColumn('attachement', function ($row) {
                    if($row->attachment_file_path) {
                        return '<a href="/bromi/public'. $row->attachment_file_path . '" target="_blank">View</a>';
                    } else {
                        return '<span>No Attachment</span>';
                    }
                    return '';
				})
				->editColumn('updated_at_format', function ($row) {
					return Carbon::parse($row['updated_at'])->format('d/m/Y h:i:s A');
				})
				->editColumn('Actions', function ($row) {
                    if($row['status'] == 'Open') {
                        return '<div class="text-center">
                            <a href="/bromi/public/superadmin/tickets/'.$row->ticket_id.'" id="demo" class="btn btn-primary">Comment</a>
                            <button type="button" class="btn btn-sm" style="background-color: red;color:white" data-abc="'.$row->ticket_id.'" onclick="closeTicket(this)">Close</button>
                        </div>';
                    }
                    return '';
				})
                ->rawColumns(['Actions','ticket_status','attachement'])
				->make(true);
		}

        $tickets = Ticket::with(['user.city'])->orderBy('updated_at','DESC')->get();
        $categories = Category::all();

		return view('superadmin.ticket_system.tickets.index', compact('tickets', 'categories'));
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('superadmin.ticket_system.tickets.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AppMailer $mailer)
    {
        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            'priority' => 'required',
            'message' => 'required'
        ]);

        $ticket = new Ticket([
            'title' => $request->input('title'),
            'user_id' => Auth::user()->id,
            'ticket_id' => Str::random(10), //strtoupper(str_random(10)),
            'category_id' => $request->input('category'),
            'priority' => $request->input('priority'),
            'message' => $request->input('message'),
            'status' => "Open"
        ]);

        $ticket->save();
        // $mailer = new AppMailer();
        // $user = Auth::user();
        // $mailer->sendTicketInformation($user, $ticket);

        return redirect('admin/Properties');
    }

    public function userTickets()
    {
        $tickets = Ticket::where('user_id', Auth::user()->id)->paginate(10);

        return view('superadmin.ticket_system.tickets.user_tickets', compact('tickets'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ticket_id)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
        return view('superadmin.ticket_system.tickets.show', compact('ticket'));
    }

    public function close($ticket_id, AppMailer $mailer)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
        $ticket->status = "Closed";
        $ticket->save();
        $ticketOwner = $ticket->user;
        $mailer->sendTicketStatusNotification($ticketOwner, $ticket);
        return redirect()->back();
    }
}
