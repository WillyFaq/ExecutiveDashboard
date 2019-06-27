<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');
Route::get('/nilai_pt_historik', 'HomeController@getNilaiPerguruanTinggi');
Route::group(['prefix' => '/sdm/dosen/{prodi}'], function(){
    Route::get('sertifikasi', 'SdmController@getDosenProdiSertifikasi');
    Route::get('jafung', 'SdmController@getDosenProdiJafung');
});
