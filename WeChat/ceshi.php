<?php
/**
 * Created by PhpStorm.
 * User: guoyongjian
 * Date: 18/5/6
 * Time: 下午10:33
 */

require './index.php';

define('APPID','wx240c190a43fceb6c');
define('SECRET','d498156463d69ca68f7e3cb9bc2a7a08');

$weChat = new WeChat(APPID,SECRET);
//var_dump($weChat->getAccessToken());


//var_dump($weChat->getTicket());

var_dump($weChat->getQrcode(333));