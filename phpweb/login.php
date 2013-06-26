<?php
function __autoload($class_name)
{
	require_once $class_name . '.php';
}
if (!isset($_POST["user"]))
	exit;
if (!isset($_POST["passwd"]))
	exit;
$passwd=$_POST["passwd"];
$user=$_POST["user"];
session_start();

try {
	$ldap=new ldap(config::$LDAP_Server_Host,config::$LDAP_Server_Port);

	$isvalidate= $ldap->validate($user."@cellon.com",$passwd);

	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	if (strcmp($isvalidate , "ok")==0)
	{
		$_SESSION["developer"]=$user;
		$extra = 'showproject.php';
	}
	else
	{
		$extra = 'index.html';
	}
	header("Location: http://$host$uri/$extra");

}
catch (Exception $e)
{
	echo $e->getMessage();
	echo "<br><a href=\"#\" onclick=\"javascript:history.go(-1)\">back</a>";
}

?>