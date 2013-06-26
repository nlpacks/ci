<?php
function __autoload($class_name)
{
	require_once $class_name . '.php';
}

try {
	session_start();
	
	$sec=new securitycheck();
	$sec->isLogin();

	$db=new Database();
	$db->connect();

	if (isset($_POST["state"]))
		$state=$_POST["state"];
	if (isset($_POST["developer"]))
		$developer=urldecode($_POST["developer"]);
	if (isset($_POST["starttime"]))
		$starttime=urldecode($_POST["starttime"]);
	if (isset($_POST["endtime"]))
		$endtime=urldecode($_POST["endtime"]);
	if (isset($_POST["projectid"]))
		$projectid=$_POST["projectid"];
	
	$tk=new task();
	
	if (isset($_POST["state"]))
		$arrayTask=$tk->filter($state,$developer,$starttime,$endtime,$projectid);
	else
		$arrayTask=$tk->load();


	$so=new selectoptions();
	$arrayTaskSelectOptions=$so->filter($arrayTask);
	//$arrayTaskSelectOptions=$so->load();

	if (!isset($_POST["action"]))
		echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Frameset//EN\">
				<html>
				<head>
				<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
				<script src=\"build.js\"></script>
				<script src=\"datetimepicker.js\"></script>
				<title>show all task</title>
				</head>
				<body>current user:".$_SESSION["developer"]."<br>
				<span id=\"taskcontent\">";


	echo "<table  border=\"1\">
			<tr>
			<td>id</td>
			<td>name</td>
			<td>projectId</td>
			<td>commituser</td>
			<td>committime</td>
			<td>commithost</td>
			<td>state</td>
			<td>buildOptons</td>
			<td>logfile</td>
			<td>jobstarttime</td>
			<td>completetime</td>
			<td>canceluser</td>
			<td>cancelhost</td>
			<td>canceltime</td>
			<td>ftype</td>
			<td>operator</td>
			</tr>";

	config::matchTaskSelectOptions($arrayTask, $arrayTaskSelectOptions);
	foreach ($arrayTask as $key => $value)
	{
		echo "<tr>
				<td nowrap>".$value->id."</td>
				<td nowrap>".$value->name."</td>
				<td nowrap>".$value->projectid."</td>
				<td nowrap>".$value->commituser."</td>
				<td nowrap>".$value->committime."</td>
				<td nowrap>".$value->commithost."</td>
				<td nowrap>".$value->stateToHTML()."</td>
				<td nowrap>".$value->selectOptionToHTMLTable()."</td>
				<td nowrap>".$value->logfileToHTML()."</td>
				<td nowrap>".$value->jobstarttime."</td>
				<td nowrap>".$value->completetime."</td>
				<td nowrap>".$value->canceluser."</td>
				<td nowrap>".$value->cancelhost."</td>
				<td nowrap>".$value->canceltime."</td>
				<td nowrap>".$value->ftyeToHTML()."</td>
				<td nowrap>".$value->operatorToHTML($_SESSION["developer"])."</td>
			</tr>";
	}
	$db->disconnect();
	echo "</table>";
	
	if (!isset($_POST["action"]))
		echo "</span>
			<br>
			<hr>adv filter
			<br>state <select id=\"state\" name=\"state\">
						<option value=\"-1\">all</option>
						<option value=\"".config::$Task_Wait."\">wait</option>
						<option value=\"".config::$Task_Working."\">working</option>								
						<option value=\"".config::$Task_Cancel."\">cancel</option>
						<option value=\"".config::$Task_Success."\">execute success</option>
 						<option value=\"".config::$Task_Failure."\">execute fail</option>						
						<option value=\"".config::$Task_Submit_Failure."\">submit fail</option>
					</select> 
			<br>commiter <input type=\"text\" id=\"developer\" name=\"developer\">
			<br>commit time from <input type=\"text\" id=\"starttime\" name=\"starttime\" readonly=\"true\" onclick=\"javascript:NewCssCal('starttime','yyyyMMdd','arrow',true,'24',true)\" style=\"cursor:pointer\"> to <input type=\"text\" id=\"endtime\" name=\"endtime\" readonly=\"true\" onclick=\"javascript:NewCssCal('endtime','yyyyMMdd','arrow',true,'24',true)\" style=\"cursor:pointer\">
			<br>projectid <input type=\"text\" id=\"projectid\" name=\"projectid\" maxlength=\"10\" onkeyup=\"this.value=this.value.replace(/[^\\d]/g,'');\">
			<br><input type=\"button\" value=\"filter\" onclick=\"filtertask()\"> &nbsp;&nbsp;<input type=\"button\" value=\"reset\" onclick=\"resetfilter()\">
			<br>
			<hr>
			<a href=\"#\" onclick=\"javascript:history.go(-1)\">back</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"logout.php\">logout</a>
			</body>
			</html>";
}
catch (Exception $e)
{
	echo $e->getMessage();
	echo "<br><a href=\"#\" onclick=\"javascript:history.go(-1)\">back</a>";
}

?>