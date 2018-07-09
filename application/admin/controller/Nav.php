<?php

namespace app\admin\controller;

use think\Request;
use think\Db;
use think\Url;
use app\admin\controller\Index;
use app\admin\validate\Nav as validate;
use app\admin\model\Nav as model;

class Nav extends Index
{
	function _empty()
	{
        $this->redirect(Url::build('Index/index'));
    }

    function index()
    {
    	$list = model::field('id,name,url')->select();
    	$total = model::count();

    	$this->assign('list',$list);
    	$this->assign('total',$total);
    	// 列表页面
    	return $this->fetch();
    }

    function edit($id)
    {
    	$result = model::field('id,name')->find($id);

    	$this->assign('result',$result);
    	// 编辑页面
    	return $this->fetch();
    }

    function update(Request $request)
    {
        if($request->isAjax()){
            $data = $request->post();
            $validate = new validate;
            if(!$validate->check($data))
                return json( getMsg(0,$validate->getError()) );
            else{
                $model = new model;
                if($model->update($data))
                    return json( getMsg(1,'更新成功') );
                else
                    return json( getMsg(0,'更新失败') );
            }
        }
    }
}