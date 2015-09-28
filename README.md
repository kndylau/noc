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

使用虚拟机镜像，启动后请按照下述1.4更新软件

1.2 从虚拟机开始安装的详细步骤请参考 INSTALL.txt

1.3 如果在现有系统安装, 请参考INSTALL.txt

1.4 软件升级方法, 请参考INSTALL.txt
cd /usr/src/noc/web
git pull
可以下载最新的软件

如果数据库结构需要调整，只能手工做

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
4.7 2015.08.28 增加故障处理显示的宽屏/窄屏选择
注：需使用以下命令增加 userpref table

CREATE TABLE `userpref` (
  `user` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` varchar(200) NOT NULL,
  PRIMARY KEY  (`user`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

</pre>
