<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\ThreadController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Place all the routes here that are for the admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/createBoard', [BoardController::class, 'create'])->name('admin.createBoard');
    Route::post('/admin/boards', [BoardController::class, 'store'])->name('admin.storeBoard');
    Route::get('/admin/deleteBoard', [BoardController::class, 'showAllBoards'])->name('admin.deleteBoard');
    Route::delete('/admin/deleteBoard/{board}', [BoardController::class, 'destroy'])->name('admin.destroyBoard');
});

// Place all the routes here that are for the user, mod and admin
Route::middleware(['auth', 'role:user|mod|admin'])->group(function () {
    Route::get('/{board}/createThread', [ThreadController::class, 'create'])->name('threads.create');
    Route::get('/{board}/{thread}', [ThreadController::class, 'show'])->name('threads.show');
    Route::post('/{board}/threads', [ThreadController::class, 'store'])->name('threads.store');
    Route::delete('/threads/{thread}', [ThreadController::class, 'destroy'])->name('threads.destroy');
});

// Accessible for everyone:
Route::get('/{board}', [BoardController::class, 'show']);

