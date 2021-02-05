<?php

namespace Openpay\Library;

class Loader {

  private $option;

	public function index(){
		echo "Hello Loader";
	}

	public function setConfig($option){
	  $this->option = $option;
  }

	public function isScan(){

  }


  public function query(){
    $this->http_query([]);
  }


  private function http_query($map){
    $headerArray =array("Content-type:application/json;","Accept:application/json");
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $this->option->host);
    curl_setopt($curl, CURLOPT_HEADER,0);//是否需要头部信息（否）
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER,$headerArray);  //定义curl请求头部信息
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($map));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT,5);      //设置允许执行的最长秒数。
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT ,5);//在发起连接前等待的时间，如果设置为0，则无限等待。

    //忽略https证书
    if(substr($this->option->host,0,5) == 'https') {
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    }
    $output = curl_exec($curl); //json
    curl_close($curl);

    $result = json_decode($output,true);//json => array
    if($result['return_code'] != '00'){
      throw new Exception($result["return_code"],$result["return_msg"]);
      //return $this->ret_msg($result['return_code'],$result['return_msg']);
    }

    //本地验签
    if($this->check_sign($result) !== 1){

      return $this->ret_msg(403,'本地验签失败');
    }

    //获取返回码
    $ret_code = $result['return_code'];
    $ret_msg  = $result['return_msg'];

    unset($result['return_msg']);
    unset($result['return_code']);
    unset($result['sign']);

    return $this->ret_msg($ret_code,$ret_msg,$result);
  } //http_query() end


  /**
   * 请求加签
   * @param $map
   * @return mixed
   */
  private function make_sign($map){
    //删除数组空元素
    $notEmptyArr = array_filter($map,function($item){
      return !empty($item);
    });

    ksort($notEmptyArr);
    //获取私钥
    $priKey = openssl_pkey_get_private(file_get_contents($this->option->private_key));
    $signStr = urldecode(http_build_query($notEmptyArr)); //防止'/'被转义
    openssl_sign($signStr,$signature,$priKey,OPENSSL_ALGO_SHA256);
    openssl_free_key($priKey);
    return base64_encode($signature);
  } //make_sign() end

  /**
   * @param int $ret_code
   * @param string $message
   * @param array $data
   * @return false|string
   */
  private function ret_msg($ret_code=200,$message="SUCCESS",$data=[]){
    return json_encode(
      ["ret_code"    => $ret_code,
        "message"    => $message,
        "data"       => $data
      ]
    );
  } //ret_msg() end


}

