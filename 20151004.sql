CREATE TABLE `ticket_system` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `sortid` int(5) NOT NULL default '0',
  `desc` varchar(40) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

insert into ticket_system values (1,1,'服务器');
insert into ticket_system values (2,2,'磁盘阵列');
insert into ticket_system values (3,3,'网络设备');
insert into ticket_system values (4,4,'互联网出口');
insert into ticket_system values (5,5,'专线');
insert into ticket_system values (6,6,'机房设施');

CREATE TABLE `ticket_reason` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `sortid` int(5) NOT NULL default '0',
  `desc` varchar(40) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

insert into ticket_reason values (1,1,'其他');
insert into ticket_reason values (2,2,'电源');
insert into ticket_reason values (3,3,'主板');
insert into ticket_reason values (4,4,'硬盘');
insert into ticket_reason values (5,5,'内存');
insert into ticket_reason values (6,6,'模块');
insert into ticket_reason values (7,7,'光缆');

ALTER TABLE  `ticket` ADD  `system` VARCHAR( 10 ) NOT NULL AFTER  `et`;
ALTER TABLE  `ticket` ADD  `reason` VARCHAR( 10 ) NOT NULL AFTER  `system` ;
ALTER TABLE  `ticket` ADD  `level` VARCHAR( 1 ) NOT NULL AFTER  `reason` ;

CREATE TABLE `ticket_level` (
  `id` int(2) NOT NULL auto_increment,
  `desc` varchar(40) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

insert into ticket_level values (1,'未感');
insert into ticket_level values (2,'轻微');
insert into ticket_level values (3,'严重');
insert into ticket_level values (4,'重大');
