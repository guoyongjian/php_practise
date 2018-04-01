<?php
$host = '127.0.0.1';
$port = 9501;

/**
 *$host : 127.0.0.1 本地DP
 *        192.168.50.33 监听外网IP
 *$port :   端口号
 *$mode :   多进程的方式
 *$sock type    :   SWOOLE SOCK_TCP
 */
$server = new swoole_server($host,$port);

//使用 $swoole    server->on(string $event,mixed $callback);
/**
 $event
 *      connect :   当建立连接的时候 $server    $fd
 *      receive :   当接收到数据
 *      close   :   关闭链接
 */

$server->on('connect',function($server,$fd){
    echo '建立连接成功' . PHP_EOL;
});

$server->on('receive',function($server,$fd,$form_id,$data){
    $server->send($fd,'666');
});

$server->on('close',function($server,$fd){
    echo '关闭连接';
});

$server->start();


