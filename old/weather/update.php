<?php

$temp = $_REQUEST['temp'];
$humid = $_REQUEST['humid'];

$mysqli = new mysqli('127.0.0.1', 'root', 'Tjx,54321', 'marsapp');
if ($mysqli->connect_errno) {

  // Let's try this:
  echo "Sorry, this website is experiencing problems.";

  // Something you should not do on a public site, but this example will show you
  // anyways, is print out MySQL error related information -- you might log this
  echo "Error: Failed to make a MySQL connection, here is why: \n";
  echo "Errno: " . $mysqli->connect_errno . "\n";
  echo "Error: " . $mysqli->connect_error . "\n";

  // You might want to show them something nice, but we will simply exit
  exit;
}
$sql = "INSERT INTO `weather` (`time`, `temperature`, `humidity`) VALUES (CURRENT_TIMESTAMP, '" . $temp . "', '" . $humid . "')";

if ($mysqli->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $mysqli->error;
}

$mysqli->close();