<?php
include LIB_PATH . '/database/Model.php';
include LIB_PATH . '/database/interface/Base.php';
class MongoModel extends Model implements Base{
	public static function insert($data){
		return 'This is Insert';
	}

	public static function delete($id){
		return 'This is Delete';
	}

	public static function update($id, $data){
		return 'This is Update';
	}

	public static function find($id){
		return 'This is Finds';
	}
}