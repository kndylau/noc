简单的机房管理辅助程序

<pre>

1. 安装过程

最简单的使用方法是下载虚拟机镜像。

1.1 虚拟机ovf文件请到 http://staff.ustc.edu.cn/~james/noc 下载
    虚拟机root密码为 noctest, 导入虚拟机系统，设置网卡，启动后请立即修改密码
    启动后修改IP地址，参照INSTALL.txt 2.5 创建第一个用户即可使用，即执行命令
mysql noc
> INSERT INTO user VALUES ('xyz@x.y.z', 'x.x.x.x', 1, '第一个用户');

其中xyz@x.y.z 是登录名，x.x.x.x是对应的POP3服务器，1 的含义是超级管理员
程序依靠用户输入的用户名、密码，利用pop3协议连接到邮件服务器上并认证身份

虚拟机镜像软件版本为4.7 2015.08.28 版本，使用虚拟机镜像，启动后请按照下述1.4更新软件

1.2 从虚拟机开始安装的详细步骤请参考 INSTALL.txt

1.3 如果在现有系统安装, 请参考INSTALL.txt

1.4 软件升级方法, 请参考INSTALL.txt
cd /usr/src/noc/web
git pull
可以下载最新的软件

如果数据库结构需要调整，只能手工做。具体请参考下面修改日志部分。

2. 认证说明
程序依靠用户输入的用户名、密码，利用pop3协议连接到邮件服务器上并认证身份
请根据自己的环境，修改认证部分

3. 已知问题
3.1 163.com 企业邮箱用户（POP3服务器是pop.qiye.163.com）无法使用POP3登录，原因不明

4. 修改日志
4.1 2015.09.24 增加 常用信息 中附件功能
4.2 2015.09.25 增加用户权限管理
4.3 2015.09.25 增加 pop3server 字段
4.4 2015.09.26 增加 sysinfo 系统配置
4.5 2015.09.26 增加 INSTALL.txt 
4.6 2015.09.26 增加虚拟机镜像
4.7 2015.09.28 增加故障处理显示的宽屏/窄屏选择
注：需使用以下命令增加 userpref table
CREATE TABLE `userpref` (
  `user` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` varchar(200) NOT NULL,
  PRIMARY KEY  (`user`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

4.8 2015.09.30 增加联系人/VM管理
注：需使用以下命令修改表结构         

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

4.9 2015.10.04 增加故障处理中系统/原因/级别信息
注：需使用以下命令修改表结构         

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

5. 致谢
感谢如下老师提出的意见和建议：
陕西国防工业职业技术学院 徐华宇
合肥工业大学 程克勤

</pre>
