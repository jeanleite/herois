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

Route::get('/especialidades', function(){
  return view('especialidades');
});

Route::get('/classes', function(){
  return view('classes');
});

Route::get('/herois', function(){
  return view('herois');
});
