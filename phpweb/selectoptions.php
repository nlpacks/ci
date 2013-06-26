<?php

class selectoptions
{
	private $collection = array();
	function load()
	{
		$this->collection = array();
		$sql="select * from selectoptions  order by pid,id ";		
		$result=mysql_query($sql);
		if (!$result)
		{
			throw new Exception("get task select option values data fail:".mysql_error());
		}

		while(($row = mysql_fetch_array($result))!==false)
		{
			$ov=new selectoptions();
			$ov->id=$row["id"];
			$ov->tasktkey=$row["tasktkey"];
			$ov->projectid=$row["projectid"];
			$ov->optionname=$row["optionname"];
			$ov->selectvalue=$row["selectvalue"];
						
			$this->collection[strval($row["tasktkey"])][]=$ov;				
		}
		return $this->collection;
	}
	function filter($taskArray)
	{
		$this->collection = array();
		$sql="SELECT distinct s.id,s.tasktkey,s.optionname,s.selectvalue,s.projectid
		      FROM  selectoptions s, tasks t,options o,projectoptions p
		      where  s.tasktkey=t.tkey and o.name=s.optionname and p.optionid=o.id  and ";
		$tmpsql="";
		foreach($taskArray as $key => $value)
		{
			$tmpsql=$tmpsql." or t.id=".$value->id;
		}
		if (strlen($tmpsql) == 0)
			return;
		else
			$tmpsql=substr($tmpsql,3);
		$sql=$sql." ( ".$tmpsql." ) order by p.projectid,t.tkey,p.sequence ;";

		
		$result=mysql_query($sql);
		if (!$result)
		{
			throw new Exception("get tasks build options data fail:".mysql_error());
		}
		while(($row = mysql_fetch_array($result))!==false)
		{
			$ov=new selectoptions();
			$ov->id=$row["id"];
			$ov->tasktkey=$row["tasktkey"];
			$ov->projectid=$row["projectid"];
			$ov->optionname=$row["optionname"];
			$ov->selectvalue=$row["selectvalue"];
						
			$this->collection[strval($row["tasktkey"])][]=$ov;			
		}
		return $this->collection;
	}
}

?>
