<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/',array('uses'=>'CoverController@index'));
Route::put('/upload',array('uses'=>'ProcessController@upload'));
Route::get('/upload',array('uses'=>'ProcessController@upload'));
Route::post('/upload',array('uses'=>'ProcessController@process_upload'));
Route::get('/files',array('uses'=>'ProcessController@show_files'));
Route::get('/test',array('uses'=>'ProcessController@test'));
