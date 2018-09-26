<?php
include('../php/validate.php');
if (!validateCookie()) {
  echo "Not Logged in";
  exit;
}

$type = $_POST['type'];
$start = $_POST['start'];
$end = $_POST['end'];

include('../php/database.php');
$sql = "INSERT INTO progress (name,start,end) VALUES ('$type','$start','$end')";
$mysqli->query($sql);
$mysqli->close();
header("Location: http://apps.marstanjx.com/progress/");
