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
Route::get('/',function(){
    return view('admin.dashboard');
})->name('dash');
Route::resource('staff','App\Http\Controllers\StaffController');
Route::get('staff/trash/{id}','App\Http\Controllers\StaffController@trash')->name('staff.trash');
Route::get('staff-trash','App\Http\Controllers\StaffController@trashData')->name('staff.trash.all');
Route::post('staff-search','App\Http\Controllers\StaffController@search')->name('staff.search');