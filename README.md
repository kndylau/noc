简单的机房管理辅助程序

<pre>

1. 安装过程

最简单的使用方法下下载虚拟机镜像。

1.1 安装好的虚拟机ovf文件请到 http://staff.ustc.edu.cn/~james/noc 下载
    虚拟机root密码为 noctest, 导入虚拟机系统，设置网卡，启动后请立即修改密码
    启动后修改IP地址，参照INSTALL.txt 2.5 创建第一个用户即可使用，即执行命令
mysql noc
> INSERT INTO user VALUES ('xyz@x.y.z', 'x.x.x.x', 1, '第一个用户');

其中xyz@x.y.z 是登录名，x.x.x.x是该邮件的POP3服务器，
程序依靠用户输入的用户名、密码，到邮件服务器上，利用pop3协议连接并认证身份

1.2 从虚拟机开始安装的详细步骤请参考 INSTALL.txt

1.3 如果在现有系统安装, 请参考INSTALL.txt

1.4 软件升级方法, 请参考INSTALL.txt
cd /usr/src/noc/web
git pull
可以下载最新的软件

如果数据库结构需要调整，只能手工做


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

3.5 2015.09.26 增加 INSTALL.txt 

</pre>
