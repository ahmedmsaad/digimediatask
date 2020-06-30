<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/clients', 'ClientsController@show')->name('clients')->middleware('auth');;
Route::post('/addclientform', 'ClientsController@store')->name('client.store');
Route::post('/updateClient', 'ClientsController@update')->name('client.update');
Route::post('/deleteClient', 'ClientsController@delete');
Route::get('/getClient/{id}', 'ClientsController@fetchClient');

 
Route::get('/userservecies/{id}', 'ServicesController@getServicesByUserId');
Route::post('/addService', 'ServicesController@store')->name('service.store');
Route::post('/updateService', 'ServicesController@update')->name('service.update');
Route::get('/deleteService/{id}', 'ServicesController@delete');
Route::get('/getService/{id}', 'ServicesController@fetchService');
Route::get('/services', 'ServicesController@show')->name('services')->middleware('auth');;
