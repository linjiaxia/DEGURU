<?php

namespace app\admin\model;

use think\Model;

class Privilege extends Model
{
    // 数据表字段信息 留空则自动获取
    protected $field = true;
    // 新增自动完成列表
    protected $insert = ['create_time','controller'];
    // 更新自动完成列表
    protected $update = ['update_time','controller'];

    function setControllerAttr($v)
    {
        return ucfirst($v);
    }

    function setCreateTimeAttr()
    {
    	return time();
    }

    function setUpdateTimeAttr()
    {
    	return time();
    }

    static function tree($arr,$pid=0,$level=0)
    {
        static $list = [];
        foreach($arr as $v){
            if($pid == $v['pid']){
                $v['level'] = $level;
                $list[] = $v;
                Privilege::tree($arr,$v['id'],$level+1);
            }
        }
        return $list;
    }

    /**
     * 初始化处理
     * @access protected
     * @return void
     */
    protected static function init()
    {
        Privilege::beforeInsert(function(&$data){
            if(isset($data['id']))
                unset($data['id']);
        });
    }
}