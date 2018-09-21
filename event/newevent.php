<?php
session_start();
if(empty($_SESSION["id"])) {
    echo "Not Logged in";
    exit;
}

$name = $_POST['name'];
$date = $_POST['date'];
$type = $_POST['type'];

$mysqli = new mysqli('marstanjxcom.ipagemysql.com', 'mars', 'root', 'marsql');
if ($mysqli->connect_errno) {
  exit;
}
$mysqli->query("set names utf8;");

$sql = "INSERT INTO event (name,date,type) VALUES ('$name','$date','$type')";
$mysqli->query($sql);
$mysqli->close();
header("Location: http://apps.marstanjx.com/event/");

