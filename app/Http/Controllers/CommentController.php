<?php

namespace App\Http\Controllers;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(){
        $comment = request()->all()['comment'];
        $comment = Comment::create($comment);
        return redirect()->action(
            'TicketController@show', ['id' => $comment->ticket_id]
        );
    }
}
