<?php
include LIB_PATH . '/database/interface/Base.php';
class Model implements Base{
	#实例化对象列表
	public static $instance_list = array();

	/**
	 * CURD
	 * @see interface/Base.php
	 */
	public static function instance(){}
	public static function insert($data){}
	public static function delete($id){}
	public static function update($id, $data){}
	public static function find($condition){}
	public static function findOne($id){}

	/**
	 * 获取配置信息
	 * @param  [string] 	$key 	[配置关键字]
	 * @return [mixed]		[配置]
	 */
	public static function config($key){
		return $GLOBALS['app']->getConfig()->$key;
	}

	/**
	 * Model日志方法
	 * @param  	[string] 	$content  	[内容]
	 * @return  [boolean] 	[成功？ 是:true 否:false]
	 */
	public static function log($level, $content){
		Log::$level($content);
	}

	/**
	 * 魔术调用DB特性
	 * @param  [string] 	$function  		[方法名]
	 * @param  [array] 		$arguments 		[参数]
	 * @return [mixed]
	 */
	#public function __callStatic($function, $arguments){
		
	#}
}