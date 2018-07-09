<?php

namespace app\index\model;

class Phone
{
	private $accountSid = 'c8f1e627d8f84efe8e5a43b0121f81ef';
    private $timestamp;
    private $token = '16ad8557796646c3be1b13604b9b14e5';
    private $type = 'json';
    private $sms;
    private $url = 'https://api.miaodiyun.com/20150822/industrySMS/sendSMS';
    private $moblie;
    public $result;

    function __construct($moblie,$code)
    {
    	$this->moblie = $moblie;
    	$this->sms = '【家栋科技】您的验证码为' . $code . '，请于30分钟内正确输入，如非本人操作，请忽略此短信。';
    	$data = $this->data_post($moblie);
    	$header = $this->createHeaders();
    	$this->setMsg($data,$header);
    }

	private function setMsg($data,$header){
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$this->url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

		$result = curl_exec($ch);

		curl_close($ch);
		
		$this->result = json_decode($result);
	}

	private function data_post($moblie){
		$this->time = date("YmdHis",time());
		$str = '';
		$str .= 'accountSid=' . $this->accountSid;
		$str .= '&timestamp=' . $this->time;
		$str .= '&sig=' . md5($this->accountSid . $this->token . $this->time);
		$str .= '&respDataType=' . $this->type;
		$str .= '&smsContent=' . $this->sms;
		$str .= '&to=' . $this->moblie;
		
		return $str;
	}

	private function createHeaders()
	{
		$headers = array('Content-type:application/x-www-form-urlencoded', 'Accept: application/json');
		
		return $headers;
	}
}