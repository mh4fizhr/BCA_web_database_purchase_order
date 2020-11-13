<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/backend/po/update/{id}', 'ApiController@update_po');
Route::post('/backend/po/tgl/update/{id}', 'ApiController@update_tgl_po');
Route::post('/backend/po/service/update/{id}', 'ApiController@update_service');
Route::post('/backend/po/mcu/update/{id}', 'ApiController@update_mcu');

Route::post('/backend/driver/update/{id}', 'ApiController@update_driver');
Route::post('/backend/driver/pkwt/update/{id}', 'ApiController@update_pkwt');

Route::post('/backend/mobil/update/{id}', 'ApiController@update_mobil');

Route::post('/backend/ump/update/{id}', 'ApiController@update_ump');

Route::post('/backend/user/update/{id}', 'ApiController@update_user');

Route::post('/backend/ump/kota/update/{id}', 'ApiController@update_kota');

Route::post('/backend/ump/jkk/update/{id}', 'ApiController@update_jkk');
