-- MySQL dump 10.11
--
-- Host: localhost    Database: noc
-- ------------------------------------------------------
-- Server version	5.0.95

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES latin1 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `IP`
--

DROP TABLE IF EXISTS `IP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `IP` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `IP` varchar(100) NOT NULL,
  `MASK` varchar(100) NOT NULL,
  `net` int(1) NOT NULL,
  `use` varchar(50) NOT NULL,
  `lxr` varchar(100) NOT NULL,
  `memo` varchar(250) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `JF_CAB`
--

DROP TABLE IF EXISTS `JF_CAB`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `JF_CAB` (
  `CABID` varchar(20) NOT NULL default '',
  `PS1` varchar(20) NOT NULL default '',
  `PS2` varchar(20) NOT NULL default '',
  `MGT` varchar(20) NOT NULL default '',
  `CABUSE` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`CABID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `JF_Server`
--

DROP TABLE IF EXISTS `JF_Server`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `JF_Server` (
  `ServerID` varchar(20) NOT NULL default '',
  `CABID` varchar(20) NOT NULL default '',
  `StartU` int(11) NOT NULL default '0',
  `EndU` int(11) NOT NULL default '0',
  `KVM` varchar(10) NOT NULL default '',
  `Type` varchar(40) NOT NULL default '',
  `NAME` varchar(200) NOT NULL default '',
  `USER` varchar(20) NOT NULL default '',
  `MGT` varchar(20) NOT NULL default '',
  `IP1` varchar(30) NOT NULL default '',
  `IP2` varchar(30) NOT NULL default '',
  `MAC1` varchar(30) NOT NULL default '',
  `MAC2` varchar(30) NOT NULL default '',
  `SN` varchar(30) NOT NULL default '',
  `Connector` varchar(100) NOT NULL default '',
  `Comment` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`ServerID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ODF`
--

DROP TABLE IF EXISTS `ODF`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ODF` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `JF` varchar(30) NOT NULL,
  `BH` varchar(30) NOT NULL,
  `USE` varchar(100) NOT NULL,
  `MEMO` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ODFPAN`
--

DROP TABLE IF EXISTS `ODFPAN`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ODFPAN` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `BH` varchar(20) NOT NULL,
  `X` int(2) unsigned NOT NULL,
  `S` varchar(6) NOT NULL,
  `DX` int(2) NOT NULL,
  `USE` varchar(50) NOT NULL,
  `TX` varchar(50) NOT NULL,
  `SB` varchar(50) NOT NULL,
  `MEMO` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=721 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hist`
--

DROP TABLE IF EXISTS `hist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hist` (
  `id` int(8) unsigned NOT NULL auto_increment,
  `tm` datetime NOT NULL,
  `oid` varchar(50) NOT NULL,
  `old` varchar(500) NOT NULL,
  `new` varchar(500) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=340 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `info`
--

DROP TABLE IF EXISTS `info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `sortid` int(5) NOT NULL default '0',
  `title` varchar(150) NOT NULL,
  `memo` varchar(65000) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `jifang_daily`
--

DROP TABLE IF EXISTS `jifang_daily`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jifang_daily` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tm` datetime NOT NULL,
  `huanjing` tinyint(1) unsigned NOT NULL,
  `server` tinyint(1) unsigned NOT NULL,
  `msg` varchar(255) NOT NULL,
  `op` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket` (
  `id` int(11) NOT NULL auto_increment,
  `st` datetime NOT NULL,
  `et` datetime NOT NULL default '0000-00-00 00:00:00',
  `memo` varchar(255) character set latin1 collate latin1_bin NOT NULL,
  `op` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ticketdetail`
--

DROP TABLE IF EXISTS `ticketdetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticketdetail` (
  `id` int(11) NOT NULL auto_increment,
  `tid` int(11) NOT NULL,
  `tm` datetime NOT NULL,
  `memo` varchar(255) character set latin1 collate latin1_bin NOT NULL,
  `op` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `email` varchar(50) NOT NULL,
  `isadmin` tinyint(4) NOT NULL,
  `truename` varchar(20) NOT NULL,
  PRIMARY KEY  (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-09-24 11:23:08
