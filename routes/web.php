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

Route::get('/search', 'HomeController@index')->name('home');

Route::get('/search/endpoint','HomeController@searchEndpoint');
Route::get('/document','HomeController@serveDocument');

Route::get('/alldocuments','HomeController@getCustomDocumentLists');
Route::post('/alldocsendpoint','HomeController@allDocsEndpoint');
Route::get('/alldocsendpoint','HomeController@allDocsEndpoint');