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
    $router->get('test', 'AuthController@test');
    $router->post('CountDown', 'ExaminationController@CountDown');
    $router->get('ExamTitle', 'ExaminationController@QuestionsData');
    $router->post('QuestionsData', 'ExaminationController@QuestionsData');
    $router->get('ChoiceJudge', 'ExaminationController@ChoiceJudge');
    $router->post('Charts', 'ExaminationController@Charts');
    $router->get('ScoreStats', 'ExaminationController@ScoreStats');
    $router->get('Personal', 'ExaminationController@Personal');
});

Route::middleware('refresh.token')->group(function($router) {
    $router->get('profile','UserController@profile');
});

Route::group(['middleware'=>'api'],function(){
    Route::any('CountDown',['uses'=>'ExaminationController@CountDown']);
    Route::any('ExamTitle',['uses'=>'ExaminationController@ExamTitle']);
    Route::any('QuestionsData',['uses'=>'ExaminationController@QuestionsData']);
    Route::any('ChoiceJudge',['uses'=>'ExaminationController@ChoiceJudge']);
    Route::any('Charts',['uses'=>'ExaminationController@Charts']);
    Route::any('ScoreStats',['uses'=>'ExaminationController@ScoreStats']);
    Route::any('Personal',['uses'=>'AuthController@Personal']);
});


// 给需要跨域的路由增加cors中间件
Route::group(['middleware' => 'cors'], function(Router $router){
    Route::any('CountDown',['uses'=>'ExaminationController@CountDown']);
    Route::any('ExamTitle',['uses'=>'ExaminationController@ExamTitle']);
    Route::any('QuestionsData',['uses'=>'ExaminationController@QuestionsData']);
    Route::any('ChoiceJudge',['uses'=>'ExaminationController@ChoiceJudge']);
    Route::any('Charts',['uses'=>'ExaminationController@Charts']);

});
