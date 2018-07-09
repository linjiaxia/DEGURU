<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Url;
use think\Request;

class Index extends Controller
{
	function _empty()
	{
		$this->redirect(Url::build('Index/index'));
	}

	function denied()
	{
		return $this->fetch();
	}

	function __construct()
	{
		// 先调用父类的构造函数
		parent::__construct();
		// 获取当前管理员的ID
		$adminId = session('id');

		// 验证登陆
		if(!$adminId)
			$this->redirect(Url::build('Login/index'));

		$request = Request::instance();
		// 验证权限
		if($request->controller() != 'Index'){
			// 判断是否为超级管理员
			if($adminId != 1){
				$pri = Db::name('privilege')->alias('p')->field('COUNT(p.id) has')->join('role_privilege rp','p.id=rp.pri_id','left')->join('admin_role ar','ar.role_id=rp.role_id','left')->where('ar.admin_id',$adminId)->where('controller',$request->controller())->where('action',$request->action())->find();
				
				if($pri['has'] < 1)
					$this->redirect(url('Index/denied'));
			}
		}
	}

	function index()
	{
		// 获取当前管理员的ID
		$adminId = session('id');
		// 取出当前管理员所有的权限
		if($adminId == 1){
			$list = Db::name('privilege')->select();
		}else{
			$list = Db::name('role_privilege')->alias('rp')->field('rp.pri_id')->join('admin_role ar','ar.role_id=rp.role_id','left')->where('ar.admin_id',$adminId)->select();
			$list = array_unique(array_column($list,'pri_id'));
			$list = Db::name('privilege')->whereIn('id',$list)->select();
		}

		if($adminId != 1){
			$role = Db::name('role')->alias('r')->field('r.name')->join('admin_role ar','ar.role_id=r.id','left')->where('ar.admin_id',$adminId)->select();
			$role = array_column($role,'name');
			$role = implode($role,'|');
		}else{
			$role = '超级管理员';
		}
		
		$this->assign('role',$role);
		$this->assign('list',$list);
		return $this->fetch();
	}

	function logout()
	{
		session('id',null);
		$this->redirect(url('Login/index'));
	}

	function welcome()
	{
		return $this->fetch();
	}
}