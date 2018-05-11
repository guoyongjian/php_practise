<?php
/**
 * Created by PhpStorm.
 * User: guoyongjian
 * Date: 18/5/12
 * Time: 上午12:20
 */

//把session存储到memcache里
ini_set('session.save_handler','memcache');
//所使用的memcached信息
ini_set('session.save_path','tcp://127.0.0.1:11211');
ini_set('session.save_path','tcp://127.0.0.1:11211;tcp://127.0.0.1:11212');