ALTER TABLE  JF_Server CHANGE USER USER VARCHAR( 50 ) ;

update module set id=97 where id=7;
update module set id=98 where id=8;

insert into module values(7,'vm','VM管理模块');
insert into module values(8,'lxr','联系人管理模块');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
CREATE TABLE `vm_cluster` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `memo` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
CREATE TABLE `vm_server` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `cid` int(8) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `memo` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
