<?php

$temp = $_REQUEST['temp'];
$humid = $_REQUEST['humid'];

$myfile = fopen("data.txt", "w") or die("Unable to open file!");
$txt = $temp . "," . $humid;
fwrite($myfile, $txt);
fclose($myfile);
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
$sql = "SELECT * FROM user 
    WHERE
    id = '" . $_POST['user_name'] . "'
    AND
    password = '" . sha1($_POST['user_pass']) . "'";

if (!$result = $mysqli->query($sql)) {
  echo "Sorry, the website is experiencing problems.";

  echo "Error: Our query failed to execute and here is why: \n";
  echo "Query: " . $sql . "\n";
  echo "Errno: " . $mysqli->errno . "\n";
  echo "Error: " . $mysqli->error . "\n";
  exit;
}

if ($result->num_rows === 0) {
  echo "We could not find a match for ID" . $_POST['user_name'] . "sorry about that. Please try again.";
  exit;
}
$user = $result->fetch_array(MYSQLI_ASSOC);
echo $user;
echo "<br>";
foreach($user as $key => $value)
{
  echo $key." has the value". $value;
  echo "<br>";
}
echo "Sometimes I see " . $user['name'] . " " . $user['email'] . " on TV.";
$result->free();
$mysqli->close();