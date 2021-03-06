<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PollController;
use App\Http\Controllers\SendingsController;
use App\Http\Controllers\PollClientController;
use App\Http\Controllers\ReportsController;

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
    return view('Dashboard.index');
})->middleware(['auth'])->name("dashboard");


Route::get('/create', function () {
    return view('Dashboard.create');
})->middleware(['auth'])->name("create");

Route::get('/list', function () {
    return view('Dashboard.listPoll');
})->middleware(['auth'])->name("list");

Route::get('/modify/{id}', function () {
    return view('Dashboard.modify');
})->middleware(['auth'])->name("poll");

Route::get('/send', function () {
    return view('Dashboard.send');
})->middleware(['auth'])->name("send");

Route::get('/poll/{id}', function () {
    return view('Poll.index');
})->middleware(['auth'])->name("poll");

Route::get('/panel', function () {
    return view('Dashboard.panel');
})->middleware(['auth'])->name("panel");



Route::prefix("api")->group(function () {
    Route::apiResource("sends", SendingsController::class);
    Route::apiResource("polls", PollController::class);
    Route::apiResource("send-poll", PollClientController::class);
    Route::apiResource("reports", ReportsController::class);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
