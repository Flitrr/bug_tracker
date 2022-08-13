<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Column;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ColumnsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request, Board $board)
    {
        $column = new Column();
        $column->name = $request->name;
        $column->board_id = $board->id;
        $column->save();
        return Redirect::route('boards.show', ['board' => $column->board]);
    }

    public function show(Column $column)
    {
        return Inertia::render('Column/View', ['column' => $column]);
    }

    public function edit(Column $column)
    {
        return Inertia::render('Column/Edit', ['column' => $column]);
    }

    public function update(Request $request, Board $board, Column $column)
    {
        if ($request->user()->cannot('update', $column)) {
            abort(403);
        }

        $column->name = $request->name;
        $column->save();
        return Redirect::route('columns.show', ['column' => $column]);
    }


    public function destroy(Column $column)
    {
        $this->authorize('delete', $column);

        $column->delete();
        return Redirect::route('boards.show', ['board' => $column->board]);
    }
}
