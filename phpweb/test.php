
<?php
function __autoload($class_name)
{
	require_once $class_name . '.php';
}

try {
	session_start();	

		
	$db=new Database();
	$db->connect();
		
	/*
	 * 1：首先从数据库中的各个表中分别获取数据到多个数组中，所有的数据库连接查询都在这一步完成
	* 2：上一步获取的数据是各自独立的，还没有进行数据之间关联，定义一个数据关联的函数
	* 3：将多个数组中的数据进行关联，形成一个完整的project对象，通过单个project对象的成员方法可以直接获取该对类的扩展属性和具体的值，这一步是不需要再连接到数据库
	* 4：这样可以减少数据库连接的次数
	*/
	$pj=new project();
	$pjArray=$pj->load();
	$op=new options();
	$optionArray=$op->loadOptions(config::$Project_Build_Option);
	//$opextArray=$op->loadOptions(config::$Project_Property_Option);
	$ov=new optionvalues();
	$ovArray=$ov->load();
		
		
	config::matchProjectOptions($pjArray, $optionArray, $ovArray);
		
	echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Frameset//EN\">
				<html>
				<head>
				<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
				<script src=\"build.js\"></script>
				<title>show all projects</title>
				</head>
				<body>
				<table id=\"projectconetnt\" border=\"1\">";
		
	foreach ($pjArray as $value)
	{
		/*
		 * 这里循环列出项目所有的参数及其选项
		*
		*另外由于某些参数的值是允许在页面上进行修改，那么这些值就是动态变化的
		*同时这些参数的值必须传到另外一个地方写到数据库中去，那么这些参数的HTML元素的id在当前页面必须是唯一的
		*将这些元素的id组成一个jason的数组传给javascript
		*/
		echo "<tr>
				<td nowrap>".$value->id."</td>
						<td nowrap>".$value->name."</td>
								<td nowrap>".$value->src."</td>
										<td nowrap>".$value->principal."</td>
												<td nowrap>".$value->pri."</td>
														<td nowrap>".$value->groups."</td>
																<td nowrap>".$value->remark."</td>
																		<td nowrap>".$value->optionsToHtmlTable()."</td>
																				<td nowrap><input type=\"button\" value=\"build\" onclick=\"build(".$value->id.",'".$value->name."','".$value->groups."',".$value->optionsToJavaScriptArray().")\"></td>
																						</tr>";

	}
	$db->disconnect();
		
	echo "</table>
				<br>
				<a href=\"showtask.php\">show task</a>
				<br>
				<br>
				<a href=\"logout.php\">logout</a>
				</body>
				</html>";
}
catch (Exception $e)
{
	echo $e->getMessage();
	echo "<br><a href=\"#\" onclick=\"javascript:history.go(-1)\">back</a>";
}
?>
