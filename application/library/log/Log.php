<?php
/**
 *	日志工具类
 *	@author 	[wfengchen] 	<wfengchen@live.com>
 *	@version  	[2015.01.21]
 */
class Log{
	const LOG_PATH = ROOT_PATH . '/public/log/';
	const LOG_SIZE = 20971520;
	public static $log_level = array('error'=>1, 'warning'=>1, 'info'=>1);
	public static $log_content = '';

	public static function __callStatic($function, $argument){
		if(isset(self::$log_level[$function])){
			if(isset($argument[0]) && !isset($argument[1])){
				self::record($function, $argument[0]);
				return true;
			}
		}
		return false;
	}

	private static function record($level, $content){
		$date = date('Y-m-d H:i:s', time());
		self::$log_content .= "[{$level}] {$date} {$content}\r\n";
		return true;
	}

	public static function level($level){
		
	}

	public static function write(){
		if(!is_dir(self::LOG_PATH)){
			if(!mkdir(self::LOG_PATH)){
				return false;	
			}
		}
		
		if(self::$log_content === ''){
			return false;
		}

		$file_name = date('Y-m-d', time()) . '.log';
		$file_path = self::LOG_PATH . $file_name;

		if(is_file($file_path)){
			if(filesize($file_path) > self::LOG_SIZE){
				rename($file_path, $file_path . '.' . time());
			}
		}

		$file = fopen($file_path, 'a');
		if($file){
			fwrite($file, self::$log_content . "\r\n");
			fclose($file);
			return true;
		}
		return false;
	}
}
