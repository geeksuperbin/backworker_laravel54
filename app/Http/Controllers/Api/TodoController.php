<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


// 使用ORM
use App\ToDoList;
use App\WhyStop;

class TodoController extends Controller{

    //// 获取TODO任务列表
    //Route::get('todo', 'TodoController@getToDoList');
    public function getToDoList(){
        $todoLists = ToDoList::all();
        dd($todoLists);
  
    }


    //// 添加一条TODO任务
    //Route::post('todo','TodoController@insertToDoTask');
    public function insertToDoTask(Request $resquest){
        // dd($resquest->all());
        $listName = $resquest->list_name;
        $a = ToDoList::insert([
            "id"=>uuid2(),
            "list_name"=>$listName,
            "status"=> 1, // 1 是未开始、2表示进行中 3 表示暂停 4 表示结束
            "spend_time" =>0, // 单位是分钟
            "stop_count"=>0,
            "created_at"=> date('Y-m-d H:i:s'),
        ]);
        
        return $this->returnInfo(["info"=>"任务添加成功"]);        

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