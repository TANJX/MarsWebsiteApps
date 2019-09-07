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

$sql = "SELECT * FROM `weather`";

$result = $mysqli->query($sql);
$count = 0;
$json = array();
while ($row = $result->fetch_assoc()) {
  $json[$count]->time = $row["time"];
  $json[$count]->temperature = $row["temperature"];
  $json[$count]->humidity = $row["humidity"];
  $count++;
}

$mysqli->close();

echo json_encode($json);
