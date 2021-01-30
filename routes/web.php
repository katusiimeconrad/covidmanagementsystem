<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
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

Route::get('/', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/patients', function(){
    return view('template.index');
});

require __DIR__.'/auth.php';

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
Route::get('/districtsr', [DistrictController::class, 'show'])->name('district.show');



