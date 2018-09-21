<?php
function base64_to_jpeg($base64_string, $output_file)
{
  // open the output file for writing
  $ifp = fopen($output_file, 'wb');

  // split the string on commas
  // $data[ 0 ] == "data:image/png;base64"
  // $data[ 1 ] == <actual base64 string>
  $data = explode(',', $base64_string);

  // we could add validation here with ensuring count( $data ) > 1
  fwrite($ifp, base64_decode($data[1]));

  // clean up the file resource
  fclose($ifp);

  return $output_file;
}

session_start();
if (empty($_SESSION["id"])) {
  echo "Not Logged in";
  exit;
}

$content = $_POST['content'];
$date = date('Y-m-d H:i:s');

$mysqli = new mysqli('marstanjxcom.ipagemysql.com', 'mars', 'root', 'marsql');
if ($mysqli->connect_errno) {
  exit;
}
$mysqli->query("set names utf8;");

$query = 'data:image/';
if (substr($content, 0, strlen($query)) === $query) {
  $t = "files/" . time() . ".png";
  base64_to_jpeg($content, $t);
  $sql = "INSERT into paste (date,type,content) VALUES ('$date','image','$t')";
} else {
  $sql = "INSERT into paste (date,type,content) VALUES ('$date','text','$content')";
}

$mysqli->query($sql);
$mysqli->close();
header("Location: http://apps.marstanjx.com/paste");
exit;
