<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Constants;
use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Mailers\AppMailer;
use App\Models\UserNotifications;
use Illuminate\Support\Facades\Session;
use Str;

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
    public function index()
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

        $auth=Auth::user()->id;
        
        $tickets = Ticket::where('user_id',$auth)->with(['category'])->orderBy('id','DESC')->get();

        return view('admin.ticket_system.tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.ticket_system.tickets.create', compact('categories'));
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

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/ticket_attachment'), $filename);
        }

        $ticket = new Ticket([
            'title' => $request->input('title'),
            'user_id' => Auth::user()->id,
            'ticket_id' => Str::random(10),
            'category_id' => $request->input('category'),
            'priority' => $request->input('priority'),
            'attachment_file_path' => $request->hasFile('attachment') ? '/uploads/ticket_attachment/' . $filename : null,
            'message' => $request->input('message'),
            'status' => "Open"
        ]);

        $ticket->save();

        UserNotifications::create([
            "user_id" => Auth::user()->id,
            "notification" => 'New ticket raised',
            "notification_type" => Constants::NEW_TICKET,
            'by_user' => Auth::user()->id,
        ]);

        return redirect('admin/index')->with("status", "A ticket with ID: #$ticket->ticket_id has been opened.");
    }

    public function userTickets()
    {
        $tickets = Ticket::where('user_id', Auth::user()->id)->paginate(10);

        return view('admin.ticket_system.tickets.user_tickets', compact('tickets'));
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
        // dd($ticket->comments);
        return view('admin.ticket_system.tickets.show', compact('ticket'));
    }

    public function close($ticket_id, AppMailer $mailer)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
        $ticket->status = "Closed";
        $ticket->save();
        $ticketOwner = $ticket->user;
        // $mailer->sendTicketStatusNotification($ticketOwner, $ticket);
        return redirect()->back()->with("status", "The ticket has been closed.");
    }
}
