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
Route::post('/upload',array('as' => 'process.upload', 'uses'=>'ProcessController@process_upload'));
Route::post('/uploadAction',array('uses'=>'ProcessController@process_upload'));

//Route::get('/files',array('as' => 'process.show_files', 'uses'=>'ProcessController@show_files'));
Route::get('/showfiles',array('as' => 'cover.show_files', 'uses'=>'CoverController@show_files'));
Route::get('/processed_files',array('as' => 'cover.processed_files', 'uses'=>'CoverController@processed_files'));

Route::get('/test',array('uses'=>'ProcessController@test'));
Route::get('/home',array('uses'=>'HomeController@showWelcome'));

Route::post('/ajaxUserProfile',array('uses'=>'HomeController@ajaxUserProfile'));
Route::post('/ajaxInProgress',array('uses'=>'CoverController@ajaxInProgress'));
Route::get('/ajaxInProgress',array('as' => 'cover.ajaxInProgress', 'uses'=>'CoverController@ajaxInProgress'));

Route::get('/attachments', array('uses'=>'AttachmentsController@index'));

Route::resource('attachments', 'File\AttachmentsController',array('names' => array('index'  => 'file.attachments.index'
                                                                                            ,'create' =>'file.attachments.create'
                                                                                            ,'store'  =>'file.attachments.store'
                                                                                            ,'show'   =>'file.attachments.show'
                                                                                            ,'edit'   =>'file.attachments.edit'
                                                                                            ,'update' =>'file.attachments.update'
                                                                                            ,'destroy'=>'file.attachments.destroy'
                                                                                            )));

Route::resource('attachments', 'AttachmentsController',array('names' => array('index'  => 'attachments.index'
                                                                                            ,'create' =>'attachments.create'
                                                                                            ,'store'  =>'attachments.store'
                                                                                            ,'show'   =>'attachments.show'
                                                                                            ,'edit'   =>'attachments.edit'
                                                                                            ,'update' =>'attachments.update'
                                                                                            ,'destroy'=>'attachments.destroy'
                                                                                            )));