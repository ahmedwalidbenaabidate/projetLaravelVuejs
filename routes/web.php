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

//Route AffectationMateriel-----------------------------------
Route::get('/affectationMateriels/all', "App\Http\Controllers\AffectationMaterielController@index");
Route::post('/affectationMateriels/create', "App\Http\Controllers\AffectationMaterielController@create");
Route::get('/affectationMateriels/get/{id}', "App\Http\Controllers\AffectationMaterielController@show");
Route::post('/affectationMateriels/update', "App\Http\Controllers\AffectationMaterielController@update");
Route::delete('/affectationMateriels/delete/{id}', "App\Http\Controllers\AffectationMaterielController@destroy");

//Route Depense-----------------------
Route::get('/depenses/all', "App\Http\Controllers\DepenseController@index");
Route::post('/depenses/create', "App\Http\Controllers\DepenseController@create");
Route::get('/depenses/get/{id}', "App\Http\Controllers\DepenseController@show");
Route::post('/depenses/update', "App\Http\Controllers\DepenseController@update");
Route::delete('/depenses/delete/{id}', "App\Http\Controllers\DepenseController@destroy");

//Route Carburant----------------------------------------
Route::get('/carburants/all', "App\Http\Controllers\CarburantController@index");
Route::post('/carburants/create', "App\Http\Controllers\CarburantController@create");
Route::get('/carburants/get/{id}', "App\Http\Controllers\CarburantController@show");
Route::post('/carburants/update', "App\Http\Controllers\CarburantController@update");
Route::delete('/carburants/delete/{id}', "App\Http\Controllers\CarburantController@destroy");

//Route Administratif-------------------------------------
Route::get('/administratifs/all', "App\Http\Controllers\AdministratifController@index");
Route::post('/administratifs/create', "App\Http\Controllers\AdministratifController@create");
Route::get('/administratifs/get/{id}', "App\Http\Controllers\AdministratifController@show");
Route::post('/administratifs/update', "App\Http\Controllers\AdministratifController@update");
Route::delete('/administratifs/delete/{id}', "App\Http\Controllers\AdministratifController@destroy");


//Route Stats
Route::get('/stats/get/', "App\Http\Controllers\statsController@index");

//Route User----------------------------------------
Route::get('/users/all', "App\Http\Controllers\UserController@index");
Route::post('/users/create', "App\Http\Controllers\UserController@create");
Route::get('/users/get/{id}', "App\Http\Controllers\UserController@show");
Route::post('/users/update', "App\Http\Controllers\UserController@update");
Route::delete('/users/delete/{id}', "App\Http\Controllers\UserController@destroy");



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::view('{any}', 'dashboard')
->middleware('auth')
->where('any', '.*');