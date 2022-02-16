<?php



/* 生成唯一标志
* 标准的UUID格式为：xxxxxxxx-xxxx-xxxx-xxxxxx-xxxxxxxxxx(8-4-4-4-12)
* 来源：https://www.cnblogs.com/tine/p/9316509.html 
*/

function  uuid()  
{  
    $chars = md5(uniqid(mt_rand(), true));  
    $uuid = substr ( $chars, 0, 8 ) . '-'
            . substr ( $chars, 8, 4 ) . '-' 
            . substr ( $chars, 12, 4 ) . '-'
            . substr ( $chars, 16, 4 ) . '-'
            . substr ( $chars, 20, 12 );  
    return $uuid ;  
} 


function uuid2()
{
    $r = substr(get_hash(),0,36);
    return $r;
}

/**
 * 获取当前的格式化的时间，用于做任务名称前缀
 * @return false|string
 */
function get_time()
{
    $t = date("Y_m_d_Hms",time());
    return $t;
}



/**
 * 随机字符串
 *
 * @return string
 */
function get_hash(){
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()+-';
    $random = $chars[mt_rand(0,73)].$chars[mt_rand(0,73)].$chars[mt_rand(0,73)].$chars[mt_rand(0,73)].$chars[mt_rand(0,73)];//Random 5 times
    $content = uniqid().$random;  // 类似 5443e09c27bf4aB4uT
    return sha1($content);
}