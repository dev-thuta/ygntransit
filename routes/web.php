<?php

use App\Http\Controllers\BusLineController;
use App\Http\Controllers\BusRouteController;
use App\Http\Controllers\BusStopController;
use App\Http\Controllers\TownshipController;
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

Auth::routes();

Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    // townships
    Route::get('/admin/townships/', [
        TownshipController::class,
        'index'
    ]);
    Route::get('/admin/townships/add', [
        TownshipController::class,
        'add'
    ]);
    Route::post('admin/townships/create', [
        TownshipController::class,
        'create'
    ]);
    Route::get('/admin/townships/edit/{id}', [
        TownshipController::class,
        'edit'
    ]);
    Route::put('/admin/townships/update/{id}', [
        TownshipController::class,
        'update'
    ]);
    Route::get('/admin/townships/delete/{id}', [
        TownshipController::class,
        'delete'
    ]);

    // bus lines
    Route::get('/admin/bus-lines/', [
        BusLineController::class,
        'index'
    ]);
    Route::get('/admin/bus-lines/add', [
        BusLineController::class,
        'add'
    ]);
    Route::post('admin/bus-lines/create', [
        BusLineController::class,
        'create'
    ]);
    Route::get('/admin/bus-lines/edit/{id}', [
        BusLineController::class,
        'edit'
    ]);
    Route::put('/admin/bus-lines/update/{id}', [
        BusLineController::class,
        'update'
    ]);
    Route::get('/admin/bus-lines/delete/{id}', [
        BusLineController::class,
        'delete'
    ]);

    // bus stops
    Route::get('/admin/bus-stops/', [
        BusStopController::class,
        'index'
    ]);
    Route::get('/admin/bus-stops/add', [
        BusStopController::class,
        'add'
    ]);
    Route::post('admin/bus-stops/create', [
        BusStopController::class,
        'create'
    ]);
    Route::get('/admin/bus-stops/edit/{id}', [
        BusStopController::class,
        'edit'
    ]);
    Route::put('/admin/bus-stops/update/{id}', [
        BusStopController::class,
        'update'
    ]);
    Route::get('/admin/bus-stops/delete/{id}', [
        BusStopController::class,
        'delete'
    ]);

    // bus routes
    Route::get('/admin/bus-routes/', [
        BusRouteController::class,
        'index'
    ]);
    Route::get('/admin/bus-routes/add/{id}', [
        BusRouteController::class,
        'add'
    ]);
    Route::post('admin/bus-routes/create', [
        BusRouteController::class,
        'create'
    ]);
    Route::get('/admin/bus-routes/edit/{id}', [
        BusRouteController::class,
        'edit'
    ]);
    Route::put('/admin/bus-routes/update/{id}', [
        BusRouteController::class,
        'update'
    ]);
    Route::get('/admin/bus-routes/delete/{id}', [
        BusRouteController::class,
        'delete'
    ]);
});

Route::get('/bus-lines', [
    BusLineController::class,
    'publicIndex'
]);
Route::get('/bus-stops', [
    BusStopController::class,
    'publicIndex'
]);
Route::get('/bus-routes', [
    BusRouteController::class,
    'publicIndex'
]);