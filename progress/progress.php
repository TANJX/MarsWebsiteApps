<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PROGRESS | Mars Inc.</title>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-116224796-1"></script>
  <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
          dataLayer.push(arguments);
      }

      gtag('js', new Date());
      gtag('config', 'UA-116224796-1');

  </script>
  <script>
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
</head>

<body>
<div class="title ">
  <div class="container">
    <h1 style="color: white">Progress Bar</h1>
    <p style="color: white">Mars' life</p>
  </div>
</div>
<div class="container">
  <a class="nav-link" href="newprogress.html">New Progress Bar</a>
  <div class="bar-wrapper">
    <?php
    include('../php/database.php');
    $sql = "SELECT * FROM progress;";
    $result = $mysqli->query($sql);
    while ($row = $result->fetch_assoc()) {
      echo "<div class='bar-wrapper'>";
      echo "<div class='bar-info'>";
      echo "<h2>";

      date_default_timezone_set('America/Los_Angeles');

      $now = new DateTime('now');
      $startdate = new DateTime($row['start']);
      $enddate = new DateTime($row['end']);

      $interval1 = $startdate->diff($now);
      $interval2 = $startdate->diff($enddate);
      $diff = 1.0 * $interval1->days / $interval2->days;
      if ($interval1->invert == 1) $diff = 0;
      echo "$row[name]";
      echo "</h2></div>";
      echo "<div class='bar'><div class='percent'><p>" . round(min(100, $diff * 100),2) . "%</p></div><div class='progress-bar' style='width: " . ($diff * 100) . "%'> </div></div></div>";
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
  .title {
    background-color: forestgreen;
  }

</style>

</html>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
<link rel="stylesheet"
      href="https://unpkg.com/bootstrap-material-design@4.0.0-beta.3/dist/css/bootstrap-material-design.min.css"
      integrity="sha384-k5bjxeyx3S5yJJNRD1eKUMdgxuvfisWKku5dwHQq9Q/Lz6H8CyL89KF52ICpX4cL" crossorigin="anonymous">

<link rel="stylesheet" href="../css/header.css">
<link rel="stylesheet" href="../css/menu.css">
<link rel="stylesheet" href="progress.css">
