<?php
/**
 * Created by PhpStorm.
 * User: guoyongjian
 * Date: 18/4/1
 * Time: 下午11:43
 */

$serv = new swoole_websocket_server('0.0.0.0',9501);

//建立连接
$serv->on('open',function($ws,$request){
    echo 'connect success' . PHP_EOL;
    $ws->push($request->fd,'welcome' . PHP_EOL);
});

//接收数据
$serv->on('message',function($ws,$request){
    echo 'MESSAGE : ' . $request->data . PHP_EOL;
    $ws->push($request->fd,'get it message' . PHP_EOL);
});

//关闭连接
$serv->on('close',function($ws,$request){
    echo 'close' . PHP_EOL;
});

//启动websocket
$serv->start();