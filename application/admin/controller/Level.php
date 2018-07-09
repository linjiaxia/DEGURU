<?php

namespace app\admin\controller;

use think\Url;
use think\Request;
use app\admin\controller\Index;
use app\admin\validate\Level as validate;
use app\admin\model\Level as model;

class Level extends Index
{
	function _empty()
	{
		$this->redirect(Url::build('Index/index'));
	}

	function index()
	{
		$list = model::field('id,name,top_number,bottom_number,rate')->paginate(5);
        $total = model::count();

		$this->assign('list',$list);
        $this->assign('total',$total);
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
    	$result = model::field('id,name,top_number,bottom_number,rate')->find($id)->getData();

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