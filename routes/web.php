<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

| 您可以在此处为您的应用程序注册网络路由。 这些
| 路由由 RouteServiceProvider 在一个组内加载
| 包含“web”中间件组。 现在创造一些伟大的东西！
*/

Route::get('/', function () {
    return view('index');
});
