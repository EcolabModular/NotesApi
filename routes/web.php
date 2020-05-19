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

$router->get('/notes', 'NoteController@index');
$router->get('/itemnotes/{item}', 'NoteController@notesItem');
$router->post('/notes', 'NoteController@store');
$router->get('/notes/{note}', 'NoteController@show');
$router->put('/notes/{note}', 'NoteController@update');
$router->patch('/notes/{note}', 'NoteController@update');
$router->delete('/notes/{note}', 'NoteController@destroy');
