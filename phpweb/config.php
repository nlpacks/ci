<?php


class config
{
	public static $Database_Host_Address="192.168.80.89";
	public static $Database_User_Name="root";
	public static $Database_User_Password="cellonmysql!@#";
	
	public static $Project_Build_Option="build";
	public static $Project_Property_Option="show";

	public static $Project_Select_Option="select";
	public static $Project_Text_Option="text";
	public static $Project_Key_Option="keylist";
	public static $Task_Wait=4;
	public static $Task_Success=5;
	public static $Task_Failure=6;
	public static $Task_Working=104;
	public static $Task_Cancel=0;
	public static $Task_Submit_Failure=7;
	public static $Task_Interrupted=8;

	public static $Task_For_Build="build";
	public static $Task_For_Pack="pack";
	public static $Task_For_Patch="patch";
	public static $Task_For_Interrupt="interrupt";
	public static $LDAP_Server_Host="192.168.10.20";
	public static $LDAP_Server_Port=389;

	
	
	public static function matchProjectOptions($projectArray,$optionsArray,$optionValueArray)
	{
		foreach ($optionsArray as $value)
		{
			foreach ($value as $svalue)
			{
				//set project option list
				
				//if the options hasn't define any values, must set an empty array
				//otherwise there is an NULL object error
				if (isset($optionValueArray[strval($svalue->projectid)."_".strval($svalue->id)]))
					$svalue->optionValueArray=$optionValueArray[strval($svalue->projectid)."_".strval($svalue->id)];
				else
					$svalue=array();
			}
				
		}

		foreach ($projectArray as $value)
		{
			//set project option list
			//some project hasn't options, must check before set
			if (isset($optionsArray[strval($value->id)]))
				$value->optionArray=$optionsArray[strval($value->id)];
			else  //if no options array, set an empty size array, can't be an NULL object 
				$value->optionArray= array();
		}

	}
	public static function matchTaskSelectOptions($arrayTask, $arrayTaskSelectOptions)
	{
		foreach ($arrayTask as $value)
		{
			if (isset($arrayTaskSelectOptions[strval($value->tkey)]))
				$value->selectoptionArray=$arrayTaskSelectOptions[strval($value->tkey)];
			else
				$value->selectoptionArray=array();
		}
	}
}
?>
