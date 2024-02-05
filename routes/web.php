<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->prefix('dashboard')->name('admin.')->group(function () {

    //CLIENTS
    Route::resource('/clients', ClientController::class);
    Route::delete('/clients/delete_file/{client}-{file}', [ClientController::class, 'delete_file'])->name('clients.delete_file');
    Route::delete('/clients/delete_Allfile/{client}', [ClientController::class, 'delete_Allfile'])->name('clients.delete_Allfile');
    Route::get('/clients/downloadFile/{client}/{file}', [ClientController::class, 'downloadFile'])->name('clients.downloadFile');
    Route::get('/clients/changeClientPosition/{client}', [ClientController::class, 'changeClientPosition'])->name('clients.changeClientPosition');

    //FILES
    Route::get('/client/files/{client}', [FileController::class, 'index'])->name('files.index');
    Route::post('/client/store/{client}', [FileController::class, 'store'])->name('files.store');

    //NOTES
    Route::get('/notes/{client}', [NoteController::class, 'index'])->name('notes.index');
    Route::get('/notes/create/{client}', [NoteController::class, 'create'])->name('notes.create');
    Route::get('/notes/edit/{note}/{client}', [NoteController::class, 'edit'])->name('notes.edit');
    Route::post('/notes/store/{client}', [NoteController::class, 'store'])->name('notes.store');
    Route::put('/notes/update/{note}/{client}', [NoteController::class, 'update'])->name('notes.update');
    Route::delete('/notes/delete/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');
    Route::delete('/notes/destroyAllNote/{client}', [NoteController::class, 'destroyAllNote'])->name('notes.destroyAllNote');
    Route::get('/notes/isCompletedNote/{note}', [NoteController::class, 'isCompletedNote'])->name('notes.isCompletedNote');
    Route::get('/notes/getMonthNote/{month}/{client}', [NoteController::class, 'getMonthNote'])->name('notes.getMonthNote');

    //EVENTS
    Route::get('/events/{client}', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/{client}/getEvents', [EventController::class, 'getEvents'])->name('events.getEvents');
    Route::post('/events/{client}', [EventController::class, 'store'])->name('events.store');
    Route::put('/events/{client}/{event}/dateUpdate', [EventController::class, 'dateUpdate'])->name('events.dateUpdate');
    Route::put('/events/{client}/{event}/updateContent', [EventController::class, 'updateContent'])->name('events.updateContent');
    Route::delete('/events/{client}/{event}/deleteEvent', [EventController::class, 'deleteEvent'])->name('events.deleteEvent');
    Route::get('/events/{client}/search', [EventController::class, 'search']);
});

require __DIR__ . '/auth.php';
