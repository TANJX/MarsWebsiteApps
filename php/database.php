<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2018/09/25
 * Time: 18:22
 */
$mysqli = new mysqli('marstanjxcom.ipagemysql.com', 'mars', 'root', 'marsql');
if ($mysqli->connect_errno) {
  exit;
}
$mysqli->query("set names utf8;");