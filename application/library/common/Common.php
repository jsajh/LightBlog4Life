<?php
/**
 * 跳转方法
 * @param  [string] 	$url 	[跳转地址]
 * @return [void]
 */
function goUrl($url = ''){
	header('Location:' . HOST . "/{$url}");
	exit();
}

/**
 * 载入文件 *针对工具载入解耦
 * @param  [string] 	$path 	[路径]
 * @return [void]
 */
function load($path){
	Yaf_Loader::import($path);
}