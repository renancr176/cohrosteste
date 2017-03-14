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

Auth::routes();

Route::get('/', ['as' => 'home', function () {
    return view('home');
}]);

Route::group(['namespace' => 'AddressBook'], function () {
    Route::get('agenda', ['as' => 'agenda', 'uses' => 'AddressBookController@index']);
    Route::get('agenda/inserir', ['as' => 'agenda.inserir', 'uses' => 'AddressBookController@create']);
    Route::post('agenda/inserir', ['as' => 'agenda.inserir.store', 'uses' => 'AddressBookController@store']);
    Route::get('agenda/detalhar/{id}', ['as' => 'agenda.detalhar', 'uses' => 'AddressBookController@show']);
    Route::get('agenda/editar/{id}', ['as' => 'agenda.editar', 'uses' => 'AddressBookController@edit']);
    Route::post('/agenda/editar/{id}', ['as' => 'agenda.editar.update', 'uses' => 'AddressBookController@update']);
    //Route::post('/agenda', ['as' => 'agenda.destroy', 'uses' => 'AddressBookController@destroy']);
    
});


Route::get('/home', 'HomeController@index');
