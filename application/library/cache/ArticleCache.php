<?php
load(CACHE_PATH . '/Cache.php');
class ArticleCache extends Cache{
	public static $type = 'Redis';
}