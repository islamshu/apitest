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
Route::group(["prefix" => "v1", "namespace" => "API"], function($router) {

  

    Route::apiResource("slider", "SliderController");
    Route::apiResource("category", "CategoryController");
    Route::apiResource("store", "StoreController");
    Route::get("store_home", "StoreController@index_home");
    Route::apiResource("professional", "ProfessionalController");
    Route::get("professional_home", "ProfessionalController@index_home");
    Route::apiResource("product", "ProductController");

    

});
