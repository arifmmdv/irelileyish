<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Section
Route::get('/{locale}/section/{slug}', '\App\Http\Controllers\ApiController@section');
// Sections
Route::get('/{locale}/sections/{slug}', '\App\Http\Controllers\ApiController@sections');
// Section Children
Route::get('/{locale}/children/{slug}', '\App\Http\Controllers\ApiController@children');

// Update sections to section_type slug