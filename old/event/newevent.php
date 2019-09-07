<?php
include('../php/validate.php');
if (!validateCookie()) {
  echo "Not Logged in";
  exit;
}

$name = $_POST['name'];
$date = $_POST['date'];
$type = $_POST['type'];

include('../php/database.php');

$sql = "INSERT INTO event (name,date,type) VALUES ('$name','$date','$type')";
$mysqli->query($sql);
$mysqli->close();
header("Location: http://apps.marstanjx.com/event/");

