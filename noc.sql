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
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `infoid` int(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `size` int(10) NOT NULL,
  `type` varchar(50) NOT NULL,
  `tm` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
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
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `sortid` int(5) NOT NULL default '0',
  `title` varchar(150) NOT NULL,
  `memo` varchar(65000) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket` (
  `id` int(11) NOT NULL auto_increment,
  `st` datetime NOT NULL,
  `et` datetime NOT NULL default '0000-00-00 00:00:00',
  `memo` varchar(255) character set latin1 collate latin1_bin NOT NULL,
  `op` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticketdetail` (
  `id` int(11) NOT NULL auto_increment,
  `tid` int(11) NOT NULL,
  `tm` datetime NOT NULL,
  `memo` varchar(255) character set latin1 collate latin1_bin NOT NULL,
  `op` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `email` varchar(50) NOT NULL,
  `pop3server` varchar(50) NOT NULL,
  `isadmin` tinyint(4) NOT NULL,
  `truename` varchar(20) NOT NULL,
  PRIMARY KEY  (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userright` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `user` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  `right` int(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `module` (
  `id` int(4) unsigned NOT NULL auto_increment,
  `module` varchar(50) NOT NULL,
  `memo` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
INSERT INTO `module` VALUES (1,'jifang','机房巡检'),(2,'ticket','故障处理'),(3,'server','服务器管理'),(4,'odf','ODF管理'),(5,'ip','IP管理'),(6,'info','常用信息'),(7,'user','用户管理'),(8,'ALL','所有模块');
