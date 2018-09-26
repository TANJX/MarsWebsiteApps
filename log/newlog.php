<?php
include('../php/validate.php');
if (!validateCookie()) {
  echo "Not Logged in";
  exit;
}
$msg = $_POST['msg'];

include('../php/database.php');
$sql = "INSERT INTO log (msg,time) VALUES ('$msg',now())";
$mysqli->query($sql);
$mysqli->close();
header("Location: http://apps.marstanjx.com/log/");
