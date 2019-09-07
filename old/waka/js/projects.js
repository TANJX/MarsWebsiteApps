/**
 * @requires moment
 * @requires $
 * @requires Chart
 */
function project_chart(user, time, element) {
  $.ajax({
    url: `http://api.marstanjx.com:3000/waka/chart/project/${user}/${time}`, success: function (result) {
      const ctx = document.getElementById(element).getContext('2d');
      new Chart(ctx, {
        type: 'bar',
        data: result,
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
            labels: {
              generateLabels: function (chart) {
                const data = chart.data;
                if (data.labels.length && data.datasets.length) {
                  return data.datasets.map(function (dataset, i) {
                    const fill = dataset.backgroundColor;
                    const value = dataset.data.map(obj => obj.y).reduce((result, val) => result + val);
                    return {
                      text: dataset.label + " : " + getTimeString(value),
                      fillStyle: fill,
                      index: i
                    };
                  });
                } else {
                  return [];
                }
              }
            }
          },
          scales: {
            yAxes: [{
              stacked: true,
              ticks: {
                beginAtZero: true,
                callback: getTimeString,
                stepSize: 3600,
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
}
