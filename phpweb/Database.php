<?php

class Database
{
	public $con;

	public function connect()
	{
		$con=mysql_connect(config::$Database_Host_Address, config::$Database_User_Name, config::$Database_User_Password);
		if (!$con)
		{
			throw new Exception('Could not connect: '.mysql_error());
		}
		$this->con=$con;
		mysql_query("SET NAMES UTF8");
		mysql_query("SET CHARACTER SET UTF8");
		mysql_query("SET CHARACTER_SET_RESULTS=UTF8'");
		mysql_select_db("builddb", $con);
	}
	public function executeSql($sql)
	{
		if (!mysql_query($sql))			
			throw new Exception("[".$sql."] execute failed :".mysql_error());
	}
	public function disconnect()
	{
		mysql_close($this->con);
	}
}

class ProductDatabase
{
	private $db;
	public function  __construct($db)
	{
		$this->db=$db;
	}
	public function createDB()
	{
		if (!mysql_query("drop database build; ",$this->db->con))
		{
			throw new Exception("drop database failed :".mysql_error());
		}
		else {
			echo "drop database successful;<br>";
		}
		if (!mysql_query("create database build; ",$this->db->con))
		{
			throw new Exception("create database failed :".mysql_error());
		}
		else {
			echo "create database successful;<br>";
		}
		$this->db->connect();
		if (!mysql_query("DROP TABLE IF EXISTS servers; ",$this->db->con))
		{
			throw new Exception("DROP TABLE IF EXISTS servers failed :".mysql_error());
		}
		else {
			echo "DROP TABLE servers successful;<br>";
		}
		if (!mysql_query("DROP TABLE IF EXISTS projects; ",$this->db->con))
		{
			throw new Exception("DROP TABLE IF EXISTS projects failed :".mysql_error());
		}
		else {
			echo "DROP TABLE projects successful;<br>";
		}	
		if (!mysql_query("DROP TABLE IF EXISTS options; ",$this->db->con))
		{
			throw new Exception("DROP TABLE IF EXISTS options failed :".mysql_error());
		}
		else {
			echo "DROP TABLE options successful;<br>";
		}
		if (!mysql_query("DROP TABLE IF EXISTS optionvalues; ",$this->db->con))
		{
			throw new Exception("DROP TABLE IF EXISTS optionvalues failed :".mysql_error());
		}
		else {
			echo "DROP TABLE optionvalues successful;<br>";
		}		
		if (!mysql_query("DROP TABLE IF EXISTS selectoptions; ",$this->db->con))
		{
			throw new Exception("DROP TABLE IF EXISTS selectoptions failed :".mysql_error());
		}
		else {
			echo "DROP TABLE selectoptions successful;<br>";
		}		
		if (!mysql_query("DROP TABLE IF EXISTS tasks; ",$this->db->con))
		{
			throw new Exception("DROP TABLE IF EXISTS tasks failed :".mysql_error());
		}
		else {
			echo "DROP TABLE tasks successful;<br>";
		}

		
		

		if (!mysql_query("CREATE TABLE  servers (  id int(10) unsigned NOT NULL AUTO_INCREMENT,  name varchar(64) NOT NULL DEFAULT '',  host varchar(32) NOT NULL,  port int(11) NOT NULL DEFAULT '0',  state int(10) unsigned NOT NULL DEFAULT '0',  remark varchar(64) NOT NULL DEFAULT '',  PRIMARY KEY (id,name) USING BTREE) ; ",$this->db->con))
		{
			throw new Exception("CREATE TABLE  servers failed :".mysql_error());
		}
		else {
			echo "CREATE TABLE servers successful;<br>";
		}		
		if (!mysql_query("CREATE TABLE  projects (  id int(10) unsigned NOT NULL AUTO_INCREMENT,  name varchar(128) NOT NULL DEFAULT '',  src text NOT NULL,  principal varchar(64) NOT NULL,  principalemail varchar(32) NOT NULL,  pri int(10) unsigned NOT NULL DEFAULT '1000',  remark varchar(128) NOT NULL DEFAULT '',  state int(10) unsigned NOT NULL DEFAULT '0',  groups varchar(128) NOT NULL,  serverid int(10) unsigned NOT NULL,  PRIMARY KEY (id),  KEY FK_projects_servers_id (serverid)) ; ",$this->db->con))
		{
			throw new Exception("CREATE TABLE  projects failed :".mysql_error());
		}
		else {
			echo "CREATE TABLE projects successful;<br>";
		}		
		if (!mysql_query("CREATE TABLE  options (  id int(10) unsigned NOT NULL AUTO_INCREMENT,  pid int(10) unsigned NOT NULL,  name varchar(128) NOT NULL,  ftype varchar(128) NOT NULL,  sequence int(10) unsigned NOT NULL DEFAULT '1',  state int(10) unsigned NOT NULL DEFAULT '0',  category varchar(64) NOT NULL,  PRIMARY KEY (id),  KEY FK_extends_projects (pid),  CONSTRAINT FK_extends_projects FOREIGN KEY (pid) REFERENCES projects (id));",$this->db->con))
		{
			throw new Exception("CREATE TABLE  options failed :".mysql_error());
		}
		else {
			echo "CREATE TABLE options successful;<br>";
		}	
		if (!mysql_query("CREATE TABLE  optionvalues (  id int(10) unsigned NOT NULL AUTO_INCREMENT,  pid int(10) unsigned NOT NULL,  oid int(10) unsigned NOT NULL,  opname varchar(256) NOT NULL,  opvalue varchar(256) NOT NULL,  state int(10) unsigned NOT NULL DEFAULT '1',  PRIMARY KEY (id)) ;",$this->db->con))
		{
			throw new Exception("CREATE TABLE  optionvalues failed :".mysql_error());
		}
		else {
			echo "CREATE TABLE optionvalues successful;<br>";
		}	
		if (!mysql_query("CREATE TABLE  selectoptions (  id int(10) unsigned NOT NULL AUTO_INCREMENT,  tkey varchar(32) NOT NULL,  oname varchar(32) NOT NULL,  opvalue varchar(32) NOT NULL,  pid int(10) unsigned NOT NULL,  PRIMARY KEY (id)); ",$this->db->con))
		{
			throw new Exception("CREATE TABLE  selectoptions failed :".mysql_error());
		}
		else {
			echo "CREATE TABLE selectoptions successful;<br>";
		}		
		if (!mysql_query("CREATE TABLE  tasks (  id int(10) unsigned NOT NULL AUTO_INCREMENT,  name varchar(64) NOT NULL DEFAULT '',  commituser varchar(32) NOT NULL DEFAULT '',  committime datetime NOT NULL DEFAULT '0000-00-00 00:00:00',  commithost varchar(32) NOT NULL,  state int(10) unsigned NOT NULL DEFAULT '0',  logfile varchar(64) NOT NULL DEFAULT '',  completetime datetime DEFAULT '0000-00-00 00:00:00',  pid int(10) unsigned NOT NULL DEFAULT '0',  canceluser varchar(32) DEFAULT NULL,  cancelhost varchar(32) DEFAULT NULL,  canceltime datetime DEFAULT NULL,  jobstarttime datetime DEFAULT '0000-00-00 00:00:00',  ftype varchar(32) NOT NULL,  opkey varchar(32) NOT NULL,  PRIMARY KEY (id),  KEY FK_tasks_project_ID (pid),  CONSTRAINT FK_tasks_project_ID FOREIGN KEY (pid) REFERENCES projects (id)) ; ",$this->db->con))
		{
			throw new Exception("CREATE TABLE  tasks failed :".mysql_error());
		}
		else {
			echo "CREATE TABLE tasks successful;<br>";
		}		

		
		
		
		if (!mysql_query("INSERT INTO servers VALUES (1,'192.168.80.44','192.168.80.44',2000,1,'test server'),(2,'192.168.80.89','192.168.80.89',2000,1,'Tinboost'),(3,'192.168.80.106','192.168.80.106',2000,1,'ArgonSpin'),(4,'192.168.80.90','192.168.80.90',2000,1,'PCD');",$this->db->con))
		{
			throw new Exception("init server list data failed :".mysql_error());
		}
		else {
			echo "init server list data successful;<br>";
		}

		if (!mysql_query("INSERT INTO projects VALUES (1,'A8660','http://192.168.80.89/svn/a8660am/trunk','King Xu','King.Xu@cellon.com',1000,'A8660',1,'A8660',1),(2,'C8680','ssh://roger.liu@192.168.80.106:29418/qrd8625r4/android.git','Zhenhua Gong','Zhenhua.Gong@cellon.com',1000,'C8680 for Haier',1,'Android4',1),(3,'C8560','http://192.168.80.90/svn/cellonmsmrepo/msm7627/branches/C8560','Jc Wan','Jc.Wan@cellon.com',1000,'C8560',1,'C8560',4),(4,'C8092','http://192.168.80.90/svn/cellonmsmrepo/msm7627/branches/c8092a','King Xu','King.Xu@cellon.com',1000,'C8092',1,'C8092',3),(5,'C8096','http://192.168.80.90/svn/cellonmsmdsrepo/msm7627/branches/C8096','King Xu','King.Xu@cellon.com',1000,'C8096',1,'C8096',3),(6,'C8096s','http://192.168.80.90/svn/cellonmsmdsrepo/msm7627/branches/C8096s','King Xu','King.Xu@cellon.com',1000,'C8096s',1,'C8096s',3),(7,'IC8560','http://192.168.80.90/svn/cellonmsmdsrepo/msm7627/branches/IC8560','King Xu','King.Xu@cellon.com',1000,'IC8560',1,'IC8560',3);",$this->db->con))
		{
			throw new Exception("init test project data failed :".mysql_error());
		}
		else {
			echo "init test project data successful;<br>";
		}

		if (!mysql_query("INSERT INTO options VALUES (1,1,'device','select',1,1,'build'),(2,1,'type','select',2,1,'build'),(3,1,'product','select',3,1,'build'),(4,1,'variant','select',4,1,'build'),(5,1,'region','select',5,1,'build'),(6,1,'logo','select',6,1,'build'),(7,1,'ANDROID_DISPLAY_VERSION','text',7,1,'build'),(8,1,'classjar','keylist',5,1,'show'),(9,1,'metasjar','keylist',6,1,'show'),(10,1,'language','select',1,1,'show'),(11,1,'module','text',2,1,'show'),(12,1,'plugin','select',3,1,'show'),(13,1,'catalog','text',4,1,'show'),(14,1,'PRODUCT_OTA_PUBLIC_KEYS','text',8,1,'build'),(15,1,'key','keylist',10,0,'build'),(16,2,'type','select',1,1,'build'),(17,2,'product','select',2,1,'build'),(18,2,'variant','select',3,1,'build');",$this->db->con))
		{
			throw new Exception("init test project options data failed :".mysql_error());
		}
		else {
			echo "init test project options data successful;<br>";
		}
		if (!mysql_query("INSERT INTO optionvalues VALUES (1,1,1,'Device','1',1),(2,1,1,'Simulator','2',1),(3,1,2,'release','1',1),(4,1,2,'debug','2',1),(5,1,3,'C8660','1',1),(6,1,3,'core','2',1),(7,1,3,'full_crespo','3',1),(8,1,3,'full','4',1),(9,1,3,'full_passion','5',1),(10,1,3,'generic','6',1),(11,1,3,'generic_x86','7',1),(12,1,3,'msm7627a','8',1),(13,1,3,'sample_addon','9',1),(14,1,3,'sdk','10',1),(15,1,3,'sim','11',1),(16,1,4,'user','1',1),(17,1,4,'userdebug','2',1),(18,1,4,'eng','3',1),(19,1,5,'2degrees_NZ','1',1),(20,1,5,'Airtel_African','2',1),(21,1,5,'CCE_Brazil','3',1),(22,1,5,'Galander_Argentina','4',1),(23,1,5,'Latam','5',1),(24,1,5,'Latam_claro','6',1),(25,1,5,'Latam_Claro_PA','7',1),(26,1,5,'Latam_Claro_Peru','8',1),(27,1,5,'Latam_Comcel','9',1),(28,1,5,'Latam_Digicel_Pacific','10',1),(29,1,5,'Latam_Telcel','11',1),(30,1,5,'PRC','12',1),(31,1,5,'WE','13',1),(32,1,5,'WifiEnd','14',1),(33,1,5,'YU','15',1),(34,1,6,'Latam.png','0',1),(35,1,6,'2degrees_NZ.png','1',1),(36,1,6,'Latam_Digicel_Pacific.png','2',1),(37,1,6,'Latam_Claro_Peru.png','3',1),(38,1,6,'Digitel.png','4',1),(39,1,6,'Latam_Comcel.png','5',1),(40,1,6,'CCE_Brazil.png','6',1),(41,1,6,'Open_Market.png','7',1),(42,1,6,'motorola.png','8',1),(43,1,6,'PRC.png','9',1),(44,1,6,'YU.png','10',1),(45,1,6,'PCD.png','11',1),(46,1,6,'Persona_Argentina.png','12',1),(47,1,6,'Airtel_African.png','13',1),(48,1,6,'Digicel.png','14',1),(49,1,6,'Latam_Telcel.png','15',1),(50,1,6,'WifiEnd.png','16',1),(51,1,6,'Latam_claro.png','17',1),(52,1,6,'Galander_Argentina.png','18',1),(53,1,6,'Latam_Claro_PA.png','19',1),(54,1,7,'ANDROID_DISPLAY_VERSION','C8660CA_Claro_CA_3.0 ',1),(55,1,14,'PRODUCT_OTA_PUBLIC_KEYS','ota.x509.pem',1),(56,2,16,'release','1',1),(57,2,16,'debug','2',1),(58,2,17,'A8660','1',1),(59,2,17,'C8680','2',1),(60,2,17,'copper','3',1),(61,2,17,'core','4',1),(62,2,17,'full_maguro','5',1),(63,2,17,'full','6',1),(64,2,17,'full_panda','7',1),(65,2,17,'full_tuna','8',1),(66,2,17,'full_x86','9',1),(67,2,17,'generic_armv5','10',1),(68,2,17,'generic','11',1),(69,2,17,'generic_x86','12',1),(70,2,17,'HWW820','13',1),(71,2,17,'large_emu_hw','14',1),(72,2,17,'msm7627_6x','15',1),(73,2,17,'msm7627a','16',1),(74,2,17,'msm7627_surf','17',1),(75,2,17,'msm7630_fusion','18',1),(76,2,17,'msm7630_surf','19',1),(77,2,17,'msm8660_surf','20',1),(78,2,17,'msm8960','21',1),(79,2,17,'sample_addon','22',1),(80,2,17,'sdk','23',1),(81,2,17,'sdk_x86','24',1),(82,2,17,'sesamejam','25',1),(83,2,17,'TinBoost','26',1),(84,2,17,'U8828D','27',1),(85,2,17,'vbox_x86','28',1),(86,2,18,'user','1',1),(87,2,18,'userdebug','2',1),(88,2,18,'eng','3',1);",$this->db->con))
		{
			throw new Exception("init test project option values data failed :".mysql_error());
		}
		else {
			echo "init test project option values data successful;<br>";
		}
	}

}

?>