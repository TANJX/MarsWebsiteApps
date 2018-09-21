<?php
session_start();
if (empty($_SESSION["id"])) {
  echo "Not Logged in";
  exit;
}

$type = $_POST['type'];
$start = $_POST['start'];
$end = $_POST['end'];

$mysqli = new mysqli('marstanjxcom.ipagemysql.com', 'mars', 'root', 'marsql');
if ($mysqli->connect_errno) {
  exit;
}
$mysqli->query("set names utf8;");

$sql = "INSERT INTO progress (name,start,end) VALUES ('$type','$start','$end')";
$mysqli->query($sql);
$mysqli->close();
header("Location: http://apps.marstanjx.com/progress/");
