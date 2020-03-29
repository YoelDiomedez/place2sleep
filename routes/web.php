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
Route::get('/choice', 'HomeController@choice')->name('choice');
Route::get('/select/{id}', 'HomeController@select')->name('select');

Route::apiResource('/cemetery', 'CemeteryController')->except(['show']);
Route::apiResource('/deceased', 'DeceasedController')->except(['show']);
Route::apiResource('/relative', 'RelativeController')->except(['show']);

Route::apiResource('/niche', 'NicheController')->except(['show']);
Route::apiResource('/pavilion', 'PavilionController')->except(['show']);
Route::apiResource('/mausoleum', 'MausoleumController')->except(['show']);

Route::prefix('api')->group(function () {
    Route::get('pavilion', 'PavilionController@get');
});