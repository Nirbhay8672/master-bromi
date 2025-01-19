<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Mailers\AppMailer;
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
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $auth=Auth::user()->id;
        $tickets = Ticket::where('user_id',$auth)->with('category')->get();
        $response = [
            'message' => 'Ticket has been fetched successfully.',
            'current_page' => 0, // Set the current page number here
            'total_records' => $tickets->count(), // Set the total number of records here
            'limit' => $perPage, // Set the limit per page here
            'data' => $tickets,
        ];
        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AppMailer $mailer)
    {
        // dd($request);
        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            'priority' => 'required',
            'message' => 'required'
        ]);
        $ticket = new Ticket([
            'title' => $request->input('title'),
            'user_id' => Auth::user()->id,
            'ticket_id' => Str::random(10),//strtoupper(str_random(10)),
            'category_id' => $request->input('category'),
            'priority' => $request->input('priority'),
            'message' => $request->input('message'),
            'status' => "Open"
        ]);

        $ticket->save();
        return response()->json(['message' => 'Ticket Added successfully']);

        // return redirect('admin/index')->with("status", "A ticket with ID: #$ticket->ticket_id has been opened.");
    }

    public function userTickets(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $auth=Auth::user()->id;
        $tickets = Ticket::where('user_id',$auth)->get();
        $response = [
            'message' => 'Ticket has been fetched successfully.',
            'current_page' => 0, // Set the current page number here
            'total_records' => $tickets->count(), // Set the total number of records here
            'limit' => $perPage, // Set the limit per page here
            'data' => $tickets,
        ];
        return response()->json($response, 200);
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
        return response()->json([
            "status" => 200,
            "message" => "Ticket has been fetched successfully",
            "data" => $ticket
        ]);
    }

    public function close($ticket_id, AppMailer $mailer)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
        $ticket->status = "Closed";
        $ticket->save();
        $ticketOwner = $ticket->user;
        // $mailer->sendTicketStatusNotification($ticketOwner, $ticket);
        return response()->json(['message' => 'The ticket has been closed']);
        // return redirect()->back()->with("status", "The ticket has been closed.");
    }
}
