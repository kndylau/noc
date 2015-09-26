简单的机房管理辅助程序


<pre>
1. 安装过程

创建数据库:参考noc.sql 内容创建table

修改db.php中数据库有关信息

选择上传文件的保存目录，默认是 /usr/src/noc/file /usr/src/noc/file_del 
创建这两个目录，并且允许httpd进程用户可写

mkdir -p /usr/src/noc/file /usr/src/noc/file_del
chown apache /usr/src/noc/file /usr/src/noc/file_del

并且需要在数据库中插入如下信息才能让第一个用户登录：

INSERT INTO user (email, pop3server, isadmin, truename) VALUES ('james@ustc.edu.cn', '202.38.64.8', 1, '第一个用户');


2. 认证说明

程序依靠用户输入的用户名、密码，到邮件服务器上，利用pop3协议连接并认证身份
请根据自己的环境，修改认证部分


3. 修改日志

3.1 2015.09.24 修改
增加 常用信息 中附件功能

表： file file_del
mkdir /usr/src/noc/file /usr/src/noc/file_del
chown apache /usr/src/noc/file /usr/src/noc/file_del

3.2 2015.09.25 增加用户权限管理

3.3 2015.09.25 增加 pop3server 字段

3.4 2015.09.26 增加 sysinfo 系统配置

</pre>
