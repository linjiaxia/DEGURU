<?php

namespace app\admin\controller;

use think\Request;
use think\Db;
use think\Url;
use app\admin\controller\Index;
use app\admin\model\Privilege as model;
use app\admin\validate\Privilege as validate;

class Privilege extends Index
{
	function _empty()
    {
        $this->redirect(Url::build('Index/index'));
    }

    function index()
    {
        $list = model::order('id','DESC')->paginate(10)->each(function($item){
            $result = Db::name('privilege')->where('id',$item['pid'])->find();
            $item['pid'] = is_null($result) ? '顶级权限' : $result['name'];
            return $item;
        });
        $total = model::count();
        
        $this->assign('total',$total);
        $this->assign('list',$list);
        // 列表页面
        return $this->fetch();
    }

    function create()
    {
    	$list = Db::name('privilege')->field('id,name,pid')->select();
        $list = model::tree($list);

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
        $list = Db::name('privilege')->field('id,name,pid')->select();
        $list = model::tree($list);
        $result = model::field('id,name,pid,controller,action')->find($id);

        $this->assign('result',$result);
        $this->assign('list',$list);
        //编辑页面
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
        $ids = model::field('id')->where("pid=$id")->select();
        if(!$ids){
            if(model::destroy($id))
                return json( getMsg(1,'删除成功') );
            else
                return json( getMsg(0,'删除失败') );
        }else
            return json( getMsg(0,'当前栏目还有子栏目') );
    }

    function deletion(Request $request)
    {
    	$data = $request->post()['ids'];
        $ids = Db::name('privilege')->field('id')->whereIn('pid',$data)->select();
        $ids = array_column($ids,'id');
        $model = new model;
        if(!$ids){
            if($model->destroy($data))
                return json( getMsg(1,'删除成功') );
            else
                return json( getMsg(0,'删除失败') );
        }else{
            if( !empty( array_diff( $ids,array_intersect($data,$ids) ) ) )
                return json( getMsg(0,'当前栏目还有子栏目') );
            else{
                if($model->destroy($data))
                    return json( getMsg(1,'删除成功') );
                else
                    return json( getMsg(0,'删除失败') );
            }
        }
    }
}