<?php

namespace App\Http\Controllers;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(){
        $comment = request()->all()['comment'];
        $comment = Comment::create($comment);
        $user = Auth()->user();
        return compact('comment', 'user');
    }
}
