<?php
/**
 * Created by PhpStorm.
 * User: guoyongjian
 * Date: 18/5/6
 * Time: 下午9:54
 */
use GuzzleHttp\Client;
require '../vendor/autoload.php';
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
        file_put_contents($token_file,$result);
        return $result;
    }
    
    //发送GET请求
    private function requestGet($url,$ssl = true){
        $client = new Client(['base_uri' => $url]);
        $response = $client->request('GET', $url);
        if ($response->getStatusCode() != 200) {
            return false;
        }
        $response = json_decode($response->getBody(), 1);
        return $response['access_token'];
    }
    
}