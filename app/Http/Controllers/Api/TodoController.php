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
        $todoLists = ToDoList::where("deleted_at",'=',null)->orderBy('start_time', 'desc')->get();


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
    // 注意挂起的任务不继续统计时间

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
        // dump($request->todo);
        // echo "editToDoTask";

        ToDoList::where("id",$uuid)
            ->update([
                'list_name'=>$request->todo,
                'updated_at'=>date('Y-m-d H:i:s')
            ]);
        // echo "deleteToDoTask";
        return $this->returnInfo(["info"=>"任务名修改成功"]);
    }

    //// 开始一条TODO任务
    //Route::get('todo/start/{uuid}', 'TodoController@startToDoTask');
    public function startToDoTask($uuid){
        $status = ToDoList::where("id",$uuid)
                    ->get()
                    ->first();

        $starTime = $status->start_time;
        $complete_time = $status->complete_time;


        if(!$starTime && !$complete_time){
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

            return $this->returnInfo(["info"=>"不起作用的，不要再点了"]);  
        }

        // echo "startToDoTask";
    }

    //// 挂起一条TODO任务
    //Route::get('todo/break/{uuid}', 'TodoController@breakToDoTask');
    public function breakToDoTask($uuid, Request $resquest){
        // echo "breakToDoTask";
        $reason = $resquest->reason; // 中断理由

        // 查看当前任务的状态能否中断，即 status 仅为 2 - 进行的情况可以中断   

        $statusId = ToDoList::where("id",$uuid)
            ->get()
            ->first()
            ->status;

        if($statusId == 2){
            // 可以进行中断操作
            WhyStop::insert([
                'list_id'=>$uuid,
                'why_stop'=>$reason,
                'stop_start_time'=>date('Y-m-d H:i:s')
            ]);

            ToDoList::where("id",$uuid)
                ->update([
                    'status'=>3, // 表示暂停
                    'updated_at'=>date('Y-m-d H:i:s')
                ]);

            return $this->returnInfo(["info"=>"中断成功，干其他事去吧，别拖延纳"]);

        }else{
            return $this->returnInfo(["info"=>"中断不了，无能为力"]);

        }    
            
        // dump($statusId);
        // dump($uuid);

    }

    //// 继续一条TODO任务
    //Route::get('todo/continue/{uuid}', 'TodoController@continueToDoTask');
    public function continueToDoTask($uuid){
        // echo "continueToDoTask";
        // dd($uuid);
        $statusId = ToDoList::where("id",$uuid)
            ->get()
            ->first()
            ->status;

        if($statusId == 3){
            // 可以进行继续操作
            $id = WhyStop::where("list_id",$uuid)->orderBy('id','desc')->get()->first()->id;

            WhyStop::where("id",$id)->update([
                "stop_stop_time"=>date('Y-m-d H:i:s')
            ]);


            ToDoList::where("id",$uuid)
                ->update([
                    'status'=>2, // 表示可再继续
                    'updated_at'=>date('Y-m-d H:i:s')
                ]);

            return $this->returnInfo(["info"=>"欢迎回来"]);

        }else{
            return $this->returnInfo(["info"=>"回来不了了，恢复异常，滋滋~"]);

        }  


    }

    //// 完成一条TODO任务
    //Route::get('todo/done/{uuid}', 'TodoController@doneToDoTask');
    public function doneToDoTask($uuid){
        $res = ToDoList::where("id",$uuid)
            ->get()
            ->first()
            ->complete_time;

        if(!$res){
            $updateStatus = ToDoList::where("id",$uuid)
                ->update([
                    'status'=>4, // 表示结束
                    'complete_time'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s')
                ]);

            return $this->returnInfo(["info"=>"完成任务Done！！！！"]);
        }else{
            return $this->returnInfo(["info"=>"没有任务了！！！！"]);

        }
    }


}