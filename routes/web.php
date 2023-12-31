<?php

use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
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



Route::resource('/series', SeriesController::class)
    ->except(['show']);

Route::middleware('autenticador')->group(function () {
    Route::get('/', function () {
        return redirect('/series');
    });

    Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])->name('seasons.index');
Route::get('/season/{season}/episodes', [EpisodesController::class, 'index'])->name('episodes.index');
Route::post('/season/{season}/episodes', [EpisodesController::class, 'update'])->name('episodes.update');

});


// Route::post('/season/{season}/episodes', function (Request $request) {
//     dd($request->all());
// });
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('signin');
Route::get('/register', [UsersController::class, 'create'])->name('users.create');
Route::post('/register', [UsersController::class, 'store'])->name('users.register');
Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');
