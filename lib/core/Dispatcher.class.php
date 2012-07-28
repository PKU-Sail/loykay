<?php
class Dispatcher
{
	public static function Dispatch()
	{
		call_user_func(C('URL_MOD'));
	}
	
	private static function rewrite()
	{
		
	}
	
	private static function normal()
	{
		
	}
}