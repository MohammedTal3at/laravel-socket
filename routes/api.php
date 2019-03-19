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


/*get comments*/
Route::get('posts/{post_id}/comments','CommentController@index');

Route::middleware('auth:api')->group(function () {
	/* add comment */
	Route::post('posts/{post_id}/comment','CommentController@store');

});
