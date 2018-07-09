<?php

namespace app\index\model;

use think\Model;

class Member extends Model
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
        Member::beforeInsert(function(&$data){
            $data['password'] = md5($data['password'] . crypt('shabi','shi'));
            if(isset($data['id']))
                unset($data['id']);
        });
    }
}