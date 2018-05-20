<?php


//遍历目录下的文件和文件夹

$dir = './ceshi';


cc($dir);

$arr = [];

function cc($dir){
   $file = @opendir($dir);
   if($file){
       while(($s = readdir($file)) !== false){
           if(($s !== '.') && ($s !== '..')){
               if(is_dir($dir . '/' . $s)){
                   echo $dir .'/' . $s . PHP_EOL;
                   cc($dir . '/' . $s);
               }else{
                   echo $s . PHP_EOL;
               }
           }
       }
   }
}




