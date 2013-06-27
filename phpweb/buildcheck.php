<?php

function __autoload($class_name)
{
	require_once $class_name . '.php';
}

	session_start();
	
	$sec=new securitycheck();
	$sec->isLogin();
	
	
	$pid=$_POST["pid"];
	$pname=$_POST["pname"];
	$ftype=$_POST["ftype"];	
	$developer=$_SESSION["developer"];
	$groups=$_POST["groups"];
	
	$build=new submitbuild();
	
	$db=new Database();
	try {
		$db->connect();
		
		if ($build->existTask($pid,$_POST)>0)
		{
			echo "exist";
			return;
		}
		echo "ok";
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
	}
	$db->disconnect();
	
?>
