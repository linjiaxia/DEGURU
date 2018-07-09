<?php

namespace app\admin\controller;

use think\Db;
use think\Url;
use think\Request;
use app\admin\controller\Index;

class Member extends Index
{
	function _empty()
	{
		$this->redirect(Url::build('Index/index'));
	}

	function index()
	{
		$memberData = Db::name('member')->field('id,name,phone,email,status,create_time')->where('status','<>',2)->order('id','DESC')->paginate(10);
		$total = Db::name('member')->where('status','<>',2)->order('id','DESC')->count();

		$this->assign('memberData',$memberData);
		$this->assign('total',$total);
		// 列表页面
		return $this->fetch();
	}

	function detail($id)
	{
		$memberData = Db::name('member')->field('name,gender,phone,email,birthday')->find($id);

		$this->assign('memberData',$memberData);
		// 会员详情页
		return $this->fetch();
	}

	function recycle($id)
	{
		if( Db::name('member')->update(['id'=>$id,'status'=>2]) )
			return json( getMsg(1,'移除成功') );
		else
			return json( getMsg(0,'移除失败') );
	}

	function recycles(Request $request)
	{
		$ids = $request->post()['ids'];
		foreach($ids as $v){
			if( !Db::name('member')->update(['id'=>$v,'status'=>2]) )
				return json( getMsg(0,'移除失败') );
		}
		return json( getMsg(1,'移除成功') );
	}

	function recyclelist()
	{
		$memberData = Db::name('member')->field('id,name,phone,email,create_time')->where('status',2)->paginate(10);
		$total = Db::name('member')->where('status',2)->count();

		$this->assign('memberData',$memberData);
		$this->assign('total',$total);
		// 回收站
		return $this->fetch();
	}

	function restore($id)
	{
		if( Db::name('member')->update(['id'=>$id,'status'=>0]) )
			return json( getMsg(1,'还原成功') );
		else
			return json( getMsg(0,'还原失败') );
	}
}