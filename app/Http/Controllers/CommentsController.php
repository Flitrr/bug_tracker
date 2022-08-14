<?php

namespace App\Http\Controllers;

use App\Models\Bug;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CommentsController extends Controller
{
    public function create(Bug $bug)
    {
        return Inertia::render('Comments/Create', ['bug' => $bug]);
    }
    public function store(Bug $bug, Request $request)
    {
        $comment = new Comment();
        $comment->body = $request->body;
        $comment->commentable()->associate($bug);
        $comment->save();
        $comment->commentable()->associate(Auth::user());
        return Redirect::route('bugs.show', ['bug' => $bug->id]);
    }
}
