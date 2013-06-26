<?php


class project
{
	function load()
	{
		$collection = array();
		$sql="SELECT p.*,g.name as groupname,g.serverid FROM projects p,groups g where p.state=1 and g.state=1 and p.groupid=g.id order by p.id;";
		$result=mysql_query($sql);
		if (!$result)
		{
			throw new Exception("get project data fail:".mysql_error());
		}
		while(($row = mysql_fetch_array($result))!==false)
		{
			$pj=new project();
			$pj->id=$row["id"];
			$pj->name=$row["name"];
			$pj->src=$row["src"];
			$pj->principal=$row["principal"];
			$pj->principalemail=$row["principalemail"];
			$pj->pri=$row["pri"];
			$pj->remark=$row["remark"];
			$pj->state=$row["state"];
			$pj->groups=$row["groupname"];
			$pj->serverid=$row["serverid"];
			$collection[]=$pj;
		}
		return $collection;
	}
	function filterByGroups($groups)
	{
		$collection = array();
		$sql="SELECT p.*,g.name as groupname,g.serverid FROM projects p,groups g where p.state=1 and g.state=1 and p.groupid=g.id and g.name='".$groups."' order by p.id;";
		$result=mysql_query($sql);
		if (!$result)
		{
			throw new Exception("get project data fail:".mysql_error());
		}

		while(($row = mysql_fetch_array($result))!==false)
		{
			$pj=new project();
			$pj->id=$row["id"];
			$pj->name=$row["name"];
			$pj->src=$row["src"];
			$pj->principal=$row["principal"];
			$pj->principalemail=$row["principalemail"];
			$pj->pri=$row["pri"];
			$pj->remark=$row["remark"];
			$pj->state=$row["state"];
			$pj->groups=$row["groupname"];
			$pj->serverid=$row["serverid"];
			$collection[]=$pj;
		}
		return $collection;
	}

	function optionsToHtmlTable()
	{
		$str="<table border=\"1\">";

		foreach ($this->optionArray as $value)
		{
			$id=$value->id;
			$pid=$value->projectid;
			$type=$value->ftype;
			$name=$value->name;
			$elementid=$name."_".$pid."_".$id;
			if ($type == config::$Project_Select_Option)
			{
				$str=$str."<tr>
						<td>".$name."</td>
								<td><select id=\"".$elementid."\" name=\"".$name."\">".$value->optionValuesToHTML()."</select></td>
										</tr>";
			}
			else if ($type == config::$Project_Text_Option)
			{
				$str=$str."<tr>
						<td>".$name."</td>
								<td><input type=\"text\" id=\"".$elementid."\" name=\"".$name."\" value=\"".$value->optionValuesToHTML()."\"></td>
										</tr>";
			}
			else if ($type == config::$Project_Key_Option)
			{
				$str=$str."<tr>
						<td colspan=\"2\">
						<table border=\"1\">
						<tr><td colspan=\"2\">".$name."</td></tr>"
								.$value->optionValuesToHTML().
								"</table>
										</td>
										</tr>";
			}
				
		}

		$str=$str."</table>";
		return $str;
	}
	function optionsToJavaScriptArray()
	{
		$str="";
		foreach ($this->optionArray as $value)
		{
			$id=$value->id;
			$pid=$value->projectid;
			$name=$value->name;
			$str=$str.",'".$name."_".$pid."_".$id."'";
		}

		if (strlen($str)>1)
			$str=substr($str,1);

		$str="new Array(".$str.")";
		return $str;
	}

}

?>