<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VehiculeController;
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
 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Page d’accueil = dashboard protégé
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/dashboard', [DashboardController::class, 'index']);
    // Routes d'authentification Breeze
require __DIR__.'/auth.php';

// Page login protégée par middleware guest
Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
     return view('auth.login');
    })->name('login');
});

// Inclut les routes d'authentification si Breeze/Jetstream installé
require __DIR__.'/auth.php';


     
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('vehicules', VehiculeController::class);
});

require __DIR__.'/auth.php';
 
 