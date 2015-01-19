<?php
#声明常量
include CONF_PATH . 'constant/define_constants_'. SERVER_TYPE . '.php';

class Bootstrap extends Yaf_Bootstrap_Abstract{
	/**
	 * 初始化配置
	 * @return [void]
	 */
	public function _initConfig() {
		$arrConfig = Yaf_Application::app()->getConfig();
		Yaf_Registry::set('config', $arrConfig);
	}

	/**
	 * 注册路由协议
	 * @param  [Yaf_Dispatcher] $dispatcher [调度器]
	 * @return [void]
	 */
 	public function _initRoute(Yaf_Dispatcher $dispatcher) {
	  	$router = Yaf_Dispatcher::getInstance()->getRouter();
	  	$config = Yaf_Registry::get('config')->routes;
	  	
		$router->addConfig($config);
	}
}