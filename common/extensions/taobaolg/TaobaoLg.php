<?php
class TaobaoLg extends CComponent
{
    public $app_key = '1021790400';
    public $secret='sandbox4c3eee4bad7be8769efbda7fa';
    public $backurl = 'http://g.meipin.com/user/tbback';
/*    
    //正式上线地址
	public $app_key = '21790400';
    public $secret='d75dab54c3eee4bad7be8769efbda7fa';
    public $backurl = 'http://www.meipin.com/user/tbback';*/

    public function getTbaoLogin()
    {
         $state = time();
     	 $url= "https://oauth.tbsandbox.com/authorize?response_type=code&client_id=";
     	 $url .= $this->app_key;
     	 $url .= "&redirect_uri=".$this->backurl;
     	 $url .= "&state=".$state;
     	 $url .="&view=web";
     	 header("location:".$url);
    }

    public function getBackContent($state,$code)
    {
    	$url ='https://oauth.tbsandbox.com/token';
    	$postfields= array(
    		'grant_type'=>'authorization_code',
    		'client_id'=>$this->app_key,
  			'client_secret'=>$this->secret,
  			'code'=>$code ,
  			'state'=>$state,
 			'redirect_uri'=>$this->backurl);
 			$post_data = '';
		foreach($postfields as $key=>$value)
		{
		    $post_data .="$key=".urlencode($value)."&";
		}
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);  
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
		//指定post数据
		curl_setopt($ch, CURLOPT_POST, true);
		//添加变量
		curl_setopt($ch, CURLOPT_POSTFIELDS, substr($post_data,0,-1));
		$output = curl_exec($ch);
		$httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		//echo $httpStatusCode;
		curl_close($ch);
		$result =json_decode($output,true);
		//var_dump($aa);
        $backarry = '';
        $backarry['taobao_user_id'] = $result['taobao_user_id'];
        $backarry['taobao_user_nick'] = $result['taobao_user_nick'];
        $backarry['status'] = $httpStatusCode;
		return $backarry;
	}
}
