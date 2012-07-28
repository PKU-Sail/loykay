<?php
class String
{
	public static function filterSqlValue($string)
	{
		if(!is_array($string))
		{
			return "'".addslashes(trim($string))."'";
		}
		foreach ($string as $k=>$v)
		{
			$string[$k] = "'".addslashes(trim($v))."'";
		}
		return implode(',',$string);
	}
}