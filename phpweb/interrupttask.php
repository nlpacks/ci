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
	$user=$_SESSION["developer"];
	$host=$_SERVER["REMOTE_ADDR"];
	$time=date('Y-m-d_H-i-s');
	
	$sqlcheck="select state from tasks where id=".$tid;
	$sql="update tasks set canceluser='".$user."',cancelhost='".$host."',canceltime='".$time."',state=".config::$Task_Interrupted." where id=".$tid;

	

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
		if ($state == config::$Task_Working)
		{
			$db->executeSql($sql);
			
			$server=new servers();
			$server->filterByTask($tid);
			//send socket message to notify build server
			$socket=new socket($server->host,$server->port);
			$socket->send(config::$Task_For_Interrupt."/".$tid.";");
			
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
