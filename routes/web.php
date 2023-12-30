<?php

use Illuminate\Support\Facades\Route;

// Top
Route::get('/', function () {
    return view('pages.top');
})->middleware('auth')->name('top');

// Pages
Route::middleware('auth')->group(function (){

    // Additonal pages
    Route::get('department/chart','App\Http\Controllers\DepartmentController@chart')->name('department.chart');
    Route::group(['prefix' => 'develop', 'as' => 'develop.'],function (){
        Route::get('sql','App\Http\Controllers\DevelopController@sql')->name('sql.get');
        Route::post('sql','App\Http\Controllers\DevelopController@sqlExecute')->name('sql.post');
    });


    // Basic resouces
    Route::resource('account', 'App\Http\Controllers\AccountController');


    // Device resouces
    Route::resource('desktop_pc', 'App\Http\Controllers\DesktopPcController');
    Route::resource('laptop_pc', 'App\Http\Controllers\LaptopPcController');
    Route::resource('mobile_phone', 'App\Http\Controllers\MobilePhoneController');


    // Manage resouces
    Route::resource('mailing_list', 'App\Http\Controllers\MailingListController');
    Route::resource('bc_route', 'App\Http\Controllers\BcRouteController');
    Route::resource('department', 'App\Http\Controllers\DepartmentController');

});


require __DIR__.'/auth.php';
