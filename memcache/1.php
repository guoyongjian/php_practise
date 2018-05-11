<?php
/**
 * Created by PhpStorm.
 * User: guoyongjian
 * Date: 18/5/11
 * Time: 下午12:27
 */

$m = new memcache();

$host = '127.0.0.1';
$port = 11211;
$m->connect($host,$port);
$name = $m->get('name');


echo $name;

