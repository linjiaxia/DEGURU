<?php

namespace app\admin\controller;

use think\Url;
use app\admin\controller\Index;

class Error extends Index
{
	function _empty()
	{
		$this->redirect(Url::build('Index/index'));
	}
}