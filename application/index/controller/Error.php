<?php

namespace app\index\controller;

use think\Controller;
use think\Url;

class Error extends Controller
{
	function _empty()
	{
		return $this->redirect(Url::build('/'));
	}
}