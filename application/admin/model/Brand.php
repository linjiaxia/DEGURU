<?php

namespace app\admin\model;

use think\Model;
use think\Db;

class Brand extends Model
{
    // 数据表字段信息 留空则自动获取
    protected $field = true;
    // 新增自动完成列表
    protected $insert = ['create_time'];
    // 更新自动完成列表
    protected $update = ['update_time'];

    function getSmLogoAttr($v)
    {
        return DS . 'upload' . DS . $v;
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
        Brand::beforeInsert(function(&$data){
            if(isset($data['id']))
                unset($data['id']);
        });
    }
}