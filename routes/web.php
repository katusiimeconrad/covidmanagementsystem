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

    Route::get('paytest','App\Http\Controllers\TestController@index');


    require __DIR__.'/auth.php';

    //cronjob url
    Route::get('/cron','App\Http\Controllers\CronController@index');

    //Authenticated user can access
    Route::group(['middleware' => ['auth']], function () {

        Route::get('/dashboard', 'App\Http\Controllers\DashboardController@dashboard')->name('dashboard');

        //patient routes
        Route::group(['prefix'  =>   'patients'], function() {
            Route::get('/', 'App\Http\Controllers\PatientController@index')->name('patients.index');
            Route::get('/{id}/edit', 'App\Http\Controllers\PatientController@edit')->name('patient.view');
        });

        //district routes
        Route::group(['prefix'  =>   'districts'], function() {
            Route::get('/', 'App\Http\Controllers\DistrictController@index')->name('districts.index');
            Route::get('/{id}', 'App\Http\Controllers\DistrictController@show')->name('districts.show');
            Route::post('/store', 'App\Http\Controllers\DistrictController@store')->name('districts.store');
            Route::get('/{id}/edit', 'App\Http\Controllers\DistrictController@edit')->name('districts.edit');
            Route::post('/update', 'App\Http\Controllers\DistrictController@update')->name('districts.update');
            Route::get('/{id}/delete', 'App\Http\Controllers\DistrictController@delete')->name('districts.delete');
        });

        //hospitals routes
        Route::group(['prefix'  =>   'hospitals'], function() {
            Route::get('/', 'App\Http\Controllers\HospitalController@index')->name('hospitals.index');
            Route::post('/store', 'App\Http\Controllers\HospitalController@store')->name('hospitals.store');
            Route::get('/{id}/edit', 'App\Http\Controllers\HospitalController@edit')->name('hospitals.edit');
            Route::post('/update', 'App\Http\Controllers\HospitalController@update')->name('hospitals.update');
            Route::get('/{id}/delete', 'App\Http\Controllers\HospitalController@delete')->name('hospitals.delete');

        });

        //Officers routes
        Route::group(['prefix'  =>   'officers'], function() {
            Route::get('/', 'App\Http\Controllers\HealthOfficerController@index')->name('officers.index');
            Route::post('/store', 'App\Http\Controllers\HealthOfficerController@store')->name('officers.store');
            Route::get('/{id}/edit', 'App\Http\Controllers\HealthOfficerController@edit')->name('officers.edit');
            Route::post('/update', 'App\Http\Controllers\HealthOfficerController@update')->name('officers.update');
            Route::get('/{id}/delete', 'App\Http\Controllers\HealthOfficerController@delete')->name('officers.delete');
            Route::get('/assign/{id}','App\Http\Controllers\HealthOfficerController@assign')->name('assign.hospital');
        });

        //Donor routes
        Route::group(['prefix'  =>   'donors'], function() {
            Route::get('/', 'App\Http\Controllers\DonorController@index')->name('donors.index');
            Route::get('/{id}', 'App\Http\Controllers\DonorController@show')->name('donors.show');          //Information Relating to a paricular donor
            Route::post('/store', 'App\Http\Controllers\DonorController@store')->name('donors.store');
            Route::get('/{id}/edit', 'App\Http\Controllers\DonorController@edit')->name('donors.edit');
            Route::post('/update', 'App\Http\Controllers\DonorController@update')->name('donors.update');
            Route::get('/{id}/delete', 'App\Http\Controllers\DonorController@delete')->name('donors.delete');

        });


        
        //Funds Routes
        Route::group(['prefix'  =>   'funds'], function() {
            Route::get('/', 'App\Http\Controllers\FundController@index')->name('funds.index');
            Route::get('/{id}', 'App\Http\Controllers\FundController@show')->name('funds.show');
            Route::post('/store', 'App\Http\Controllers\FundController@store')->name('funds.store');
            Route::get('/{id}/edit', 'App\Http\Controllers\FundController@edit')->name('funds.edit');
            Route::post('/update', 'App\Http\Controllers\FundController@update')->name('funds.update');
            Route::get('/{id}/delete', 'App\Http\Controllers\FundController@delete')->name('funds.delete');

        });

         //Payments Routes
         Route::group(['prefix'  =>   'payments'], function() {
            Route::get('/', 'App\Http\Controllers\PaymentController@index')->name('payments.index');
            Route::get('/{id}', 'App\Http\Controllers\PaymentController@show')->name('payments.show');
            Route::post('/store', 'App\Http\Controllers\PaymentController@store')->name('payments.store');
            Route::get('/{id}/edit', 'App\Http\Controllers\PaymentController@edit')->name('payments.edit');
            Route::post('/update', 'App\Http\Controllers\PaymentController@update')->name('payments.update');
            Route::get('/{id}/delete', 'App\Http\Controllers\PaymentController@delete')->name('payments.delete');
         });

    });



