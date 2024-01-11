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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index');
    Route::get('/home','HomeController@index');
});

Route::get('/supplier', 'SupplierController@index');
Route::post('new_supplier', 'SupplierController@create');
Route::post('update_supplier/{id}', 'SupplierController@update');
Route::get('status/{id}', 'SupplierController@status');

Route::get('/cott', 'CottController@index');
Route::get('cott/create', 'CottController@create');
Route::post('/submitData', 'CottController@submitData');
Route::post('updateStatus', 'CottController@updateStatus');
Route::post('add_comments/{id}', 'CottController@addComments');
Route::get('/filter', 'CottController@filter');
Route::get('/export_cott_pdf', 'CottController@export_cott_pdf')->name('export_cott_pdf');

Route::get('/spi', 'SpiController@index');
Route::get('spi/create', 'SpiController@create');
Route::post('spi/submitData', 'SpiController@submitData');
Route::post('spi/updateStatus', 'SpiController@updateStatus');
Route::post('add_comments/{id}', 'SpiController@addComments');
Route::get('/filterSpi', 'SpiController@filterSpi');
Route::get('/export_spi_pdf', 'SpiController@export_spi_pdf')->name('export_spi_pdf');

Route::get('/user', 'UserController@index');
Route::post('new_user', 'UserController@create');
Route::get('users/delete/{id}', 'UserController@delete')->name('users.delete');