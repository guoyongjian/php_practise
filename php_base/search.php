<?php


//遍历目录下的文件和文件夹

$dir = './ceshi';

$arr = [];
cc($dir);



function cc($dir){
    global $arr;
   $file = @opendir($dir);
   if($file){
       while(($s = readdir($file)) !== false){
           if(($s !== '.') && ($s !== '..')){
               if(is_dir($dir . '/' . $s)){
                   $arr['path'][] = $dir .'/' . $s . PHP_EOL;
                   cc($dir . '/' . $s);
               }else{
                   $arr['files'][] = $s . PHP_EOL;
               }
           }
       }
   }
}


print_r($arr);



