<?php
/**
 * Created by PhpStorm.
 * User: guoyongjian
 * Date: 18/4/1
 * Time: 下午10:33
 */

$server = new swoole_http_server('0.0.0.0',9501);

$server->on('request',function($request,$response){
    var_dump($request);
    $response->header('Content-type','text/html;charset=utf-8');
    $response->end('hello' . rand(1,999));
});
$server->start();
