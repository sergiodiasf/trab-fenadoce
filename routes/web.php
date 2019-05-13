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

Route::get('/', 'IndexController@listarCandidatas')->name('index.listar');
Route::get('/show-candidata/{id}', 'IndexController@showCandidata')->name('voto-candidata');
Route::post('/insere-voto', 'IndexController@votar')->name('votar');

Route::resource('candidatas', 'CandidataController')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
