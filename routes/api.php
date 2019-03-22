<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Router;

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

Route::prefix('auth')->group(function($router) {
    $router->post('login', 'AuthController@login');
    $router->any('CountDown', 'ExaminationController@CountDown');
    $router->post('QuestionsData', 'ExaminationController@QuestionsData');
    $router->post('ScoreStats', 'ExaminationController@ScoreStats');
    $router->post('Personal', 'AuthController@Personal');
    $router->get('ExamTitle', 'ExaminationController@ExamTitle');
    $router->post('FeekBack', 'ExaminationController@FeekBack');
    $router->post('Collection', 'ExaminationController@Collection');
    $router->post('SearchCollect', 'ExaminationController@SearchCollect');
    $router->post('DelectCollect', 'ExaminationController@DelectCollect');
});

