<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToDoList extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    public $table = "todo_list";

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;



    /**
     * 数据库字段黑名单(不能被批量赋值的属性)
     *
     * @var array
     */
    public $guarded = [];

    /*
     * 使用非递增或者非数字的主键 
     */
    public  $incrementing = false;

}
