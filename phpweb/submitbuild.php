<?php
class submitbuild
{
	function filterTaskOptions($projectid)
	{
		$collection = array();
		$sql="SELECT distinct s.*
		      FROM  selectoptions s, tasks t,options o,projectoptions p
		      where  s.tasktkey=t.tkey and o.name=s.optionname and p.optionid=o.id
				and (t.state=".config::$Task_Wait." or t.state=".config::$Task_Working." ) and t.projectid=".$projectid."
			  order by p.projectid,t.tkey,p.sequence ;";
	
		$result=mysql_query($sql);
		if (!$result)
		{
			throw new Exception("get tasks build options data fail:".mysql_error());
		}
		while(($row = mysql_fetch_array($result))!==false)
		{
			$tasktkey=$row["tasktkey"];
			$optionname=$row["optionname"];
			$selectvalue=$row["selectvalue"];
			$collection[strval($row["tasktkey"])][]=$optionname."=".$selectvalue;
		}	
		return $collection;
	}
	
	
	function existTask($pid,$array)
	{
		//相同的提交请求判断标准
		//1: 项目projectid相同
		//2：提交的参数一样
		
		//从数据库中将当前状态为4或104的task相应的selectoptions找出来形成一个数组，然后按字典顺序排序
		//将当前要提交的参数也组合成一个数组并按字典顺序排序
		//循环比较当前的数组是否和task中每条任务的参数数组一样，如果一样，就表示己经存在相同的任务，否则就不存在相同的任务
		$total=0;
		$currentArgs=array();
		foreach ($array as $key => $value)
		{
			if ($key != "pid" && $key != "pname" && $key != "ftype" && $key != "groups" )
			{
				$currentArgs[]=$key."=".$value;
			}
		}
		asort($currentArgs);
		$currentArgs_str=implode(",", $currentArgs);
		$existArgs=$this->filterTaskOptions($pid);
		
		foreach ($existArgs as $value)
		{
			asort($value);
			$tArgs_str=implode(",", $value);

			if (strcmp($currentArgs_str,$tArgs_str)==0)
			{
				//exist same task with same arguments
				$total=1;
				break;
			}		
		}
		
		return $total>0;		
	}
	
	function submitArgs($pid,$tkey,$array)
	{
		$sqlArray=array();
		foreach ($array as $key => $value)
		{
			if ($key != "pid" && $key != "pname" && $key != "ftype" && $key != "groups" )
			{
				$sqlArray[]="insert into selectoptions (projectid,tasktkey,optionname,selectvalue) values (".$pid.",'".$tkey."','".$key."','".$value."');";
			}
		}
		return $sqlArray;
	}
}

?>