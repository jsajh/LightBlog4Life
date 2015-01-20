<?php
class Model{
	#增
	#abstract public static function insert();
	#删
	#abstract public static function delete();
	#改
	#abstract public static function update();
	#查
	#abstract public static function find();

	#实例化
	#abstract public function getInstance();

	/**
	 * 魔术调用DB特性
	 * @param  [string] 	$function  		[方法名]
	 * @param  [array] 		$arguments 		[参数]
	 * @return [mixed]
	 */
	public function __call($function, $arguments){
		
	}
}