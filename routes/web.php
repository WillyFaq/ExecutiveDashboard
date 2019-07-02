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
Route::get('/sdm/profil/{judul}/{nilai}', 'SdmController@detail');
Route::get('/sdm/beban_kerja', 'SdmController@beban_kerja');
Route::get('/sdm/produktivitas', 'SdmController@produktivitas');
Route::get('/sdm/list_dosen', 'SdmController@list_dosen');
//Route::get('/sdm/list_dosen_detail', 'SdmController@list_dosen_detail');
Route::get('/sdm/list_dosen_detail/{id}', 'SdmController@list_dosen_detail');
Route::get('/sdm/list_dosen_filter/{id}', 'SdmController@list_dosen_filter');

Route::get('/sdm/dosen', 'SdmController@dosen');
Route::get('/sdm/detail_ajax/{type}', 'SdmController@detail_ajax')->name('sdm.detail_ajax');;
Route::get('/sdm/dosen_document', 'SdmController@dosen_document')->name('sdm.dosen_document');;
Route::get('/sdm/dosen_detail', 'SdmController@dosen_detail');

Route::get('/pendidikan', 'PendidikanController@index');
Route::get('/pendidikan/{kode_prodi}', 'PendidikanController@detail');
/*Route::get('/', function () {
    return view('home');
});*/

