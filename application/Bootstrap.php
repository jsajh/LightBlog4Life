<?php
#声明常量
include CONF_PATH . 'constant/define_constants_'. SERVER_TYPE . '.php';
#载入公共方法库
include LIB_PATH . '/common/Common.php';
#载入日志工具
include LIB_PATH . '/log/Log.php';

class Bootstrap extends Yaf_Bootstrap_Abstract{
	public function _initApp(){
		# Config
		$arrConfig = Yaf_Application::app()->getConfig();
		Yaf_Registry::set('config', $arrConfig);

		# Route
		$router = Yaf_Dispatcher::getInstance()->getRouter();
	  	$config = Yaf_Registry::get('config')->routes;
		$router->addConfig($config);

		# Library
		$log_level = Yaf_Registry::get('config')->log_level;
		Log::level($log_level);
	}
}