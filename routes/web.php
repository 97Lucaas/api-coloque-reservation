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



Route::get('/', fn()=>view('welcome'))
    ->name('welcome');

Route::resource('invitations', InvitationsController::class)
    ->only(['create', 'store']);

Route::get('/invitations/{invitation_key}/qrcode', [InvitationsController::class, 'qrcode'])
    ->name('invitations.qrcode');





Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', fn()=>view('dashboard'))
        ->name('dashboard')
        ->middleware('can:view-dashboard');



    Route::middleware(['can:scan'])->group(function () {
        Route::get('/scanner', fn()=>view('scanner'))
            ->name('scanner');

        Route::get('/invitations/{invitation_key}/scan', [InvitationsController::class, 'scan'])
            ->name('invitations.scan');

        Route::get('/invitations/{invitation_key}/unscan', [InvitationsController::class, 'unscan'])
            ->name('invitations.unscan');
    });



    Route::resource('invitations', InvitationsController::class)
        ->except(['create', 'store'])
        ->middleware('can:handle-invitations');



    Route::middleware(['can:exec-commands'])->group(function () {

        Route::get('/command/gitpull', function () {
            exec("cd .. && git pull", $output);
            dd($output);
        })->name('command.gitpull');

        Route::get('/command/migrate', function () {
            exec("cd .. && php artisan migrate", $output);
            dd($output);
        })->name('command.migrate');
    
    });
});



require __DIR__.'/auth.php';