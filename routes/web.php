<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'admin'])->namespace('Admin')->group(function () {
// specialty
    Route::get('/specialties', 'SpecialtyController@index');
    Route::get('/specialties/create', 'SpecialtyController@create');
    Route::get('/specialties/{specialty}/edit', 'SpecialtyController@edit');
    Route::post('/specialties', 'SpecialtyController@store');
    Route::put('/specialties/{specialty}', 'SpecialtyController@update');
    Route::delete('/specialties/{specialty}', 'SpecialtyController@destroy');

// doctors
    Route::resource('doctors', 'DoctorController');
// patients
    Route::resource('patients', 'PatientController');
});

Route::middleware(['auth', 'doctor'])->namespace('Doctor')->group(function () {
// schedule
    Route::get('/schedule', 'ScheduleController@edit');
    Route::post('/schedule', 'ScheduleController@store');


});





