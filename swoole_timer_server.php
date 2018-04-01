<?php
/**
 * Created by PhpStorm.
 * User: guoyongjian
 * Date: 18/4/2
 * Time: 上午12:23
 */

//多次循环执行
swoole_timer_tick(2000,function($time_id){
    echo '执行' . $time_id . PHP_EOL;
});



//单次执行
swoole_timer_after(3000,function(){
    echo '3000后执行' . PHP_EOL;
});