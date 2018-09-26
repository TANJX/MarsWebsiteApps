<?php

function validate($user, $sha)
{
  $mysqli = new mysqli('marstanjxcom.ipagemysql.com', 'mars', 'root', 'marsql');
  if ($mysqli->connect_errno) {
    exit;
  }
  $mysqli->query("set names utf8;");
  $sql = "SELECT * FROM user 
    WHERE
    id = '" . $user . "'
    AND
    password = '" . $sha . "'";
  $result = $mysqli->query($sql);

  $mysqli->close();
  return $result->num_rows !== 0;
}

function validateCookie()
{
  if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    return validate($_COOKIE['username'], $_COOKIE['password']);
  }
  return false;
}