<?php
load(CACHE_PATH . '/driver/Driver.php');
class RedisDriverv extends Driver{
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