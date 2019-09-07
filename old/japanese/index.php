<!DOCTYPE html>
<html lang="jp">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no">
  <title>Japanese Notes</title>
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
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"
          integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

</head>

<body>
<script>
    var i = 1;
    $(function () {
        for (i = 1; i <= 131; i++) {
            $('#c' + i).load('notes/c' + i + '.htm');
        }
    });

    var old = 1;

    function unit(u) {
        document.getElementById("unit-" + old).style.display = "none";
        document.getElementById("unit-" + u).style.display = "block";
        old = u;
    }

    $(document).ready(function () {
        document.getElementById("loading").style.display = "none";
    });

</script>


<header id="header" class="header header--fixed">
  <?php
  header("Content-type:text/html;charset=utf-8");
  if ($_REQUEST['page'] == '') {
    $doc = new DOMDocument();
    $doc->loadHTMLFile("header.htm");
    echo $doc->saveHTML();
  }
  ?>
</header>
<div class="title ">
  <div class="container">
    <h1>日本語のノート</h1>
    <p>Marsです</p>
  </div>
</div>
<div class="container notes">
  <?php
  if ($_REQUEST['page'] != '') {
    $notes = explode(",", $_REQUEST['page']);
    foreach ($notes as $entry) {
      $ids = explode("-", $entry);
      if (count($ids) > 1) {
        for ($i = $ids[0]; $i <= $ids[1]; $i++) {
          echo "<div id='c$i'></div>";
        }
      } else {
        if ($entry > 132 || $entry < 1) continue;
        echo "<div id='c$entry'></div>";
      }
    }
  } else {
    for ($i = 1; $i <= 131; $i++) {
      echo "<div id='c$i'></div>";
    }
  }
  ?>
  <p id="loading">加载中...</p>
</div>
<?php
$doc = new DOMDocument();
$doc->loadHTMLFile("../menu.htm");
echo $doc->saveHTML();
?>
</body>

</html>
<script src="https://rawgithub.com/WickyNilliams/headroom.js/gh-pages/assets/scripts/main.js"></script>
<script src="index.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

<link rel="stylesheet" href="normalize.css"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
<link rel="stylesheet"
      href="https://unpkg.com/bootstrap-material-design@4.0.0-beta.3/dist/css/bootstrap-material-design.min.css"
      integrity="sha384-k5bjxeyx3S5yJJNRD1eKUMdgxuvfisWKku5dwHQq9Q/Lz6H8CyL89KF52ICpX4cL" crossorigin="anonymous">
<link rel="stylesheet" href="../css/header.css">
<link rel="stylesheet" href="../css/menu.css">
<link rel="stylesheet" href="index.css">
