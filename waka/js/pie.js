/**
 * @requires moment
 * @requires $
 * @requires Chart
 */
function pie_chart(user, time, field, element) {
  $.ajax({
    url: `https://api.marstanjx.com/waka/chart/${field}/${user}/${time}`,
    success(result) {
      const ctx = document.getElementById(element).getContext('2d');

      new Chart(ctx, {
        type: 'doughnut',
        data: result,
        options: {
          tooltips: {
            callbacks: {
              label(tooltipItem, data) {
                let label = data.labels[tooltipItem.index] || '';

                if (label) {
                  label += ': ';
                }
                label += getTimeString(data.datasets[0].data[tooltipItem.index]);
                return label;
              },
            },
          },
          legend: {
            position: 'right',
          },
        },
      });
    },
  });
}
