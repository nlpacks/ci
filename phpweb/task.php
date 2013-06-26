<?php

class task
{
	private $collection = array();
	function load()
	{
		$this->collection = array();
		$sql="select g.name as groups,s.host,t.id,t.name,t.commituser,t.committime,t.commithost,t.state,t.logfile,t.completetime,t.projectid,t.canceluser,t.cancelhost,t.canceltime,t.jobstarttime,t.ftype,t.tkey 
				from projects p,tasks t,groups g,servers s 
				where (t.state=".config::$Task_Wait." or t.state=".config::$Task_Working." ) and p.id=t.projectid and g.id=p.groupid and s.id=g.serverid 
				order by t.id ;";
		$result=mysql_query($sql);
		if (!$result)
		{
			throw new Exception("get task data fail:".mysql_error());
		}
		while(($row = mysql_fetch_array($result))!==false)
		{
			$tk=new task();
			$tk->id=$row["id"];
			$tk->name=$row["name"];
			$tk->groups=$row["groups"];
			$tk->host=$row["host"];			
			$tk->commituser=$row["commituser"];
			$tk->committime=$row["committime"];
			$tk->commithost=$row["commithost"];
			$tk->state=$row["state"];
			$tk->logfile=$row["logfile"];
			$tk->completetime=$row["completetime"];
			$tk->projectid=$row["projectid"];
			$tk->canceluser=$row["canceluser"];
			$tk->cancelhost=$row["cancelhost"];
			$tk->canceltime=$row["canceltime"];
			$tk->jobstarttime=$row["jobstarttime"];
			$tk->ftype=$row["ftype"];
			$tk->tkey=$row["tkey"];

			$this->collection[]=$tk;
		}
		return $this->collection;
	}
	function filterByGroups($groups)
	{
		$this->collection = array();		
		$sql="select g.name as groups,s.host,t.id,t.name,t.commituser,t.committime,t.commithost,t.state,t.logfile,t.completetime,t.projectid,t.canceluser,t.cancelhost,t.canceltime,t.jobstarttime,t.ftype,t.tkey 
				from projects p,tasks t,groups g,servers s 
				where (t.state=".config::$Task_Wait." or t.state=".config::$Task_Working." ) and g.id=p.groupid and s.id=g.serverid and p.id=t.projectid and g.name=='".$groups."' 
				order by t.id;";		
		$result=mysql_query($sql);
		if (!$result)
		{
			throw new Exception("get tasks data fail:".mysql_error());
		}

		while(($row = mysql_fetch_array($result))!==false)
		{
			$tk=new task();
			$tk->id=$row["id"];
			$tk->name=$row["name"];
			$tk->groups=$row["groups"];
			$tk->host=$row["host"];
			$tk->commituser=$row["commituser"];
			$tk->committime=$row["committime"];
			$tk->commithost=$row["commithost"];
			$tk->state=$row["state"];
			$tk->logfile=$row["logfile"];
			$tk->completetime=$row["completetime"];
			$tk->projectid=$row["projectid"];
			$tk->canceluser=$row["canceluser"];
			$tk->cancelhost=$row["cancelhost"];
			$tk->canceltime=$row["canceltime"];
			$tk->jobstarttime=$row["jobstarttime"];
			$tk->ftype=$row["ftype"];
			$tk->tkey=$row["tkey"];

			$this->collection[]=$tk;
		}
		return $this->collection;
	}
	function filter($state,$developer,$starttime,$endtime,$projectid)
	{
		$this->collection = array();
		$sql="select g.name as groups,s.host,t.id,t.name,t.commituser,t.committime,t.commithost,t.state,t.logfile,t.completetime,t.projectid,t.canceluser,t.cancelhost,t.canceltime,t.jobstarttime,t.ftype,t.tkey 
				from projects p,tasks t,groups g,servers s 
				where p.id=t.projectid and g.id=p.groupid and s.id=g.serverid  ";
		
		if ($state>-1)
			$sql=$sql." and t.state=".$state;
		//is NULL or empty string ?
		if (isset($developer) && empty($developer) ==false )
			$sql=$sql." and t.commituser='".$developer."'";
		if (isset($starttime) && empty($starttime) ==false )
			$sql=$sql." and t.committime>='".$starttime."'";
		if (isset($endtime) && empty($endtime) ==false )
			$sql=$sql." and t.committime<='".$endtime."'";
		if (isset($projectid) && empty($projectid) ==false )
			$sql=$sql." and p.id=".$projectid;	
			
		$sql=$sql." order by t.id; ";
		
		$result=mysql_query($sql);
		
		if (!$result)
		{
			throw new Exception("get tasks data fail:".mysql_error());
		}
	
		while(($row = mysql_fetch_array($result))!==false)
		{
			$tk=new task();
			$tk->id=$row["id"];
			$tk->name=$row["name"];
			$tk->groups=$row["groups"];
			$tk->host=$row["host"];			
			$tk->commituser=$row["commituser"];
			$tk->committime=$row["committime"];
			$tk->commithost=$row["commithost"];
			$tk->state=$row["state"];
			$tk->logfile=$row["logfile"];
			$tk->completetime=$row["completetime"];
			$tk->projectid=$row["projectid"];
			$tk->canceluser=$row["canceluser"];
			$tk->cancelhost=$row["cancelhost"];
			$tk->canceltime=$row["canceltime"];
			$tk->jobstarttime=$row["jobstarttime"];
			$tk->ftype=$row["ftype"];
			$tk->tkey=$row["tkey"];
	
			$this->collection[]=$tk;
		}
		return $this->collection;
	}
	
	function isAdmin($currentdeveloper)
	{
		$sql="select * from config where fname='admin' and state=1 ;";
		$result=mysql_query($sql);
		if (!$result)
		{
			throw new Exception("get config data fail:".mysql_error());
		}
		$value="";
		while(($row = mysql_fetch_array($result))!==false)
		{
			$value=$row["fvalue"];
		}
		$pos=strpos(strtolower(",".$value.","),strtolower(",".$currentdeveloper.","));
		if ($pos === false)
			return false;
		else return true;
	}
	function selectOptionToHTMLTable()
	{
		$str="<table>";
		foreach($this->selectoptionArray as $key => $value)
		{
			$str=$str."<tr><td nowrap>-".$value->optionname."=".$value->selectvalue."</td></tr>";
		}
		return $str."</table>";
	}
	function operatorToHTML($currentdeveloper)
	{
		$str="";
		if ($currentdeveloper==$this->commituser || $this->isAdmin($currentdeveloper))
		{
			if ($this->state==config::$Task_Wait)
				$str="<input type=\"button\" value=\"cancel\" onclick=\"canceltask(".$this->id.")\"/>";
			if ($this->state==config::$Task_Working)
				$str="<input type=\"button\" value=\"stop\" onclick=\"interrupttask(".$this->id.")\"/>";
		}
		
		return $str;
	}
	function stateToHTML()
	{
		$str="";
		if ($this->state==config::$Task_Cancel )
			$str="cancel by user";
		if ($this->state==config::$Task_Failure )
			$str="done but failure";
		if ($this->state==config::$Task_Success )
			$str="done and success";
		if ($this->state==config::$Task_Submit_Failure )
			$str="submit failure";
		if ($this->state==config::$Task_Wait )
			$str="waiting...";
		if ($this->state==config::$Task_Working )
			$str="<font color=\"red\">working...</font>";		
		return $str;
	}
	function ftyeToHTML()
	{
		$str="";
		if (strcasecmp($this->ftype,config::$Task_For_Build)==0 )
			$str="project compile";
		if (strcasecmp($this->ftype,config::$Task_For_Pack)==0 )
			$str="pack file for release";
		if (strcasecmp($this->ftype,config::$Task_For_Patch)==0 )
			$str="create patch file";
		return $str;
	}
	function logfileToHTML()
	{
		return "\\\\".$this->host."\\logs\\".$this->groups."\\".$this->logfile;
	}
}

?>
