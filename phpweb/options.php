<?php

class options
{
	private $collection = array();
	function loadOptions($optioncategory)
	{
		$this->collection = array();
		$sql="SELECT o.*,p.projectid,p.sequence
				FROM projectoptions p, options o 
				where p.state=1 and o.state=1 and p.optionid=o.id and p.category='".$optioncategory."' 
				order by p.projectid,p.sequence; ";
		$result=mysql_query($sql);
		if (!$result)
		{
			throw new Exception("get project options data fail:".mysql_error());
		}

		while(($row = mysql_fetch_array($result))!==false)
		{
			$op=new options();
			$op->id=$row["id"];
			$op->projectid=$row["projectid"];
			$op->name=$row["name"];
			$op->ftype=$row["ftype"];
			$op->sequence=$row["sequence"];
			$this->collection[strval($row["projectid"])][]=$op;
		}
		return $this->collection;
	}
	function optionValuesToHTML()
	{
		$str="";
		if ($this->ftype == config::$Project_Select_Option)
		{
			foreach ($this->optionValueArray as $value)
			{
				$str=$str."<option value=\"".$value->value."\">".$value->name."</option>";
			}
		}
		else if ($this->ftype == config::$Project_Text_Option)
		{
			foreach ($this->optionValueArray as $value)
			{
				$str=$str.$value->value;
			}
		}
		else if ($this->ftype == config::$Project_Key_Option)
		{
			foreach ($this->optionValueArray as $value)
			{
				$str=$str."<tr><td><input type=\"text\" name=\"".$value->name."\" value=\"".$value->name."\"></td><td><input type=\"text\" name=\"".$value->value."\" value=\"".$value->value."\"></td></tr>";

			}
		}
		return $str;
	}
}

?>