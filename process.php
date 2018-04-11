<?php
/**
 * Created by PhpStorm.
 * User: guoyongjian
 * Date: 18/4/4
 * Time: 下午2:11
 */
$workers = [];

$swoole_worker_num = 3;

for($i=0;$i<$swoole_worker_num;$i++){
    echo $i;
    $process = new swoole_process('doProcess',false,true);
    $pid = $process->start();
    $workers[$pid] = $process;
}

function doProcess(swoole_process $process){
    $process->write("PID: $process->pid ");
    echo "写入信息： $process->pid $process->callback";
}


foreach($workers as $process){
    swoole_event_add($process->pipe,function($pipe) use($process){
        $data = $process->read();
        echo "接收到： $data \n";
    });
}
