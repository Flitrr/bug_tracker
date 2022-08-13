<?php

namespace App\Http\Controllers;

use App\Models\Bug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class BugsController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Bugs/All', ['bugs' => Auth::user()->bugs]);
    }

    public function create()
    {
        return Inertia::render('Bugs/New');
    }

    public function store(Request $request)
    {
        $bug = new Bug();
        $bug->name = $request->name;
        $bug->description = $request->description;
        $bug->save();
        $bug->users()->attach($request->user_id);
        return Redirect::route('bugs.index');
    }

    public function show(Bug $bug)
    {
        return Inertia::render('Bugs/View', ['bug' => $bug]);
    }

    public function edit(Bug $bug)
    {
        return Inertia::render('Bugs/Edit', ['bug' => $bug]);
    }

    public function update(Request $request, Bug $bug)
    {
        $this->authorize('update', $bug);
        $bug->name = $request->name;
        $bug->description = $request->description;
        $bug->save();
        return Redirect::route('bugs.show', ['bug' => $bug->id]);
    }

    public function destroy(Bug $bug)
    {
        $this->authorize('delete', $bug);
        $bug->delete();
        return Redirect::route('bugs.index');
    }
}
