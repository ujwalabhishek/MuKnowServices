<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
/** 
// API route group
$router->group(['prefix' => 'api'], function () use ($router) {
    // Matches "/api/register
	$router->post('register', 'AuthController@register');
   
    // Matches "/api/login
    //$router->post('login', 'AuthController@login');

    // Matches "/api/profile
    $router->get('profile', 'UserController@profile');

    // Matches "/api/users/1 
    //get one user by id
    $router->get('users/{id}', 'UserController@singleUser');

    // Matches "/api/users
    $router->get('users', 'UserController@allUsers');
});

$router->post('/auth/login', 'AuthController@login');
 */
/**
 * User credentials protected routes

$router->group(['middleware' => 'auth:api'], function () use ($router) {
    $router->get('/auth/me', 'AuthController@me');
});
 */
//$router->group(['prefix' => 'api'], function () use ($router) {
  //$router->get('lesson',  ['uses' => 'HomeController@showAllLessons']);

  //$router->get('authors/{id}', ['uses' => 'AuthorController@showOneAuthor']);

  //$router->post('authors', ['uses' => 'AuthorController@create']);

  //$router->delete('authors/{id}', ['uses' => 'AuthorController@delete']);

  //$router->put('authors/{id}', ['uses' => 'AuthorController@update']);
//});

//$router->get('lesson','HomeController@showAllLessons');

//$router->get('lesson/{id}','HomeController@showLessonData');

$router->get('test','HomeController@index');