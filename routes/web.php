<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DistrictController;

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
    return view('template.index');
});

Route::get('/hospitals', function () {
    return view('template.hospitals');
});

Route::get('/payments', function () {
    return view('template.payments');
});

Route::get('/admin', function () {
    return view('template.admin');
});


//Testing Controllers
//C
//use App\Http\Controllers\UserController;

//Route::get('/user/{id}', [UserController::class, 'show']);


Route::get('/districts', [DistrictController::class, 'index']);

//Add new District
Route::post('districts', [DistrictController::class, 'store']);

//Delete a District
Route::delete('districts/', [DistrictController::class, 'delete']);

//Search for a particular district
Route::get('district/{name}', [DistrictController::class, 'show']);



