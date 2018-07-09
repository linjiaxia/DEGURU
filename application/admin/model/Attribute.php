<?php

namespace app\admin\model;

use think\Model;
use think\Db;

class Attribute extends Model
{
    // 数据表字段信息 留空则自动获取
    protected $field = true;
    // 新增自动完成列表
    protected $insert = ['create_time'];
    // 更新自动完成列表
    protected $update = ['update_time'];

    function getChoiceAttr($v)
    {
        return $v == 0 ? '唯一' : '可选';
    }

    function getTypeIdAttr($v)
    {
        return Db::name('type')->field('name')->where('id',$v)->find()['name'];
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
        Attribute::beforeInsert(function(&$data){
            if(isset($data['id']))
                unset($data['id']);
            $data['values'] = str_replace(',','，',$data['values']);
        });

        Attribute::beforeUpdate(function(&$data){
            $data['values'] = str_replace(',','，',$data['values']);
        });
    }
}