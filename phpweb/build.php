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
	
	$logfile=$pname."_".$developer."_".date('Y-m-d_H-i-s').".log";
	
	$ctx = hash_init('md5');
	hash_update($ctx,  session_id().$_SERVER["REMOTE_ADDR"].date('Y-m-d H:i:s'));
	$opkey=hash_final($ctx);
	
	$sql="insert into tasks (projectid,name,commituser,committime,commithost,state,logfile,ftype,tkey) values ("
			.$pid.",'"
			.$pname."','"
			.$developer."','"
			.date('Y-m-d H:i:s')."','"
			.$_SERVER["REMOTE_ADDR"]."',"
			.config::$Task_Wait.",'"
			.$logfile."','"
			.$ftype."','"
			.$opkey."');";
	
	$build=new submitbuild();
	
	$sqlArray=$build->submitArgs($pid,$opkey,$_POST);
	$db=new Database();
	try {
		$db->connect();

		$db->executeSql($sql);
		foreach ($sqlArray as $value)
		{
			$db->executeSql($value);
		}
	}
	catch (Exception $e)
	{
				
		try {
			$rollbacksql="update tasks set state=".config::$Task_Submit_Failure." where tkey='".$opkey."';";
			if (!mysql_query($rollbacksql))
				throw new Exception("update task state failed :".mysql_error());
		}
		catch (Exception $ex)
		{
			echo $e->getMessage();
		}		
		$db->disconnect();
		echo $e->getMessage();
		return;
	}
	//提交任务的数据到数据库和通知编译服务器处理任务要分成两个过程
	//如果编译服务器宕机了，允许将任务的相关数据保存到数据库，编译服务器重启后会读取数据库所有未处理的任务循环处理
	try {
		$server=new servers();
		$server->filter($groups);
		//send socket message to notify build server
		$socket=new socket($server->host,$server->port);
		$socket->send(config::$Task_For_Build."/".$groups.";");

		echo "success";
	}
	catch (Exception $ex)
	{
		echo $ex->getMessage();
	}
	$db->disconnect();
	
?>
