简单的机房管理辅助程序



1. 安装过程
创建数据库
参考noc.sql 内容创建table
修改db.php中数据库有关信息

2. 登录部分修改
程序依靠用户输入的用户名、密码，到邮件服务器上，利用pop3协议连接并认证身份

请根据自己的环境，修改认证部分

如果保留以上认证方式，请修改index.php中的邮件服务器和域名部分

并且需要在数据库中插入如下信息才能让用户登录：

INSERT INTO `user` (`email`, `isadmin`, `truename`) VALUES ('james', 1, '用户名');


