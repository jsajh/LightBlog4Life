<?php
abstract class Driver{
	public $object;		#实例化对象变量

	/**
	 * 实例化对象
	 */
	final public function __construct(){
		$object = $this->getInstance();
		if($object !== false){
			$this->object = $object;
		}else{
			return false;
		}
	}

	/**
	 * 实例化缓存方法
	 * @return [mixed]
	 */
	abstract public function getInstance();

	/**
	 * 获取缓存数据
	 * @param  [string] 	$key 		[关键字]
	 * @return [mixed]      [数据]
	 */
	abstract public function get($key);

	/**
	 * 设置/更新缓存数据
	 * @param 	[string] 		$key   		[关键字]
	 * @param 	[mixed] 		$value 		[值]
	 * @return 	[boolean]		[成功？ 是:true 否:false]
	 */
	abstract public function set($key, $value);

	/**
	 * 删除缓存数据
	 * @param  [string] 	$key 		[关键字]
	 * @return [boolean]	[成功？ 是:true 否:false]
	 */
	abstract public function del($key);
}