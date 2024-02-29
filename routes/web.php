<?php

use App\Http\Controllers\CityControllers;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\vista;

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

//Route::get('/dashboard', function () {
   // return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); 
    Route::get('/info-city', [CityControllers::class, 'getContry'])->name('info-city');
    Route::post('/guardar-city', [CityControllers::class, 'guardarCity'])->name('guardar-city');
    Route::get('/dashboard', [CityControllers::class, 'dashboard'])->name('dashboard');
    Route::post('/eliminar', [CityControllers::class, 'eliminar'])->name('eliminar');

    
});

require __DIR__.'/auth.php';
