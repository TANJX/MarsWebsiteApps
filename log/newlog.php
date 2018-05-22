<?php
session_start();
if(empty($_SESSION["id"])) {
    echo "Not Logged in";
    exit;
}
$msg = $_POST['msg'];
$link = mysql_connect('marstanjxcom.ipagemysql.com', 'mars', 'root'); 
if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
}
mysql_select_db('marsql');
//设置mysql字符编码
mysql_query("set names utf8;");
//insert语句
$insert = "insert into log (msg,time) values ('$msg',now())";
$res_insert = mysql_query($insert);
header("Location: http://apps.marstanjx.com/log/");
exit;
?>
