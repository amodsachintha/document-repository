<?php


Route::get('/', function () {
    return view('index2');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/search', 'HomeController@index')->name('home');

Route::get('/search/endpoint', 'HomeController@searchEndpoint');
Route::get('/document', 'HomeController@serveDocument');

Route::get('/alldocuments', 'HomeController@getCustomDocumentLists');
Route::get('/alldocsendpoint', 'HomeController@allDocsEndpoint');

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