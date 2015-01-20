<?php
Yaf_Loader::import('database/MongoModel.php');
class ArticleModel extends MongoModel{
	public function articleDemo(){
		return self::insert("Test");
	}
}