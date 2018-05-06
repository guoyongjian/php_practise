<?php
/**
 * Created by PhpStorm.
 * User: guoyongjian
 * Date: 18/5/6
 * Time: 下午9:54
 */
class WeChat{
    private $appid;
    private $appSecret;
    
    public function __construct($appid,$appsecret)
    {
        $this->appid = $appid;
        $this->appSecret = $appsecret;
    }
    
    //获取access_token
    public function getAccessToken($token_file = './access_token'){
        if(file_exists($token_file) && filemtime($token_file) > (time() - 7200)){
            return file_get_contents($token_file);
        }
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->appid}&secret={$this->appSecret}";
         //发送GET请求
        $result = $this->requestGet($url);
        if(empty($result)){
            return false;
        }
        $result_obj = json_decode($result);
        file_put_contents($token_file,$result_obj->access_token);
        return $result_obj->access_token;
    }
    
    //发送GET请求
    private function requestGet($url,$ssl = true){
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,$curl);
        $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36';
        curl_setopt($curl,CURLOPT_USERAGENT,$user_agent);
        curl_setopt($curl,CURLOPT_AUTOREFERER,true);
        if($ssl){
            curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
            curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,1);
        }
        curl_setopt($curl,CURLOPT_HEADER,false);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        $response = curl_exec($curl);
        if(false === $response) {
            echo curl_error($curl) . '<br/>';
            return false;
        }
        return $response;
    }
    
}