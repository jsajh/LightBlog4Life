<?php
/**
 * 
 */
load(LIB_CACHE_PATH . '/driver/Driver.php');
class RedisDriver extends Driver{
	public function getInstance(){
		$redis = new Redis();
		var_dump($redis);
		var_dump($redis->connect('127.0.0.1'));
		var_dump($redis->set('haha','Hello'));
	}

	public function get($key){
		return 'This is get!';
	}

	public function set($key, $value){
		return 'This is set!';
	}

	public function del($key){
		return 'This is del!';
	}
}