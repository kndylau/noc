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
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;
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
  `USER` varchar(50) NOT NULL,
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
CREATE TABLE `file_del` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `infoid` int(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `size` int(10) NOT NULL,
  `type` varchar(50) NOT NULL,
  `tm` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
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
) ENGINE=MyISAM AUTO_INCREMENT=371 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `sortid` int(5) NOT NULL default '0',
  `title` varchar(150) NOT NULL,
  `memo` varchar(65000) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
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
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
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
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
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
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userpref` (
  `user` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` varchar(200) NOT NULL,
  PRIMARY KEY  (`user`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lxr` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `dept` varchar(40) NOT NULL,
  `name` varchar(20) NOT NULL,
  `dh` varchar(20) NOT NULL,
  `sj` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `qq` varchar(20) NOT NULL,
  `memo` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vm_cluster` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `memo` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vm_server` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `cid` int(8) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `memo` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vm_host` (
  `id` int(6) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `inuse` int(1) NOT NULL,
  `cid` varchar(50) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `use` varchar(100) NOT NULL,
  `st` date NOT NULL,
  `et` date NOT NULL,
  `lxr` varchar(20) NOT NULL,
  `cpu` varchar(3) NOT NULL,
  `mem` varchar(3) NOT NULL,
  `disk` varchar(8) NOT NULL,
  `disk2` varchar(8) NOT NULL,
  `memo` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `module` (
  `id` int(4) unsigned NOT NULL auto_increment,
  `module` varchar(50) NOT NULL,
  `memo` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=99 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
INSERT INTO `module` VALUES (1,'jifang','机房巡检'),(2,'ticket','故障处理'),(3,'server','服务器管理'),(4,'odf','ODF管理'),(5,'ip','IP管理'),(6,'info','常用信息'),(97,'user','用户管理'),(0,'ALL','所有模块'),(98,'sysinfo','系统管理'),(7,'vm','VM管理模块'),(8,'lxr','联系人管理模块');
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sysinfo` (
  `name` varchar(50) NOT NULL,
  `info` varchar(200) NOT NULL,
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
INSERT INTO `sysinfo` VALUES ('version','20150928'),('title','USTC机房管理'),('lxr','james@ustc.edu.cn');
