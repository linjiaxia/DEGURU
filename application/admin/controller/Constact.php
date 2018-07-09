<?php

namespace app\admin\controller;

use think\Request;
use think\Db;
use think\Url;
use app\admin\controller\Index;
use app\admin\validate\Constact as validate;
use app\admin\model\Constact as model;

class Constact extends Index
{
	function _empty()
	{
        $this->redirect(Url::build('Index/index'));
    }

    function index()
    {
    	$list = model::field('id,name,content,url,img')->select();
    	$total = model::count();

    	$this->assign('list',$list);
    	$this->assign('total',$total);
    	// 列表页面
    	return $this->fetch();
    }

    function edit($id)
    {
    	$result = model::field('id,name,content,url,img')->find($id);

    	$this->assign('result',$result);
    	// 编辑页面
    	return $this->fetch();
    }

    function update(Request $request, $id)
    {
        if($request->isAjax()){
            $data = $request->post();
            $validate = new validate;
            // 验证
            if( $id < 22 ){
                if(!$validate->scene('header')->check($data))
                    return json( getMsg(0,$validate->getError()) );
            }else if( $id == 22 ){
                if(!$validate->scene('middle')->check($data))
                    return json( getMsg(0,$validate->getError()) );
            }else if( $id > 22 ){
                if(!$validate->scene('footer')->check($data))
                    return json( getMsg(0,$validate->getError()) );
            }

            if( $id <= 5 ){
                $image = $request->file('img');
                if($image){
                    // 先找出图片路径
                    $path = ROOT_PATH . 'public' . DS . 'upload' . DS;
                    $img_path = Db::name('constact')->field('img')->find($id)['img'];
                    // 处理图片
                    if( !$fileName = $image->validate(['size'=>2097152,'ext'=>'jpeg,jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'upload') )
                        return json( getMsg(0,$image->getError()) );
                    else
                        $data['img'] = $fileName->getSaveName();
                }  
            }
            $model = new model;
            if($model->update($data)){
                if( $id <= 5 ){
                    // 清除原有的图片
                    if($image){
                        if( file_exists($path . $img_path) )
                            unlink($path . $img_path);
                    } 
                }
                return json( getMsg(1,'更新成功') );
            }else
                return json( getMsg(0,'更新失败') );
        }
    }
}