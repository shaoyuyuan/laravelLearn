<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * 
 */
class Student extends Model
{
	const SEX_UN = '10'; //未知
	const SEX_BOY = '20';//男
	const SEX_GRIL = '30'; //女

	//指定表名，默认是名的复数
	protected $table = 'students';

	//指定允许批量赋值字段
	protected $fillable = ['name', 'age', 'sex'];

	//自动维护时间戳
	public $timestamps = true;

	//
	public function getDateFormat()
	{
		return time();
	}
	//不默认格式化时间
	public function asDateTime($val)
	{
		return $val;
	}
	//解决错误“Call to a member function format() on string”
	public function fromDateTime($val)
	{
		return empty($val) ? $val : $this->getDateFormat();
	}

	public function getSex($ind = null)
	{
		$arr = [
			self::SEX_UN => '未知',
			self::SEX_BOY => '男',
			self::SEX_GRIL => '女',
		];

		if ($ind != null) {
			return array_key_exists($ind, $arr) ? $arr[$ind] : $arr[self::SEX_UN];
		}

		return $arr;
	}
}