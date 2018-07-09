<?php

namespace app\admin\model;

use think\Model;
use think\Db;

class Role extends Model
{
    // 数据表字段信息 留空则自动获取
    protected $field = true;
    // 新增自动完成列表
    protected $insert = ['create_time'];
    // 更新自动完成列表
    protected $update = ['update_time'];

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
        Role::beforeInsert(function(&$data){
            if(isset($data['id']))
                unset($data['id']);
        });
        
        Role::afterInsert(function($data){
            $ids = input('post.pri_id/a');
            if($ids){
                foreach($ids as $v){
                    Db::name('role_privilege')->insert([
                        'pri_id'  => $v,
                        'role_id' => $data->id,
                    ]);
                }
            }
        });

        Role::beforeUpdate(function($data){
            // 先清除原本的权限
            Db::name('role_privilege')->where('role_id',$data->id)->delete();
            // 接收表单重新添加一遍
            $ids = input('post.pri_id/a');
            if($ids){
                foreach($ids as $v){
                    Db::name('role_privilege')->insert([
                        'pri_id'  => $v,
                        'role_id' => $data->id,
                    ]);
                }
            }
        });

        Role::beforeDelete(function($data){
            // 把这个角色所拥有的权限数据一并删除
            $ids = empty(input('post.ids/a')) ? $data->id : input('post.ids/a');
            if(is_array($ids))
                Db::name('role_privilege')->whereIn('role_id',$ids)->delete();
            else
                Db::name('role_privilege')->where('role_id',$ids)->delete();
        });
    }
}