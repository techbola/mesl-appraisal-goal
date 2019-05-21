<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/employees', function (Request $request) {
    return \Cavi\Staff::all();
});


Route::get('/dev-clean',    function (){
    Artisan::call('clear:config');
    Artisan::call('route:config');
    Artisan::call('view:config');
    Artisan::call('cache:config');
});

Route::post('add_hmo', 'SetupController@add_hmo')->name('add_hmo');

Route::post('add_hmo_plan', 'SetupController@add_hmo_plan')->name('add_hmo_plan');

Route::post('add_bank', 'SetupController@add_bank')->name('add_bank');

Route::post('add_pfa', 'SetupController@add_pfa')->name('add_pfa');

Route::post('add_travel_purpose', 'SetupController@add_travel_purpose')->name('add_travel_purpose');

Route::post('add_travel_mode', 'SetupController@add_travel_mode')->name('add_travel_mode');

Route::post('add_travel_lodge', 'SetupController@add_travel_lodge')->name('add_travel_lodge');

Route::post('add_travel_transport', 'SetupController@add_travel_transport')->name('add_travel_trnasport');

Route::post('add_level', 'SetupController@add_level')->name('add_level');

Route::post('add_policy', 'SetupController@add_policy')->name('add_policy');

Route::post('add_department', 'SetupController@add_department')->name('add_department');

Route::post('add_staff_type', 'SetupController@add_staff_type')->name('add_staff_type');

Route::post('add_expense_request', 'SetupController@add_expense_request')->name('add_expense_request');
