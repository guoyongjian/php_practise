<?php

//冒泡排序

$arr = [2,3,6,4];

$len = count($arr);


//for($i=0;$i<$len;$i++){
//    for($j=$len-1;$j>$i;$j--){
//        if($arr[$j]<$arr[$j-1]){
//            $a = $arr[$j];
//            $arr[$j] = $arr[$j-1];
//            $arr[$j-1] = $a;
//        }
//    }
//}
//print_r($arr);


for($i=1;$i<$len;$i++){
    for($j=0;$j<$len-$i;$j++){
        if($arr[$j] > $arr[$j+1]){
            $a = $arr[$j];
            $arr[$j] = $arr[$j+1];
            $arr[$j+1] = $a;
        }
    }
}
print_r($arr);




