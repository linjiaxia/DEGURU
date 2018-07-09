<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
// 调用系统类
use think\Image;
use think\Db;
use PHPMailer\PHPMailer\PHPMailer;

/**
  * 获取返回信息
  * @param  msg  string 需要返回的信息
  * @param  url  string 需要跳转的地址
  * @return info array  构造好的数组
  */
function getMsg($code,$msg,$url='')
{
	return ['code'=>$code,'msg'=>$msg,'url'=>$url];
}

/**
  * 获取返回信息
  * @param  total    string 总记录数
  * @param  list  	 string 列表信息
  * @param  pageinfo string 分页信息
  * @return info  	 array  构造好的数组
  */
function getSearch($code,$total,$list,$pageinfo)
{
	return ['code'=>$code,'total'=>$total,'list'=>$list,'pageinfo'=>$pageinfo,];
}

/**
  * 制作缩略图
  * @param  file_name string 原图名称
  * @param  file_path string 原图路径
  * @param  width     int    需要缩略图的宽度
  * @param  height    int    需要缩略图的高度
  * @return thumbName string 成功返回文件路径
  */
function thumb($file_name,$file_path,$width=150,$height=150)
{
	// 缩略图存放路径
	$path = ROOT_PATH . 'public_html' . DS . 'upload';
	// 获取原图路径
	$image_path = ROOT_PATH . 'public_html' . DS . 'upload' . DS . $file_path;
	// 拼接时间到存放路径
	$path = $path . DS . date('Ymd');
	// 判断存放路径是否存在，如果不存在，则新建
	if( !file_exists($path) )
		mkdir($path,0777,true);
	// 制作缩略图路径
	$thumb_path = $path . DS . 'thumb_' . $file_name;
	// 制作缩略图名称
	$thumbName = date('Ymd') . DS . 'thumb_' . $file_name;
	// 打开图片
	$image = Image::open($image_path);
	$image->thumb($width,$height)->save($thumb_path);
	return $thumbName;
}

/**
  * 制作水印图片
  * @param  is_water  int    水印方式：0：文字水印 1：图片水印
  * @param  file_path string 原图路径
  * @param  water 	  string 水印图片
  * @param  location  int    水印位置
  * @return thumbName string 成功返回文件路径
  */
function WaterImg($is_water,$file_path,$water='',$location=8)
{
	// 水印位置
	if($location == '') $location = 8;
	// 获取原图路径
	$image_path = ROOT_PATH . 'public_html' . DS . 'upload' . DS . $file_path;
	// 打开图片
	$image = Image::open($image_path);
	// 判断水印方式
	if( $is_water == 0 ){
		// 文字水印
		$image->text('DEGURU商城',ROOT_PATH . 'public_html' . DS . 'ziti.ttf',20,'#ffffff',$location)->save($image_path);
	}else{
		// 图片水印
		$water_img = Db::name('water')->field('water_img')->find($water);
		$water_img = ROOT_PATH . 'public_html' . DS . 'upload' . DS . $water_img['water_img'];
		// 添加水印并保存
		$image->water($water_img,$location)->save($image_path);
	}
}

/**
  * 数组去重
  * @param  arr       array 需要去重的数组
  * @return arr_after array 去重完成的数组
  */
function more_array_unique($arr=array()){  
    foreach($arr[0] as $k => $v){  
        $arr_inner_key[]= $k;   //先把二维数组中的内层数组的键值记录在在一维数组中  
    }  
    foreach ($arr as $k => $v){  
        $v =join(",",$v);    //降维 用implode()也行  
        $temp[$k] =$v;      //保留原来的键值 $temp[]即为不保留原来键值  
    }  
    $temp =array_flip($temp);    //去重：去掉重复的字符串  
    $temp =array_flip($temp);    //去重：去掉重复的字符串  
    foreach ($temp as $k => $v){  
        $a = explode(",",$v);   //拆分后的重组 如：Array( [0] => james [1] => 30 )  
        $arr_after[$k]= array_combine($arr_inner_key,$a);  //将原来的键与值重新合并  
    }  
    return $arr_after;  
}

/**
  * 获取随机数
  * @param  length int    需要随机数的长度
  * @return number string 返回的随机数
  */
function GetRandStr($length){  
  $str='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';  
  $len=strlen($str)-1;  
  $randstr='';  
  for($i=0;$i<$length;$i++){  
    $num=mt_rand(0,$len);  
    $randstr .= $str[$num];  
  }  
  return $randstr;  
}

/**
 * 系统邮件发送函数
 * @param string $to 接收邮件者邮箱
 * @param string $subject 邮件主题
 * @param string $body 邮件内容
 * @param string $attachment 附件列表
 * @return boolean
 */
function SendMail($title,$username,$time,$email,$url)
{
    $config = config('email');
    import('org.util.phpmailer.PHPMailer');
    $mail = new PHPMailer;
    $mail->CharSet = 'utf-8';//设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码，
    $mail->IsSMTP();//设定使用SMTP服务
    $mail->SMTPSecure = 'ssl'; 
    $mail->SMTPDebug = $config['mail_debug'];//关闭SMTP调试功能//1=errors and messages//2=messages only
    $mail->SMTPAuth  = true;//启用SMTP验证功能
    $mail->Port      = $config['mail_port'];  // SMTP服务器的端口号
    $mail->Host      = $config['mail_smtp'];
    $mail->AddAddress($email);//添加收件人地址，
    $mail->Body      = "亲爱的" . $username . "：您在" . $time . "提交了通过邮箱".$email."找回密码请求。请点击下面的链接重置密码（按钮24小时内有效）。" . $url . "。如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问。如果您没有提交找回密码请求，请忽略此邮件。"; //设置邮件正文
    $mail->From      = $config['mail_address'];//设置发件人名字
    $mail->FromName  = '肥宅';//设置发件人名字
    $mail->Subject   = $title;//设置邮件标题
    $mail->Username  = $config['mail_loginname'];//设置用户名和密码
    $mail->Password  = $config['mail_password'];
    // return $mail->Send() ? true : $mail->ErrorInfo;
    return($mail->Send());
}

function getIpInfo($ip,$timeout=15) {  
  if(!function_exists('curl_init') or !function_exists('simplexml_load_string')) return false;  
  $ch = curl_init("http://ipinfodb.com/ip_query2.php?ip={$ip}&timezone=true");  
  $options = array(  
      CURLOPT_RETURNTRANSFER => true,  
    );  
  curl_setopt_array($ch,$options);  
  $res = curl_exec($ch);  
  curl_close($ch);  
  
  if($xml = simplexml_load_string($res)) {  
    $return = array();  
    foreach ($xml->Location->children() as $key=>$item) {  
      $return[$key] = strtolower($item);  
    }  
    return $return;  
  } else {  
    return false;  
  }  
}