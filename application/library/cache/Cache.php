<?php
class Cache{
	const DRIVER_PATH = CACHE_PATH . '/driver';
	public static $driver_type = array('Redis'=>1, 'Yac'=>1);
	private static $class;
	private static $type;

	public static function __callStatic($function, $arguments){
		Cache::__init(get_called_class());

		Cache::__clean();
	}

	/**
	 * 缓存初始化入口
	 * @param  [string] 	$class 		[当前类名]
	 * @return [boolean]	[成功? 是:true 否:false]
	 */
	private static function __init($class){
		self::$class = $class;
		self::$type = $class::$type;
	}

	/**
	 * 缓存结束出口 注销变量
	 * @return [void]
	 */
	private static function __clean(){
		self::$class = '';
		self::$type = '';
	}

	/**
	 * 获取缓存驱动对象
	 * @param  [string] 	$type 		[驱动类型]
	 * @return [object] 	[驱动对象]
	 */
	private static function getDriver($type){
		
	}
}