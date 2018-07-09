<?php

namespace app\index\controller;

use think\Db;
use think\Url;
use think\Request;
use think\Session;
use app\index\controller\Base;
use app\index\validate\Member as MemberValidate;
use app\index\model\Member as MemberModel;
use app\index\validate\Address as AddressValidate;
use app\index\model\Address as AddressModel;

class Member extends Base
{
    function __construct()
    {
        // 调用父类构造函数
        parent::__construct();
        // 获取会员ID
        $member_id = Session::get('m_id');
        // 验证登录
        if(!$member_id)
            $this->redirect(Url::build('@logon'));
    }
    
	function index()
	{
        $request = Request::instance();
		if( $request->isAjax() ){
			$data = $request->post();
            $data['id'] = Session::get('m_id');
            $status = Db::name('member')->field('status')->find($data['id'])['status'];
            if( $status != 1 )
                return json( getMsg(0,'请先通过邮箱激活账号') );
			// 验证
			$validate = new MemberValidate;
            if(!$validate->check($data))
                return json( getMsg(0,$validate->getError()) );
            // 处理出生年月日
            $data['birthday'] = $data['YYYY'] . '-';
            $data['MM'] = strlen($data['MM']) == 2 ? $data['MM'] : 0 . $data['MM'];
            $data['birthday'] .= $data['MM'] . '-';
            $data['DD'] = strlen($data['DD']) == 2 ? $data['DD'] : 0 . $data['DD'];
            $data['birthday'] .= $data['DD'];
            $data['birthday'] = strtotime($data['birthday']);
            // 头像
            $image = $request->file('face');
            if($image){
                // 先找出图片路径
                $path = ROOT_PATH . 'public_html' . DS . 'upload' . DS;
                $img_path = Db::name('member')->field('face')->find($data['id'])['face'];
                // 处理图片
                if( !$fileName = $image->validate(['size'=>2097152,'ext'=>'jpeg,jpg,png,gif'])->move(ROOT_PATH . 'public_html' . DS . 'upload') )
                    return json( getMsg(0,$image->getError()) );
                else{
                    $data['face'] = $fileName->getSaveName();
                }
            }
            // 更新
            $model = new MemberModel;
            if($model->update($data)){
            	// 清除原有的图片
                if($image){
                    if( file_exists($path . $img_path) )
                        unlink($path . $img_path);
                }
                if($data['name'])
                	Session::set('m_name',$data['name']);
                return json( getMsg(1,'设置成功') );
            }else
                return json( getMsg(0,'设置失败') );
		}else{
			$member_id = Session::get('m_id');
			// 会员信息
			$memberData = Db::name('member')->field('id,name,face,money,gender,birthday,real_name,hobby,real_name,hobby,status')->find($member_id);
			// 判断头像
			$memberData['face'] = empty($memberData['face']) ? '20180602\user_img.jpg' : $memberData['face'];
            // 待付款
            $waitData = Db::name('order')->whereIn('pay_status',[0,1])->count();
            // 待收货
            $awaitData = Db::name('order')->whereIn('post_status',[0,1])->where('pay_status',2)->count();
            // 待评论
            $beforeCommentData = Db::name('order')->where('post_status',2)->where('comment_status',0)->count();
            // 已完成
            $doneData = Db::name('order')->where('comment_status',1)->count();
			
            $this->assign('memberData',$memberData);
            $this->assign('waitData',$waitData);
            $this->assign('awaitData',$awaitData);
            $this->assign('beforeCommentData',$beforeCommentData);
			$this->assign('doneData',$doneData);
			// 会员信息页面
			return $this->fetch();
		}
	}

    function address(Request $request)
    {
        if( $request->isAjax() ){
            $data = $request->post();
            // 验证
            $validate = new AddressValidate;
            if(!$validate->check($data))
                return json( getMsg(0,$validate->getError()) );
            $data['member_id'] = Session::get('m_id');
            // 获取状态码
            $status = $request->route('status/d');
            $order_id = $request->route('order_id/d');
            $url = $status == 1 ? Url::build('@pay/'.$order_id) : Url::build('@address/'.$status);
            $model = new AddressModel;
            if($model->save($data))
                return json( getMsg(1,'添加成功',$url) );
            else
                return json( getMsg(0,'添加失败') );
        }else{
            $member_id = Session::get('m_id');
            // 会员信息
            $memberData = Db::name('member')->field('id,name,face,credit,status')->find($member_id);
            // 会员等级
            $levelData = Db::name('member_level')->field('name')->where('top_number','>',$memberData['credit'])->where('bottom_number','<=',$memberData['credit'])->find()['name'];
            // 判断头像
            $memberData['face'] = empty($memberData['face']) ? '20180602\user_img.jpg' : $memberData['face'];
            // 收货地址
            $address = Db::name('address')->field('id,name,prov,city,dist,address,phone,email')->where('member_id',$member_id)->paginate(3,false,[
                'type'=>'DEGURU',
                'var_page'=>'page',
            ]);
            $addressData = $address->all();
            $page = $address->render();
            foreach($addressData as $k => $v){
                $addressData[$k]['address'] = $v['prov'].$v['city'].$v['dist'].$v['address'];
            }
            // 获取状态码
            $status = $request->route('status/d');
            $order_id = $request->route('order_id/d');
            
            $this->assign('memberData',$memberData);
            $this->assign('levelData',$levelData);
            $this->assign('addressData',$addressData);
            $this->assign('page',$page);
            $this->assign('status',$status);
            $this->assign('order_id',$order_id);
            // 收货地址
            return $this->fetch();
        }
    }

    function editAddress(Request $request)
    {
        if( $request->isAjax() ){
            $data = $request->post();
            // 验证
            $validate = new AddressValidate;
            if(!$validate->check($data))
                return json( getMsg(0,$validate->getError()) );
            $model = new AddressModel;
            if($model->update($data))
                return json( getMsg(1,'更新成功') );
            else
                return json( getMsg(0,'更新失败') );
        }else{
            $member_id = Session::get('m_id');
            // 会员信息
            $memberData = Db::name('member')->field('id,name,face,credit,status')->find($member_id);
            // 会员等级
            $levelData = Db::name('member_level')->field('name')->where('top_number','>',$memberData['credit'])->where('bottom_number','<=',$memberData['credit'])->find()['name'];
            // 判断头像
            $memberData['face'] = empty($memberData['face']) ? '20180602\user_img.jpg' : $memberData['face'];
            // 收货地址
            $address = Db::name('address')->field('id,name,prov,city,dist,address,phone,email')->where('member_id',$member_id)->paginate(3);
            $addressData = $address->all();
            $page = $address->render();
            foreach($addressData as $k => $v){
                $addressData[$k]['address'] = $v['prov'].$v['city'].$v['dist'].$v['address'];
            }
            $addr_id = $request->route('addr_id');
            // 会员地址信息
            $memberAddrData = Db::name('address')->field('id,name,phone,prov,city,dist,address,email')->find($addr_id);
            
            $this->assign('memberData',$memberData);
            $this->assign('levelData',$levelData);
            $this->assign('addressData',$addressData);
            $this->assign('page',$page);
            $this->assign('memberAddrData',$memberAddrData);
            // 收货地址编辑页面
            return $this->fetch();
        }
    }

    function deleteAddress($addr_id)
    {
        if( Db::name('address')->delete($addr_id) )
            return json( getMsg(1,'删除成功') );
        else
            return json( getMsg(0,'删除失败') );
    }

    function setMail(Request $request)
    {
        // 获取当前验证的会员ID
        $member_id = Session::get('m_id');
        // 查询邮箱
        $member_info = Db::name('member')->field('email,name')->find($member_id);
        // 生成邮箱验证码
        $email_code = md5( GetRandStr(5) );
        // 存入会员信息
        if( !Db::name('member')->update(['id'=>$member_id,'email_code'=>$email_code]) )
            return json( getMsg(0,'发送失败') );
        // 邮箱标题内容
        $title = '欢迎激活账号';
        $username = $member_info['name'];
        $email = $member_info['email'];
        $time = time();
        $url = $request->domain() . Url::build('@check_email/'.$member_id . '/' . $email_code);
        $result = SendMail($title,$username,$time,$email,$url);
        if( $result )
            return json( getMsg(1,'发送成功') );
        else
            return json( getMsg(0,'发送失败') );
    }

    function checkMail(Request $request)
    {
        $member_id = $request->route('member_id');
        $email_code = $request->route('email_code');
        $check_code = Db::name('member')->field('email_code')->find($member_id)['email_code'];
        if($email_code == $check_code){
            Db::name('member')->update(['id'=>$member_id,'status'=>1,'email_code'=>'']);
            return '<h1>激活成功</h1>';
        }else
            return '<h1>激活失败！或已成功激活（请勿重复激活）</h1>';
    }

    function order()
    {
        // 获取当前会员ID
        $member_id = Session::get('m_id');
        // 获取订单信息
        $order_info = Db::name('order')->alias('o')->join('order_goods og','og.order_id=o.id','left')->field('id,goods_id,goods_attr_id,number,price,pay_status,post_status')->where('o.member_id',$member_id)->order('id','DESC')->paginate(5,false,[
            'type'=>'DEGURU',
            'var_page'=>'page',
        ]);
        $page = $order_info->render();
        $orderData = $order_info->all();
        foreach($orderData as $k => $v){
            // 判断订单状态
            // 先判断是否付款
            switch($v['pay_status']){
                case 0:
                $orderData[$k]['status_n'] = '0';
                $orderData[$k]['status'] = '待付款';
                break;
                case 1:
                $orderData[$k]['status_n'] = '1';
                $orderData[$k]['status'] = '未支付';
                break;
                case 2:
                    $orderData[$k]['status_n'] = '2';
                    switch($v['post_status']){
                        case 0:
                        $orderData[$k]['status'] = '未发货';
                        break;
                        case 1:
                        $orderData[$k]['status'] = '已发货';
                        break;
                        case 2:
                        $orderData[$k]['status'] = '确认收货';
                        break;
                    }
            }
            // 商品信息
            $goods_info = Db::name('goods')->field('name,logo,freight_price')->find($v['goods_id']);
            $orderData[$k]['name'] = $goods_info['name'];
            $orderData[$k]['freight'] = $goods_info['freight_price'];
            $orderData[$k]['logo'] = DS . 'upload' . DS . $goods_info['logo'];
            // 商品属性
            $attr_info = Db::name('goods_attribute')->field('attribute_value')->where('goods_id',$v['goods_id'])->whereIn('id',$v['goods_attr_id'])->select();
            $orderData[$k]['attr'] = '';
            foreach($attr_info as $v){
                $orderData[$k]['attr'] .= $v['attribute_value'] . ' ';
            }
            $orderData[$k]['attr'] = rtrim($orderData[$k]['attr']);
        }
        
        $this->assign('orderData',$orderData);
        $this->assign('page',$page);
        // 订单页面
        return $this->fetch();
    }

    function orderDetail(Request $request)
    {
        $order_id = $request->route('order_id/d');
        $orderData = Db::name('order')->alias('o')->join('order_goods og','og.order_id=o.id','left')->field('id,goods_id,goods_attr_id,number,price,total_price')->where('id',$order_id)->select();
        // 定义一个存放总的运费
        $freight_price = 0;
        foreach( $orderData as $k => $v ){
            // 商品信息
            $goods_info = Db::name('goods')->field('freight_price,name,logo')->find($v['goods_id']);
            $orderData[$k]['name'] = $goods_info['name'];
            $orderData[$k]['logo'] = DS . 'upload' . DS . $goods_info['logo'];
            $freight_price += $goods_info['freight_price'];
            // 商品属性
            $attr_info = Db::name('goods_attribute')->field('attribute_value')->where('goods_id',$v['goods_id'])->whereIn('id',$v['goods_attr_id'])->select();
            $orderData[$k]['attr'] = '';
            foreach($attr_info as $v){
                $orderData[$k]['attr'] .= $v['attribute_value'] . ' ';
            }
            $orderData[$k]['attr'] = rtrim($orderData[$k]['attr']);
        }
        // 发货状态
        $post_status = Db::name('order')->field('post_status')->find($order_id)['post_status'];
        
        $this->assign('orderData',$orderData);
        $this->assign('freight_price',$freight_price);
        $this->assign('post_status',$post_status);
        // 订单详情
        return $this->fetch();
    }
}