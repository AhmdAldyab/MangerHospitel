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

Auth::routes();

Route::get('/', function () {
    return view('dashboard');
});

Route::group(['namespace' => 'Section'],function(){
    Route::resource('Section', 'SectionController');
    Route::resource('Room', 'RoomController');
});

Route::group(['namespace' => 'Employee'],function(){
    Route::resource('Doctor', 'DoctorController');
    Route::resource('Nurse', 'NurceController');
    Route::resource('Worker', 'WorkerController');
});

Route::get('/home', 'HomeController@index')->name('home');
