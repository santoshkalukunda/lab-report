<?php

use App\Http\Controllers\FilterController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TestreportController;
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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	Route::resource('organizations', OrganizationController::class)->only(['index', 'store']); 
	Route::resource('patients', PatientController::class); 
	Route::resource('tests', TestController::class); 
	Route::get('testreports', [TestreportController::class,'index'])->name('testreports.index');
	Route::post('testreports/{patient}', [TestreportController::class,'store'])->name('testreports.store');
	Route::delete('testreports/{testreport}', [TestreportController::class,'destroy'])->name('testreports.destroy');
	Route::get('test-report-pdf/{patient}', [PDFController::class,'testReport'])->name('test-reports-pdf');
	Route::get('filter-patients', [FilterController::class,'filterPatient'])->name('filter-patient');
	Route::get('pdf-patients', [FilterController::class,'PDFPatient'])->name('pdf-patient');
});

