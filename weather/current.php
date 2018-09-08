<?php

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
echo "test";

$sql = "SELECT * FROM `weather` ORDER BY time DESC";

$result = $mysqli->query($sql);
$row = $result->fetch_assoc();

echo $row["time"] . "," . $row["temperature"] . "," . $row["humidity"];

$mysqli->close();
