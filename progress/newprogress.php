<?php
session_start();
if(empty($_SESSION["id"])) {
    echo "Not Logged in";
    exit;
}
$type = $_POST['type'];
$start = $_POST['start'];
$end = $_POST['end'];
$link = mysql_connect('marstanjxcom.ipagemysql.com', 'mars', 'root'); 
if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
}
mysql_select_db('marsql'); 
//设置mysql字符编码
mysql_query("set names utf8;");
//insert语句
$insert = "insert into progress (name,start,end) values ('$type','$start','$end')";
$res_insert = mysql_query($insert);
header("Location: http://apps.marstanjx.com/progress/");
exit;
?>
