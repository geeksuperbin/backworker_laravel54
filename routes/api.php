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
| 您可以在此处为您的应用程序注册 API 路由。 这些
| 路由由 RouteServiceProvider 在一个组内加载
| 被分配了“api”中间件组。 享受构建您的 API 的乐趣！
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::get('fei', 'FeiController@index');


// // 192.168.0.222:9999/api/hello
// Route::get('/hello',function(){
//     return 'world';
// });

// 获取TODO任务列表
Route::get('todo', 'TodoController@getToDoList');
// 添加一条TODO任务
Route::post('todo','TodoController@insertToDoTask');
// 删除一条TODO任务
Route::delete('todo/{uuid}','TodoController@deleteToDoTask');
// 修改一条TODO任务
Route::put('todo/{uuid}','TodoController@editToDoTask');
// 开始一条TODO任务
Route::get('todo/start/{uuid}', 'TodoController@startToDoTask');
// 挂起一条TODO任务
Route::put('todo/break/{uuid}', 'TodoController@breakToDoTask');
// 继续一条TODO任务
Route::get('todo/continue/{uuid}', 'TodoController@continueToDoTask');
// 完成一条TODO任务
Route::get('todo/done/{uuid}', 'TodoController@doneToDoTask');


// 登录
Route::post('user/login', 'UserController@login');
// 获取 token
// /user/info?token=admin-token
Route::get('/user/info', 'UserController@getToken');
// Route::post('/user/info', 'UserController@getToken');

// 退出
Route::post('/user/logout', 'UserController@logout');


