<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Waka | Mars Inc.</title>
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
  <link rel="stylesheet" href="/waka/index.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.js"></script>
  <script
          src="https://code.jquery.com/jquery-3.3.1.min.js"
          integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
          crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Raleway:600" rel="stylesheet">
</head>
<body>
<div class="container">
  <h1>Coding Activity for <span></span></h1>
  <div class="full">
    <canvas id="project_chart" width="400" height="150"></canvas>
  </div>
  <div class="flex">
    <div>
      <canvas id="language_chart" width="200" height="100"></canvas>
    </div>
    <div>
      <canvas id="editor_chart" width="200" height="100"></canvas>
    </div>
  </div>
</div>
<script src="/waka/js/projects.js"></script>
<script src="/waka/js/language.js"></script>
<script src="/waka/js/editor.js"></script>
<script>
    function getTimeString(second) {
        const minutes = moment.duration(second, 'seconds').as('minutes');
        const hour = minutes / 60;
        return Math.floor(hour) + "h " + Math.floor(minutes % 60) + "m";
    }

    (function () {
        let user = 'mars';
      <?php
      $usr = $_GET['user'];
      if ($usr != '')
        echo "user = '" . $usr . "';";
      ?>
        $('h1 span').html(user);
        project_chart(user, "project_chart");
        language_chart(user, "language_chart");
        editor_chart(user, "editor_chart");
    })();
</script>
</body>
</html>
