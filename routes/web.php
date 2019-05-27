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

Route::get('/', 'HomeController@index');

Route::get('/sdm', 'SdmController@index');
Route::get('/sdm/profil', 'SdmController@profil');
Route::get('/sdm/profil/{judul}/{nilai}', 'SdmController@profil');
Route::get('/sdm/beban_kerja', 'SdmController@beban_kerja');
Route::get('/sdm/produktivitas', 'SdmController@produktivitas');

Route::get('/pendidikan', 'PendidikanController@index');
/*Route::get('/', function () {
    return view('home');
});*/
