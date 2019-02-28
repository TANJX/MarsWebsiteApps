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
  <script
          src="https://code.jquery.com/jquery-3.3.1.min.js"
          integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
          crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
</head>
<body>
<canvas id="myChart" width="400" height="200"></canvas>
<script>
    let user = 'mars';
    <?php
    $usr = $_GET['user'];
    if ($usr != '')
      echo "user = '" . $usr . "';";
    ?>
    $.ajax({
        url: "http://api.marstanjx.com:3000/waka/" + user + "/0", success: function (result) {
            let mydata = [];
            let count = 0;
            let label = [];
            for (let i = result.length - 1; i >= 0; i--) {
                mydata[count] = {};
                label.push(result[i]['date']);
                mydata[count]['x'] = result[i]['date'];
                mydata[count]['y'] = Math.round(result[i]['total'] / 60.0 * 100) / 100.0;
                count++;
            }
            console.log(mydata);
            const ctx = document.getElementById("myChart").getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: label,
                    datasets: [{
                        label: "coding activity by date",
                        data: mydata,
                        backgroundColor: 'rgba(54, 162, 235, 0.8)',
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }
    });
</script>
</body>
</html>
