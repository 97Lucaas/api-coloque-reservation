<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvitationsController;
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
    return view('welcome');
});
Route::resource('invitations', InvitationsController::class)->only(['create', 'store']);


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/scanner', function () {
        return view('scanner');
    })->name('scanner');

    Route::get('/invitations/{invitation_key}/scan', [InvitationsController::class, 'scan'])->name('invitations.scan');
    Route::resource('invitations', InvitationsController::class)->except(['create', 'store']);

});



require __DIR__.'/auth.php';
