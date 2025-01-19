<?php

namespace App\Http\Controllers\Superadmin;

use App\Models\Comment;
use App\Mailers\AppMailer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function postComment(Request $request, AppMailer $mailer)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);
            // dd($request->comment);
        $comment = Comment::create([
            'ticket_id' => $request->input('ticket_id'),
            'user_id' => Auth::user()->id,
            'comment' => $request->comment
        ]);

        return redirect('superadmin/tickets');
        if($comment){

        }
        // send mail if the user commenting is not the ticket owner
        if($comment->ticket->user->id !== Auth::user()->id) {
            $mailer->sendTicketComments($comment->ticket->user, Auth::user(), $comment->ticket, $comment);
        }
       
            
    }
}