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

Route::get('/clients', 'clientsController@show')->name('clients');
Route::post('/addclientform', 'clientsController@store')->name('client.store');
Route::post('/updateClient', 'clientsController@update')->name('client.update');
Route::post('/deleteClient', 'clientsController@delete');
Route::get('/getClient', 'clientsController@fetchClient');


Route::get('/userservecies/{id}', 'servicesController@getServicesByUserId');
Route::post('/addService', 'servicesController@store')->name('service.store');
Route::post('/updateService', 'servicesController@update')->name('service.update');
Route::post('/deleteService', 'servicesController@delete');
Route::get('/getService', 'servicesController@fetchService');