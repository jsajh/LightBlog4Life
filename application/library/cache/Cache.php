<?php
class Cache{
	const DRIVER_PATH = CACHE_PATH . '/driver';
	public static $driver_type = array('Redis'=>1, 'Yac'=>1);
	private static $driver_list = array();
	private static $path;
	private static $class;
	private static $type;

	public static function __callStatic($function, $arguments){
		if(Cache::__init(get_called_class(), $function, $arguments)){
			Cache::getDriver();
		}
		Cache::__clean();
		return false;
	}

	/**
	 * 缓存初始化入口
	 * @param  [string] 	$class 		[当前类名]
	 * @return [boolean]	[成功? 是:true 否:false]
	 */
	private static function __init($class, $function, arguments){
		Cache::$class = $class;
		if(!is_string($class) && $class === ''){
			Cache::log('error', 'Cache Type undefined in config!');
			return false;
		}

		Cache::$path = Cache::config('path');
		if(empty(Cache::$path)){
			Cache::log('error', 'Cache Path undefined in config!');
			return false;
		}


		return true;
	}

	/**
	 * 缓存结束出口 注销变量
	 * @return [void]
	 */
	private static function __clean(){
		Cache::$class = '';
		Cache::$type = '';
	}

	/**
	 * 获取缓存驱动对象
	 * @param  [string] 	$type 		[驱动类型]
	 * @return [object] 	[驱动对象]
	 */
	private static function getDriver(){
		var_dump(0000);
		if(!isset(self::$driver_type[self::$type])){
			Cache::log('error', 'Undefined Cache Driver Type! Type: ' . self::$type);
			return null;
		}
		var_dump(1111);
		if(!isset(self::$driver_list[self::$type])){
			include CACHE_PATH . '/driver/' . self::$type . 'Driver.php';

			$class_name = self::$type . 'Driver';
			var_dump(class_exists($class_name));
			$driver = new $class_name();
			var_dump($driver->get('Hello'));
			exit();
		}
	}

	/**
	 * Model日志方法 解耦
	 * @param  	[string] 	$content  	[内容]
	 * @return  [void]
	 */
	private static function log($level, $content){
		Log::$level($content);
	}

	/**
	 * 获取配置 解耦
	 * @param  [string]   	$key  	[关键字]
	 * @return [mixed] 		[值]
	 */
	private static function config($key){
		return $GLOBALS['app']->getConfig()->cache->$key;
	}

	/**
	 * 获取详细配置信息
	 * @param  [string] 	$method    		[方法]
	 * @param  [array] 		$arguments 		[参数]
	 * @return [array]    	[配置]
	 */
	private static function getDetailConfig($method, $arguments){
		
	}
}