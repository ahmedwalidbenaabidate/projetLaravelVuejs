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
    return view('welcome');
});

//Route Chantiers--------------------------------------------
Route::get('chantiers/all', "App\Http\Controllers\ChantierController@index");
Route::post('/chantiers/create', "App\Http\Controllers\ChantierController@create");
Route::get('/chantiers/get/{id}', "App\Http\Controllers\ChantierController@show");
Route::post('/chantiers/update', "App\Http\Controllers\ChantierController@update");
Route::delete('/chantiers/delete/{id}', "App\Http\Controllers\ChantierController@destroy");

//Route Qualites----------------------------------------------
 Route::get('/qualites/all', "App\Http\Controllers\QualiteController@index");

Route::post('/qualites/create', "App\Http\Controllers\QualiteController@create");
Route::get('/qualites/get/{id}', "App\Http\Controllers\QualiteController@show");
Route::post('/qualites/update', "App\Http\Controllers\QualiteController@update");
Route::delete('/qualites/delete/{id}', "App\Http\Controllers\QualiteController@destroy");

//Route Employees------------------------------------------------
Route::get('employees/all', "App\Http\Controllers\EmployeeController@index");
Route::post('/employees/create', "App\Http\Controllers\EmployeeController@create");
Route::get('/employees/get/{id}', "App\Http\Controllers\EmployeeController@show");
Route::post('/employees/update', "App\Http\Controllers\EmployeeController@update");
Route::delete('/employees/delete/{id}', "App\Http\Controllers\EmployeeController@destroy");

//Route Pointage------------------------
Route::get('/pointages/allAbs', "App\Http\Controllers\PointageController@indexAfficherAbs");
Route::post('/pointages/create', "App\Http\Controllers\PointageController@create");



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::view('{any}', 'dashboard')
->middleware('auth')
->where('any', '.*');