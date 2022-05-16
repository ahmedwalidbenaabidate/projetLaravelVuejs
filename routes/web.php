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
Route::get('/employees/all', "App\Http\Controllers\EmployeeController@index");
Route::post('/employees/create', "App\Http\Controllers\EmployeeController@create");
Route::get('/employees/get/{id}', "App\Http\Controllers\EmployeeController@show");
Route::post('/employees/update', "App\Http\Controllers\EmployeeController@update");
Route::delete('/employees/delete/{id}', "App\Http\Controllers\EmployeeController@destroy");

//Route Pointage------------------------
Route::get('/pointages/allAbs', "App\Http\Controllers\PointageController@indexAfficherAbs");
Route::get('/pointages/all', "App\Http\Controllers\PointageController@index");
Route::get('/pointages/allAbsDate/{date_pointage}', "App\Http\Controllers\PointageController@indexAfficherAbsParDate");
Route::post('/pointages/update', "App\Http\Controllers\PointageController@update");
Route::post('/pointages/create', "App\Http\Controllers\PointageController@create");
Route::delete('/pointages/delete/{id}', "App\Http\Controllers\PointageController@destroy");

//Route TypeMateriel--------------------------
Route::get('/typemarteriels/all', "App\Http\Controllers\ControllerTypeMateriel@index");
Route::post('/typemarteriels/create', "App\Http\Controllers\ControllerTypeMateriel@create");
Route::get('/typemarteriels/get/{id}', "App\Http\Controllers\ControllerTypeMateriel@show");
Route::post('/typemarteriels/update', "App\Http\Controllers\ControllerTypeMateriel@update");
Route::delete('/typemarteriels/delete/{id}', "App\Http\Controllers\ControllerTypeMateriel@destroy");

//Route Materiel-----------------------------
Route::get('materiels/all', "App\Http\Controllers\MaterielController@index");
Route::post('/materiels/create', "App\Http\Controllers\MaterielController@create");
Route::get('/materiels/get/{id}', "App\Http\Controllers\MaterielController@show");
Route::post('/materiels/update', "App\Http\Controllers\MaterielController@update");
Route::delete('/materiels/delete/{id}', "App\Http\Controllers\MaterielController@destroy");

//Route Accident--------------------------------
Route::get('/accidents/all', "App\Http\Controllers\AccidentController@index");
Route::post('/accidents/create', "App\Http\Controllers\AccidentController@create");
Route::get('/accidents/get/{id}', "App\Http\Controllers\AccidentController@show");
Route::post('/accidents/update', "App\Http\Controllers\AccidentController@update");
Route::delete('/accidents/delete/{id}', "App\Http\Controllers\AccidentController@destroy");



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::view('{any}', 'dashboard')
->middleware('auth')
->where('any', '.*');