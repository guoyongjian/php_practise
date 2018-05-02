<?php
/**
 * Created by PhpStorm.
 * User: guoyongjian
 * Date: 18/4/2
 * Time: 上午1:58
 */

$client = new swoole_client(SWOOLE_SOCK_TCP,SWOOLE_SOCK_ASYNC);

//注册成功回调
$client->on('connect',function($cli){
    $cli->send('hello world\n');
});

//注册数据接收回调函数
$client->on('receive',function($cli,$data){
    echo 'RECEIVED:' . $data . '\n';
});

//注册连接失败回调函数
$client->on('error',function($cli){
    echo 'connect failed' . PHP_EOL;
});

//注册连接关闭回调
$client->on('close',function($cli){
    echo 'Connection close\n';
});

$client->connect('127.0.0.1',9501,3);