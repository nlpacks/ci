-- MySQL dump 10.13  Distrib 5.1.41, for debian-linux-gnu (x86_64)
--
-- Host: 192.168.80.89    Database: test
-- ------------------------------------------------------
-- Server version	5.1.41-3ubuntu12.10

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL,
  `args` varchar(64) NOT NULL,
  `opvalue` varchar(128) NOT NULL,
  `opname` varchar(128) NOT NULL,
  `state` int(10) unsigned NOT NULL DEFAULT '0',
  `index` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_options_project_id` (`pid`),
  CONSTRAINT `FK_options_project_id` FOREIGN KEY (`pid`) REFERENCES `projects` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=281 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `options`
--

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
INSERT INTO `options` VALUES (1,3,'droid_region','1','c8560ar',1,1),(2,3,'droid_region','2','c8560ca_approve',1,1),(3,3,'droid_region','3','c8560ca_CN',1,1),(4,3,'droid_region','4','c8560ca',1,1),(5,3,'droid_region','5','c8560_Claro_Do',1,1),(6,3,'droid_region','6','c8560_Claro_PA',1,1),(7,3,'droid_region','7','c8560_Claro_PE',1,1),(8,3,'droid_region','8','c8560_Claro_PR',1,1),(9,3,'droid_region','9','c8560cr',1,1),(10,3,'droid_region','10','c8560',1,1),(11,3,'droid_region','11','c8560_Digitel_VE',1,1),(12,3,'droid_region','12','c8560_Entel_BO',1,1),(13,3,'droid_region','13','c8560ni_approve',1,1),(14,3,'droid_region','14','c8560_PCD_PNG',1,1),(15,3,'droid_region','15','c8560_TELCEL_MX',1,1),(16,3,'droid_region','16','c8560_TE_VZ',1,1),(17,3,'droid_region','17','c8663',1,1),(18,3,'droid_region','18','cellon',1,1),(19,3,'arm_region','1','C8560',1,2),(20,3,'arm_region','2','C8560ca',1,2),(21,3,'arm_region','3','C8560_TELCEL_MX',1,2),(22,3,'arm_region','4','c8560_Entel_BO',1,2),(23,3,'arm_region','5','C8560ca_cr',1,2),(24,3,'arm_region','6','c8560_Claro_PE',1,2),(25,3,'arm_region','7','c8560_Claro_PA',1,2),(26,3,'arm_region','8','c8560_Claro_Do',1,2),(27,3,'arm_region','9','c8560ca_approve',1,2),(28,3,'arm_region','10','c8560_Digitel_VE',1,2),(29,3,'arm_region','11','c8560_Digicel_PA',1,2),(30,3,'arm_region','12','c8560_Claro_PR',1,2),(31,3,'arm_region','13','c8560ni_approve',1,2),(32,1,'droid_region_choices','1','Latam',1,4),(33,1,'droid_region_choices','2','Latam_claro',1,4),(34,1,'droid_region_choices','3','Latam_Telcel',1,4),(35,1,'droid_region_choices','4','PRC',1,4),(36,1,'droid_region_choices','5','WE',1,4),(37,2,'arm_product_choices','1','C8560',1,3),(38,2,'arm_product_choices','2','C8560ca',1,3),(39,2,'arm_product_choices','3','C8560_TELCEL_MX',1,3),(40,2,'arm_product_choices','4','c8560_Entel_BO',1,3),(41,2,'arm_product_choices','5','C8560ca_cr',1,3),(42,2,'arm_product_choices','6','c8560_Claro_PE',1,3),(43,2,'arm_product_choices','7','c8560_Claro_PA',1,3),(44,2,'arm_product_choices','8','c8560_Claro_DR',1,3),(45,2,'arm_product_choices','9','c8560_Digicel_Pacific',1,3),(46,2,'arm_product_choices','10','c8560_Digitel_VE',1,3),(47,2,'arm_product_choices','11','c8560_Digicel_Panama',1,3),(48,2,'arm_product_choices','12','c8560_Claro_PR',1,3),(49,2,'arm_product_choices','13','c8560ni_approve',1,3),(50,2,'variant_choices','1','user',1,1),(51,2,'variant_choices','2','userdebug',1,1),(52,2,'variant_choices','3','eng',1,1),(53,2,'droid_customer_choices','1','c8560ar',1,2),(54,2,'droid_customer_choices','2','c8560ca_approve',1,2),(55,2,'droid_customer_choices','3','c8560ca_CN',1,2),(56,2,'droid_customer_choices','4','c8560ca',1,2),(57,2,'droid_customer_choices','5','c8560_Claro_DR',1,2),(58,2,'droid_customer_choices','6','c8560_Claro_PA',1,2),(59,2,'droid_customer_choices','7','c8560_Claro_PE',1,2),(60,2,'droid_customer_choices','8','c8560_Claro_PR',1,2),(61,2,'droid_customer_choices','9','c8560cr',1,2),(62,2,'droid_customer_choices','10','c8560',1,2),(63,2,'droid_customer_choices','11','c8560_Digicel_Pacific',1,2),(64,2,'droid_customer_choices','12','c8560_Digicel_Panama',1,2),(65,2,'droid_customer_choices','13','c8560_Digitel_VE',1,2),(66,2,'droid_customer_choices','14','c8560_Entel_BO',1,2),(67,2,'droid_customer_choices','15','c8560ni_approve',1,2),(68,2,'droid_customer_choices','16','c8560_PCD_PNG',1,2),(69,2,'droid_customer_choices','17','c8560_TELCEL_MX',1,2),(70,2,'droid_customer_choices','18','c8560_TE_VZ',1,2),(71,2,'droid_customer_choices','19','c8663',1,2),(72,2,'droid_customer_choices','20','cellon',1,2),(73,4,'variant_choices','1','user',1,1),(74,4,'variant_choices','2','userdebug',1,1),(75,4,'variant_choices','3','eng',1,1),(76,4,'droid_customer_choices','1','c8092a',1,2),(77,4,'droid_customer_choices','2','c8092',1,2),(78,4,'droid_customer_choices','3','c8092-gov',1,2),(79,4,'droid_customer_choices','4','c8092l',1,2),(80,4,'droid_customer_choices','5','c8092_mifone',1,2),(81,4,'droid_customer_choices','6','c8092p-co',1,2),(82,4,'droid_customer_choices','7','c8092p',1,2),(83,4,'droid_customer_choices','8','c8092q',1,2),(84,4,'droid_customer_choices','9','c8092s',1,2),(85,4,'droid_customer_choices','10','c8092s-my',1,2),(86,4,'droid_customer_choices','11','c8092T',1,2),(87,4,'droid_customer_choices','12','c8092TE-GT',1,2),(88,4,'droid_customer_choices','13','c8092_telenor',1,2),(89,4,'droid_customer_choices','14','c8092-tempVersion',1,2),(90,4,'droid_customer_choices','15','c8093c-cm',1,2),(91,4,'droid_customer_choices','16','c8093c_id',1,2),(92,4,'droid_customer_choices','17','c8093c_my',1,2),(93,4,'droid_customer_choices','18','c8093GF',1,2),(94,4,'droid_customer_choices','19','c8093GF-EN',1,2),(95,4,'droid_customer_choices','20','c8093i',1,2),(96,4,'droid_customer_choices','21','c8093j',1,2),(97,4,'droid_customer_choices','22','c8093k',1,2),(98,4,'droid_customer_choices','23','c8093m',1,2),(99,4,'droid_customer_choices','24','c8093mi',1,2),(100,4,'droid_customer_choices','25','c8093m-mc',1,2),(101,4,'droid_customer_choices','26','c8093p',1,2),(102,4,'droid_customer_choices','27','c8093p-de',1,2),(103,4,'droid_customer_choices','28','c8093p-gt',1,2),(104,4,'droid_customer_choices','29','c8093p-mv',1,2),(105,4,'droid_customer_choices','30','c8093p-pr',1,2),(106,4,'droid_customer_choices','31','c8093s',1,2),(107,4,'droid_customer_choices','32','c8093_telenor',1,2),(108,4,'droid_customer_choices','33','c8093_tigo',1,2),(109,4,'droid_customer_choices','34','c8096',1,2),(110,4,'droid_customer_choices','35','c8663',1,2),(111,4,'droid_customer_choices','36','c8868',1,2),(112,4,'droid_customer_choices','37','cellon',1,2),(113,4,'droid_customer_choices','38','gongqing',1,2),(114,4,'arm_product_choices','1','C8092',1,3),(115,4,'arm_product_choices','2','C8093',1,3),(116,4,'arm_product_choices','3','C8093J',1,3),(117,4,'arm_product_choices','4','C8093M',1,3),(118,4,'arm_product_choices','5','C8096',1,3),(119,4,'arm_product_choices','6','C8663',1,3),(120,4,'arm_product_choices','7','C8868',1,3),(121,4,'arm_product_choices','8','C8092a',1,3),(122,4,'arm_product_choices','9','C8093p',1,3),(123,4,'arm_product_choices','10','C8093_tigo',1,3),(124,4,'arm_product_choices','11','C8092L',1,3),(125,4,'arm_product_choices','12','C8093p-xx',1,3),(126,4,'arm_product_choices','13','C8093c-cm',1,3),(127,4,'arm_product_choices','14','C8092p-co',1,3),(128,5,'build_type_choices','1','release',1,1),(129,5,'build_type_choices','2','debug',1,1),(130,5,'variant_choices','1','user',1,3),(131,5,'variant_choices','2','userdebug',1,3),(132,5,'variant_choices','3','eng',1,3),(133,5,'droid_product_choices','1','c8093d',1,2),(134,5,'droid_product_choices','2','c8096cm',1,2),(135,5,'droid_product_choices','3','c8096lf',1,2),(136,5,'droid_product_choices','4','c8096p',1,2),(137,5,'droid_product_choices','5','core',1,2),(138,5,'droid_product_choices','6','full_dream',1,2),(139,5,'droid_product_choices','7','full',1,2),(140,5,'droid_product_choices','8','full_passion',1,2),(141,5,'droid_product_choices','9','full_sapphire',1,2),(142,5,'droid_product_choices','10','generic_dream',1,2),(143,5,'droid_product_choices','11','generic',1,2),(144,5,'droid_product_choices','12','generic_passion',1,2),(145,5,'droid_product_choices','13','generic_sapphire',1,2),(146,5,'droid_product_choices','14','msm7625_ffa',1,2),(147,5,'droid_product_choices','15','msm7625_surf',1,2),(148,5,'droid_product_choices','16','msm7627_7x_ffa',1,2),(149,5,'droid_product_choices','17','msm7627_7x_surf',1,2),(150,5,'droid_product_choices','18','msm7630_1x',1,2),(151,5,'droid_product_choices','19','msm7630_fusion',1,2),(152,5,'droid_product_choices','20','msm7630_surf',1,2),(153,5,'droid_product_choices','21','msm8660_csfb',1,2),(154,5,'droid_product_choices','22','msm8660_surf',1,2),(155,5,'droid_product_choices','23','qsd8250_ffa',1,2),(156,5,'droid_product_choices','24','qsd8250_surf',1,2),(157,5,'droid_product_choices','25','qsd8650a_st1x',1,2),(158,5,'droid_product_choices','26','sample_addon',1,2),(159,5,'droid_product_choices','27','sdk',1,2),(160,5,'droid_product_choices','28','sim',1,2),(161,5,'arm_product_choices','1','C8092',1,4),(162,5,'arm_product_choices','2','C8093',1,4),(163,5,'arm_product_choices','3','C8096',1,4),(164,5,'arm_product_choices','4','C8560',1,4),(165,5,'arm_product_choices','5','C8096P',1,4),(166,5,'arm_product_choices','6','C8096LF',1,4),(167,5,'arm_product_choices','7','C8096CM',1,4),(168,6,'build_type_choices','1','release',1,1),(169,6,'build_type_choices','2','debug',1,1),(170,6,'variant_choices','1','user',1,3),(171,6,'variant_choices','2','userdebug',1,3),(172,6,'variant_choices','3','eng',1,3),(173,6,'droid_product_customer_choices','1','c8096',1,4),(174,6,'droid_product_customer_choices','2','c8096s_Generic',1,4),(175,6,'droid_product_choices','1','c8096',1,2),(176,6,'droid_product_choices','2','core',1,2),(177,6,'droid_product_choices','3','full_dream',1,2),(178,6,'droid_product_choices','4','full',1,2),(179,6,'droid_product_choices','5','full_passion',1,2),(180,6,'droid_product_choices','6','full_sapphire',1,2),(181,6,'droid_product_choices','7','generic_dream',1,2),(182,6,'droid_product_choices','8','generic',1,2),(183,6,'droid_product_choices','9','generic_passion',1,2),(184,6,'droid_product_choices','10','generic_sapphire',1,2),(185,6,'droid_product_choices','11','msm7625_ffa',1,2),(186,6,'droid_product_choices','12','msm7625_surf',1,2),(187,6,'droid_product_choices','13','msm7627_7x_ffa',1,2),(188,6,'droid_product_choices','14','msm7627_7x_surf',1,2),(189,6,'droid_product_choices','15','msm7630_1x',1,2),(190,6,'droid_product_choices','16','msm7630_fusion',1,2),(191,6,'droid_product_choices','17','msm7630_surf',1,2),(192,6,'droid_product_choices','18','msm8660_csfb',1,2),(193,6,'droid_product_choices','19','msm8660_surf',1,2),(194,6,'droid_product_choices','20','qsd8250_ffa',1,2),(195,6,'droid_product_choices','21','qsd8250_surf',1,2),(196,6,'droid_product_choices','22','qsd8650a_st1x',1,2),(197,6,'droid_product_choices','23','sample_addon',1,2),(198,6,'droid_product_choices','24','sdk',1,2),(199,6,'droid_product_choices','25','sim',1,2),(200,6,'arm_product_choices','1','C8092',1,5),(201,6,'arm_product_choices','2','C8093',1,5),(202,6,'arm_product_choices','3','C8096',1,5),(203,6,'arm_product_choices','4','C8560',1,5),(204,6,'arm_product_choices','5','C8096P',1,5),(205,6,'arm_product_choices','6','C8096LF',1,5),(206,6,'arm_product_choices','7','C8096CM',1,5),(207,7,'build_type_choices','1','release',1,1),(208,7,'build_type_choices','2','debug',1,1),(209,7,'variant_choices','1','user',1,3),(210,7,'variant_choices','2','userdebug',1,3),(211,7,'variant_choices','3','eng',1,3),(212,7,'droid_product_customer_choices','1','cellon',1,4),(213,7,'droid_product_customer_choices','2','i8560_cherrymobile',1,4),(214,7,'droid_product_customer_choices','3','i8560_CSL',1,4),(215,7,'droid_product_customer_choices','4','i8560_CSLNEW',1,4),(216,7,'droid_product_customer_choices','5','i8560_MIFONE',1,4),(217,7,'droid_product_customer_choices','6','i8560_SP',1,4),(218,7,'droid_product_customer_choices','7','i8560_WE',1,4),(219,7,'droid_product_choices','1','c8560_4_4_csl',1,2),(220,7,'droid_product_choices','2','c8560_4_4_cslnew',1,2),(221,7,'droid_product_choices','3','c8560_4_4',1,2),(222,7,'droid_product_choices','4','c8560_4_4_sp',1,2),(223,7,'droid_product_choices','5','c8560',1,2),(224,7,'droid_product_choices','6','core',1,2),(225,7,'droid_product_choices','7','full_dream',1,2),(226,7,'droid_product_choices','8','full',1,2),(227,7,'droid_product_choices','9','full_passion',1,2),(228,7,'droid_product_choices','10','full_sapphire',1,2),(229,7,'droid_product_choices','11','generic_dream',1,2),(230,7,'droid_product_choices','12','generic',1,2),(231,7,'droid_product_choices','13','generic_passion',1,2),(232,7,'droid_product_choices','14','generic_sapphire',1,2),(233,7,'droid_product_choices','15','msm7625_ffa',1,2),(234,7,'droid_product_choices','16','msm7625_surf',1,2),(235,7,'droid_product_choices','17','msm7627_7x_ffa',1,2),(236,7,'droid_product_choices','18','msm7627_7x_surf',1,2),(237,7,'droid_product_choices','19','msm7630_1x',1,2),(238,7,'droid_product_choices','20','msm7630_fusion',1,2),(239,7,'droid_product_choices','21','msm7630_surf',1,2),(240,7,'droid_product_choices','22','msm8660_csfb',1,2),(241,7,'droid_product_choices','23','msm8660_surf',1,2),(242,7,'droid_product_choices','24','qsd8250_ffa',1,2),(243,7,'droid_product_choices','25','qsd8250_surf',1,2),(244,7,'droid_product_choices','26','qsd8650a_st1x',1,2),(245,7,'droid_product_choices','27','sample_addon',1,2),(246,7,'droid_product_choices','28','sdk',1,2),(247,7,'droid_product_choices','29','sim',1,2),(248,7,'arm_product_choices','1','C8092',1,5),(249,7,'arm_product_choices','2','C8093',1,5),(250,7,'arm_product_choices','3','C8096',1,5),(251,7,'arm_product_choices','4','IC8560_2_2',1,5),(252,7,'arm_product_choices','5','C8096P',1,5),(253,7,'arm_product_choices','6','C8096LF',1,5),(254,7,'arm_product_choices','7','C8096CM',1,5),(255,7,'arm_product_choices','8','IC8560_4_4',1,5),(256,1,'build_type_choices','1','release',1,1),(257,1,'build_type_choices','2','debug',1,1),(258,1,'droid_product_choices','1','A8660',1,2),(259,1,'droid_product_choices','2','core',1,2),(260,1,'droid_product_choices','3','full_crespo',1,2),(261,1,'droid_product_choices','4','full',1,2),(262,1,'droid_product_choices','5','full_passion',1,2),(263,1,'droid_product_choices','6','generic',1,2),(264,1,'droid_product_choices','7','generic_x86',1,2),(265,1,'droid_product_choices','8','msm7627a',1,2),(266,1,'droid_product_choices','9','sample_addon',1,2),(267,1,'droid_product_choices','10','sdk',1,2),(268,1,'droid_product_choices','11','sim',1,2),(269,1,'variant_choices','1','user',1,3),(270,1,'variant_choices','2','userdebug',1,3),(271,1,'variant_choices','3','eng',1,3),(272,1,'arm_product_choices','1','C8661',1,5),(273,1,'arm_product_choices','2','C8661_P1',1,5),(274,1,'arm_product_choices','3','C8093J',1,5),(275,1,'arm_product_choices','4','C8093M',1,5),(276,1,'arm_product_choices','5','C8096',1,5),(277,1,'arm_product_choices','6','C8663',1,5),(278,1,'arm_product_choices','7','C8868',1,5),(279,1,'arm_product_choices','8','A8660',1,5),(280,1,'arm_product_choices','9','M8662',1,5);
/*!40000 ALTER TABLE `options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL DEFAULT '',
  `shell` varchar(128) NOT NULL,
  `src` text NOT NULL,
  `spl` varchar(64) NOT NULL,
  `splemail` varchar(32) NOT NULL,
  `pri` int(10) unsigned NOT NULL DEFAULT '1000',
  `desc` varchar(128) NOT NULL DEFAULT '',
  `state` int(10) unsigned NOT NULL DEFAULT '0',
  `serverid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_projects_servers_id` (`serverid`),
  CONSTRAINT `FK_projects_servers_id` FOREIGN KEY (`serverid`) REFERENCES `servers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'A8660','/home/buildsrv/Lucky_Code_90/A8660','http://192.168.80.89/svn/a8660am/trunk','King Xu','King.Xu@cellon.com',1000,'A8660',1,3),(2,'C8560','/home/build/lucky_Project/script','http://192.168.80.90/svn/cellonmsmrepo/msm7627/branches/C8560','Jc Wan','Jc.Wan@cellon.com',1000,'C8560',1,3),(3,'C8560','/home/buildsrv/Lucky_Code_90/C8560','http://192.168.80.90/svn/cellonmsmrepo/msm7627/branches/C8560','Jc Wan','Jc.Wan@cellon.com',1000,'C8560',1,4),(4,'C8092','/home/build/lucky_Project/script','http://192.168.80.90/svn/cellonmsmrepo/msm7627/branches/c8092a','King Xu','King.Xu@cellon.com',1000,'C8092',1,3),(5,'C8096','/home/build/lucky_Project/script','http://192.168.80.90/svn/cellonmsmdsrepo/msm7627/branches/C8096','King Xu','King.Xu@cellon.com',1000,'C8096',1,3),(6,'C8096s','/home/build/lucky_Project/script','http://192.168.80.90/svn/cellonmsmdsrepo/msm7627/branches/C8096s','King Xu','King.Xu@cellon.com',1000,'C8096s',1,3),(7,'IC8560','/home/build/lucky_Project/script','http://192.168.80.90/svn/cellonmsmdsrepo/msm7627/branches/IC8560','King Xu','King.Xu@cellon.com',1000,'IC8560',1,3);
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `selectoptions`
--

DROP TABLE IF EXISTS `selectoptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `selectoptions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tkey` varchar(32) NOT NULL,
  `args` varchar(32) NOT NULL,
  `opvalue` varchar(32) NOT NULL,
  `pid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `selectoptions`
--

LOCK TABLES `selectoptions` WRITE;
/*!40000 ALTER TABLE `selectoptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `selectoptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servers`
--

DROP TABLE IF EXISTS `servers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `host` varchar(32) NOT NULL,
  `port` int(11) NOT NULL DEFAULT '0',
  `state` int(10) unsigned NOT NULL DEFAULT '0',
  `desc` varchar(64) NOT NULL DEFAULT '',
  `logpath` varchar(128) NOT NULL,
  `releasepath` varchar(128) NOT NULL,
  PRIMARY KEY (`id`,`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servers`
--

LOCK TABLES `servers` WRITE;
/*!40000 ALTER TABLE `servers` DISABLE KEYS */;
INSERT INTO `servers` VALUES (1,'192.168.80.44','192.168.80.44',2000,1,'test server','/home/roger/data/logfile','\\\\192.168.80.44\\smp-res'),(2,'192.168.80.89','192.168.80.89',2000,1,'Tinboost','/mnt/dropbox','\\\\192.168.80.89\\smp-res'),(3,'192.168.80.106','192.168.80.106',2000,1,'ArgonSpin','/tmp','\\\\192.168.80.106\\smp-res'),(4,'192.168.80.90','192.168.80.90',2000,1,'PCD','/home/dropbox/logfile','\\\\192.168.80.90\\smp-res');
/*!40000 ALTER TABLE `servers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `commituser` varchar(32) NOT NULL DEFAULT '',
  `committime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `commithost` varchar(32) NOT NULL,
  `state` int(10) unsigned NOT NULL DEFAULT '0',
  `logfile` varchar(64) NOT NULL DEFAULT '',
  `completetime` datetime DEFAULT '0000-00-00 00:00:00',
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `canceluser` varchar(32) DEFAULT NULL,
  `cancelhost` varchar(32) DEFAULT NULL,
  `canceltime` datetime DEFAULT NULL,
  `jobstarttime` datetime DEFAULT NULL,
  `type` varchar(32) NOT NULL,
  `opkey` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tasks_project_ID` (`pid`),
  CONSTRAINT `FK_tasks_project_ID` FOREIGN KEY (`pid`) REFERENCES `projects` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-05-08 13:46:59
