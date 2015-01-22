<?php
Yaf_Loader::import('database/MongoModel.php');
class UserModel extends MongoModel{
	public function getUser($id){
		if (!is_numeric($id)) {
			goUrl();
		}
		$id = (integer)$id;
		$result = self::findOne($id);
		if($result === array()){
			$result = array(
				'id'=>0,
				'name'=>'未知',
				'icon'=>'http://default.png'
			);
		}
		return $result;
	}
}