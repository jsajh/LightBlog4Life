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
					$mongo = new MongoClient($config->server);
					$db = $mongo->selectDB($config->database); 
					self::$instance_list[$model_type] = $db;
				}catch(MongoConnectionException $e){
					self::Log('error', 'Mongodb Connect Error! Address: ' . $config->server);
					return false;
				}catch(Exception $e){
					self::Log('error', $e->getMessage());
					return false;
				}
			}
			$db = self::$instance_list[$model_type];
			$collection = new MongoCollection($db, $collection_name);
			self::$instance_list[$called_class] = $collection;
		}
		return self::$instance_list[$called_class];
	}

	public static function insert($data){
		try{
			$collection = self::instance();
			$result = $collection->insert($data);
			if(isset($result['w'])){
				self::Log('error', 'Mongodb Insert Unknow Error! Result: ' . json_encode($result));
				return false;
			}
			return true;
		}catch(MongoCursorException $e){
			self::Log('error', 'Mongodb Insert Error! Message: ' . $e->getMessage());
			return false;
		}
	}

	public static function delete($id){
		try{
			$collection = self::instance();
			$collection->remove(array('id'=>$id), array('justOne' => true));
			if(isset($result['w'])){
				self::Log('error', 'Mongodb Delete Unknow Error! Result: ' . json_encode($result));
				return false;
			}
			return true;
		}catch(MongoCursorException $e){
			self::Log('error', 'Mongodb Delete Error! Message: ' . $e->getMessage());
			return false;
		}catch(MongoCursorTimeoutException $e){
			self::Log('error', 'Mongodb Delete Timeout! Message: ' . $e->getMessage());
			return false;
		}
	}

	public static function update($id, $data){
		try{
			$collection = self::instance();
			$result = $collection->update(array('id' => $id), $data);
			if(isset($result['w'])){
				self::Log('error', 'Mongodb Update Unknow Error! Result: ' . json_encode($result));
				return false;
			}
		}catch(MongoCursorException $e){
			self::Log('error', 'Mongodb Update Error! Message: ' . $e->getMessage());
			return false;
		}catch(MongoCursorTimeoutException $e){
			self::Log('error', 'Mongodb Update Timeout! Message: ' . $e->getMessage());
			return false;
		}
	}

	public static function find($condition){
		$collection = self::instance();
		$mongo_result = $collection->find($condition);
		$result = array();
		foreach ($mongo_result as $value) {
			$result[] = $value;
		}
		return $result;
	}

	public static function findOne($id){
		if(!is_numeric($id)){
			return array();
		}
		$id = (integer)$id;
		$collection = self::instance();
		return $collection->findOne(array('id'=>$id));
	}
}