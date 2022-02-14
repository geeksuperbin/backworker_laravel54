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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
