<?php 
require_once './common/init.php';
/*error_reporting(E_PARSE);
require_once './lib/core/ErrorHandler.php';
set_error_handler(array('ErrorHandler','captureError'));
set_exception_handler(array('ErrorHandler','captureException'));
register_shutdown_function(array('ErrorHandler','captureShutdown'));
function lala($a)
{
	if($a=='a' || $a=='b'){
		throw new Exception('fuck', '123a');
	}
}
try {
	lala('a');
}catch (Exception $a){
	echo '<preg>';
	echo 'this information comes from catch code block.<br>';
	echo $a->getMessage();
	echo '</preg>';
}

undefined_function();*/


/*abstract class A
{
	
	public function __construct()
	{
		$this->sayHello();
	}
	
	abstract function sayHello();
}

class B extends A
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function sayHello()
	{
		echo 11111;
	}
}

new B();*/


/*$a = '';
if($a == true)
{
	echo 'a wei zhen'; 
}else
{
	echo 'a wei jia';
}*/


/*class BaseModel
{
	
}

class CompanyModel extends BaseModel
{
}

$a = new CompanyModel();
echo substr(get_class($a), 0,-5);*/

/*class A
{
	abstract $a;
}

class B extends A
{
	
}

$a = new B();
*/


/*mysql_connect('localhost','root','123123') or die ('failed 1');
mysql_select_db('project') or die ('2');
$result = mysql_query("select l.NAME as name1 , i.NAME as name2 from institution i , lesson l");
$aaa = array();
while($aa = mysql_fetch_assoc($result))
{
	array_push($aaa, $aa);
}
var_dump($aaa);

*/

/*$a = array('peter','louis');
next($a);
$a[key($a)] = 'susan';
echo current($a);
var_dump($a);*/

/*$str = '11122';
$a = substr($str, 1,-4);
echo $a;*/
?>




















