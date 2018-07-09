<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Url;


class Base extends Controller
{
    function _empty()
    {
        $this->redirect(Url::build('/'));
    }
    
	function __construct()
	{
		// 实现父类方法
		parent::__construct();
		// 导航
    	$navData = Db::name('nav')->field('name,url')->select();
    	// 一级分类
    	$catData = Db::name('category')->field('id,name')->where('pid',0)->select();
        // 联系我们
        $constactData = Db::name('constact')->field('id,name,content,url,img')->select();

    	$this->assign('navData',$navData);
        $this->assign('catData',$catData);
    	$this->assign('constactData',$constactData);
	}
}