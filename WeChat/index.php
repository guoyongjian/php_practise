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
    private $token;
    
    public function __construct($appid,$appsecret,$token)
    {
        $this->appid = $appid;
        $this->appSecret = $appsecret;
        $this->token = $token;
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
        $result = json_decode($result,1);
        file_put_contents($token_file,$result['access_token']);
        return $result['access_token'];
    }
    
    //获取ticket
    public function getTicket($content=1){
        $url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=' . $this->getAccessToken();
        $arr = [
            'scene'=>json_encode(['scene_str'=>$content])
        ];
        $params = [
            'action_name'=>'QR_LIMIT_SCENE',
            'action_info'=>json_encode($arr)
        ];
        $res = $this->requestPost($url,json_encode($params));
        return $res['ticket'];
    }
    
    //getQRcode
    public function getQrcode($content){
        $ticket = $this->getTicket($content);
        $url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=' . urlencode($ticket);
        if(empty($url)){
            return false;
        }
        header('Content-Type: image/png');
        echo $this->requestGet($url);
    }
    
    //检验url的合法性
    public function firstValid(){
        //验证签名
        if($this->checkSignature()){
            echo $_GET['echostr'];
        }else{
            return false;
        }
    }
    
    //验证签名
    public function checkSignature(){
        $signature = $_GET['signature'];
        $timestamp = $_GET['timestamp'];
        $nonce = $_GET['nonce'];
        
        //将时间戳，随机字符串，token按照字母顺序排序并连接
        $arr = [$this->token,$timestamp,$nonce];
        sort($arr,SORT_STRING);//字典顺序
        $str = implode($arr);//连接
        $str = sha1($str);//加密
        if($signature == $str){
            return true;
        }
        return false;
    }
    
    
    //发送GET请求
    private function requestGet($url,$ssl = true){
        $client = new Client(['base_uri' => $url]);
        $response = $client->request('GET', $url);
        if ($response->getStatusCode() != 200) {
            return false;
        }
        $response = $response->getBody();
        return $response;
    }
    
    //发送post请求
    private function requestPost($url,$arr=''){
        $client = new Client(['base_uri' => $url]);
        $r = $client->request('POST', $url, [
            'body' => $arr
        ]);
        if ($r->getStatusCode() != 200) {
            return false;
        }
        $response = json_decode($r->getBody(), 1);
        return $response;
    }
    
}