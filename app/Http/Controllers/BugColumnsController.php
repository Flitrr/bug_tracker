<?php

namespace App\Http\Controllers;

use App\Models\Bug;
use App\Models\Column;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Inertia\Inertia;

class BugColumnsController extends Controller
{
    public function index(Column $column)
    {
        return Inertia::render('Bugs/All', [
            'bugs' => Auth::user()->bugs,
            'column_id' => $column->id,
        ]);
    }

    public function create(Column $column)
    {
        return Inertia::render('Bugs/New', [
            'column_id' => $column->id,
        ]);
    }

    public function store(Column $column, Request $request)
    {
        $bug = new Bug();
        $bug->name = $request->user;
        $bug->description = $request->description;
        $bug->save();
        $bug->users()->attach(Auth::user()->id);
        $bug->columns()->attach($column->id);
        return Redirect::route('boards.show', ['board' => $column->board->id]);
    }

    public function select(Column $column, Bug $bug)
    {
        $bug->columns()->attach($column->id);
        return Response::noContent();
    }

    public function remove(Column $column, Bug $bug)
    {
        $bug->columns()->detach([$column->id]);
        return Response::noContent();
    }
}
