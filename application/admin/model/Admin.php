<?php

namespace app\admin\model;

use think\Model;
use think\Db;

class Admin extends Model
{
    // 数据表字段信息 留空则自动获取
    protected $field = true;
    // 新增自动完成列表
    protected $insert = ['create_time'];
    // 更新自动完成列表
    protected $update = ['update_time'];

    function getGenderAttr($v)
    {
        return $v == 1 ? '男' : '女';
    }

    function setCreateTimeAttr()
    {
    	return time();
    }

    function setUpdateTimeAttr()
    {
    	return time();
    }

    /**
     * 初始化处理
     * @access protected
     * @return void
     */
    protected static function init()
    {
        Admin::beforeInsert(function(&$data){
            $data['password'] = md5($data['password'] . crypt('shabi','shi'));
            if(isset($data['id']))
                unset($data['id']);
        });

        Admin::afterInsert(function($data){
            $ids = input('post.role_id/a');
            if($ids){
                foreach($ids as $v){
                    Db::name('admin_role')->insert([
                        'role_id'   =>  $v,
                        'admin_id'  =>  $data->id,
                    ]);
                }
            }
        });

        Admin::beforeUpdate(function(&$data){
            // 超级管理员必须是启用的
            if($data->id == 1)
                $data['is_use'] = 1;

            // 先清除原本的角色
            Db::name('admin_role')->where('admin_id',$data->id)->delete();
            $ids = input('post.role_id/a');
            if($ids){
                foreach($ids as $v){
                    Db::name('admin_role')->insert([
                        'role_id'   =>  $v,
                        'admin_id'  =>  $data->id,
                    ]);
                }
            }

            // 如果修改密码
            if(isset($data['password']))
                $data['password'] = md5($data['password'] . crypt('shabi','shi'));
        });

        Admin::beforeDelete(function($data){
            $ids = empty(input('post.ids/a')) ? $data->id : input('post.ids/a');
            if(is_array($ids))
                Db::name('admin_role')->whereIn('admin_id',$ids)->delete();
            else
                Db::name('admin_role')->where('admin_id',$ids)->delete();
        });
    }
}