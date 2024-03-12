<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
  Route::get('/symptoms/load-more', 'App\Http\Services\SymptomsService@loadMoreData')->name('symptoms.load-more');
  Route::resource('symptoms', 'App\Http\Controllers\SymptomsController');
  Route::get('/', 'App\Http\Controllers\HomeController@index')->name('index');
});

Route::get('/registration', function () {
  return view('pages.registration');
})->name('registration');
Route::post('/user-create', 'App\Http\Controllers\AuthController@register')->name('user-create');

Route::get('/login-page', function () {
  return view('pages.authorization');
})->name('login-page');
Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login');
Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');
