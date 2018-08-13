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

Route::group(['middleware' => 'api'], function(){
  // Classes
  Route::resource('classes','ClassesController');
  // Especialidades
  Route::resource('especialidades','EspecialidadesController');
  // Herois
  Route::resource('herois','HeroisController');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
