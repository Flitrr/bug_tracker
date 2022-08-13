<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
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
        $board->user_id = $request->user()->id;
        $board->name = $request->name;
        $board->save();
        return Redirect::route('boards.index');
    }

    public function show(Board $board)
    {
        $board->columns;
        return Inertia::render('Boards/One', [
            'board' => $board,
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
        $board->name = $request->name;
        $board->save();
        return Redirect::route('boards.show', [
            'board' => $board,
        ]);
    }
}
