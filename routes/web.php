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
    return view('index');
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