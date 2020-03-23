<?php

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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::apiResource('/period', 'PeriodController')->except(['show']);
Route::apiResource('/cemetery', 'CemeteryController')->except(['show']);
Route::apiResource('/deceased', 'DeceasedController')->except(['show']);
Route::apiResource('/relative', 'RelativeController')->except(['show']);
Route::apiResource('/price', 'PriceController')->except(['show']);
