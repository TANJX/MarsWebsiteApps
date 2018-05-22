<?php
session_start();
if(empty($_SESSION["id"])) {
    echo "Not Logged in";
    exit;
}
$name = $_POST['name'];
$date = $_POST['date'];
$type = $_POST['type'];
$link = mysql_connect('marstanjxcom.ipagemysql.com', 'mars', 'root'); 
if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
}
mysql_select_db('marsql');
//设置mysql字符编码
mysql_query("set names utf8;");
//insert语句
$insert = "insert into event (name,date,type) values ('$name','$date','$type')";
$res_insert = mysql_query($insert);
header("Location: http://apps.marstanjx.com/event/");
exit;
