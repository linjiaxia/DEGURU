<?php

namespace app\admin\model;

use think\Model;

class Level extends Model
{
	// 数据表名称
    protected $table = 'sp_member_level';
    // 数据表字段信息 留空则自动获取
    protected $field = true;
    // 新增自动完成列表
    protected $insert = ['create_time'];
    // 更新自动完成列表
    protected $update = ['update_time'];

    function getRateAttr($v)
    {
        if($v == 100){
            return '无折扣';
        }else{
            $before = substr($v,0,1);
            $radix = substr($v,1);
            if($radix != 0){
                return $before . '.' . $radix . '折';
            }else{
                return $before . '折';
            }
        }
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
        Level::beforeInsert(function(&$data){
            if(isset($data['id']))
                unset($data['id']);
        });
    }
}