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
