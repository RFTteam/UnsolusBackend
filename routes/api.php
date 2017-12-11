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

/**
 * Post http request for registering the users.
 */
Route::post('/register',[
    'uses'=>'UserController@postUser'
]);

/**
 * Post http request for signing in the user and getting the token.
 */
Route::post('/signin',[
    'uses'=>'UserController@signin'
]);

/**
 * Get http request for getting the current authenticated user's information.
 */
Route::get('/user',[
    'uses'=>'UserController@getCurrentUser',
    'middleware'=>'auth.jwt'
]);

/**
 * Put http request for updating user information.
 */
Route::put('/user',[
    'uses'=>'UserController@updateUser',
    'middleware'=>'auth.jwt'
]);

/**
 * Get http request for getting all the registered users.
 */
Route::get('/users',[
    'uses'=>'UserController@getUsers',
    'middleware'=>'auth.jwt'
]);

/**
 * Get http request for getting one user, given by the id.
 */
Route::get('/users/{id}',[
    'uses'=>'UserController@getUser',
    'middleware'=>'auth.jwt'
]);

/**
 * Put http request for generating a new password for the user.
 */
Route::put('/user/password',[
    'uses'=>'UserController@ResetPassword'
]);

Route::get('/allusers',[
    'uses'=>'UserController@getUsers',
]);

/**
 * Get http request for getting all players per a game.
 */
Route::get('/players/{game}',[
    'uses'=>'GamerinfoController@getPlayerPerGame',
    'middleware'=>'auth.jwt'
]);

/**
 * Post http request for adding a new player account.
 */
Route::post('/player',[
    'uses'=>'GamerinfoController@newPlayer',
    'middleware'=>'auth.jwt'
]);

/**
 * Get http request for getting the current user's player accounts.
 */
Route::get('/myaccounts',[
    'uses'=>'GamerinfoController@getMyPlayers',
    'middleware'=>'auth.jwt'
]);

/**
 * Put http request for updating the player info
 * The player is given by the id.
 */
Route::put('/player/{id}',[
    'uses'=>'GamerinfoController@updatePlayer',
    'middleware'=>'auth.jwt'
]);

/**
 * Delete http request for deleting the player, given by the id.
 */
Route::delete('/player/{id}',[
    'uses'=>'GamerinfoController@deletePlayer',
    'middleware'=>'auth.jwt'
]);
/**
 * Get http request for getting all the players.
 */
Route::get('/players',[
    'uses'=>'GamerinfoController@getAllPlayers',
    'middleware'=>'auth.jwt'
]);

/**
 * Get http request for getting one player, given by the id.
 */
Route::get('/player/{id}',[
    'uses'=>'GamerinfoController@getPlayer',
    'middleware'=>'auth.jwt'
]);


Route::get('/player/language/{id}',[
    'uses'=>'GamerinfoController@getLanguage',
    'middleware'=>'auth.jwt'
]);

Route::get('/player/country/{id}',[
    'uses'=>'GamerinfoController@getCountry',
    'middleware'=>'auth.jwt'
]);

Route::get('/player/email/{id}',[
    'uses'=>'GamerinfoController@getEmail',
    'middleware'=>'auth.jwt'
]);
/**
 * Get http request for getting all games containing their name.
 */
Route::get('/games',[
    'uses'=>'GameController@getGameNames',
    'middleware'=>'auth.jwt'
]);

/**
 * Get http request for getting all countries.
 */
Route::get('/countries',[
    'uses'=>'CountryController@getCountries',
    'middleware'=>'auth.jwt'
]);

/**
 * Get http request for getting all languages.
 */
Route::get('/languages',[
    'uses'=>'LanguageController@getLanguages',
    'middleware'=>'auth.jwt'
]);

/**
 * Post http request for adding a new team.
 */
Route::post('/team',[
    'uses'=>'TeamController@newTeam',
    'middleware'=>'auth.jwt'
]);

/**
 * Delete http request for deleting a team, given by id.
 */
Route::delete('/team/{id}',[
    'uses'=>'TeamController@deleteTeam',
    'middleware'=>'auth.jwt'
]);

/**
 * Get http request for getting all teams.
 */
Route::get('/teams',[
    'uses'=>'TeamController@getTeams',
    'middleware'=>'auth.jwt'
]);

/**
 * Get http request for getting teams by game.
 */
Route::get('/teams/{game}',[
    'uses'=>'TeamController@getTeamsPerGame',
    'middleware'=>'auth.jwt'
]);

/**
 * Get http request for getting the team, given by id.
 */
Route::get('/team/{id}',[
    'uses'=>'TeamController@getTeam',
    'middleware'=>'auth.jwt'
]);

Route::get('/myteams',[
    'uses'=>'TeamController@getMyTeams',
    'middleware'=>'auth.jwt'
]);

/**
 * Post http request for joining the team.
 */
Route::post('/teammember/{id}',[
    'uses'=>'TeammemberController@joinTeam',
    'middleware'=>'auth.jwt'
]);

/**
 * Delete http request for leaving the team.
 */
Route::delete('/teammember/{id}',[
    'uses'=>'TeammemberController@leaveTeam',
    'middleware'=>'auth.jwt'
]);

/**
 * Get http request for getting all teammembers per a team.
 */
Route::get('/teammembers/{id}',[
    'uses'=>'TeammemberController@getPlayersPerTeam',
    'middleware'=>'auth.jwt'
]);
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
