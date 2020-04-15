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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Con esta ruta estamos estableciendo el recurso con el que vamos a consumir nuestra API
//Hacemos la autenticación hacia nuestra api mediante un token

Route::apiResource('workposition', 'Api\WorkPositionController')->middleware('auth:api');



// Route::apiResource('post', 'Api\PostController')->middleware('auth:api');

