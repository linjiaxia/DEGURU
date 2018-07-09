<?php

namespace app\admin\controller;

use think\Request;
use think\Db;
use think\Url;
use app\admin\controller\Index;
use app\admin\validate\Admin as validate;
use app\admin\model\Admin as model;

class Admin extends Index
{
	function _empty()
	{
        $this->redirect(Url::build('Index/index'));
    }

    function index()
    {
    	$list = model::paginate(10)->each(function($item){
            $result = Db::name('admin_role')->alias('ar')->join('role r','ar.role_id=r.id','left')->field('r.name')->where('ar.admin_id',$item['id'])->select();
            $result = array_column($result,'name');
            $result = implode('|',$result);
            $item['role_name'] = $result==null ? '超级管理员' : $result;
        });
        $total = model::count();

        $this->assign('total',$total);
        $this->assign('list',$list);
    	// 列表页面
    	return $this->fetch();
    }

    function create()
    {
    	$list = Db::name('role')->field('id,name')->select();

    	$this->assign('list',$list);
    	// 添加页面
    	return $this->fetch();
    }

    function save(Request $request)
    {
    	if($request->isAjax()){
            $data = $request->post();
            $validate = new validate;
            if(!$validate->scene('insert')->check($data))
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
        $list = Db::name('role')->field('id,name')->select();
        $result = Db::name('admin')->field('id,name,is_use')->find($id);
        $role = Db::name('admin_role')->where('admin_id',$id)->select();
        $role = array_column($role,'role_id');
        
        $this->assign('role',$role);
        $this->assign('result',$result);
        $this->assign('list',$list);
        // 编辑页面
        return $this->fetch();
    }

    function update(Request $request, $id)
    {
        // 获取当前管理员ID
        $adminId = session('id');
        if($adminId > 1 && $adminId != $id)
            return json( getMsg(0,'无权修改') ); 

        if($request->isAjax()){
            $data = $request->post();
            $validate = new validate;
            if(empty($data['password'])){
                if(!$validate->scene('edit')->check($data))
                    return json( getMsg( 0,$validate->getError() ) );
                unset($data['password']);
            }else
                if(!$validate->scene('update')->check($data))
                    return json( getMsg( 0,$validate->getError() ) );
            $model = new model;
            if($model->update($data))
                return json( getMsg(1,'更新成功') );
            else
                return json( getMsg(0,'更新失败') );
        }
    }

    function delete($id)
    {
        if($id == 1)
            return json( getMsg(0,'超级管理员不能被删除') );
        if(model::destroy($id))
            return json( getMsg(1,'删除成功') );
        else
            return json( getMsg(0,'删除失败') );
    }

    function deletion(Request $request)
    {
        $ids = $request->post()['ids'];
        if(in_array(1,$ids))
            return json( getMsg(0,'超级管理员不能被删除') );
        if(model::destroy($ids))
            return json( getMsg(1,'删除成功') );
        else
            return json( getMsg(0,'删除失败') );
    }

    function isuse($id)
    {
        // 超级管理员不能被修改
        if($id == 1)
            return json( getMsg(0,'超级管理员不能被禁用') );

        $info = Db::name('admin')->field('is_use')->where('id',$id)->find();
        $info['is_use'] = $info['is_use'] == 1 ? 0 : 1;
        $result = Db::name('admin')->where('id',$id)->update($info);
        if($result)
            return json( getMsg(1,'更新成功') );
        else
            return json( getMsg(0,'更新失败') );
    }
}