/**
 * @requires moment
 * @requires $
 * @requires Chart
 */
function project_chart(user, element) {
    $.ajax({
        url: "http://api.marstanjx.com:3000/waka/chart/project/" + user + "", success: function (result) {
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
                    },
                    scales: {
                        yAxes: [{
                            stacked: true,
                            ticks: {
                                beginAtZero: true,
                                callback: function (value) {
                                    const minutes = moment.duration(value, 'seconds').as('minutes');
                                    const hour = minutes / 60;
                                    return Math.floor(hour) + "h " + Math.floor(minutes % 60) + "m";
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
}
