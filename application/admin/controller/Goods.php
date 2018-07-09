<?php

namespace app\admin\controller;

use think\Url;
use think\Db;
use think\Request;
use app\admin\controller\Index;
use app\admin\model\Category;
use app\admin\model\Brand;
use app\admin\model\Level;
use app\admin\model\Type;
use app\admin\model\Attribute;
use app\admin\model\Water;
use app\admin\model\Goods as model;
use app\admin\validate\Goods as validate;

class Goods extends Index
{
	function _empty()
	{
		$this->redirect(Url::build('Index/index'));
	}

	function showCat()
	{
		$cat = Category::field('id,pid,name')->select();
		$cat = Category::tree($cat);

		return json($cat);
	}

	function showAttr($id)
	{
		$attr = Db::name('attribute')->field('id,name,choice,values')->where('type_id',$id)->select();
		foreach($attr as $k => $v){
			if($v['values'] == '')
				continue;
			$attr[$k]['values'] = explode('，',$v['values']);
		}
		$this->assign('attr',$attr);
		$info = $this->fetch('_attr');
		return json( getMsg(1,$info) );
	}

	function editAttr(Request $request, $id)
	{
		$goods_id = $request->post('goods_id');
		
		// 取出当前商品的属性数据
		$attr = Db::name('attribute')->alias('a')->join('goods_attribute ga','ga.attribute_id=a.id','left')->field('a.id,a.name,a.choice,a.values,ga.*')->where('type_id',$id)->where('goods_id',$goods_id)->select();
		$attr_info = Db::name('attribute')->field('id,name,choice,values')->where('type_id',$id)->select();
		$exist_id = array_column($attr,'attribute_id');
		foreach($attr_info as $k => $v){
			$attr_info[$k]['id'] = NULL;
			$attr_info[$k]['goods_id'] = NULL;
			$attr_info[$k]['attribute_id'] = $v['id'];
			$attr_info[$k]['attribute_value'] = NULL;
			$attr_info[$k]['attribute_price'] = NULL;
			if($v['values'] == '')
				continue;
			$attr_info[$k]['values'] = explode('，',$v['values']);
			if( in_array($v['id'],$exist_id) )
				unset($attr_info[$k]);continue;
		}
		foreach($attr as $k => $v){
			if($v['values'] == '')
				continue;
			$attr[$k]['values'] = explode('，',$v['values']);
		}
		
		$attr = array_merge($attr,$attr_info);
		$this->assign('attr',$attr);
		$info = $this->fetch('_edit');
		return json( getMsg(1,$info) );
	}

	function delAttr($id)
	{
		Db::name('goods_attribute')->delete($id);
		return json( getMsg(1,'删除成功') );
	}

	function checknum($id)
	{
		$len = Db::name('goods_picture')->where('goods_id',$id)->count();
		return json( ['len'=>$len] );
	}

	function delImg($id)
	{
		$pic_id = input('post.pic_id/d');
		$len = Db::name('goods_picture')->where('goods_id',$id)->count();
		// 至少保留一张商品相册图片
		if( $len <= 1 )
			return json( getMsg(0,'至少保留一张商品相册图片') );
		// 先找出图片路径
		$path = ROOT_PATH . 'public_html' . DS . 'upload' . DS;
		$img_path = Db::name('goods_picture')->field('sm_picture,picture')->find($pic_id);

		if( Db::name('goods_picture')->delete($pic_id) ){
			if( file_exists($path . $img_path['sm_picture']) )
                unlink($path . $img_path['sm_picture']);
            if( file_exists($path . $img_path['picture']) )
                unlink($path . $img_path['picture']);
			return json( getMsg(1,'删除成功') );
		}else
			return json( getMsg(0,'删除失败') );
	}

	function kucun(Request $request, $id)
	{
		if($request->isAjax()){
			$gai = $request->post('attribute_id/a');
			$gn = $request->post('number/a');
			// 先清除原本的库存数据
			Db::name('goods_number')->where('goods_id',$id)->delete();
			if( !empty($gai) ){
				// 先计算两个数组的比例
				$rate = count($gai) / count($gn);
				// 去除重复
				$gai = array_chunk($gai,$rate);
				$gai = more_array_unique($gai);
				$_key = array_keys($gai);
				foreach($gn as $k => $v){
					if(!in_array($k,$_key))
						continue;
					$arr = $gai[$k];
					// 升序数组
					sort($arr);
					$arr = implode(',',$arr);
					Db::name('goods_number')->insert([
						'goods_id'=>$id,
						'number'=>$v,
						'attribute_id'=>$arr,
					]);
				}
			}else{
				Db::name('goods_number')->insert([
					'goods_id'=>$id,
					'number'=>$gn[0],
				]);
			}
			return json( getMsg(1,'设置成功') );
		}else{
			// 根据商品ID取出这件商品同一个有多个值的属性
			$childSql = Db::name('goods_attribute')->field('attribute_id')->where('goods_id',$id)->group('attribute_id')->having('count(attribute_id)>1')->buildSql();
			$result = Db::name('goods_attribute')->alias('ga')->join('attribute a','ga.attribute_id=a.id','left')->field('ga.*,a.name')->where('attribute_id in'.$childSql)->where('goods_id',$id)->select();
			$attr = [];
			foreach($result as $v){
				$attr[$v['attribute_id']][] = $v;
			}
			
			// 取出当前商品设置过库存的数据
			$goods_number = Db::name('goods_number')->where('goods_id',$id)->select();
			$len = count($attr);

			$this->assign('id',$id);
			$this->assign('attr',$attr);
			$this->assign('goods_number',$goods_number);
			$this->assign('len',$len);
			// 库存页面
			return $this->fetch();
		}
	}

	function catList(Request $request, $id)
	{
		$list = Db::name('goods_cat')->alias('gc')->join('goods g','g.id=gc.goods_id','left')->field('id,name,sm_logo,supermarket_price,shop_price,is_sale,is_new,is_best,is_hot')->where('is_delete',0)->where('g.cat_id|gc.cat_id',$id)->group('id')->paginate(10,false,['query'=>$request->param()]);
		$total = Db::name('goods_cat')->alias('gc')->join('goods g','g.id=gc.goods_id','left')->where('is_delete',0)->where('g.cat_id|gc.cat_id',$id)->group('id')->count();
		$pageinfo = $list->render();

		$this->assign('list',$list);
		$msg = $this->fetch('_index');
		if($request->post())
			return json( getSearch(1,$total,$msg,$pageinfo) );
		else{
			$this->assign('list',$list);
			$this->assign('total',$total);
			return $this->fetch('index');
		}
	}

	function index()
	{
		$list = model::field('id,name,sm_logo,supermarket_price,shop_price,is_sale,is_new,is_best,is_hot')->where('is_delete',0)->order('id','DESC')->paginate(10);
		$total = model::where('is_delete',0)->count();

		$this->assign('list',$list);
		$this->assign('total',$total);
		// 列表页面
		return $this->fetch();
	}

	function create()
	{
		/**********分类**********/
		$cat = Category::field('id,name,pid')->select();
		$cat = Category::tree($cat);
		/**********品牌**********/
		$brand = Brand::field('id,name')->select();
		/**********会员级别**********/
		$level = Level::field('id,name,rate')->select();
		/**********类型**********/
		$type = Type::field('id,name')->select();
		/**********图片水印**********/
		$water_img = Water::field('id,name')->select();

		$this->assign('cat',$cat);
		$this->assign('brand',$brand);
		$this->assign('level',$level);
		$this->assign('type',$type);
		$this->assign('water_img',$water_img);
		// 添加页面
		return $this->fetch();
	}

	function save(Request $request)
	{
		if($request->isAjax()){
			$data = $request->post();
			// 实例化验证器，进行验证
			$validate = new validate;
			if(!$validate->check($data))
				return json( getMsg(0,$validate->getError()) );
			// 接收logo图片
			$image = $request->file('logo');
			if(!$image)
			    return json( getMsg(0,'请上传logo图片') );
			if( !$fileName = $image->validate(['size'=>2097152,'ext'=>'jpeg,jpg,png,gif'])->move(ROOT_PATH . 'public_html' . DS . 'upload') )
			    return json( getMsg(0,$image->getError()) );
			else{
				$file_name = $fileName->getFilename();
				$data['logo'] = $fileName->getSaveName();
				$data['sm_logo'] = thumb($file_name,$data['logo']);
				WaterImg($data['is_water'],$data['logo'],$data['waterImg'],$data['location']);
			}
			// 添加商品数据
			$model = new model;
            if(!$model->save($data))
                return json( getMsg(0,'添加失败') );
            // 获取添加成功的商品ID
            $goods_id = $model->id;

			// 接收商品相册图片
			$pictures = $request->file('picture');
			if(!$pictures)
				return json( getMsg(0,'请上传至少一张商品相册图片') );
			foreach($pictures as $picture){
			    if( !$fileName = $picture->validate(['size'=>2097152,'ext'=>'jpeg,jpg,png,gif'])->move(ROOT_PATH . 'public_html' . DS . 'upload') )
			        return json( getMsg(0,$picture->getError()) );
			    else{
			        $file_name = $fileName->getFilename();
			        $info['goods_id'] = $goods_id;
			        $info['picture'] = $fileName->getSaveName();
			        $info['sm_picture'] = thumb($file_name,$info['picture']);
			        WaterImg($data['water_method'],$info['picture'],$data['water_img'],$data['water_location']);
			        if( !Db::name('goods_picture')->insert($info) )
			        	return json( getMsg(0,'添加失败') );
			    }
			}
			return json( getMsg(1,'添加成功') );
		}
	}

	function edit(Request $request, $id)
	{
		/**********分类**********/
		$cat = Category::field('id,name,pid')->select();
		$cat = Category::tree($cat);
		/**********品牌**********/
		$brand = Brand::field('id,name')->select();
		/**********会员级别**********/
		$level = Level::field('id,name,rate')->select();
		/**********类型**********/
		$type = Type::field('id,name')->select();
		/**********图片水印**********/
		$water_img = Water::field('id,name')->select();

		$this->assign('cat',$cat);
		$this->assign('brand',$brand);
		$this->assign('level',$level);
		$this->assign('type',$type);
		$this->assign('water_img',$water_img);
		// 获取商品数据
		$result = model::find($id);
		// 获取扩展分类信息
		$ext_cat = Db::name('goods_cat')->field('cat_id')->where('goods_id',$id)->select();
		// 获取会员价格
		$member_price = Db::name('member_price')->field('level_id,level_price')->where('goods_id',$id)->select();
		// 获取商品相册信息
		$pic_before = DS . 'upload' . DS;
		$goods_pic = Db::name('goods_picture')->field('id,sm_picture')->where('goods_id',$id)->select();

		$this->assign('result',$result);
		$this->assign('ext_cat',$ext_cat);
		$this->assign('member_price',$member_price);
		$this->assign('pic_before',$pic_before);
		$this->assign('goods_pic',$goods_pic);
		// 编辑页面
		return $this->fetch();
	}

	function update(Request $request, $id)
	{
		$data = $request->post();
		// 实例化验证器，进行验证
		$validate = new validate;
		if(!$validate->check($data))
			return json( getMsg(0,$validate->getError()) );
		// 接收logo图片
		$image = $request->file('logo');
		if($image){
			// 先找出图片路径
			$path = ROOT_PATH . 'public_html' . DS . 'upload' . DS;
			$img_path = Db::name('goods')->field('sm_logo,logo')->find($id);
			// 添加新的图片
			if( !$fileName = $image->validate(['size'=>2097152,'ext'=>'jpeg,jpg,png,gif'])->move(ROOT_PATH . 'public_html' . DS . 'upload') )
			    return json( getMsg(0,$image->getError()) );
			else{
				$file_name = $fileName->getFilename();
				$data['logo'] = $fileName->getSaveName();
				$data['sm_logo'] = thumb($file_name,$data['logo']);
				WaterImg($data['is_water'],$data['logo'],$data['waterImg'],$data['location']);
			}
		}
		// 更新商品数据
		$model = new model;
        if(!$model->update($data))
            return json( getMsg(0,'更新失败') );
        // 清除原有的logo图片
        if($image){
        	if( file_exists($path . $img_path['sm_logo']) )
                unlink($path . $img_path['sm_logo']);
            if( file_exists($path . $img_path['logo']) )
                unlink($path . $img_path['logo']);
        }
        // 获取更新成功的商品ID
        $goods_id = $id;

        // 接收商品相册图片
		$pictures = $request->file('picture');
		if($pictures){
			// 循环插入商品相册图片
			foreach($pictures as $picture){
			    if( !$fileName = $picture->validate(['size'=>2097152,'ext'=>'jpeg,jpg,png,gif'])->move(ROOT_PATH . 'public_html' . DS . 'upload') )
			        return json( getMsg(0,$picture->getError()) );
			    else{
			        $file_name = $fileName->getFilename();
			        $info['goods_id'] = $goods_id;
			        $info['picture'] = $fileName->getSaveName();
			        $info['sm_picture'] = thumb($file_name,$info['picture']);
			        WaterImg($data['water_method'],$info['picture'],$data['water_img'],$data['water_location']);
			        if( !Db::name('goods_picture')->insert($info) )
			        	return json( getMsg(0,'添加失败') );
			    }
			}
		}
		return json( getMsg(1,'更新成功') );
	}

	function recyclelist()
	{
		$list = model::field('id,name,sm_logo,supermarket_price,shop_price,is_sale,is_new,is_best,is_hot')->where('is_delete',1)->paginate(10);
		$total = model::where('is_delete',1)->count();

		$this->assign('list',$list);
		$this->assign('total',$total);
		// 回收站
		return $this->fetch();
	}

	function recycle($id)
	{
		if( Db::name('goods')->update(['id'=>$id,'is_delete'=>1]) )
			return json( getMsg(1,'回收成功') );
		else
			return json( getMsg(0,'回收失败') );
	}

	function recycles(Request $request)
	{
		$ids = $request->post()['ids'];
		foreach($ids as $v){
			if( !Db::name('goods')->update(['id'=>$v,'is_delete'=>1]) )
				return json( getMsg(0,'回收失败') );
		}
		return json( getMsg(1,'回收成功') );
	}

	function restore($id)
	{
		if( Db::name('goods')->update(['id'=>$id,'is_delete'=>0]) )
			return json( getMsg(1,'还原成功') );
		else
			return json( getMsg(0,'还原失败') );
	}

	function delete($id)
    {
    	// 先找出图片路径
		$path = ROOT_PATH . 'public_html' . DS . 'upload' . DS;
		$img_path = Db::name('goods')->field('sm_logo,logo')->find($id);
		$pic_path = Db::name('goods_picture')->field('sm_picture,picture')->where('goods_id',$id)->select();
        if(model::destroy($id)){
        	// 清除原有的logo图片
        	if( file_exists($path . $img_path['sm_logo']) )
                unlink($path . $img_path['sm_logo']);
            if( file_exists($path . $img_path['logo']) )
                unlink($path . $img_path['logo']);
            foreach($pic_path as $v){
            	if( file_exists($path . $v['sm_picture']) )
	                unlink($path . $v['sm_picture']);
	            if( file_exists($path . $v['picture']) )
	                unlink($path . $v['picture']);
            }
            return json( getMsg(1,'删除成功') );
        }else
            return json( getMsg(0,'删除失败') );
    }

    function deletion(Request $request)
    {
        $ids = $request->post()['ids'];
        // 先找出图片路径
		$path = ROOT_PATH . 'public_html' . DS . 'upload' . DS;
		$img_path = Db::name('goods')->field('sm_logo,logo')->whereIn('id',$ids)->select();
		$pic_path = Db::name('goods_picture')->field('sm_picture,picture')->whereIn('goods_id',$ids)->select();
        if(model::destroy($ids)){
        	foreach($img_path as $v){
            	if( file_exists($path . $v['sm_logo']) )
	                unlink($path . $v['sm_logo']);
	            if( file_exists($path . $v['logo']) )
	                unlink($path . $v['logo']);
            }
        	foreach($pic_path as $v){
            	if( file_exists($path . $v['sm_picture']) )
	                unlink($path . $v['sm_picture']);
	            if( file_exists($path . $v['picture']) )
	                unlink($path . $v['picture']);
            }
            return json( getMsg(1,'删除成功') );
        }else
            return json( getMsg(0,'删除失败') );
    }
}