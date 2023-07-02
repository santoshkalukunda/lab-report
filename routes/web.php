<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TestreportController;
use App\Http\Controllers\UserController;
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

Route::group(['middleware' => ['role:super-admin']], function () {
	Route::post('users/{user}/change-password', [UserController::class, 'changePassword'])->name('users.changePassword');
    Route::resource('users', 'App\Http\Controllers\UserController');
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    Route::resource('organizations', OrganizationController::class)->only(['index', 'store']);
    Route::resource('patients', PatientController::class);
    Route::resource('categories', CategoryController::class);

    Route::get('tests', [TestController::class, 'index'])->name('tests.index');
    Route::post('tests/{category}', [TestController::class, 'store'])->name('tests.store');
    Route::get('tests/{test}/edit', [TestController::class, 'edit'])->name('tests.edit');
    Route::get('tests/{test}/show', [TestController::class, 'show'])->name('tests.show');
    Route::put('tests/{test}', [TestController::class, 'update'])->name('tests.update');
    Route::delete('tests/{test}', [TestController::class, 'destroy'])->name('tests.destroy');

    Route::get('testreports', [TestreportController::class, 'index'])->name('testreports.index');
    Route::post('testreports/{patient}', [TestreportController::class, 'store'])->name('testreports.store');
    Route::delete('testreports/{testreport}', [TestreportController::class, 'destroy'])->name('testreports.destroy');

    Route::get('test-report-pdf/{patient}', [PDFController::class, 'testReport'])->name('test-reports-pdf');
    Route::get('test-bill-pdf/{patient}', [PDFController::class, 'billView'])->name('test-bill-pdf');

    Route::get('search-patients', [FilterController::class, 'filterPatient'])->name('filter-patient');
    Route::get('pdf-patients', [FilterController::class, 'PDFPatient'])->name('pdf-patient');
    Route::get('search-test-report', [FilterController::class, 'filterTestReport'])->name('filter-test-report');
    Route::get('pdf-test-report', [FilterController::class, 'PDFTestReport'])->name('pdf-test-report');
});

Route::group(['middleware' => ['role:super-admin|user']], function () {
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    // Route::resource('organizations', OrganizationController::class)->only(['index', 'store']);
    Route::resource('patients', PatientController::class)->except('destroy');
    Route::resource('categories', CategoryController::class)->except('destroy');

    Route::get('tests', [TestController::class, 'index'])->name('tests.index');
    Route::post('tests/{category}', [TestController::class, 'store'])->name('tests.store');
    Route::get('tests/{test}/edit', [TestController::class, 'edit'])->name('tests.edit');
    Route::get('tests/{test}/show', [TestController::class, 'show'])->name('tests.show');
    Route::put('tests/{test}', [TestController::class, 'update'])->name('tests.update');
    // Route::delete('tests/{test}', [TestController::class, 'destroy'])->name('tests.destroy');

    Route::get('testreports', [TestreportController::class, 'index'])->name('testreports.index');
    Route::post('testreports/{patient}', [TestreportController::class, 'store'])->name('testreports.store');
    // Route::delete('testreports/{testreport}', [TestreportController::class,'destroy'])->name('testreports.destroy');

    Route::get('test-report-pdf/{patient}', [PDFController::class, 'testReport'])->name('test-reports-pdf');
    Route::get('test-bill-pdf/{patient}', [PDFController::class, 'billView'])->name('test-bill-pdf');

    Route::get('search-patients', [FilterController::class, 'filterPatient'])->name('filter-patient');
    Route::get('pdf-patients', [FilterController::class, 'PDFPatient'])->name('pdf-patient');
    Route::get('search-test-report', [FilterController::class, 'filterTestReport'])->name('filter-test-report');
    Route::get('pdf-test-report', [FilterController::class, 'PDFTestReport'])->name('pdf-test-report');
});
