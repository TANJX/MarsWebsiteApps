<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  $doc = new DOMDocument();
  $doc->loadHTMLFile("login.html");
  echo $doc->saveHTML();
} else {
  if (empty($_POST['name'])) {
    echo 'The username field must not be empty.';
    exit;
  }
  if (empty($_POST['password'])) {
    echo 'The password field must not be empty.';
    exit;
  }
  include('../php/validate.php');

  if (!validate($_POST['name'], sha1($_POST['password']))) {
    echo "We could not find a match for ID " . $_POST['name'] . "sorry about that. Please try again.";
    exit;
  }
  setcookie('username', $_POST['name'], time() + 60 * 60 * 24 * 30, "/");
  setcookie('password', sha1($_POST['password']), time() + 60 * 60 * 24 * 30, "/");
  header("Location: http://apps.marstanjx.com/");
  exit;
}
