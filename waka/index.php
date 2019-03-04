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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.js"></script>
  <script
          src="https://code.jquery.com/jquery-3.3.1.min.js"
          integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
          crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
</head>
<body>
<canvas id="project_chart" width="400" height="200"></canvas>
<canvas id="language_chart" width="400" height="200"></canvas>
<script src="/waka/js/projects.js"></script>
<script src="/waka/js/language.js"></script>
<script>
    (function () {
        let user = 'mars';
      <?php
      $usr = $_GET['user'];
      if ($usr != '')
        echo "user = '" . $usr . "';";
      ?>
        project_chart(user, "project_chart");

        language_chart(user, "language_chart");
    })();
</script>
</body>
</html>
