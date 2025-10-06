<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvitationsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EventsController;

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

Route::get('/rgpd', fn()=>view('rgpd'))
    ->name('rgpd');

Route::resource('invitations', InvitationsController::class)
    ->only(['create', 'store']);

Route::get('/invitations/{invitation_key}/qrcode', [InvitationsController::class, 'qrcode'])
    ->name('invitations.qrcode');

Route::get('/invitations/{invitation_key}/sent', [InvitationsController::class, 'sent'])
    ->name('invitations.sent');

Route::get('/invitations/{invitation_key}/sendmail', [InvitationsController::class, 'sendmail'])
    ->name('invitations.sendmail');

Route::middleware(['auth', 'can:view-dashboard'])->group(function () {

    Route::get('/dashboard', fn()=>view('dashboard'))
        ->name('dashboard');


    Route::middleware(['can:globalscan'])->group(function () {
        Route::get('/globalscanner', fn()=>view('globalscanner'))
            ->name('globalscanner');
    });

    Route::get('/invitations/{invitation_key}/scan', [InvitationsController::class, 'scan'])
        ->name('invitations.scan');

    Route::get('/invitations/{invitation_key}/unscan', [InvitationsController::class, 'unscan'])
        ->name('invitations.unscan');



    Route::resource('invitations', InvitationsController::class)
        ->except(['create', 'store'])
        ->middleware('can:handle-invitations');


    Route::resource('events', EventsController::class)
        ->except(['show', 'index']);

    Route::resource('users', UsersController::class)
        ->except(['create', 'store', 'show']);



    Route::middleware(['can:exec-commands'])->group(function () {

        Route::get('/command/gitpull', function () {
            exec("cd .. && git pull", $output, $returnVar);
            
            $message = implode("\n", $output);

            if (strpos($message, 'Already up to date') !== false) {
                $confirm = "✅ Le dépôt est déjà à jour.";
            } else {
                $confirm = "🚀 Pull effectué !\n$message";
            }

            return nl2br($confirm);
        });

        Route::get('/command/migrate', function () {
            exec("cd .. && php artisan migrate", $output);
            dd($output);
        })->name('command.migrate');
    
    });
});

// Route::get('/events/{event_slug}/invitations', [EventsController::class, 'invitations'])->name('events.invitations');

Route::get('/events/{event_slug}', [EventsController::class, 'show'])->name('events.show');
Route::get('/events/{event_id}/scanner', [EventsController::class, 'scanner'])->name('events.scanner');
Route::get('/events/{event_id}/{invitation_key}/scan', [EventsController::class, 'scan'])->name('events.scan');
Route::get('/events/{event_slug}/invite', function($event_slug) {
    return redirect()->route('events.show', $event_slug);
});
Route::get('/events', [EventsController::class, 'index'])->name('events.index');


require __DIR__.'/auth.php';