<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Paste | Mars Inc.</title>
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

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
  <link rel="stylesheet"
        href="https://unpkg.com/bootstrap-material-design@4.0.0-beta.3/dist/css/bootstrap-material-design.min.css"
        integrity="sha384-k5bjxeyx3S5yJJNRD1eKUMdgxuvfisWKku5dwHQq9Q/Lz6H8CyL89KF52ICpX4cL" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="../css/menu.css">
</head>

<body>
<div class="title ">
  <div class="container">
    <h1>Paste</h1>
    <p>by Mars</p>
  </div>
</div>

<div class="container">
  <?php
  $conn = mysql_connect('marstanjxcom.ipagemysql.com', 'mars', 'root');
  mysql_select_db('marsql');
  mysql_query("set names utf8;");

  $sql = sprintf("select * from paste ORDER BY date DESC;");
  $result = mysql_query($sql, $conn);
  echo $thstr;
  while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    echo "<div class='card event-block clearfix ";
    echo "$row[type]";
    echo "'>";
    if ($row[type] === 'image') {
      echo '<a href="' . $row[content] . '" target="_blank">';
      echo '<img class="image" style="width: 100%" src="';
      echo $row[content];
      echo '">';
      echo "</a>";
    } else {
      echo "<div class='content'>";
      echo $row[content];
      echo "</div>";
    }
    echo "<p>";
    echo $row[date];
    echo "</p>";
    echo "</div>";
  }
  mysql_free_result($result);
  mysql_close($conn);
  ?>
</div>

<div class="new container">
  <form action="newentry.php" method="POST">
    <div class="form-group">
      <h2>Add New Entry</h2>
      <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="7"></textarea>
    </div>
    <input type="submit" value="SUBMIT" class="btn btn-primary btn-raised ">
  </form>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src="paste.js"></script>
<script>


</script>
<style>
  .title {
    background-color: aquamarine;
    color: black;
    margin-bottom: 50px;
  }

  .btn {
    margin-top: 20px;
  }

  .image {
    margin: 20px auto;
  }

  .new {
    margin-top: 30px;
  }

</style>
</body>

</html>
