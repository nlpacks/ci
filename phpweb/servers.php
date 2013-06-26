<?php

class servers
{
	private $collection = array();
	function load()
	{
		$this->collection = array();
		$sql="select * from servers where state=1 order by id";		
		$result=mysql_query($sql);
		if (!$result)
		{
			throw new Exception("get server data fail:".mysql_error());
		}

		while(($row = mysql_fetch_array($result))!==false)
		{
			$ov=new servers();
			$ov->id=$row["id"];
			$ov->name=$row["name"];
			$ov->host=$row["host"];
			$ov->port=$row["port"];
			$ov->state=$row["state"];
			$ov->remark=$row["remark"];	
			$this->collection[]=$ov;			
		}
		return $this->collection;
	}
	function filter($groups)
	{
		$sql="SELECT s.* FROM groups g, servers s where g.serverid=s.id and g.state=1 and s.state=1 and  g.name='".$groups."' ;";		
		$result=mysql_query($sql);
		if (!$result)
		{
			throw new Exception("filter server by project groups fail:".mysql_error());
		}

		while(($row = mysql_fetch_array($result))!==false)
		{
			$this->id=$row["id"];
			$this->name=$row["name"];
			$this->host=$row["host"];
			$this->port=$row["port"];
			$this->state=$row["state"];
			$this->remark=$row["remark"];	
		}
		return $this;
	}
	function filterByTask($tid)
	{
		$sql="SELECT s.* 
				FROM tasks t , projects p, groups g ,servers s 
				where t.projectid=p.id and p.groupid =g.id and g.serverid=s.id and t.id=".$tid;
		$result=mysql_query($sql);
		if (!$result)
		{
			throw new Exception("filter server by task id fail:".mysql_error());
		}
	
		while(($row = mysql_fetch_array($result))!==false)
		{
			$this->id=$row["id"];
			$this->name=$row["name"];
			$this->host=$row["host"];
			$this->port=$row["port"];
			$this->state=$row["state"];
			$this->remark=$row["remark"];
		}
		return $this;
	}
}

?>
