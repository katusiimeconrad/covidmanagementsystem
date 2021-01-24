<?php

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


