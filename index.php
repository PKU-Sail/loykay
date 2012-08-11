<?php 
//require_once './common/init.php';
$conn = mysql_connect(SAE_MYSQL_HOST_S . ':' . SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS) or die(mysql_error());

/*error_reporting(E_PARSE); // ceshi
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

//fsockopen('https://api.weibo.com/oauth2/access_token','80','');
$code = $_GET['code'];
$data = array(
	'client_id' => '3811326615',
	'client_secret' => '142e1db6be74fd704fa8e6110d7cecc6',
	'grant_type' => 'authorization_code',
	'code' => $code,
	'redirect_uri' => 'http://loykay.sinaapp.com',
);

$a = array();
foreach($data as $k=>$v)
{
	array_push($a,$k . '=' . $v);
}
$str = implode('&',$a);
$lenth = strlen($str);

$code = $_GET['code'];
$header = "POST https://api.weibo.com/oauth2/access_token HTTP/1.1\n";
$header.= "Host:api.weibo.com\n";
$header.= "Referer:http://loykay.sinaapp.com/?code=" . $code . "\n";
$header.= "Content-Type:application/x-www-form-urlencoded\n";
$header.= "Content-Length:" . $lenth . "\n";
$header.= "Connection: close\n";
$header.= "\n";
$header.= $str . "\n";

/*$fp = fsockopen('api.weibo.com','443',$errno,$errstr,10) or exit($errstr."---->".$errno);

fputs($fp,$header);
while(!feof($fp))
{
	$line = fgets($fp,1024);
	var_dump($line);
}
fclose($fp);*/


$submit_url = "https://api.weibo.com/oauth2/access_token"; 

$curl = curl_init(); 

curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC ) ; 
//curl_setopt($curl, CURLOPT_USERPWD, "username:password"); 
curl_setopt($curl, CURLOPT_SSLVERSION,3); 
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); 
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); 
curl_setopt($curl, CURLOPT_HEADER, true); 
curl_setopt($curl, CURLOPT_POST, true); 
curl_setopt($curl, CURLOPT_POSTFIELDS, $str ); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)"); 
curl_setopt($curl, CURLOPT_URL, $submit_url); 
$rrr = curl_exec($curl);
//$data = explode("text/html", $rrr);
//$temp = explode("\r\n", $data[1]) ; 
//$result = unserialize( $temp[2] ) ; 
$pattern = "/{.*}/";
preg_match($pattern,$rrr,$matches);
var_dump($matches);

//var_dump($rrr);
//print_r($result); 
//curl_close($curl); 



//continue testin....  please continue test it!!!!
?>

<meta property="wb:webmaster" content="1d98aeefbf497e72" />

<form action="https://api.weibo.com/2/statuses/update.json" method="post">
<input name="status" type="text"/>
<input name="access_token" value="<?php echo $_GET['code']; ?>" type="hidden"/>

<input type="submit" value="submit"/>
</form>
</html>


<form action="https://api.weibo.com/oauth2/access_token" method="post">
<input name="client_id" value="3811326615" type="hidden"/>
<input name="client_secret" value="142e1db6be74fd704fa8e6110d7cecc6" type="hidden" />
<input name="grant_type" value="authorization_code" type="hidden"/>
<input name="code" value="<?php echo $_GET['code']; ?>" type="hidden"/>
<input name="redirect_uri" value="http://loykay.sinaapp.com/" type="hidden" />
<input name="submit" value="submit" type="submit"  />
</form>













