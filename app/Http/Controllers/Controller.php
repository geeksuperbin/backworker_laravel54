<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * 返回客户端结果
     *
     * @param $data
     * @return mixed
     */
    protected function returnInfo($data = null,$code=20000)
    {
        $arr = array(
            'code' => $code,
        );

        if ($data) {
            $add = ['data' => $data];
            $arr = array_merge($arr, $add);
        }

        return $arr;
    }

}
