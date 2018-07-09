<?php

namespace app\admin\controller;

use think\Request;
use think\Db;
use think\Url;
use app\admin\controller\Index;
use app\admin\model\Type as model;
use app\admin\validate\Type as validate;

class Type extends Index
{
    function _empty()
    {
        $this->redirect(Url::build('Index/index'));
    }

    function index()
    {
    	$list = model::field('id,name,create_time')->order('id','DESC')->paginate(10);
        $total = model::count();

        $this->assign('total',$total);
    	$this->assign('list',$list);
        // 列表页面
    	return $this->fetch();
    }

    function create()
    {
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