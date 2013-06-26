<?php

function __autoload($class_name)
{
	require_once $class_name . '.php';
}

	session_start();
	
	$sec=new securitycheck();
	$sec->isLogin();

	$tid=$_POST["id"];
	//$developer=$_COOKIE["developer"];
	$canceluser=$_SESSION["developer"];
	$cancelhost=$_SERVER["REMOTE_ADDR"];
	$canceltime=date('Y-m-d_H-i-s');
	
	$sqlcheck="select state from tasks where id=".$tid;
	$sql="update tasks set canceluser='".$canceluser."',cancelhost='".$cancelhost."',canceltime='".$canceltime."',state=".config::$Task_Cancel." where id=".$tid;

	

	$db=new Database();
	try {
		$db->connect();
		
		
		$result=mysql_query($sqlcheck);
		if (!$result)
		{
			throw new Exception("get task state fail:".mysql_error());
		}
		while(($row = mysql_fetch_array($result))!==false)
		{
			$state=$row["state"];
		}
		if ($state == config::$Task_Wait)
		{
			$db->executeSql($sql);
			echo "success";
		}
		else
			echo "fail";
		$db->disconnect();

	}
	catch (Exception $e)
	{
		echo $e->getMessage();			
		$db->disconnect();
		return;
	}
	
?>
