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

Route::apiResource('cemetery', 'CemeteryController')->except(['show']);
Route::apiResource('deceased', 'DeceasedController')->except(['show']);
Route::apiResource('relative', 'RelativeController')->except(['show']);
Route::apiResource('pavilion', 'PavilionController')->except(['show']);

Route::apiResource('niche', 'NicheController');
Route::apiResource('mausoleum', 'MausoleumController');

Route::apiResource('niches/inhumation', 'InhumationNicheController')->names([
    
    'index'   => 'niche.inhumation.index',
    'store'   => 'niche.inhumation.store',
    'update'  => 'niche.inhumation.update',
    'destroy' => 'niche.inhumation.destroy'

])->except(['show']);

Route::apiResource('mausoleums/inhumation', 'InhumationMausoleumController')->names([
    
    'index'   => 'mausoleum.inhumation.index',
    'store'   => 'mausoleum.inhumation.store',
    'update'  => 'mausoleum.inhumation.update',
    'destroy' => 'mausoleum.inhumation.destroy'

])->except(['show']);

Route::apiResource('niches/exhumation', 'ExhumationNicheController')->names([
    
    'index'   => 'niche.exhumation.index',
    'store'   => 'niche.exhumation.store',
    'update'  => 'niche.exhumation.update',
    'destroy' => 'niche.exhumation.destroy'

])->except(['show']);

Route::apiResource('mausoleums/exhumation', 'ExhumationMausoleumController')->names([
    
    'index'   => 'mausoleum.exhumation.index',
    'store'   => 'mausoleum.exhumation.store',
    'update'  => 'mausoleum.exhumation.update',
    'destroy' => 'mausoleum.exhumation.destroy'

])->except(['show']);

Route::prefix('api')->group( function () {

    Route::get('pavilion', 'PavilionController@get');
    Route::get('deceased', 'DeceasedController@get');
    Route::get('relative', 'RelativeController@get');

    Route::get('niche', 'NicheController@get');
    Route::get('mausoleum', 'MausoleumController@get');

    Route::get('niches/inhumation', 'InhumationNicheController@get');
    Route::get('mausoleums/inhumation', 'InhumationMausoleumController@get');
});