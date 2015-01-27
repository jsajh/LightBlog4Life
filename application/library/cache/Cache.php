<?php
#声明本目录路径
define('LIB_CACHE_PATH', __DIR__);

/**
 * 
 */
class Cache{
	const DRIVER_PATH = LIB_CACHE_PATH . '/driver';
	private static $driver_type = array('Redis'=>1, 'Yac'=>1);
	private static $driver_list = array();
	private static $path;
	private static $class;
	private static $method;
	private static $type;
	private static $config;
	private static $cache_config = array();

	public static function __callStatic($method, $arguments){
		if(Cache::__init(get_called_class(), $method, $arguments)){
			$data = Cache::getCache();
		}
		Cache::__clean();
		return $data;
	}

	/**
	 * 缓存初始化入口
	 * @param  [string] 	$class 		[当前类名]
	 * @return [boolean]	[成功? 是:true 否:false]
	 */
	private static function __init($class, $method, $arguments){
		Cache::$class = lcfirst(substr($class, 0, -5));
		Cache::$method = $method;

		Cache::$path = Cache::config('path');
		if(Cache::$path === false){
			Cache::log('error', 'Cache Path undefined in config!');
			return false;
		}

		Cache::$cache_config = Cache::getCacheConfig();
		if(Cache::$cache_config === false){
			Cache::log('error', 'Cache Config no found!');
			return false;
		}
		return true;
	}

	/**
	 * 缓存结束出口 注销变量
	 * @return [void]
	 */
	private static function __clean(){
		Cache::$class='';
		Cache::$type='';
		Cache::$cache_config = array();
	}

	/**
	 * 获取缓存驱动对象
	 * @return [object] 	[驱动对象]
	 */
	private static function getDriver(){
		$type = Cache::$cache_config['type'];
		
		if(!isset(Cache::$driver_type[$type])){
			Cache::log('error', 'Undefined Cache Driver Type! Type: ' . self::$type);
			return null;
		}

		if(!isset(Cache::$driver_list[$type])){
			if(include Cache::DRIVER_PATH . "/{$type}Driver.php"){
				$class_name = $type . 'Driver';
				Cache::$driver_list[$type] = new $class_name();	
			}else{
				Cache::log('error', '\'' . Cache::DRIVER_PATH . "/{$type}Driver.php' file no found!");
				return nulll;
			}
		}
		return Cache::$driver_list[$type];
	}

	/**
	 * Model日志方法 解耦
	 * @param  	[string] 	$level  	[等级]	exp. error|warning|info
	 * @param  	[string] 	$content  	[内容]
	 * @return  [void]
	 */
	private static function log($level, $content){
		Log::$level(' [Cache] ' . $content);
	}

	/**
	 * 获取配置 解耦
	 * @param  [string]   	$key  	[关键字]
	 * @return [mixed] 		[值]
	 */
	private static function config($key){
		$config = $GLOBALS['app']->getConfig()->cache->$key;
		if(is_string($config)){
			return $config;
		}elseif(is_object($config)){
			return $config->toArray();
		}else{
			return false;
		}
	}

	/**
	 * 获取详细配置信息
	 * @return [array]    	[配置]
	 */
	private static function getCacheConfig(){
		if(!isset(Cache::$config)){
			Cache::$config = Cache::config('config');	
		}

		if(Cache::$config === false){
			Cache::log('error', 'Can\'t find config item!');
			return false;
		}

		# 全局默认配置
		$config = Cache::$config['default'];
		if($config === false){
			Cache::log('error', 'Can\'t find default config!');
			return false;
		}

		# 类级默认配置
		if(isset(Cache::$config[Cache::$class]['default'])){
			$config = array_replace($config, Cache::$config[Cache::$class]['default']);
		}

		# 方法级详细配置
		if(isset(Cache::$config[Cache::$class][Cache::$method])){
			$config = array_replace($config, Cache::$config[Cache::$class][Cache::$method]);
		}
		return $config;
	}

	/**
	 * 缓存逻辑主体
	 * @return [mixed] [数据]
	 */
	private static function getCache(){
		$driver = Cache::getDriver();
		var_dump($driver);
	}

	/**
	 * 根据来源获取数据 子类重写
	 * @return [mixed] [数据]
	 */
	protected static function getSrouceData(){

	}
}