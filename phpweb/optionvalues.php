<?php

class optionvalues
{
	private $collection = array();
	function load()
	{
		$this->collection = array();
		$sql="SELECT o.id,p.projectid,p.sequence,p.optionid,o.fname,o.fvalue 
				FROM optionvalues o, options s,projectoptions p 
				where o.optionid=s.id and s.id=p.optionid and s.state=1 and o.state=1 and p.state=1 
				order by p.projectid,p.sequence,o.fname; ";		
		$result=mysql_query($sql);
		if (!$result)
		{
			throw new Exception("get project option values data fail:".mysql_error());
		}

		while(($row = mysql_fetch_array($result))!==false)
		{
			$ov=new optionvalues();
			$ov->id=$row["id"];
			$ov->projectid=$row["projectid"];
			$ov->optionid=$row["optionid"];
			$ov->name=$row["fname"];
			$ov->value=$row["fvalue"];
						
			$this->collection[strval($ov->projectid)."_".strval($ov->optionid)][]=$ov;			
		}
		return $this->collection;
	}
	
}

?>