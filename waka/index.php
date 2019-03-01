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
<canvas id="myChart" width="400" height="200"></canvas>
<script>
    (function () {
        let user = 'mars';
      <?php
      $usr = $_GET['user'];
      if ($usr != '')
        echo "user = '" . $usr . "';";
      ?>
        $.ajax({
            url: "http://api.marstanjx.com:3000/waka/" + user + "/0", success: function (result) {

                // in second
                const threshold = 120;

                let mydata = [];
                let label = [];
                let projects = {};

                let all_project_names = [];

                for (let i = result.length - 1; i >= 0; i--) {
                    const projectNames = Object.keys(result[i]['projects']);
                    for (let p = 0; p < projectNames.length; p++) {
                        if (!all_project_names.includes(projectNames[p])) {
                            all_project_names.push(projectNames[p]);
                            projects[projectNames[p]] = [];
                        }
                    }
                }

                let count = 0;
                for (let i = result.length - 1; i >= 0; i--) {
                    // for every day
                    mydata[count] = {};
                    const date = result[i]['date'];
                    const minutes = Math.round(result[i]['total'] / 60.0 * 100) / 100.0;
                    label.push(date);

                    mydata[count]['x'] = date + " (total: " + minutes + " minutes)";
                    mydata[count]['y'] = minutes;

                    for (let p = 0; p < all_project_names.length; p++) {
                        projects[all_project_names[p]].push({x: date, y: 0});
                    }
                    const projectNames = Object.keys(result[i]['projects']);
                    for (let p = 0; p < projectNames.length; p++) {
                        const projectName = projectNames[p];
                        if (result[i]['projects'][projectName] > threshold)
                            projects[projectName][count]['y'] = result[i]['projects'][projectName];
                    }
                    count++;
                }

                let project_datasets = [];
                const projectNames = Object.keys(projects);
                for (let p = 0; p < projectNames.length; p++) {
                    // check if project time too small
                    let check = false;
                    for (let t = 0; t < projects[projectNames[p]].length; t++) {
                        if (projects[projectNames[p]][t]['y'] > threshold) {
                            check = true;
                            break;
                        }
                    }
                    if (!check) {
                        continue;
                    }
                    const r = Math.floor(Math.random() * 255);
                    const g = Math.floor(Math.random() * 255);
                    const b = Math.floor(Math.random() * 255);
                    project_datasets.push({
                        label: projectNames[p],
                        data: projects[projectNames[p]],
                        backgroundColor: 'rgba(' + r + ', ' + g + ',' + b + ', 0.8)'
                    });
                }

                project_datasets.sort((pa, pb) => {
                    let sum_a = 0, sum_b = 0;
                    for (let t = 0; t < pa['data'].length; t++) {
                        sum_a += pa['data'][t]['y'];
                        sum_b += pb['data'][t]['y'];
                    }
                    return sum_b - sum_a;
                });

                console.log(project_datasets);

                const ctx = document.getElementById("myChart").getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: label,
                        datasets: project_datasets,
                    },
                    options: {
                        tooltips: {
                            mode: 'x',
                            filter: function (data) {
                                return data['yLabel'] !== 0;

                            },
                            callbacks: {
                                label: function (tooltipItem, data) {
                                    let label = data.datasets[tooltipItem.datasetIndex].label || '';

                                    if (label) {
                                        label += ': ';
                                    }
                                    label += moment.duration(tooltipItem.yLabel, 'seconds').humanize();
                                    return label;
                                }
                            }
                        },
                        legend: {
                            position: 'right',
                        },
                        scales: {
                            yAxes: [{
                                stacked: true,
                                ticks: {
                                    beginAtZero: true,
                                    callback: function (value) {
                                        const minutes = moment.duration(value, 'seconds').as('minutes');
                                        const hour = minutes / 60;
                                        return Math.floor(hour) + " hours " + Math.floor(minutes % 60) + " minutes";
                                    }
                                }
                            }],
                            xAxes: [{
                                stacked: true,
                            }],
                        }
                    }
                });
            }
        });
    })();
</script>
</body>
</html>
