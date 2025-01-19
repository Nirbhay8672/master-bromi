<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use App\Mailers\AppMailer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function postComment(Request $request, AppMailer $mailer)
    {
        $comment = Comment::create([
            'ticket_id' => $request->input('ticket_id'),
            'user_id' => Auth::user()->id,
            'comment' => $request->input('comment')
        ]);

        if($comment->ticket->user->id !== Auth::user()->id) {
            $mailer->sendTicketComments($comment->ticket->user, Auth::user(), $comment->ticket, $comment);
        }
            
        $auth=Auth::user()->id;
        $tickets = Ticket::where('user_id',$auth)->with('category')->paginate(10);
        return view('admin.ticket_system.tickets.index', compact('tickets'));
    }
}
