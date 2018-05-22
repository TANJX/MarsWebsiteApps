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
$link = mysql_connect('marstanjxcom.ipagemysql.com', 'mars', 'root');
if (!$link) {
  die('Could not connect: ' . mysql_error());
}
mysql_select_db('marsql');
//设置mysql字符编码
mysql_query("set names utf8;");
//insert语句
$query = 'data:image/';
if (substr($content, 0, strlen($query)) === $query) {
  $t = "files/" . time() . ".png";
  base64_to_jpeg($content, $t);
  $insert = "insert into paste (date,type,content) values ('$date','image','$t')";
} else {
  $insert = "insert into paste (date,type,content) values ('$date','text','$content')";
}
$res_insert = mysql_query($insert);
header("Location: http://apps.marstanjx.com/paste");
exit;
