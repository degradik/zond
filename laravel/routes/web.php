<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Counter;





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
    return view('pages.home');
})->name('home');

Route::get('/counter', Counter::class);


// Регистрация
Route::middleware('guest')->group(function () {
    Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
});

// Выход
Route::post('/logout', [App\Http\Controllers\Auth\LogoutController::class, 'logout'])->name('logout')->middleware('auth');

// Профиль пользователя
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile')->middleware('auth');

Route::post('/rentals/{rental}/complete', [App\Http\Controllers\RentalController::class, 'complete'])
    ->name('rentals.complete')
    ->middleware('auth');




Route::get('/stations', [App\Http\Controllers\MapController::class, 'getStations']);

Route::post('/rentals', [App\Http\Controllers\RentalController::class, 'store'])->middleware('auth');

Route::post('/rentals/create', [App\Http\Controllers\RentalController::class, 'store'])->name('rentals.store')->middleware('auth');

Route::get('/stations/{stationId}/available-umbrellas-list', [App\Http\Controllers\MapController::class, 'getAvailableUmbrellasList']);


