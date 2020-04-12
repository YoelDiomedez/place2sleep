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

Route::get('/home', 'HomeController@index')->name('home')->middleware('permission:home');
Route::get('/choice', 'HomeController@choice')->name('choice');
Route::get('/select/{id}', 'HomeController@select')->name('select');

Route::get('search', 'SearchController@index')->name('search');
Route::get('search/niche', 'SearchController@niche');
Route::get('search/mausoleum', 'SearchController@mausoleum');

Route::middleware(['auth'])->group( function () {

    Route::apiResource('cemetery', 'CemeteryController')->except(['show'])->middleware('permission:cemetery');
    Route::apiResource('deceased', 'DeceasedController')->except(['show'])->middleware('permission:deceased');
    Route::apiResource('relative', 'RelativeController')->except(['show'])->middleware('permission:relative');
    Route::apiResource('pavilion', 'PavilionController')->except(['show'])->middleware('permission:pavilion');

    Route::apiResource('niche', 'NicheController')->middleware('permission:niche');
    Route::apiResource('mausoleum', 'MausoleumController')->middleware('permission:mausoleum');

    Route::middleware(['permission:inhumation'])->group( function () {

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

    });

    Route::middleware(['permission:exhumation'])->group( function () {

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

     });

    Route::prefix('api')->group( function () {

        Route::get('pavilion', 'PavilionController@get')->middleware('permission:pavilion');
        Route::get('deceased', 'DeceasedController@get')->middleware('permission:deceased');
        Route::get('relative', 'RelativeController@get')->middleware('permission:relative');

        Route::get('niche', 'NicheController@get')->middleware('permission:niche');
        Route::get('mausoleum', 'MausoleumController@get')->middleware('permission:mausoleum');

        Route::get('niches/inhumation', 'InhumationNicheController@get')->middleware('permission:inhumation');
        Route::get('mausoleums/inhumation', 'InhumationMausoleumController@get')->middleware('permission:inhumation');
    });
});

