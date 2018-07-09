<?php

namespace app\admin\controller;

use think\Request;
use think\Db;
use think\Url;
use app\admin\controller\Index;
use app\admin\validate\Water as validate;
use app\admin\model\Water as model;

class Water extends Index
{
	function _empty()
	{
        $this->redirect(Url::build('Index/index'));
    }

    function index()
    {
        $list = model::field('id,name,sm_water_img,create_time')->order('id','DESC')->paginate(10);
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
            $image = $request->file('water_img');
            if(!$image)
                return json( getMsg(0,'请上传图片') );
            else{
                if( !$fileName = $image->validate(['size'=>2097152,'ext'=>'jpeg,jpg,png,gif'])->move(ROOT_PATH . 'public_html' . DS . 'upload') )
                    return json( getMsg(0,$image->getError()) );
                else{
                    $data['water_img'] = $fileName->getSaveName();
                    $data['sm_water_img'] = thumb($fileName->getFilename(),$data['water_img']);
                }
            }
            $model = new model;
            if($model->save($data))
                return json( getMsg(1,'添加成功') );
            else
                return json( getMsg(0,'添加失败') );
        }
    }

    function edit($id)
    {
        $result = model::field('id,name,sm_water_img')->find($id);

        $this->assign('result',$result);
        // 编辑页面
        return $this->fetch();
    }

    function update(Request $request, $id)
    {
        if($request->isAjax()){
            $data = $request->post();
            $validate = new validate;
            if(!$validate->check($data))
                return json( getMsg(0,$validate->getError()) );
            $image = $request->file('water_img');
            if($image){
                 // 先找出图片路径
                $path = ROOT_PATH . 'public_html' . DS . 'upload' . DS;
                $img_path = Db::name('water')->field('sm_water_img,water_img')->find($id);
                // 处理图片
                if( !$fileName = $image->validate(['size'=>2097152,'ext'=>'jpeg,jpg,png,gif'])->move(ROOT_PATH . 'public_html' . DS . 'upload') )
                    return json( getMsg(0,$image->getError()) );
                else{
                    $data['water_img'] = $fileName->getSaveName();
                    $data['sm_water_img'] = thumb($fileName->getFilename(),$data['water_img']);
                }
            }
            $model = new model;
            if($model->update($data)){
                // 清除原有的图片
                if($image){
                    if( file_exists($path . $img_path['sm_water_img']) )
                        unlink($path . $img_path['sm_water_img']);
                    if( file_exists($path . $img_path['water_img']) )
                        unlink($path . $img_path['water_img']);
                }
                return json( getMsg(1,'更新成功') );
            }else
                return json( getMsg(0,'更新失败') );
        }
    }

   function delete($id)
    {
        // 先找出图片路径
        $path = ROOT_PATH . 'public_html' . DS . 'upload' . DS;
        $img_path = Db::name('water')->field('sm_water_img,water_img')->find($id);
        if(model::destroy($id)){
            // 清除原有的图片
            if( file_exists($path . $img_path['sm_water_img']) )
                unlink($path . $img_path['sm_water_img']);
            if( file_exists($path . $img_path['water_img']) )
                unlink($path . $img_path['water_img']);
            return json( getMsg(1,'删除成功') );
        }else
            return json( getMsg(0,'删除失败') );
    }

    function deletion(Request $request)
    {
        $ids = $request->post()['ids'];
        // 先找出图片路径
        $path = ROOT_PATH . 'public_html' . DS . 'upload' . DS;
        $img_path = Db::name('water')->field('sm_water_img,water_img')->whereIn('id',$ids)->select();
        if(model::destroy($ids)){
            // 清除原有的图片
            foreach($img_path as $v){
                if( file_exists($path . $v['sm_water_img']) )
                    unlink($path . $v['sm_water_img']);
                if( file_exists($path . $v['water_img']) )
                    unlink($path . $v['water_img']);
            }
            return json( getMsg(1,'删除成功') );
        }else
            return json( getMsg(0,'删除失败') );
    }
}