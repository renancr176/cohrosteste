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
    Route::get('contact', ['as' => 'contact', 'uses' => 'AddressBookController@index']);
    Route::get('contact/create', ['as' => 'contact.create', 'uses' => 'AddressBookController@create']);
    Route::post('contact/create', ['as' => 'contact.store', 'uses' => 'AddressBookController@store']);
    Route::get('contact/{id}/show', ['as' => 'contact.show', 'uses' => 'AddressBookController@show']);
    Route::get('contact/{id}/edit', ['as' => 'contact.edit', 'uses' => 'AddressBookController@edit']);
    Route::post('contact/{id}/edit', ['as' => 'contact.update', 'uses' => 'AddressBookController@update']);
    Route::post('contact/{id}', ['as' => 'contact.destroy', 'uses' => 'AddressBookController@destroy']);
    
});


Route::get('/home', 'HomeController@index');
