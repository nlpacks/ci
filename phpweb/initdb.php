<?php
	include "Database.php";
	

	$rhost=$_POST["host"];
	$ruser=$_POST["user"];
	$rpasswd=$_POST["passwd"];

	try {
		$db=new Database();
		$db->connect();
		$pdb=new ProductDatabase($db);
		$pdb->createDB();
		$db->disconnect();
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
	}
?>