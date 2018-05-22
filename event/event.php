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
  <script>
    function validateForm() {
      var a = document.forms["Form"]["name"].value;
      echo(a);
      if (a == null || a == " ") {
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
      <h1>Event List</h1>
      <p>Mars' life</p>

    </div>
  </div>
  <div class="container">
    <a class="nav-link" href="newevent.html">New Event</a>

    <div class="selection-checkboxes">
      <div>
        <input class="styled-checkbox" id="checkbox-1" type="checkbox" value="value1" onclick="calc(1);" checked>
        <label for="checkbox-1">All</label>
      </div>

      <div>
        <input class="styled-checkbox" id="checkbox-2" type="checkbox" value="value2" onclick="calc(2);" checked>
        <label for="checkbox-2">Life</label>
      </div>

      <div>
        <input class="styled-checkbox" id="checkbox-3" type="checkbox" value="value3" onclick="calc(3);" checked>
        <label for="checkbox-3">School</label>
      </div>

      <div>
        <input class="styled-checkbox" id="checkbox-4" type="checkbox" value="value4" onclick="calc(4);" checked>
        <label for="checkbox-4">Work</label>
      </div>
    </div>

    <?php
$conn = mysql_connect('marstanjxcom.ipagemysql.com', 'mars', 'root'); 
mysql_select_db('marsql');
mysql_query("set names utf8;");

$sql = sprintf("select * from event ORDER BY date ASC;");  
$result = mysql_query($sql, $conn);  
echo $thstr;  
while ($row=mysql_fetch_array($result, MYSQL_ASSOC))
{ 
  date_default_timezone_set('America/Los_Angeles');

  echo "<div class='card event-block clearfix ";
  echo "$row[type]" ;
  echo "'>";
  echo "<div class='block-left'>";
  echo "<h4 class=''>";
  echo "$row[name]" ;
  echo "</h4>";
  echo "<h6 class='text-muted'>";
  echo "$row[date]";
  echo "</h6></div>";
  $now = new DateTime('now');
  $date = new DateTime($row[date]);
  $interval = $date->diff($now);
  if($interval->invert==1){
    echo "<div class='block-right future'>";
    echo "<h4>";
    echo $interval->days;
    echo " days";
  }else{
    echo "<div class='block-right past'>";
    echo "<h4>";
    echo $interval->days;
    echo " days";
  }
  echo"</h4></div></div>";
}  
mysql_free_result($result);  
mysql_close($conn);  
?>

  </div>
  <?php
    $doc = new DOMDocument();
  $doc->loadHTMLFile("../menu.htm");
  echo $doc->saveHTML();
  ?>
</body>

<script>
  function calc(i) {
    if (i == 1 && document.getElementById('checkbox-1').checked) {
      document.getElementById("checkbox-2").checked = true;
      document.getElementById("checkbox-3").checked = true;
      document.getElementById("checkbox-4").checked = true;
    }
    if (i == 1 && !document.getElementById('checkbox-1').checked) {
      document.getElementById("checkbox-2").checked = false;
      document.getElementById("checkbox-3").checked = false;
      document.getElementById("checkbox-4").checked = false;
    }
    if (i > 1 && !document.getElementById("checkbox-" + i).checked) {
      document.getElementById("checkbox-1").checked = false;
    }
    var items = document.getElementsByClassName("life");
    var j;
    for (j = 0; j < items.length; j++) {
      if (document.getElementById("checkbox-2").checked)
        items[j].style.display = "block";
      else
        items[j].style.display = "none";
    }
    items = document.getElementsByClassName("school");
    for (j = 0; j < items.length; j++) {
      if (document.getElementById("checkbox-3").checked)
        items[j].style.display = "block";
      else
        items[j].style.display = "none";
    }
    items = document.getElementsByClassName("work");
    for (j = 0; j < items.length; j++) {
      if (document.getElementById("checkbox-4").checked)
        items[j].style.display = "block";
      else
        items[j].style.display = "none";
    }
  }

</script>

</html>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
<link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.0.0-beta.3/dist/css/bootstrap-material-design.min.css" integrity="sha384-k5bjxeyx3S5yJJNRD1eKUMdgxuvfisWKku5dwHQq9Q/Lz6H8CyL89KF52ICpX4cL" crossorigin="anonymous">
<link rel="stylesheet" href="../css/header.css">
<link rel="stylesheet" href="../css/menu.css">
<link rel="stylesheet" href="event.css">
