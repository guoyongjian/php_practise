<?php
/**
 * Created by PhpStorm.
 * User: guoyongjian
 * Date: 18/4/2
 * Time: 上午1:22
 */

$client = new swoole_client(SWOOLE_SOCK_TCP);

//连接到服务器
if(!$client->connect('127.0.0.1',9501,5)){
    die('connect failed');
}

//向服务器发送数据
if(!$client->send('hello world')){
    die('send failed');
}

//从服务端接收数据
$data = $client->recv();
if(!$data) {
    die('recv failed');
}

echo $data;

//关闭连接
$client->close();