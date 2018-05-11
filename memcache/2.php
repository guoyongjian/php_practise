<?php
/**
 * Created by PhpStorm.
 * User: guoyongjian
 * Date: 18/5/11
 * Time: 下午11:36
 */


//memcache集群
$m = new memcache();

$m->addServer('127.0.0.1',11211);
$m->addServer('127.0.0.1',11212);

//常规操作