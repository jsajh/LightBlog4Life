<?php
include LIB_PATH . '/database/Model.php';
class MongoModel extends Model{
	public static function instance(){
		$called_class = get_called_class();
		if(!isset(self::$instance_list[$called_class])){
			$model_type = lcfirst(substr(__CLASS__, 0, -5));
			$config = self::config($model_type);

			$collection_name = lcfirst(substr($called_class, 0, -5));
			if(!isset(self::$instance_list[$model_type])){
				try{
					$mongo = new MongoClient('asdfasdf');#$config->server
					$db = $mongo->selectDB($config->database);
					self::$instance_list[$model_type] = $db;
				}catch(MongoConnectionException $e){
					
					return false;
				}catch(Exception $e){

				}
			}
			// $db = self::$instance_list[$model_type];
			// $collection = new MongoCollection($db, $collection_name);
			
			// $data = $collection->find();

			// foreach ($data as $value) {
			//  	var_dump($value);
			// }
		}


	}

	public static function insert($data){
		self::instance();
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