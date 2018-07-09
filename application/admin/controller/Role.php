<?php

namespace app\admin\controller;

use think\Request;
use think\Db;
use think\Url;
use app\admin\controller\Index;
use app\admin\validate\Role as validate;
use app\admin\model\Role as model;

class Role extends Index
{
	function _empty()
    {
        $this->redirect(Url::build('Index/index'));
    }

    function index()
    {
        $list = model::field('id,name,describe')->paginate(5);
        $total = model::count();

        $this->assign('total',$total);
        $this->assign('list',$list);
        // 列表页面
    	return $this->fetch();
    }

    function create()
    {
    	$list = Db::name('privilege')->field('id,name,pid')->where('pid=0')->select();
    	foreach($list as $k => $v){
    		$list[$k]['next'] = Db::name('privilege')->field('id,name,pid')->where('pid',$v['id'])->select();
    		foreach($list[$k]['next'] as $ko => $vo){
    			$list[$k]['next'][$ko]['next'] = Db::name('privilege')->field('id,name,pid')->where('pid',$vo['id'])->select();
    		}
    	}

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
        $list = Db::name('privilege')->field('id,name,pid')->where('pid=0')->select();
        foreach($list as $k => $v){
            $list[$k]['next'] = Db::name('privilege')->field('id,name,pid')->where('pid',$v['id'])->select();
            foreach($list[$k]['next'] as $ko => $vo){
                $list[$k]['next'][$ko]['next'] = Db::name('privilege')->field('id,name,pid')->where('pid',$vo['id'])->select();
            }
        }
        $privilege = Db::name('role_privilege')->field('pri_id')->where('role_id',$id)->select();
        $privilege = array_column($privilege,'pri_id');
        $role = Db::name('role')->field('id,name,describe')->find($id);
        
        $this->assign('role',$role);
        $this->assign('privilege',$privilege);
        $this->assign('list',$list);
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