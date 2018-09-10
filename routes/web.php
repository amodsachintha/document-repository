<?php


// EMAIL - secretary@divisional.lk


Route::get('/', 'DocumentController@index');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/search', 'HomeController@index')->name('home');

Route::get('/search/endpoint', 'HomeController@searchEndpoint');
Route::get('/document', 'HomeController@serveDocument');


//Route::get('/alldocuments', 'HomeController@getCustomDocumentLists');
//Route::get('/alldocsendpoint', 'HomeController@allDocsEndpoint');
// NO Login for viewing //
Route::get('/alldocuments', 'DocumentController@getCustomDocumentLists');
Route::get('/alldocsendpoint', 'DocumentController@allDocsEndpoint');


//Add
Route::get('/add', 'HomeController@showAddDocument');
Route::post('/add', 'HomeController@addDocument');

//Destroy
Route::get('/deletedocument', 'HomeController@deleteDocument');

//Lendings
Route::get('/lendings', 'HomeController@showLendings');
Route::get('/lendings/return', 'HomeController@returnDocument');
Route::get('/lendings/add', 'HomeController@addIndividualLendShow');
Route::post('/lendings/add', 'HomeController@addIndividualLend');
Route::get('/lendings/archive', 'HomeController@showArchive');


// PROFILE
Route::get('/profile', 'HomeController@showProfile');
Route::post('/profile/password', 'HomeController@changePassword');


// DELETE
Route::get('/purge', 'HomeController@purgeDocument');