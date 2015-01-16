<?php
/**
 * Blog 入口控制器
 */
class IndexController extends Yaf_Controller_Abstract {
	/**
	 * Blog首页
	 * @return [type]       [description]
	 */
	public function indexAction() {
        return true;
	}

	/**
	 * Blog内容页
	 * @return [type]
	 */
	public function contentAction(){
		
	}

	public function testAction(){
		echo 'Hello';
		return false;
	}
}