<?php
function L($string,$file = 'log.txt')
{
	$string = date('Y-m-d H:i:s') . ' : ' . $string . "\n";
	$fh = fopen($file, 'a+');
	fwrite($fh, $string);
}

function C($key,$value = false,$require = null)
{
	static $config = array();
	if($require != null)
	{
		$config = include_once $require;
	}
	if($value === false)
	{
		if(isset($config[$key]))
		{
			return $config[$key];
		}
	}
	else
	{
		$orignal = null;
		if(isset($config[$key]))
			$orignal = $config[$key];
		$config[$key] = $value;
		return $orignal;
	}
}

function implode_value($values)
{
	foreach ($values as $k => $v)
	{
		$values[$k] = '\'' . addslashes($v) . '\'';
	}
	$str = implode(',',$values);
	return '(' . $str . ')';
}

function implode_key($keys)
{
	foreach ($keys as $k => $v)
	{
		$keys[$k] = '`' . $k . '`';
	}
	$str = implode(',', $keys);
	return '(' . $str . ')';	
}

function M($className,$db = false)
{
	if(is_array($className))
	{
		$oa = array();
		foreach ($className as $v)
		{
			$class = $v . 'Model';
			array_push($oa, new $class());
		}
		return new HybridModel($oa, $db);
	}
	$class = $className . 'Model';
	return new $class();
}