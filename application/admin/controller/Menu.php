<?php

namespace app\admin\controller;

use think\Request;
use think\Db;
use think\Url;
use app\admin\controller\Index;
use app\admin\model\Menu as model;
use app\admin\validate\Menu as validate;

class Menu extends Index
{
    function _empty()
    {
        $this->redirect(Url::build('Index/index'));
    }

    function index()
    {
        $request = Request::instance();
        $name = $request->param('name/s');
        $where = '%' . $name . '%';
        $list = model::field('id,name,pid,is_show')->order('id','DESC')->where('id|name','like',$where)->paginate(10,false,['query'=>$request->param()]);
        $total = model::where('id|name','like',$where)->count();
        if( $request->isPost() ){
            $paginate = $list->render();

            $this->assign('list',$list);
            $list = $this->fetch('_index');
            return json( getSearch(1,$total,$list,$paginate) );
        }
        
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
        //添加页面
        return $this->fetch();
    }

    function save(Request $request)
    {
        if($request->isAjax()){
            $data = $request->post();
            $validate = new validate;
            if(!$validate->scene('insert')->check($data))
                return json( getMsg(0,$validate->getError()) );
            else{
                $model = new model;
                if($model->save($data))
                    return json( getMsg(1,'添加成功') );
                else
                    return json( getMsg(0,'添加失败') );
            }
        }
    }

    function edit($id)
    {
        $list = Db::name('privilege')->field('id,name,pid')->select();
        $list = model::tree($list);
        $result = model::field('id,name,pid,is_show')->find($id);

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
            if(!$validate->scene('update')->check($data))
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

    function delete($id)
    {
        $ids = model::field('id')->where("pid=$id")->select();
        if(!$ids){
            if(model::destroy($id))
                return json( getMsg(1,'删除成功') );
            else
                return json( getMsg(0,'删除失败') );
        }else{
            return json( getMsg(0,'当前栏目还有子栏目') );
        }
    }

    function deletion(Request $request){
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
