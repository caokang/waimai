<?php

class PHPSMS
{

 

 
    public function send($mobile, $message)
    {
        $App_Id=C('AppId');
        $App_Secret=C('AppSecret');
        $access_token=$this->get_Access_token();
        $token=$this->getToken();
        $timestamp = date('Y-m-d H:i:s');
        $url="http://api.189.cn/v2/dm/randcode/sendSms";

        $param['app_id']= "app_id=".$App_Id;
        $param['access_token'] = "access_token=".$access_token;
        $param['timestamp'] = "timestamp=".$timestamp;
        $param['phone']="phone=".$mobile;
        $param['token']="token=".$token;
        $param['randcode']="randcode=".$message;
        ksort($param);
        $plaintext = implode("&",$param);
        $param['sign'] = "sign=".rawurlencode(base64_encode(hash_hmac("sha1", $plaintext, $App_Secret, $raw_output=True)));
        ksort($param);

        $result=$this->curl_post($url,implode("&",$param));
        $resultArr=json_decode($result);

        

    }
    //获取信任码
    public function getToken(){

        $App_Id=C('AppId');
        //dump($App_Id);
        $App_Secret=C('AppSecret');
         $access_token=$this->get_Access_token();
         $timestamp = date('Y-m-d H:i:s');
        $url = "http://api.189.cn/v2/dm/randcode/token?";

        $param['app_id']= "app_id=".$App_Id;
        $param['access_token'] = "access_token=".$access_token;
        $param['timestamp'] = "timestamp=".$timestamp;
        ksort($param);
        $plaintext = implode("&",$param);
        $param['sign'] = "sign=".rawurlencode(base64_encode(hash_hmac("sha1", $plaintext, $App_Secret, $raw_output=True)));
        ksort($param);
        $url .= implode("&",$param);
        //$result = curl_get($url);
       
        $r=$this->curl_get($url);
        $result=json_decode($r,true);
        return $result['token'];
        
    }
    //获取访问令牌 
    public function get_Access_token(){
        
        $App_Id=C('AppId');
        $App_Secret=C('AppSecret');
        $grant_type='client_credentials';
       
        $send = 'app_id='.$App_Id.'&app_secret='.$App_Secret.'&grant_type='.$grant_type;
   
        $access_token = $this->curl_post("https://oauth.api.189.cn/emp/oauth2/v3/access_token", $send);
        $access_token = json_decode($access_token, true);
       
        return $access_token['access_token'];
  
    }

function curl_post($url,$data){ // 模拟提交数据函数      
    $curl = curl_init(); // 启动一个CURL会话      
    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址                  
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查      
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在      
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器      
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转      
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer      
    curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求      
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包      
    curl_setopt($curl, CURLOPT_COOKIEFILE, $GLOBALS['cookie_file']); // 读取上面所储存的Cookie信息      
    curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环      
    curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容      
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回      
    $tmpInfo = curl_exec($curl); // 执行操作      
    if (curl_errno($curl)) {      
       echo 'Errno'.curl_error($curl);      
    }      
    curl_close($curl); // 关键CURL会话      
    return $tmpInfo; // 返回数据      
  }

    /**
     * 模拟提交参数，支持https提交 可用于各类api请求
     * @param string $url ： 提交的地址
     * @param array $data :POST数组
     * @param string $method : POST/GET，默认GET方式
     * @return mixed
     */
    function curl_get($url, $data='', $method='GET'){ 
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        if($method=='POST'){
            curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
            if ($data != ''){
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
            }
        }
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
        $tmpInfo = curl_exec($curl); // 执行操作
        curl_close($curl); // 关闭CURL会话
        return $tmpInfo; // 返回数据
    }
       
}