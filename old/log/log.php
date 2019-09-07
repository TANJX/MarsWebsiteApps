<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>LOG | Mars Inc.</title>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-116224796-1"></script>
  <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
          dataLayer.push(arguments);
      }

      gtag('js', new Date());
      gtag('config', 'UA-116224796-1');

      function validateForm() {
          var a = document.forms["Form"]["name"].value;
          echo(a);
          if (a == null || a === " ") {
              document.getElementById("error-box").style.display = "block";
              return false;
          }
          document.getElementById("error-box").style.display = "none";
          return true;
      }

  </script>


  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
  <link rel="stylesheet"
        href="https://unpkg.com/bootstrap-material-design@4.0.0-beta.3/dist/css/bootstrap-material-design.min.css"
        integrity="sha384-k5bjxeyx3S5yJJNRD1eKUMdgxuvfisWKku5dwHQq9Q/Lz6H8CyL89KF52ICpX4cL" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="../css/menu.css">
  <script src="https://use.typekit.net/uzk1een.js"></script>
  <script>
      try {
          Typekit.load({async: true});
      } catch (e) {
      }
  </script>
</head>

<body>
<div class="title ">
  <div class="container">
    <h1>Log</h1>
    <p>Mars' life</p>
  </div>
</div>
<div class="main container">
  <a class="nav-link" href="newlog.html">New Log</a>
  <?php

  include('../php/database.php');
  $sql = "SELECT * FROM log ORDER BY time DESC;";
  $result = $mysqli->query($sql);

  while ($row = $result->fetch_assoc()) {
    echo "<div class='card'>";
    echo "<div class='card-body'>";
    echo "<h4 class='card-title'>";
    echo "$row[msg]";
    echo "</h4><h6 class='card-subtitle mb-2 text-muted'>";
    echo "$row[time]";
    echo "</h6></div></div>";
  }
  $mysqli->close();
  ?>
</div>
<?php
$doc = new DOMDocument();
$doc->loadHTMLFile("../menu.htm");
echo $doc->saveHTML();
?>
</body>

<style>
  .main {
    font-family: "source-han-sans-japanese", "source-han-sans-simplified-c", sans-serif;
  }

  .title {
    background-color: #b4b4b4;
  }

  .card {
    box-shadow: none;
    border-bottom: 1px solid #ccc;
  }

  .card-body {
    padding: 1.4rem 1.25rem 0.7rem;
  }

  .card-subtitle {
    margin-top: 12px;
    font-size: .7rem;
  }

</style>

</html>