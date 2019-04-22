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

Auth::routes();

Route::get('/pdf/upload', 'PDFController@index')->name('pdfUpload');
Route::post('/pdf/upload', 'PDFController@uploadPDF')->name('pdfUpload');

Route::get('/pdf/list', 'PDFController@listPdf')->name('listPdf');

Route::get('/pdf/{id}', 'PDFController@show')->name('showPdf');

Route::get('/home', 'HomeController@index')->name('home');