<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TodoController extends Controller{

    //// 获取TODO任务列表
    //Route::get('todo', 'TodoController@getToDoList');
    public function getToDoList(){
        echo "getToDoList";
    }


    //// 添加一条TODO任务
    //Route::post('todo','TodoController@insertToDoTask');
    public function insertToDoTask(Request $resquest){
        dump($resquest->todo);
        echo "insertToDoTask";
    }

    //// 删除一条TODO任务
    //Route::delete('todo/{uuid}','TodoController@deleteToDoTask');
    public function deleteToDoTask($uuid){
        echo "deleteToDoTask";
    }


    //// 修改一条TODO任务
    //Route::put('todo/{uuid}','TodoController@editToDoTask');
    public function editToDoTask(Request $request, $uuid){
        dump($request->todo);
        echo "editToDoTask";
    }

    //// 开始一条TODO任务
    //Route::get('todo/start/{uuid}', 'TodoController@startToDoTask');
    public function startToDoTask($uuid){
        echo "startToDoTask";
    }

    //// 挂起一条TODO任务
    //Route::get('todo/break/{uuid}', 'TodoController@breakToDoTask');
    public function breakToDoTask($uuid){
        echo "breakToDoTask";

    }

    //// 继续一条TODO任务
    //Route::get('todo/continue/{uuid}', 'TodoController@continueToDoTask');
    public function continueToDoTask($uuid){
        echo "continueToDoTask";
    }

    //// 完成一条TODO任务
    //Route::get('todo/done/{uuid}', 'TodoController@doneToDoTask');
    public function doneToDoTask($uuid){
        echo "doneToDoTask";
    }


}