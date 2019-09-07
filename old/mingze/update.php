<?php

$ip = $_REQUEST['ip'];

$myfile = fopen("data.txt", "w") or die("Unable to open file!");
$txt = $ip;
fwrite($myfile, $txt);
fclose($myfile);
