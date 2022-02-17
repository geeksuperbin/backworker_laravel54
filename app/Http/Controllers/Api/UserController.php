<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class UserController extends Controller{


	// 登录
	public function login(Request $request){

		return '{"code":20000,"data":{"token":"admin-token"}}';

	}


	// 获取用户 token 
	// 没做 token 判断，只聚焦todo清单功能
	public function getToken(Request $request){


		return '{"code":20000,"data":{"roles":["admin"],"introduction":"I am a super administrator","avatar":"https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4a.gif","name":"Super Admin"}}';

		
	}


	public function logout(){

		return '{"code":20000,"data":"success"}';
		// {"code":"20000","data":{"info":"\u4efb\u52a1\u6dfb\u52a0\u6210\u529f"}}

	}


}



