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
