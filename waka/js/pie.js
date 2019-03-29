/**
 * @requires moment
 * @requires $
 * @requires Chart
 */
function pie_chart(user, field, element) {
  $.ajax({
    url: "http://api.marstanjx.com:3000/waka/chart/" + field + "/" + user + "", success: function (result) {
      const ctx = document.getElementById(element).getContext('2d');

      new Chart(ctx, {
        type: 'doughnut',
        data: result,
        options: {
          tooltips: {
            callbacks: {
              label: function (tooltipItem, data) {
                let label = data.labels[tooltipItem.index] || '';

                if (label) {
                  label += ': ';
                }
                label += getTimeString(data.datasets[0].data[tooltipItem.index]);
                return label;
              }
            }
          },
          legend: {
            position: 'right',
          }
        }
      });
    }
  });
}
