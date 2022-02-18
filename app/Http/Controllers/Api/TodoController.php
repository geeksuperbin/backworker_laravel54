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

        // 任务花费时间统计
        $this->spendTime();

        // $todoLists = ToDoList::all();

        // 排除软删除的元素
        $todoLists = ToDoList::where("deleted_at",'=',null)->get();


        // 元素个数
        $num = count($todoLists);
        // 转化为json
        // $data = $todoLists->toJson();
        
        // json 校验：https://www.bejson.com/explore/index_new/
        return $this->returnInfo([
            "total"=>$num,
            "items"=>$todoLists
        ]);        

      
    }

    // 统计任务分钟用时
    public  function spendTime(){

        $todoLists = ToDoList::all();

        // 计算任务分钟用时

        $collectionData = $todoLists->reject(function ($item) {
            return $item->start_time == false || $item->complete_time != false || $item->deleted_at != false ; // 过滤掉没有start_time 值的集合元素,或者清单任务完成的项,或者已删除的
        })
        ->map(function ($item) {

            $nowDate = date('Y-m-d H:i:s');
            
            return 
            [

                    $item->id, // 任务id
                    $item->start_time, // 开始时间
                    floor((strtotime($nowDate)-strtotime($item->start_time))%86400/60) // 
            ]; // 返回带有 start_time 的 item 集合项
        });

        // 批量更新任务
        foreach ($collectionData as $data) {
            $uuid = $data[0];
            $start_time = $data[1];
            $spend_time = $data[2];

            ToDoList::where("id",$uuid)
                ->update([
                    'spend_time'=>$spend_time
                ]);
        }


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
        ToDoList::where("id",$uuid)
            ->update([
                'deleted_at'=>date('Y-m-d H:i:s')
            ]);
        // echo "deleteToDoTask";
        return $this->returnInfo(["info"=>"任务删除成功"]);
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
        $starTime = ToDoList::where("id",$uuid)
                    ->get()
                    ->first()
                    ->start_time;

        // dd($starTime);

        if(!$starTime){
            // dd(111);

            $updateStatus = ToDoList::where("id",$uuid)
                ->update([
                    'status'=>2, // 表示开始
                    'start_time'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s')
                ]);

            return $this->returnInfo(["info"=>"开始愉快的工作了"]);

        }else{
            // dd(222);

            return $this->returnInfo(["info"=>"任务已经开始了，不要再点了"]);  
        }

        // echo "startToDoTask";
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