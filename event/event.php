<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>EVENTS | Mars Inc.</title>
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
  <link rel="stylesheet" href="event.css">
</head>

<body>
<div class="title ">
  <div class="container">
    <h1>Event List</h1>
    <p>Mars' life</p>

  </div>
</div>
<div class="container">
  <div class="nav-link">
    <a href="newevent.html">New Event</a>
  </div>

  <div class="selection-checkboxes clearfix">
    <div class="left">
      <div>
        <input class="styled-checkbox" id="type-all" type="checkbox" value="value1" onclick="update(1);" checked>
        <label for="type-all">All</label>
      </div>
      <div>
        <input class="styled-checkbox" id="type-1" type="checkbox" value="value2" onclick="update(0);" checked>
        <label for="type-1">Life</label>
      </div>
      <div>
        <input class="styled-checkbox" id="type-2" type="checkbox" value="value3" onclick="update(0);" checked>
        <label for="type-2">School</label>
      </div>
      <div>
        <input class="styled-checkbox" id="type-3" type="checkbox" value="value4" onclick="update(0);" checked>
        <label for="type-3">Work</label>
      </div>
    </div>
    <div class="right">
      <div>
        <input class="styled-checkbox" id="time-all" type="checkbox" value="value5" onclick="update(2);" checked>
        <label for="time-all">All</label>
      </div>
      <div>
        <input class="styled-checkbox" id="time-1" type="checkbox" value="value6" onclick="update(0);" checked>
        <label for="time-1">Past</label>
      </div>
      <div>
        <input class="styled-checkbox" id="time-2" type="checkbox" value="value7" onclick="update(0);" checked>
        <label for="time-2">Future</label>
      </div>
    </div>
  </div>

  <?php

  include('../php/database.php');

  $sql = "SELECT * FROM event ORDER BY date ASC;";
  $result = $mysqli->query($sql);
  while ($row = $result->fetch_assoc()) {
    date_default_timezone_set('America/Los_Angeles');
    $now = new DateTime('now');
    $date = new DateTime($row['date']);
    $interval = $date->diff($now);

    echo "<div class='card event-block clearfix ";
    echo "$row[type] ";
    if ($interval->days == 0) {
      echo "now";
    } else if ($interval->invert == 1) {
      echo "future";
    } else {
      echo "past";
    }
    echo "'>";
    echo "<div class='block-left'>";
    echo "<h4 class=''>";
    echo "$row[name]";
    echo "</h4>";
    echo "<h6 class='text-muted'>";
    echo "$row[date]";
    echo "</h6></div>";
    if ($interval->days == 0) {
      echo "<div class='block-right now'>";
      echo "<h4>";
      echo "Today";
    } else if ($interval->invert == 1) {
      echo "<div class='block-right future'>";
      echo "<h4>";
      echo $interval->days;
      echo " days";
    } else {
      echo "<div class='block-right past'>";
      echo "<h4>";
      echo $interval->days;
      echo " days";
    }
    echo "</h4></div></div>";
  }
  $mysqli->close();
  ?>

</div>
<div class="container">
  <?php
  $doc = new DOMDocument();
  $doc->loadHTMLFile("../menu.htm");
  echo $doc->saveHTML();
  ?>
</div>
</body>

<script>
    function update(all) {
        if (all === 1) {
            document.getElementById("type-1").checked = document.getElementById("type-all").checked;
            document.getElementById("type-2").checked = document.getElementById("type-all").checked;
            document.getElementById("type-3").checked = document.getElementById("type-all").checked;
        } else if (all === 2) {
            document.getElementById("time-1").checked = document.getElementById("time-all").checked;
            document.getElementById("time-2").checked = document.getElementById("time-all").checked;
        }

        // type settings
        const type1 = document.getElementById("type-1").checked,
            type2 = document.getElementById("type-2").checked,
            type3 = document.getElementById("type-3").checked;
        document.getElementById("type-all").checked = type1 && type2 && type3;

        // time settings
        const time1 = document.getElementById("time-1").checked,
            time2 = document.getElementById("time-2").checked;
        document.getElementById("time-all").checked = time1 && time2;

        const items = document.getElementsByClassName('event-block');
        let j;
        for (j = 0; j < items.length; j++) {
            if (items[j].classList.contains('life')) {
                if (type1) {
                    items[j].style.display = "block";
                } else {
                    items[j].style.display = "none";
                }
            } else if (items[j].classList.contains('school')) {
                if (type2) {
                    items[j].style.display = "block";
                } else {
                    items[j].style.display = "none";
                }
            } else if (items[j].classList.contains('work')) {
                if (type3) {
                    items[j].style.display = "block";
                } else {
                    items[j].style.display = "none";
                }
            }
            if (items[j].style.display === "block") {
                if (items[j].classList.contains('past')) {
                    if (!time1) {
                        items[j].style.display = "none";
                    }
                }
                else {
                    if (!time2) {
                        items[j].style.display = "none";
                    }
                }
            }
        }
    }

    document.getElementById("time-1").checked = false;
    update();

</script>

</html>
