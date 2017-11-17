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

//Post http request for registering the users.
Route::post('/register',[
    'uses'=>'UserController@postUser'
]);

//Post http request for signing in the user and getting the token.
Route::post('/signin',[
    'uses'=>'UserController@signin'
]);

//Get http request for getting the current authenticated user info.
Route::get('/user',[
    'uses'=>'UserController@getCurrentUser',
    'middleware'=>'auth.jwt'
]);

//Get http request for getting all the registered users.
Route::get('/users',[
    'uses'=>'UserController@getUsers',
    'middleware'=>'auth.jwt'
]);

//Get http request for getting one user, given by the id.
Route::get('/users/{id}',[
    'uses'=>'UserController@getUser',
    'middleware'=>'auth.jwt'
]);

//Get http request for getting all players per a game.
Route::get('/players/{game}',[
    'uses'=>'GamerinfoController@getPlayerPerGame',
    'middleware'=>'auth.jwt'
]);

//Post http request for adding a new player account.
Route::post('/player',[
    'uses'=>'GamerinfoController@newPlayer',
    'middleware'=>'auth.jwt'
]);

Route::get('/games',[
    'uses'=>'GameController@getGameNames',
    'middleware'=>'auth.jwt'
]);
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
