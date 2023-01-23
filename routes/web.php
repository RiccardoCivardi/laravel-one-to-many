<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

// questa è la rotta per la parte guest del sito
Route::get('/', [PageController::class , 'index'])->name('home');

// Raggruppo tutte le rotte per la parte admin del sito
Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function(){
        // nella funzione di callback creo la mie rotta
        Route::get('/', [DashboardController::class, 'index'])->name('home');
        // qui mettiamo tutte le rotte della CRUD con la resources
        // ...
        Route::resource('projects', ProjectController::class);
        // Rotta che riordina la tabella in base alla selezione
        Route::get('projects/orderby/{column}/{direction}', [ProjectController::class, 'orderby'])->name('projects.orderby');
    });


require __DIR__.'/auth.php';


