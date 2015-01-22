<?php
Yaf_Loader::import('database/MongoModel.php');
class ArticleModel extends MongoModel{
	/**
	 * 获取文章数据
	 * @param  [integer] 	$id 	[ID]
	 * @return [array]		[数据]
	 */
	public function getArticle($id){
		if(!is_numeric($id)){
			return array();
		}

		$result = self::findOne($id);
		return $result;
	}
}