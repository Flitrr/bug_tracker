<?php

use App\Http\Controllers\BoardsController;
use App\Http\Controllers\BugColumnsController;
use App\Http\Controllers\BugsController;
use App\Http\Controllers\ColumnsController;
use App\Http\Controllers\CommentsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/user', function() {
    $user_id = \Illuminate\Support\Facades\Auth::user()->id;
    $user = \App\Models\User::with(['boards.columns.bugs.comments', 'bugs.comments', 'comments'])->find($user_id);
    return json_encode($user);
})->middleware(['auth', 'verified']);

Route::get('/boards', [BoardsController::class, 'index'])->middleware(['auth', 'verified'])->name('boards.index');
Route::post('/boards', [BoardsController::class, 'store'])->middleware(['auth', 'verified'])->name('boards.store');
Route::get('/boards/new', [BoardsController::class, 'create'])->middleware(['auth', 'verified'])->name('boards.create');
Route::delete('/boards/{board}', [BoardsController::class, 'destroy'])->middleware(['auth', 'verified'])->name('boards.destroy');
Route::get('/boards/{board}', [BoardsController::class, 'show'])->middleware(['auth', 'verified'])->name('boards.show');
Route::get('/boards/{board}/edit', [BoardsController::class, 'edit'])->middleware(['auth', 'verified'])->name('boards.edit');
Route::put('/boards/{board}', [BoardsController::class, 'update'])->middleware(['auth', 'verified'])->name('boards.update');

Route::post('/boards/{board}/columns', [ColumnsController::class, 'store'])->middleware(['auth', 'verified'])->name('columns.store');
Route::put('/boards/{board}/columns/{column}', [ColumnsController::class, 'update'])->middleware(['auth', 'verified'])->name('columns.update');
Route::get('/columns/{column}', [ColumnsController::class, 'show'])->middleware(['auth', 'verified'])->name('columns.show');
Route::delete('/columns/{column}', [ColumnsController::class, 'destroy'])->middleware(['auth', 'verified'])->name('columns.destroy');
Route::get('/columns/{column}/edit', [ColumnsController::class, 'edit'])->middleware(['auth', 'verified'])->name('columns.edit');
Route::put('/columns/{column}', [ColumnsController::class, 'update'])->middleware(['auth', 'verified'])->name('columns.update');

Route::get('/columns/{column}/bugs', [BugColumnsController::class, 'index'])->middleware(['auth', 'verified'])->name('columns.bugs.index');
Route::post('/columns/{column}/bugs', [BugColumnsController::class, 'store'])->middleware(['auth', 'verified'])->name('columns.bugs.store');
Route::post('/columns/{column}/bugs/{bug}', [BugColumnsController::class, 'select'])->middleware(['auth', 'verified'])->name('columns.bugs.select');
Route::get('/columns/{column}/bugs/create', [BugColumnsController::class, 'create'])->middleware(['auth', 'verified'])->name('columns.bugs.create');
Route::delete('/columns/{column}/bugs/{bug}', [BugColumnsController::class, 'remove'])->middleware(['auth', 'verified'])->name('columns.bugs.remove');

Route::get('/bugs', [BugsController::class, 'index'])->middleware(['auth', 'verified'])->name('bugs.index');
Route::post('/bugs', [BugsController::class, 'store'])->middleware(['auth', 'verified'])->name('bugs.store');
Route::get('/bugs/create', [BugsController::class, 'create'])->middleware(['auth', 'verified'])->name('bugs.create');
Route::get('/bugs/{bug}', [BugsController::class, 'show'])->middleware(['auth', 'verified'])->name('bugs.show');
Route::put('/bugs/{bug}', [BugsController::class, 'update'])->middleware(['auth', 'verified'])->name('bugs.update');
Route::delete('/bugs/{bug}', [BugsController::class, 'destroy'])->middleware(['auth', 'verified'])->name('bugs.destroy');
Route::get('/bugs/{bug}/edit', [BugsController::class, 'edit'])->middleware(['auth', 'verified'])->name('bugs.edit');

Route::get('/bugs/{bug}/comments/create', [CommentsController::class, 'create'])->middleware(['auth', 'verified'])->name('bugs.comments.create');
Route::post('/bugs/{bug}/comments', [CommentsController::class, 'store'])->middleware(['auth', 'verified'])->name('bugs.comments.store');
require __DIR__ . '/auth.php';
