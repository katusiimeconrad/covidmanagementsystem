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


require __DIR__.'/auth.php';

        Route::get('/cron','App\Http\Controllers\CronController@index');



    //Authenticated user can access
    Route::group(['middleware' => ['auth']], function () {
            
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        //patient routes
        Route::group(['prefix'  =>   'patients'], function() {
            Route::get('/', 'App\Http\Controllers\PatientController@index')->name('patients.index');
            Route::get('/create', 'App\Http\Controllers\PatientController@create')->name('patients.create');
            Route::post('/store', 'App\Http\Controllers\PatientController@store')->name('patients.store');
            Route::get('/{id}/edit', 'App\Http\Controllers\PatientController@edit')->name('patients.edit');
            Route::post('/update', 'App\Http\Controllers\PatientController@update')->name('patients.update');
            Route::get('/{id}/delete', 'App\Http\Controllers\PatientController@delete')->name('patients.delete');
        });

        //district routes
        Route::group(['prefix'  =>   'districts'], function() {
            Route::get('/', 'App\Http\Controllers\DistrictController@index')->name('districts.index');
            Route::get('/create', 'App\Http\Controllers\DistrictController@create')->name('districts.create');
            Route::post('/store', 'App\Http\Controllers\DistrictController@store')->name('districts.store');
            Route::get('/{id}/edit', 'App\Http\Controllers\DistrictController@edit')->name('districts.edit');
            Route::post('/update', 'App\Http\Controllers\DistrictController@update')->name('districts.update');
            Route::get('/{id}/delete', 'App\Http\Controllers\DistrictController@delete')->name('districts.delete');
        });

        //hospitals routes
        Route::group(['prefix'  =>   'hospitals'], function() {
            Route::get('/', 'App\Http\Controllers\HospitalController@index')->name('hospitals.index');
            Route::get('/create', 'App\Http\Controllers\HospitalController@create')->name('hospitals.create');
            Route::post('/store', 'App\Http\Controllers\HospitalController@store')->name('hospitals.store');
            Route::get('/{id}/edit', 'App\Http\Controllers\HospitalController@edit')->name('hospitals.edit');
            Route::post('/update', 'App\Http\Controllers\HospitalController@update')->name('hospitals.update');
            Route::get('/{id}/delete', 'App\Http\Controllers\HospitalController@delete')->name('hospitals.delete');

        });

        //hospitals routes
        Route::group(['prefix'  =>   'officers'], function() {
            Route::get('/', 'App\Http\Controllers\HealthOfficerController@index')->name('officers.index');
            Route::get('/create', 'App\Http\Controllers\HealthOfficerController@create')->name('officers.create');
            Route::post('/store', 'App\Http\Controllers\HealthOfficerController@store')->name('officers.store');
            Route::get('/{id}/edit', 'App\Http\Controllers\HealthOfficerController@edit')->name('officers.edit');
            Route::post('/update', 'App\Http\Controllers\HealthOfficerController@update')->name('officers.update');
            Route::get('/{id}/delete', 'App\Http\Controllers\HealthOfficerController@delete')->name('officers.delete');

        });

    });



