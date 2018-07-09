<?php

namespace app\admin\controller;

use think\Request;
use think\Db;
use think\Url;
use app\admin\controller\Index;
use app\admin\validate\Attribute as validate;
use app\admin\model\Attribute as model;

class Attribute extends Index
{
	function _empty()
	{
        $this->redirect(Url::build('Index/index'));
    }

    function index()
    {
    	$request = Request::instance();
    	$type_id = empty( $request->param('type_id') ) ? 1 : $request->param('type_id');
    	$type = Db::name('type')->field('id,name')->select();
    	$list = model::field('id,name,choice,values,type_id')->where('type_id',$type_id)->paginate(5);
    	$total = model::where('type_id',$type_id)->count();

    	$this->assign('total',$total);
    	$this->assign('list',$list);
    	$this->assign('type_id',$type_id);
    	$this->assign('type',$type);
    	// 列表页面
    	return $this->fetch();
    }

    function create()
    {
    	$list = Db::name('type')->field('id,name')->select();

    	$this->assign('list',$list);
    	// 添加页面
    	return $this->fetch();
    }

    function save(Request $request)
    {
    	if($request->isAjax()){
            $data = $request->post();
            $validate = new validate;
            if(!$validate->check($data))
                return json( getMsg(0,$validate->getError()) );
            $model = new model;
            if($model->save($data))
                return json( getMsg(1,'添加成功') );
            else
                return json( getMsg(0,'添加失败') );
        }
    }

    function edit($id)
    {
    	$list = Db::name('type')->field('id,name')->select();
    	$result = Db::name('attribute')->field('id,type_id,name,choice,values')->find($id);

    	$this->assign('result',$result);
    	$this->assign('list',$list);
    	// 修改页面
    	return $this->fetch();
    }

    function update(Request $request)
    {
    	if($request->isAjax()){
            $data = $request->post();
            $validate = new validate;
            if(!$validate->check($data))
                return json( getMsg(0,$validate->getError()) );
            $model = new model;
            if($model->update($data))
                return json( getMsg(1,'更新成功') );
            else
                return json( getMsg(0,'更新失败') );
        }
    }

    function delete($id)
    {
        if(model::destroy($id))
            return json( getMsg(1,'删除成功') );
        else
            return json( getMsg(0,'删除失败') );
    }

    function deletion(Request $request)
    {
        $ids = $request->post()['ids'];
        if(model::destroy($ids))
            return json( getMsg(1,'删除成功') );
        else
            return json( getMsg(0,'删除失败') );
    }
}