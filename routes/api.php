<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::get('/user', function (Request $request) {
//    $user = \Illuminate\Support\Facades\Auth::user();
//    $boards = $user->boards;
//    $bugs = $user->bugs;
//    $comments = $user->comments;
//    $columns = $boards->columns;
//    $column_bugs = $columns->bugs;
//    $column_bugs->comments;
//    $bugs->comments;
//    return json_encode($user);
//})->middleware(['auth:sanctum']);

Route::get('/boards/{board}', [\App\Http\Controllers\BoardsController::class, 'fetch'])->middleware(['auth:sanctum'])->name('boards.fetch');
