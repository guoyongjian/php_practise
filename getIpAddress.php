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
    
 $ip = getIP();

//淘宝接口根据ip查询所在区域信息
//echo '淘宝' . PHP_EOL;
$res1 = file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=$ip");
$res1 = json_decode($res1,true);
if(!empty($res1['code'])){
    exit('get data error');
}

echo '您的ip： ' . $res1['data']['ip'] . PHP_EOL;
echo '您的国家： ' . $res1['data']['country'] . PHP_EOL;
echo '您的省份： ' . $res1['data']['region'] . PHP_EOL;
echo '您的城市： ' . $res1['data']['city'] . PHP_EOL;
echo '您的运营商： ' . $res1['data']['isp'] . PHP_EOL;


echo '浏览器类型：' . getBrowser() . PHP_EOL;
echo '网站来源: ' . getFromPage();

 //获取用户浏览器类型
 function getBrowser(){
  $agent=$_SERVER["HTTP_USER_AGENT"];
  if(strpos($agent,'MSIE')!==false || strpos($agent,'rv:11.0')) //ie11判断
   return "ie";
  else if(strpos($agent,'Firefox')!==false)
   return "firefox";
  else if(strpos($agent,'Chrome')!==false)
   return "chrome";
  else if(strpos($agent,'Opera')!==false)
   return 'opera';
  else if((strpos($agent,'Chrome')==false)&&strpos($agent,'Safari')!==false)
   return 'safari';
  else
   return 'unknown';
 }
 //print_r($_SERVER);

 //获取网站来源
 function getFromPage(){
  return !empty($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : 'none';
 }
 

