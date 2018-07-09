<?php

namespace app\admin\model;

use think\Model;
use think\Db;

class Constact extends Model
{
    // 数据表字段信息 留空则自动获取
    protected $field = true;
    // 更新自动完成列表
    protected $update = ['update_time'];

    function getImgAttr($v)
    {
    	if( !empty($v) )
        	return DS . 'upload' . DS . $v;
        else
        	return '';
    }

    function setUpdateTimeAttr()
    {
    	return time();
    }
}