<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" /> 
<link href="table.css" type="text/css" rel="stylesheet" /> 
<title>NOC.ustc.edu.cn</title>
</head>
<body bgcolor="#dddddd" text="#000000">

<?php
include("db.php");
session_start();

function checkvalue($str) {
	for($i = 0 ; $i < strlen($str) ; $i++) {
        	if( ($str[$i] >='a') && ($str[$i]<='z') ) continue;
        	if( ($str[$i] >='A') && ($str[$i]<='Z') ) continue;
        	if( ($str[$i] >='0') && ($str[$i]<='9') ) continue;
        	if( $str[$i] == '-' ) continue;
        	if( $str[$i] == '_' ) continue;
        	if( $str[$i] == ' ' ) continue;
        	if( $str[$i] == ':' ) continue;
        	echo $str."中第".$i."非法字符".$str[$i];
		exit(0);
	}
}

function safe_get($str) {
	$x = $_REQUEST[$str];
	checkvalue($x);
	return $x;
}

function changehist ($qstr) {
	echo "修改记录<p><table border=1>";
        echo "<tr><th>时间</th><th>修改内容</th></tr>\n";

        $count = 0;
        $rr=mysql_query($qstr);
        while($row=mysql_fetch_row($rr)) {
                $count++;
                echo "<tr><td>";
                echo $row[1];
                echo "</td><td>";
		echo $row[3];
		echo "<br>";
		echo $row[4];
                echo "</td></tr>\n";
        }
        echo "</table>";
}

$cmd=safe_get("cmd");

if ($cmd=="logout") {
	$_SESSION["login"]=0;
	$_SESSION["isadmin"]=0;
	echo "登录已经退出";
}

if ($cmd=="login") {
	$id=safe_get("id");
	$pass=$_REQUEST["pass"];
	
	if( $id<>"" ) {
		$query="select isadmin,truename from user where email='".$id."'";
		$result=mysql_query($query,$db);
		$r=mysql_fetch_row($result);
		if($r) {
			$_SESSION["isadmin"]=$r[0];
			$_SESSION["truename"]=$r[1];
			$r = imap_open("{202.38.64.8:110/pop3/novalidate-cert}INBOX",$id."@ustc.edu.cn",$pass,0,1);
			if( $r ) {
				$_SESSION["login"]=1;
				$_SESSION["user"]=$id;
				echo "登录正常,请选择上面的各项菜单";
				echo "<script language=JavaScript> parent.location='index.php?cmd=jifang'; </script>";
				exit(0);
			}
		}
		echo "用户名或密码错误,请重新输入";
	}
} // end cmd==login

$login=$_SESSION["login"];
$isadmin=$_SESSION["isadmin"];
if($login<>1) {   // 用户没有登录
	$login=0;
	$_SESSION["login"]=0;
	echo "<p>有任何问题请联系 james@ustc.edu.cn";
	echo "<p>";
	echo "请输入邮箱的id和密码登录<p>";
	echo " <form action=index.php method=post>";
	echo "<input name=cmd type=hidden value=login>邮箱id:<input name=id>@ustc.edu.cn<br>";
	echo "邮箱密码: <input name=pass type=password><br>";
	echo "<input type=submit value=登录></form>";
	exit(0);
} // login <> 1
?>

<a href=index.php?cmd=jifang>机房巡检</a>  
<a href=index.php?cmd=ticket>故障处理</a>  
<a href=index.php?cmd=cab_list>服务器管理</a>  
<a href=index.php?cmd=odf_list>ODF管理</a>  
<a href=index.php?cmd=ip>IP管理</a>  
<a href=index.php?cmd=info>常用信息</a>  
<a href=index.php?cmd=logout>退出</a>

<?
echo $_SESSION["truename"];
echo " From:";
echo  $_SERVER["REMOTE_ADDR"]; 
echo "有任何问题请联系 james@ustc.edu.cn <hr>";

if ($cmd=="" ) {
	$cmd="jifang";
}

if($cmd=="jifang_new") {
	$cmd="jifang";
	$huanjing=safe_get("huanjing");
	$server=safe_get("server");
	$msg=mysql_escape_string($_REQUEST["msg"]);
	$q="insert into jifang_daily(tm,huanjing,server,msg,op) values(now(),".$huanjing.",".$server.",'".$msg."','".$_SESSION["user"]."')";
	mysql_query($q,$db);
}  else if($cmd=="jifang_modido") {
	$cmd="jifang";
	$id=safe_get("id");
	$huanjing=safe_get("huanjing");
	$server=safe_get("server");
	$msg=mysql_escape_string($_REQUEST["msg"]);
	$q="update jifang_daily set huanjing=".$huanjing.",server=".$server.",msg='".$msg."' where id=".$id;
	mysql_query($q,$db);
}

if ( $cmd=="jifang") {
	echo "<a href=index.php?cmd=jifang&all=yes>列出所有记录</a><p>";

	if( $_REQUEST["all"] == "yes" )
		$query="select id,tm,huanjing,server,msg,truename from jifang_daily,user where op=email order by id desc";
	else
		$query="select id,tm,huanjing,server,msg,truename from jifang_daily,user where op=email order by id desc limit 30";
	$result=mysql_query($query,$db);

	echo "<table border=1 cellspacing=0>";
	echo " <tr> <th>序号</th> <th>时间</th> <th>环境</th> <th>服务器</th> <th>事件描述</th> <th>实施人</th> </tr>";

	$count=0;

while($r=mysql_fetch_row($result)){
	$count++;
	if ( ($r[3] == 1) ||($r[3] == 1)  ) 
		echo "<tr style=\"background-color:#6dc334\">";
	else
		echo "<tr style=\"background-color:#3592e2\">";
	echo "<td align=center><a href=index.php?cmd=jifang&id=".$r[0].">".$count."</a></td>";
	echo "<td nowrap=\"nowrap\">".$r[1]."</td>";
	echo "<td>";
	if ($r[2] == 0) echo "<font color=red>异常</font>";
	else echo "正常";
	echo "</td>";
	echo "<td>";
	if ($r[3] == 0) echo "<font color=red>异常</font>";
	else echo "正常";
	echo "</td>";
	echo "<td>".$r[4]."</td>";
	echo "<td>".$r[5]."</td>";
	echo "</tr>";
	echo "\n";
}
	echo "</table>\n";
	$id = safe_get("id");
	if( $id ) {
		$query="select id,tm,huanjing,server,msg from jifang_daily where id=".$id;
		$result=mysql_query($query,$db);
		$r=mysql_fetch_row($result);
		echo "<p>";
		echo "修改记录<br>";
		echo "<form action=index.php method=post>";
		echo "<input name=cmd value=jifang_modido type=hidden>";
		echo "<input name=id value=".$r[0]." type=hidden>";
    		echo "时间:".$r[1]."<br>";
    		echo "环境状况: &nbsp;&nbsp;正常<input type=radio name=huanjing value=1";
		if ($r[2] =="1") echo " checked";
		echo "> &nbsp; &nbsp; 异常<input type=radio name=huanjing value=0";
		if ($r[2] =="0") echo " checked";
		echo "><br>";
    		echo "服务器状况: 正常<input type=radio name=server value=1";
		if ($r[3] =="1") echo " checked";
		echo "> &nbsp; &nbsp; 异常<input type=radio name=server value=0";
		if ($r[3] =="0") echo " checked";
		echo "><br>";
		echo "存在问题:<input type=text size=200 name=msg value=\"".$r[4]."\"><br>";
    		echo "<input type=submit name=修改记录></form>";

	} else {
		echo "<form action=index.php method=post>";
		echo "<input name=cmd value=jifang_new type=hidden>";
    		echo "环境状况: &nbsp;&nbsp;正常<input type=radio name=huanjing value=1 checked> &nbsp; &nbsp; 异常<input type=radio name=huanjing value=0><br>";
    		echo "服务器状况: 正常<input type=radio name=server value=1 checked> &nbsp; &nbsp; 异常<input type=radio name=server value=0><br>";
		echo "存在问题:<input type=text size=200 name=msg><br>";
		echo "<input type=submit value=新增巡检记录>";
		echo "</form>";
	}
} // end cmd==jifang


if($cmd=="ticket_new") {
	$cmd="ticket";
	$st=safe_get("st");
	$memo=mysql_escape_string($_REQUEST["memo"]);
	$memo2=mysql_escape_string($_REQUEST["memo2"]);
	$q="insert into ticket (st,et,memo,op) values('".$st."','0-0-0 00:00:00','".$memo."','".$_SESSION["user"]."')";
	mysql_query($q,$db);
	$q="SELECT LAST_INSERT_ID()";
	$result=mysql_query($q,$db);
	$r=mysql_fetch_row($result);	
	$q="insert into ticketdetail (tid,tm,memo,op) values(".$r[0].",'".$st."','".$memo2."','".$_SESSION["user"]."')";
	mysql_query($q,$db);
}  else if($cmd=="ticket_modi") {
	$cmd="ticket";
	$id=safe_get("id");
	$st=safe_get("st");
	$et=safe_get("et");
	$memo=mysql_escape_string($_REQUEST["memo"]);
	$q="update ticket set st='".$st."',et='".$et."',memo='".$memo."' where id='".$id."'";
	mysql_query($q,$db);
} else if($cmd=="ticketdetail_modi") {
	$cmd="ticket";
	$tid=safe_get("tid");
	$did=safe_get("did");
	$tm=safe_get("tm");
	$memo=mysql_escape_string($_REQUEST["memo"]);
	$q="update ticketdetail set tm='".$tm."',memo='".$memo."' where id='".$did."'";
	mysql_query($q,$db);
	$isend=safe_get("isend");
	if( $isend ) 
	$q="update ticket set et=\"".$tm."\" where id=".$tid;
	mysql_query($q,$db);
} else if($cmd=="ticketdetail_new") {
	$cmd="ticket";
	$tid=safe_get("tid");
	$tm=safe_get("tm");
	$memo=mysql_escape_string($_REQUEST["memo"]);
	$q="insert into ticketdetail (tid,tm,memo,op) values(".$tid.",'".$tm."','".$memo."','".$_SESSION["user"]."')";
	mysql_query($q,$db);
	$isend=safe_get("isend");
	if( $isend )  {
		$q="update ticket set et=\"".$tm."\" where id=".$tid;
		mysql_query($q,$db);
	}
}

if ($cmd=="ticket") {
	echo "<a href=index.php?cmd=ticket&all=yes>列出所有记录</a><p>";
	if( safe_get("all") == "yes" )
		$query="select id,st,et,memo,op,UNIX_TIMESTAMP(et)- UNIX_TIMESTAMP(st) from ticket order by st desc";
	else
		$query="select id,st,et,memo,op,UNIX_TIMESTAMP(et)- UNIX_TIMESTAMP(st) from ticket where (year(st) = year(now())) or (year(et)=year(now())) or (year(et)=0) order by st desc";
	$result=mysql_query($query,$db);

	echo "<table border=1 cellspacing=0>";
	echo " <tr> <th>序号</th> <th>开始时间</th> <th>结束时间</th> <th>故障时间</th> <th>事件描述</th> <th>时间</th> <th>处理</th> <th>实施人</th> </tr>\n";

	$count=0;
while($r=mysql_fetch_row($result)){
	$count++;
	if ( $r[2] == "0000-00-00 00:00:00" ) 
		echo "<tr style=\"background-color:#3592e2\">";
	else
		echo "<tr style=\"background-color:#6dc334\">";
	$q="select id,tm,memo,truename from ticketdetail,user where op=email and tid='".$r[0]."' order by tm";
	$result2=mysql_query($q,$db);
	$rows=mysql_num_rows($result2); 
	echo "<td rowspan=".$rows." align=center>".$count."</td>";
	if( $isadmin ==1 ) 
		echo "<td rowspan=".$rows." nowrap=\"nowrap\"><a href=index.php?cmd=ticket&id=".$r[0].">".$r[1]."</a></td>";
	else echo "<td rowspan=".$rows.">".$r[1]."</td>";
		echo "<td rowspan=".$rows." nowrap=\"nowrap\">".$r[2]."</td>";
	echo "<td rowspan=".$rows." align=right nowrap=\"nowrap\">";
	if ( $r[2] == "0000-00-00 00:00:00" )
		echo " ";
	else 
		echo round($r[5]/3600,1),"小时";
	echo "</td>";
	
	echo "<td rowspan=".$rows.">".$r[3]."</td>";
	$firstrow=1;
	while($r2=mysql_fetch_row($result2)) {
		if($firstrow==1) 
			$firstrow=0;
		else {
			if ( $r[3] == "0000-00-00 00:00:00" ) 
				echo "<tr style=\"background-color:#3592e2\">";
			else
				echo "<tr style=\"background-color:#6dc334\">";
		}
		echo "<td nowrap=\"nowrap\"><a href=index.php?cmd=ticket&did=".$r2[0].">".$r2[1]."</a></td>";
		echo "<td>".$r2[2]."</td>";
		echo "<td>".$r2[3]."</td>";
		echo "</tr>\n";
	}
}
	echo "</table>";
	$id = safe_get("id");
	$did = safe_get("did");
	if ( $did ) {
		$query="select id,tid,tm,memo from ticketdetail where id=".$did;
		$result=mysql_query($query,$db);
		$r=mysql_fetch_row($result);
		echo "<p>";
		echo "修改ticket处理信息<br>";
		echo "<form action=index.php method=post>";
		echo "<input name=cmd value=ticketdetail_modi type=hidden>";
		echo "<input name=tid value=".$r[1]." type=hidden>";
		echo "<input name=did value=".$r[0]." type=hidden>";
    		echo "时间:<input name=tm value=\"".$r[2]."\"><br>";
    		echo "描述:<input name=memo value=\"".$r[3]."\" size=100><br>";
		echo "处理结束,更新结束时间:<input type=checkbox name=isend value=1><br>";
    		echo "<input type=submit value=修改处理记录></form>";
	} else if( $id ) {
		$query="select id,st,et,memo from ticket where id=".$id;
		$result=mysql_query($query,$db);
		$r=mysql_fetch_row($result);
		echo "<p>";
		echo "修改ticket<br>";
		echo "<form action=index.php method=post>";
		echo "<input name=cmd value=iticket_modi type=hidden>";
		echo "<input name=id value=".$r[0]." type=hidden>";
    		echo "开始时间:<input name=st value=\"".$r[1]."\"><br>";
    		echo "结束时间:<input name=et value=\"".$r[2]."\"><br>";
    		echo "事件描述:<input name=memo value=\"".$r[3]."\"><br>";
    		echo "<input type=submit name=修改ticket></form>";

		echo "新增处理描述<br>";
		echo "<form action=index.php method=post>";
		echo "<input name=cmd value=ticketdetail_new type=hidden>";
		echo "<input name=tid value=".$r[0]." type=hidden>";
		echo "时间:<input name=tm value=\"";
		echo strftime("%Y-%m-%d %H:%M:00",time());
		echo "\"><br>";
		echo "处理描述:<input name=memo size=100><br>";
		echo "处理结束,更新结束时间:<input type=checkbox name=isend value=1><br>";
		echo "<input type=submit value=新增处理描述>";
		echo "</form>";
	} else {
		echo "<form action=index.php method=post>";
		echo "<input name=cmd value=ticket_new type=hidden>";
		echo "开始时间:<input name=st value=\"";
		echo strftime("%Y-%m-%d %H:%M:00",time());
		echo "\"><br>";
		echo "事件描述:<input name=memo><br>";
		echo "处理描述:<input name=memo2 size=100><br>";
		echo "<input type=submit value=新增事件记录>";
		echo "</form>";
	}
} // end cmd==ticket


if($cmd=="info_new") {
	$cmd="info";
	$title=mysql_escape_string($_REQUEST["title"]);
	$memo=mysql_escape_string($_REQUEST["memo"]);
	if($title=="") {
		echo "<form action=index.php method=post>";
		echo "<input name=cmd value=info_new type=hidden>";
		echo "标题:<input name=title size=75> <br>";
		echo "内容:<textarea name=memo cols=100 rows=40></textarea><br>";
		echo " <input type=submit value=新增常用信息> </form>";
 		exit(0);
	}
	$q="insert into info (title,memo) values('$title','$memo')";
	mysql_query($q,$db);
}  else if($cmd=="info_modido") {
	$cmd="info";
	$id=safe_get("id");
	$title=mysql_escape_string($_REQUEST["title"]);
	$memo=mysql_escape_string($_REQUEST["memo"]);
	$q="update info set title='$title',memo='$memo' where id=$id";
	mysql_query($q,$db);
} // end cmd==info_new

if ($cmd=="info_up") {
	$cmd="info";
	$id=safe_get("id");
	$q="update info set sortid=sortid-1 where id=$id";
	mysql_query($q,$db);
}
if ($cmd=="info_down") {
	$cmd="info";
	$id=safe_get("id");
	$q="update info set sortid=sortid+1 where id=$id";
	mysql_query($q,$db);
}

if ($cmd=="info") { 
	$query= "select id,title,left(memo,100) from info order by sortid,id";
	$result=mysql_query($query,$db);
	echo "<table border=1 cellspacing=0>";
	echo " <tr> <th>序号</th> <th>标题</th> <th>内容摘要</th> <th>命令</th> </tr>";

	$count=0;
	while($r=mysql_fetch_row($result)){
		$count++;
		echo "<tr><td>".$count."</td>";
		echo "<td><a href=index.php?cmd=info_detail&id=$r[0]>".$r[1]."<a/></td>";
		echo "<td><a href=index.php?cmd=info_detail&id=$r[0]>".$r[2]."<a/></td>";
		echo "<td><a href=index.php?cmd=info_modi&id=$r[0]>修改<a/> ";
		echo "<a href=index.php?cmd=info_up&id=$r[0]>上移<a/> ";
		echo "<a href=index.php?cmd=info_down&id=$r[0]>下移<a/> ";
		echo "</td>";
		echo "</tr>\n";
	}
	echo "</table>";
	echo "<p>";
	echo "<a href=index.php?cmd=info_new>新增常用信息</a>";
} // end cmd==info

if ($cmd=="info_detail") {
	$id = safe_get("id");
	$query="select id,title,memo from info where id=".$id;
	$result=mysql_query($query,$db);
	$r=mysql_fetch_row($result);
	echo "<p>";
	echo $r[1];
	echo "<hr><pre>";
	echo $r[2];
	echo "</pre>";
} 

if ($cmd=="info_modi") {
	$id = safe_get("id");
	$query="select id,title,memo from info where id=".$id;
	$result=mysql_query($query,$db);
	$r=mysql_fetch_row($result);

	echo "修改信息<br>";
	echo "<form action=index.php method=post>";
	echo "<input name=cmd value=info_modido type=hidden>";
	echo "<input name=id value=".$r[0]." type=hidden>";
    	echo "标题:<input name=title value=\"".$r[1]."\" size=75><br>";
   	echo "内容:<textarea name=memo cols=100 rows=40>";
	echo $r[2];
	echo "</textarea><br>";
   	echo "<input type=submit value=修改></form>";
} // end cmd==info_detail

if($cmd=='cab_add') {
	$cabid = safe_get("cabid");
	$ps1= safe_get("ps1");
	$ps2= safe_get("ps2");
	$mgt = mysql_escape_string($_REQUEST["mgt"]);
	$cabuse = mysql_escape_string($_REQUEST["cabuse"]);
	$qstr="insert into JF_CAB values('$cabid','$ps1','$ps2','$mgt','$cabuse')";
	$rr=mysql_query($qstr);
	echo "增加完成<p>";
	$cmd='cab_list';
}

if($cmd=='cab_modido') {
	$oldcabid = safe_get("oldcabid");
	$cabid = safe_get("cabid");
	$ps1= safe_get("ps1");
	$ps2= safe_get("ps2");
	$mgt = mysql_escape_string($_REQUEST["mgt"]);
	$cabuse = mysql_escape_string($_REQUEST["cabuse"]);
	$qstr="update JF_CAB set CABID='$cabid',PS1='$ps1',PS2='$ps2',MGT='$mgt',CABUSE='$cabuse'  where CABID='$oldcabid'";
	$rr=mysql_query($qstr);
	echo "修改完成<p>";
	$cmd='cab_list';
}

if($cmd=='cab_modi') {
	$cabid = safe_get("cabid");
	echo "<form action=index.php method=post>";
	echo "<input type=hidden name=cmd value=cab_modido>";
	echo "<input type=hidden name=oldcabid value=$cabid>";
	$qstr="select * from JF_CAB where CABID='$cabid'";
	$rr=mysql_query($qstr);
	if($row=mysql_fetch_row($rr)) {
		echo "机柜编号: <input name=cabid value=$row[0]> <br>";
		echo "用途: <input name=cabuse value=$row[4]><br>";
		echo "PS1: <input name=ps1 value='$row[1]' size=80> <br>";
		echo "PS2: <input name=ps2 value='$row[2]' size=80> <br>";
		echo "责任人: <input name=mgt value='$row[3]' size=80> <br>";
		echo "<input type=submit name=Submit value=修改>";
		echo "</form>";
	}
}
if ($cmd=='cab_list') {
	echo "机柜信息<p><table border=1>";
	echo "<tr><th>机柜编号</th><th>用途</th><th>责任人</th><th>PS1</th><th>PS2</th><th>设备数</t><th>命令</th></tr>\n";

	$qstr="select * from JF_CAB order by CABID";
	$rr=mysql_query($qstr);
	while($row=mysql_fetch_row($rr)) {
		echo "<tr><td> "; echo "<a href=index.php?cmd=cabinfo_list&cabid=$row[0]>$row[0]</a>";
		echo "</td><td>"; echo $row[4];
		echo "</td><td>"; echo $row[3];
		echo "</td><td>"; echo $row[1];
		echo "</td><td>"; echo $row[2];
		echo "</td><td>"; 
		$r=mysql_query("select count(*) from JF_Server where CABID='$row[0]'");
		$r=mysql_fetch_row($r);
		echo $r[0];
		echo "</td><td>"; 
		echo "<a href=index.php?cmd=cab_modi&cabid=$row[0]>修改</a>";
		echo "</td></tr>\n";
	}
	echo "</table>";
?>

	<form action=index.php method=post>
	<input type=hidden name=cmd value=cab_add>
	增加机柜:<p>
	机柜ID: <input name=cabid> <br> 
	用途: <input name=cabuse size=80> <br>
	PS1: <input name=ps1 size=80> <br>
	PS2: <input name=ps2 size=80> <br>
	责任人: <input name=mgt size=80> <br>
	<input type="submit" name="Submit" value="增加">
	</form>
<?
	exit(0);
} // end cmd = cab_list


if($cmd=='server_add') {
	$serverid = safe_get("serverid");
        $cabid = safe_get("cabid");
        $startu = safe_get("startu");
        $endu = safe_get("endu");
        $kvm = safe_get("kvm");
        $type = safe_get("type");
        $name = safe_get("name");
        $user = safe_get("user");
        $mgt = safe_get("mgt");
        $ip1 = safe_get("ip1");
        $ip2 = safe_get("ip2");
        $mac1 = safe_get("mac1");
        $mac2 = safe_get("mac2");
        $sn = safe_get("sn");
        $connector = safe_get("connector");
        $comment = safe_get("comment");
        $qstr="insert into JF_Server values('$serverid','$cabid',$startu,$endu,'$kvm','$type','$name','$user','$mgt','$ip1','$ip2','$mac1','$mac2','$sn','$connector','$comment')";
        $rr=mysql_query($qstr);
        echo "增加完成<p>";
        $cmd='cabinfo_list';
}

if($cmd=='server_modido') {
        $oldserverid = safe_get("oldserverid");
        $serverid = safe_get("serverid");
        $cabid = safe_get("cabid");
        $startu = safe_get("startu");
        $endu = safe_get("endu");
        $kvm = safe_get("kvm");
        $type = safe_get("type");
        $name = safe_get("name");
        $user = safe_get("user");
        $mgt = safe_get("mgt");
        $ip1 = safe_get("ip1");
        $ip2 = safe_get("ip2");
        $mac1 = safe_get("mac1");
        $mac2 = safe_get("mac2");
        $sn = safe_get("sn");
        $connector = safe_get("connector");
        $comment = safe_get("comment");
        $qstr="update JF_Server set ServerID='$serverid',CABID='$cabid',StartU=$startu,EndU=$endu,KVM='$kvm',Type='$type',NAME='$name',USER='$user',MGT='$mgt',IP1='$ip1',IP2='$ip2',MAC1='$mac1',MAC2='$mac2',SN='$sn',Connector='$connector',Comment='$comment' where ServerID='$oldserverid'";
        $rr=mysql_query($qstr);
        echo "修改完成<p>";
        $cmd='cabinfo_list';
}

if($cmd=='server_modi') {
        $serverid = safe_get("serverid");
        echo "<form action=index.php method=post>";
        echo "<input type=hidden name=cmd value=server_modido>";
        echo "<input type=hidden name=oldserverid value=$serverid>";
        $qstr="select * from JF_Server where ServerID='$serverid'";
        $rr=mysql_query($qstr);
        if($row=mysql_fetch_row($rr)) {
        	echo "Server编号: <input name=serverid value=\"$row[0]\"><br>";
                echo "机柜编号: <input name=cabid value=\"$row[1]\"> <br>";
                echo "开始U: <input name=startu value=\"$row[2]\"><br>";
                echo "结束U: <input name=endu value=\"$row[3]\"><br>";
                echo "KVM: <input name=kvm value=\"$row[4]\"><br>";
                echo "型号: <input name=type value=\"$row[5]\"><br>";
                echo "名称: <input name=name value=\"$row[6]\"><br>";
                echo "用途: <input name=user value=\"$row[7]\"><br>";
                echo "管理员: <input name=mgt value=\"$row[8]\"><br>";
                echo "IP1: <input name=ip1 value=\"$row[9]\"><br>";
                echo "IP2: <input name=ip2 value=\"$row[10]\"><br>";
                echo "MAC1: <input name=mac1 value=\"$row[11]\"><br>";
                echo "MAC2: <input name=mac2 value=\"$row[12]\"><br>";
                echo "SN: <input name=sn value=\"$row[13]\"><br>";
                echo "连接设备: <input name=connector value=\"$row[14]\"><br>";
                echo "备注: <input name=comment value=\"$row[15]\"><br>";
                echo "<input type=submit name=Submit value=修改>";
                echo "</form>";
        }
}


if ( $cmd=='cabinfo_list') {
	$cabid = safe_get("cabid");
	$qstr="select *,now() from JF_CAB where CABID='$cabid'";
	$rr=mysql_query($qstr);
	$row=mysql_fetch_row($rr);
	echo "<table border=1 width=800>";
	echo "<tr><td width=20%>";
	echo "机柜编号:";
	echo "</td><td>";
	echo $row[0];
	echo "</td><td width=20%>";
	echo "机柜责任人:";
	echo "</td><td>";
	echo $row[3];
	echo "</td></tr>";
	echo "<tr><td>";
	echo "电源1:";
	echo "</td><td>";
	echo $row[1];
	echo "</td><td>";
	echo "电源2:";
	echo "</td><td>";
	echo $row[2];
	echo "</td></tr>";
	echo "<tr><td>";
	echo "用途:";
	echo "</td><td colspan=3>";
	echo $row[4];
	echo "</td>";
	echo "<tr><td>";
	echo "打印时间:";
	echo "</td><td colspan=3>";
	echo $row[5];
	echo "</td></tr>";
	echo "</table>";
	echo "\n";
?>		

<p>
<p><font size=1>
	<table border=1>
	<tr><th>U</th><th>KVM</th><th>服务器型号</th><th>服务器描述</th><th>服务器用途</th>
	<th>责任人</th><th>IP地址</th><th>MAC地址</th><th>SN</th><th>网络连接</th><th>备注</th></tr>
<?
	$qstr="select EndU-StartU+1,EndU,KVM,Type,JF_Server.NAME,JF_Server.USER,MGT,IP1,IP2,MAC1,MAC2,SN,Connector,Comment,ServerID from JF_Server where CABID= '$cabid' order by EndU desc";
	$rr=mysql_query($qstr);
	while($row=mysql_fetch_row($rr)) {
		echo "<tr><td>"; 
		echo "<a href=index.php?cmd=server_modi&serverid=$row[14]>$row[1]</a>";
		echo "</td><td rowspan=".$row[0].">"; echo $row[2];
		echo "</td><td rowspan=".$row[0].">"; echo $row[3];
		echo "</td><td rowspan=".$row[0].">"; echo $row[4];
		echo "</td><td rowspan=".$row[0].">"; echo $row[5];
		echo "</td><td rowspan=".$row[0].">"; echo $row[6];
		echo "</td><td rowspan=".$row[0].">"; echo $row[7];
		if( $row[8]!='') { echo "<br>"; echo $row[8]; }
		echo "</td><td rowspan=".$row[0].">"; echo $row[9];echo "<br>";echo $row[10];
		echo "</td><td rowspan=".$row[0].">"; echo $row[11];
		echo "</td><td rowspan=".$row[0].">"; echo $row[12];
		echo "</td><td rowspan=".$row[0].">"; echo $row[13];
		echo "</td></tr>\n";
		if($row[0]>1) {
			for($i=0;$i<$row[0]-1;$i++) {
				echo "<tr><td>";
				echo $row[1]-$i-1;
			}
		echo "</td></tr>\n";
		
		}

	}
	echo "</table>";

        echo "<form action=index.php method=post>";
        echo "<input type=hidden name=cmd value=server_add>";
        echo "Server编号: <input name=serverid><br>";
        echo "机柜编号: <input name=cabid value=\"$cabid\"> <br>";
        echo "开始U: <input name=startu><br>";
        echo "结束U: <input name=endu><br>";
        echo "KVM: <input name=kvm><br>";
        echo "型号: <input name=type><br>";
        echo "名称: <input name=name><br>";
        echo "用途: <input name=user><br>";
        echo "管理员: <input name=mgt><br>";
        echo "IP1: <input name=ip1><br>";
        echo "IP2: <input name=ip2><br>";
        echo "MAC1: <input name=mac1><br>";
        echo "MAC2: <input name=mac2><br>";
        echo "SN: <input name=sn><br>";
        echo "连接设备: <input name=connector><br>";
        echo "备注: <input name=comment><br>";
        echo "<input type=submit name=Submit value=增加>";
        echo "</form>";

	
} // end cmd = 'cabinfo_list'


if($cmd=="ip_new") {
	$cmd="ip";
	$ip=safe_get("ip");
	$mask=safe_get("mask");
	$net=safe_get("net");
	$use=safe_get("use");
	$lxr=safe_get("lxr");
	$memo=safe_get("memo");
	$q="insert into IP(IP,MASK,net,`use`,lxr,memo) values('$ip','$mask',$net,'$use','$lxr','$memo')";
	mysql_query($q,$db);
}  else if($cmd=="ip_modi") {
	$cmd="ip";
	$id=safe_get("id");
	$ip=safe_get("ip");
	$mask=safe_get("mask");
	$net=safe_get("net");
	$use=safe_get("use");
	$lxr=safe_get("lxr");
	$memo=safe_get("memo");
	$q="update IP set IP='$ip',MASK='$mask',net=$net,`use`='$use',lxr='$lxr',memo='$memo' where id=$id";
	mysql_query($q,$db);
}

if ( $cmd=="ip") {
	$query="select id,IP,MASK,net,`use`,lxr,memo from IP order by inet_aton(IP)";
	$result=mysql_query($query,$db);
	echo "<table border=1 cellspacing=0>";
	echo " <tr> <th>序号</th> <th>IP</th> <th>用途</th> <th>联系人</th> <th>备注</th> </tr>";
	$count=0;
while($r=mysql_fetch_row($result)){
	$count++;
	if( $r[3] == '1' )   // network 
		echo "<tr style=\"background-color:#ffff00\">";
	else 
		echo "<tr>";
	echo "<td align=center><a href=index.php?cmd=ip&id=".$r[0].">".$count."</a></td>";
	if( $r[3] == '1' ) {  // network 
		echo "<td>";
		echo $r[1]."/".$r[2];
	} else {
		echo "<td align=right>";
		if ( $r[2]=="255.255.255.255" ) 
			echo $r[1];
		else 
			echo $r[1]."/".$r[2];
	}
	echo "</td>";
	echo "<td>".$r[4]."</td>";
	echo "<td>".$r[5]."</td>";
	echo "<td>".$r[6]."</td>";
	echo "</tr>";
	echo "\n";
}
echo "</table>";
	$id = safe_get("id");
	if( $id ) {
		$query="select id,IP,MASK,net,`use`,lxr,memo from IP where id=".$id;
		$result=mysql_query($query,$db);
		$r=mysql_fetch_row($result);
		echo "<p>";
		echo "修改记录<br>";
		echo "<form action=index.php method=post>";
		echo "<input name=cmd value=ip_modi type=hidden>";
		echo "<input name=id value=".$r[0]." type=hidden>";
    		echo "IP: <input name=ip value=\"".$r[1]."\"><br>";
    		echo "MASK: <input name=mask value=\"".$r[2]."\"><br>";
		if ( $r[3] == '0' )
    			echo "network? no<input type=radio name=net value=0 checked>  yes<input type=radio name=net value=1>";
		else
    			echo "network? no<input type=radio name=net value=0>  yes<input type=radio name=net value=1 checked>";
		echo "<br>";
    		echo "用途: <input name=use value=\"".$r[4]."\"><br>";
    		echo "联系人: <input name=lxr value=\"".$r[5]."\"><br>";
    		echo "备注: <input name=memo value=\"".$r[6]."\"><br>";
    		echo "<input type=submit name=修改记录></form>";

	} else {
		echo "<p><form action=index.php method=post>";
		echo "<input name=cmd value=ip_new type=hidden>";
    		echo "IP: <input name=ip><br>";
    		echo "MASK: <input name=mask><br>";
    		echo "network? no<input type=radio name=net value=0 checked>  yes<input type=radio name=net value=1><br>";
    		echo "用途: <input name=use><br>";
    		echo "联系人: <input name=lxr><br>";
    		echo "备注: <input name=memo><br>";
		echo "<input type=submit value=新增IP记录>";
		echo "</form>";
	}
} // end cmd==ip


if($cmd=='odf_new') {
	$bh = safe_get("bh");
	$jf= safe_get("jf");
	$use= safe_get("use");
	$memo = safe_get("memo");
	$qstr="insert into ODF (JF,BH,`USE`,MEMO) values('$jf','$bh','$use','$memo')";
	$rr=mysql_query($qstr);
	for ($i=1; $i<=12; $i++) {
		$qstr="insert into ODFPAN (BH,X) values('$bh',$i)";
		$rr=mysql_query($qstr);
	}
	echo "增加完成<p>";
	$cmd='odf_list';
}

if($cmd=='odf_modido') {
	$odfid = safe_get("odfid");
	$bh = safe_get("bh");
	$jf= safe_get("jf");
	$use= safe_get("use");
	$memo = safe_get("memo");

	$qstr="select * from ODF where id ='$odfid'";
	$rr=mysql_query($qstr);
	$row=mysql_fetch_row($rr);
	$qstr="insert into hist (tm,oid,old,new) values (now(),'ODF$row[0]','$row[1]/$row[2]/$row[3]/$row[4]','$jf/$bh/$use/$memo')";
	mysql_query($qstr);

	$qstr="update ODF set JF='$jf',BH='$bh',`USE`='$use',MEMO='$memo' where id='$odfid'";
	mysql_query($qstr);
	echo "修改完成<p>";
	$cmd='odf_list';
}

if($cmd=='odf_modi') {
	$odfid = safe_get("odfid");
	echo "<form action=index.php method=post>";
	echo "<input type=hidden name=cmd value=odf_modido>";
	echo "<input type=hidden name=odfid value=$odfid>";
	$qstr="select * from ODF where id ='$odfid'";
	$rr=mysql_query($qstr);
	if($row=mysql_fetch_row($rr)) {
		echo "机房: <input name=jf value=$row[1]> <br>";
		echo "ODF编号: <input name=bh value=$row[2]><br>";
		echo "用途: <input name=use value='$row[3]' size=80> <br>";
		echo "备注: <input name=memo value='$row[4]' size=80> <br>";
		echo "<input type=submit name=Submit value=修改>";
		echo "</form>";
	}
}
if ($cmd=='odf_list') {
	echo "ODF信息<p><table border=1>";
	echo "<tr><th>机房</th><th>ODF编号</th><th>用途</th><th>备注</th><th>命令</th></tr>\n";

	$qstr="select * from ODF order by JF,BH";
	$count = 0;
	$rr=mysql_query($qstr);
	while($row=mysql_fetch_row($rr)) {
		$count++;
		echo "<tr><td> "; 
		echo $row[1];
		echo "</td><td>"; 
		echo "<a href=index.php?cmd=odfpan_list&bh=$row[2]>$row[2]</a>";
		echo "</td><td>"; echo $row[3];
		echo "</td><td>"; echo $row[4];
		echo "</td><td>"; 
		echo "<a href=index.php?cmd=odf_mod&odfid=$row[0]>修改</a>";
		echo "</td></tr>\n";
	}
	echo "</table>";
?>

	<form action=index.php method=post>
	<input type=hidden name=cmd value=odf_new>
	增加ODF:<p>
	机房: <input name=jf> <br> 
	ODF编号: <input name=bh size=80> <br>
	用途: <input name=use size=80> <br>
	备注: <input name=memo size=80> <br>
	<input type="submit" name="Submit" value="增加">
	</form>
<?
	changehist("select * from hist where oid like 'ODF%' order by tm desc");
	exit(0);
} // end cmd = odf_list


if($cmd=='odfpan_modido') {
	$id = safe_get("id");
	$bh = safe_get("bh");
	$x = safe_get("x");
	$s = safe_get("s");
	$dx = safe_get("dx");
	$use= safe_get("use");
	$tx = safe_get("tx");
	$sb = safe_get("sb");
	$memo = safe_get("memo");

	$qstr="select * from ODFPAN where id ='$id'";
	$rr=mysql_query($qstr);
	$row=mysql_fetch_row($rr);
	$qstr="insert into hist (tm,oid,old,new) values (now(),'PAN$row[0]','$row[1]/$row[2]/$row[3]/$row[4]/$row[5]/$row[6]/$row[7]/$row[8]','$bh/$x/$s/$dx/$use/$tx/$sb/$memo')";
	mysql_query($qstr);
	$qstr="update ODFPAN set BH='$bh',X='$x',S='$s',DX='$dx',`USE`='$use',TX='$tx',SB='$sb',MEMO='$memo' where id='$id'";
	$rr=mysql_query($qstr);
	$rr=mysql_query("commit");
	echo "修改完成<p>";
	$cmd='odfpan_list';
}

if($cmd=='odfpan_modi') {
	$id = safe_get("id");
	echo "<form action=index.php method=post>";
	echo "<input type=hidden name=cmd value=odfpan_modido>";
	echo "<input type=hidden name=id value=$id>";
	$qstr="select * from ODFPAN where id ='$id'";

	$rr=mysql_query($qstr);
	if($row=mysql_fetch_row($rr)) {
		echo "ODF编号: <input name=bh value=$row[1]><br>";
		echo "芯号: <input name=x value=$row[2]><br>";
		echo "颜色: <input name=s value=$row[3]><br>";
		echo "对方芯号: <input name=dx value=$row[4]><br>";
		echo "用途: <input name=use value='$row[5]' size=80> <br>";
		echo "跳线: <input name=tx value=$row[6]><br>";
		echo "设备: <input name=sb value=$row[7]><br>";
		echo "备注: <input name=memo value='$row[8]' size=80> <br>";
		echo "<input type=submit name=Submit value=修改>";
		echo "</form>";
	}
	echo "<p>";
	$cmd='odfpan_list';
	changehist("select * from hist where oid = 'PAN$id' order by tm desc");
}
if ($cmd=='odfpan_list') {
	echo "ODF盘信息<p>";
	$bh = safe_get("bh");
	$qstr="select * from ODF where BH='$bh'";
    	$rr=mysql_query($qstr);
    	$row=mysql_fetch_row($rr);
	echo "机房: ".$row[1]."<br>";
	echo "ODF编号: ".$row[2]."<br>";
	echo "用途: ".$row[3]."<br>";
	echo "备注: ".$row[4]."<p>";

	echo "<table border=1>";
	echo "<tr><th>ODF编号</th><th>芯号</th><th>颜色</ht><th>对方芯号</th><th>用途</th><th>跳线</th><th>设备</th><th>备注</th></tr>\n";

	$qstr="select * from ODFPAN where BH='$bh' order by X";
	$count = 0;
	$rr=mysql_query($qstr);
	while($row=mysql_fetch_row($rr)) {
		$count++;
		echo "<tr><td>"; echo $row[1];
		echo "</td><td> "; echo "<a href=index.php?cmd=odfpan_modi&id=$row[0]&bh=$row[1]>$row[2]</a>";
		echo "</td><td>"; echo $row[3];
		echo "</td><td>"; echo $row[4];
		echo "</td><td>"; echo $row[5];
		echo "</td><td>"; echo $row[6];
		echo "</td><td>"; echo $row[7];
		echo "</td><td>"; echo $row[8];
		echo "</td></tr>\n";
	}
	echo "</table>";
	exit(0);
} // end cmd = odfpan_list
?>

