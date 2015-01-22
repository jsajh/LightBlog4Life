<?php
/**
 * Blog 入口控制器
 */
class IndexController extends Yaf_Controller_Abstract {
	/**
	 * Blog首页
	 * @return [type]       [description]
	 */
	public function indexAction() {
		
        return true;
	}

	/**
	 * Blog内容页
	 * @return [type]
	 */
	public function contentAction($id = 0){
		if(!is_numeric($id)){
			goUrl();
		}

		# 文章内容
		include MODEL_PATH . '/Article.php';
		$article_model = new ArticleModel();
		$data = $article_model->getArticle($id);
		if(!$data){
			goUrl();
		}
		$this->getView()->assign('data', $data);

		# 文章评论
		

		# 用户信息
		include MODEL_PATH . '/User.php';
		$user_model = new UserModel();
		$user = $user_model->getUser($data['user_id']);
		$this->getView()->assign('uesr', $user);

		# 推荐文章
		include CACHE_PATH . '/ArticleCache.php';
		var_dump(ArticleCache::getDemo('Hello'));
		exit();

		# 最新评论
		
		return true;
	}

	public function testAction(){
		echo 'Hello';
		return false;
	}
}