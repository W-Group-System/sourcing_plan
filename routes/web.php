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

    // change password
    Route::get('change_password','HomeController@changePassword')->name('change_password');
    Route::post('change_password','HomeController@updatePassword')->name('update_password');

    // supplier
    Route::get('/supplier', 'SupplierController@index');
    Route::post('new_supplier', 'SupplierController@create');
    Route::post('update_supplier/{id}', 'SupplierController@update');
    Route::get('status/{id}', 'SupplierController@status');

    // cottonii
    Route::get('/cott', 'CottController@index');
    Route::get('cott/create', 'CottController@create');
    Route::get('cott/edit/{id}', 'CottController@edit')->name('cott.edit');
    Route::get('cott/editApproved/{id}', 'CottController@editApproved')->name('cott.editApproved');
    Route::get('cott/editApproved', 'CottController@editMultipleApproved')->name('cott.editMultipleApproved');
    Route::post('update_cott/{id}', 'CottController@update');
    Route::post('update_cotts', 'CottController@updateMultiple');
    Route::post('/submitCott', 'CottController@submitCott');
    Route::post('updateStatusCott', 'CottController@updateStatusCott');
    Route::post('add_comments_cott/{id}', 'CottController@addCommentsCott');
    Route::post('disapproved_comments_cott/{id}', 'CottController@disapprovedComments');
    Route::post('add_demand', 'CottController@add_demand');
    Route::get('/filter', 'CottController@filter');
    Route::get('/export_cott_pdf/{start_date}/{end_date}', 'CottController@export_cott_pdf')->name('export_cott_pdf');
    Route::get('/for_approval_pdf/{start_date}/{end_date}', 'CottController@for_approval_pdf')->name('for_approval_pdf');
    Route::get('/cotts/delete/{id}', 'CottController@delete')->name('cotts.delete');
    Route::get('approvedCott/{id}', 'CottController@approvedCott');
    Route::get('disapprovedCott/{id}', 'CottController@disapprovedCott');
    Route::get('preApprover/{id}', 'CottController@preApprover');
    Route::get('pre_approval_cott/{id}', 'CottController@pre_approval_cott');

    // spinosum
    Route::get('/spi', 'SpiController@index');
    Route::get('spi/create', 'SpiController@create');
    Route::get('spi/edit/{id}', 'SpiController@edit')->name('spi.edit');
    Route::get('spi/editApproved/{id}', 'SpiController@editApproved')->name('spi.editApproved');
    Route::get('spi/editApproved', 'SpiController@editMultipleApproved')->name('spi.editMultipleApproved');
    Route::post('update_spi/{id}', 'SpiController@update');
    Route::post('update_spis', 'SpiController@updateMultiple');
    Route::post('spi/submitData', 'SpiController@submitData');
    Route::post('spi/updateStatus', 'SpiController@updateStatus');
    Route::post('add_comments_spi/{id}', 'SpiController@addCommentsSpi');
    Route::post('disapproved_comments/{id}', 'SpiController@disapprovedComments');
    Route::post('add_demand_spi', 'SpiController@add_demand_spi');
    Route::get('/filterSpi', 'SpiController@filterSpi');
    Route::get('/export_spi_pdf/{start_date}/{end_date}', 'SpiController@export_spi_pdf')->name('export_spi_pdf');
    Route::get('/for_approval_spi/{start_date}/{end_date}', 'SpiController@for_approval_spi')->name('for_approval_spi');
    Route::get('delete/{id}', 'SpiController@delete')->name('spis.delete');
    Route::get('pre_approval_spi/{id}', 'SpiController@pre_approval_spi');
    Route::get('approvedStatus/{id}', 'SpiController@approvedStatus');
    Route::get('disapprovedStatus/{id}', 'SpiController@disapprovedStatus');
    Route::get('preApproverSpi/{id}', 'SpiController@preApproverSpi');  

    // user
    Route::get('/user', 'UserController@index');
    Route::post('new_user', 'UserController@create');
    Route::get('users/delete/{id}', 'UserController@delete')->name('users.delete');

    // upload
    Route::get('/upload', 'UploadController@index');
    Route::post('new_signed', 'UploadController@create');
    Route::get('upload/view/{id}', 'UploadController@view')->name('signeds.view');
    Route::get('upload/delete/{id}', 'UploadController@delete')->name('signeds.delete');

    // Cottonii PO
    Route::get('/cott_po', 'CottPoController@index');
    Route::get('cott_po/create', 'CottPoController@create');
    Route::post('/submitPoCott', 'CottPoController@submitPoCott');
    Route::get('/cott_po/delete/{id}', 'CottPoController@delete')->name('cott_po.delete');
    Route::get('cott_po/edit/{id}', 'CottPoController@edit')->name('cott_po.edit');
    Route::post('update_cott_po/{id}', 'CottPoController@update');

    // Spinosum PO
    Route::get('/spi_po', 'SpiPoController@index');
    Route::get('spi_po/create', 'SpiPoController@create');
    Route::post('/submitPoSpi', 'SpiPoController@submitPoSpi');
    Route::get('spi_po/edit/{id}', 'SpiPoController@edit')->name('spi_po.edit');
    Route::post('update_spi_po/{id}', 'SpiPoController@update');
    Route::get('/spi_po/delete/{id}', 'SpiPoController@delete')->name('spi_po.delete');

});
