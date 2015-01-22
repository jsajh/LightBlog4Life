<?php
class Driver{
	/**
	 * 获取缓存数据
	 * @param  [string] 	$key 		[关键字]
	 * @return [mixed]      [数据]
	 */
	abstract public function get($key){}

	/**
	 * 设置/更新缓存数据
	 * @param 	[string] 		$key   		[关键字]
	 * @param 	[mixed] 		$value 		[值]
	 * @return 	[boolean]		[成功？ 是:true 否:false]
	 */
	abstract public function set($key, $value){}

	/**
	 * 删除缓存数据
	 * @param  [string] 	$key 		[关键字]
	 * @return [boolean]	[成功？ 是:true 否:false]
	 */
	abstract public function del($key){}
}