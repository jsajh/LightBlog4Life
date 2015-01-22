<?php
interface base{
	/**
	 * 统一实例化Model方法
	 * @return [boolean] [成功？ true:是 false:否]
	 */
	public static function instance();

	/**
	 * 新增数据方法
	 * @param  [array]		$data		[数据]
	 * @return [integer]	[ID]
	 */
	public static function insert($data);

	/**
	 * 删除数据方法
	 * @param  [integer] 	$id 	[ID]
	 * @return [boolean]	[成功? true:是 false:否]
	 */
	public static function delete($id);

	/**
	 * 更新数据方法
	 * @param  [integer] 	$id   	[ID]
	 * @param  [array] 		$data 	[更新]
	 * @return [boolean]	[成功？ true:是 false:否]
	 */
	public static function update($id, $data);

	/**
	 * 查找数据方法
	 * @param  [array] 	$condition 	[条件]
	 * @return [array]	[数据]
	 */
	public static function find($condition);

	/**
	 * 查找单条数据
	 * @param  [integer] 	$id 	[ID]
	 * @return [array]		[数据]
	 */
	public static function findOne($id);
}