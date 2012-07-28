<?php
class Loykay
{
	public static function autoload($classname)
	{
		if(substr($classname, -6) == 'Action')
		{
			if(is_file(ACTION_PATH . $classname . '.class.php'))
			{
				require_once ACTION_PATH . $classname . '.class.php';
				return true;
			}
		}
		elseif(substr($classname,-5) == 'Model')
		{
			if(is_file(MODEL_PATH . $classname . '.class.php'))
			{
				require_once MODEL_PATH . $classname . '.class.php';
				return true;
			}
		}
		else return false;
	}
	
	public static function init()
	{
		$list = array('Loykay','Db','Dispatcher','ErrorHandler',
		'Iterator','Tpl','BaseAction','BaseModel','HybridModel',
		'IteratorModel','ProxyAction','Tpl');
		/*
		 * load core files.
		 */
		foreach ($list as $file)
		{
			require_once CORE_PATH . $file . '.class.php';
		}
		
		date_default_timezone_set('Asia/Shanghai');
		
		/*
		 * define error and exception handlers.
		 */
		set_error_handler(array('ErrorHandler','captureError'));
		set_exception_handler(array('ErrorHandler','captureException'));
		register_shutdown_function(array('ErrorHandler','captureShutdown'));
		set_include_path(get_include_path() . CUSTOM_PATH);
		spl_autoload_register(array('self','autoload'));
	}
	public static function run()
	{
		foreach ($_GET as $key => $value)
		{
			preg_match('/[a-zA-Z0-9_]+/', $value,$matches);
			$_GET[$key] = $matches[0];
		}
		$mod = isset($_GET['mod']) ? $_GET['mod'] : 'Index';
		$act = isset($_GET['act']) ? $_GET['act'] : 'index';
		$a = new ProxyAction($mod . 'Action');
		$a->$act();
	}
}



