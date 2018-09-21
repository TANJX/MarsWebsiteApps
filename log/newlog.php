<?php
session_start();
if (empty($_SESSION["id"])) {
  echo "Not Logged in";
  exit;
}
$msg = $_POST['msg'];

$mysqli = new mysqli('marstanjxcom.ipagemysql.com', 'mars', 'root', 'marsql');
if ($mysqli->connect_errno) {
  exit;
}
$mysqli->query("set names utf8;");

$sql = "INSERT INTO log (msg,time) VALUES ('$msg',now())";
$mysqli->query($sql);
$mysqli->close();
header("Location: http://apps.marstanjx.com/log/");
