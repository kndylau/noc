<?php

$db_host = "localhost";
$db_user = "root";
$db_passwd = "";
$db_dbname = "noc";


$uploaddir = "/usr/src/noc/file";

// 连接服务器
if(($db=mysql_connect($db_host,$db_user,$db_passwd))<0){
 	Error( "连接服务器失败!");
}

// 选择数据库
if(mysql_select_db($db_dbname,$db)<0){
	Error("选择数据库出错");
}

?>
