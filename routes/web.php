<?php

use App\Http\Controllers\LicitationListController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

Route::get('/', [PagesController::class, 'licitation_list']);
Route::get('/licitation_details/{id}', [PagesController::class, 'licitation_details'])->middleware(['auth']);
Route::get('/create_licitation', [PagesController::class, 'create_licitation'])->middleware(['auth']);
Route::get('/user_profile/{id}', [PagesController::class, 'user_profile'])->middleware(['auth']);
Route::get('/my_profile', [PagesController::class, 'my_profile'])->middleware(['auth']);

Route::post('/', [LicitationListController::class, 'store'])->middleware(['auth']);
Route::delete('/licitation_details/{id}', [LicitationListController::class, 'destroy'])->name('delete_licitation')->middleware(['auth']);



Route::get('/logout', function() {
    Session::flush();
    Auth::logout();
    return redirect('/');
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
