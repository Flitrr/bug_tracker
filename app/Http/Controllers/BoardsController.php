<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class BoardsController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Boards/All', [
            'boards' => $request->user()->boards,
        ]);
    }

    public function store(Request $request)
    {
        $board = new Board();
        $board->name = $request->user;
        $board->save();
        $board->users()->attach(Auth::user()->id);
        return Redirect::route('boards.index');
    }

    public function show(Board $board)
    {
        $fullBoard = Board::with('columns.bugs.columns')->where('id', '=', $board->id)->get();
        return Inertia::render('Boards/One', [
            'board' => $fullBoard->first(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Boards/New');
    }

    public function destroy(Board $board)
    {
        $this->authorize('delete', $board);
        $board->delete();
        return Redirect::route('boards.index');
    }

    public function edit(Board $board)
    {
        return Inertia::render('Boards/Edit', [
            'board' => $board,
        ]);
    }
    public function update(Request $request, Board $board)
    {
        $this->authorize('update', $board);
        $board->name = $request->user;
        $board->save();
        return Redirect::route('boards.show', [
            'board' => $board->id,
        ]);
    }
    public function fetch(Board $board)
    {
        $columns = $board->columns;
        foreach ($columns as $column) {
            $bugs = $column->bugs;
            foreach ($bugs as $bug) {
                $bug->comments;
            }
        }
        return json_encode($board);
    }
}
