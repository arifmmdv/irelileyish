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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
});

Route::middleware(['auth:sanctum', 'verified'
])->prefix('dashboard')->group(function () {
    Route::resource('/languages', '\App\Http\Controllers\LanguageController');
    Route::resource('/sections', '\App\Http\Controllers\SectionController');
    Route::get('/sections/{id}/create', '\App\Http\Controllers\SectionController@createSub')->name('sections.createSub');
    Route::get('/sections/{id}/deleteImage', '\App\Http\Controllers\SectionController@deleteImage')->name('sections.deleteImage'); 
    Route::get('/sections/{id}/mainImage', '\App\Http\Controllers\SectionController@mainImage')->name('sections.mainImage');
    Route::resource('/templates', '\App\Http\Controllers\TemplateController');
    Route::post('/fields/{id}/create', '\App\Http\Controllers\FieldController@store')->name('templates.storeField');
    Route::resource('/fields', '\App\Http\Controllers\FieldController');
    Route::resource('/section-types', '\App\Http\Controllers\SectionTypeController');
    Route::get('/section-types/{id}/create', '\App\Http\Controllers\SectionTypeController@createSection')->name('section-types.createSection');
});
