   <?php
    header("Content-type: text/html; charset=utf-8"); 
    //获取IP地址的方法
    function getIP(){
        if (isset($_SERVER)) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $realip = $_SERVER['HTTP_CLIENT_IP'];
            } else {
                $realip = $_SERVER['REMOTE_ADDR'];
            }
        } else {
            if (getenv("HTTP_X_FORWARDED_FOR")) {
                $realip = getenv( "HTTP_X_FORWARDED_FOR");
            } elseif (getenv("HTTP_CLIENT_IP")) {
                $realip = getenv("HTTP_CLIENT_IP");
            } else {
                $realip = getenv("REMOTE_ADDR");
            }
        }
        return $realip;
    }
    
    echo $ip = getIP();

//淘宝接口根据ip查询所在区域信息
echo '淘宝' . PHP_EOL;
$res1 = file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=$ip");
$res1 = json_decode($res1,true);
print_r($res1);
echo "<br/>";
