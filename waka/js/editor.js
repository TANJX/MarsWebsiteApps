/**
 * @requires moment
 * @requires $
 * @requires Chart
 */
function editor_chart(user, element) {
    const colors = {
        "PhpStorm": "#c544f0",
        "PyCharm": "#cef157",
        "IntelliJ": "#f02b62",
        "Visual Studio": "#865fc5",
        "VS Code": "#007acc",
    };
    $.ajax({
        url: "http://api.marstanjx.com:3000/waka/total/" + user + "/0", success: function (result) {

            let editor_data = [];

            for (let i = 0; i < result.length; i++) {
                const lang_names = Object.keys(result[i]['editors']);
                for (let l = 0; l < lang_names.length; l++) {
                    const name = lang_names[l];
                    const time = result[i]['editors'][name];
                    const found = editor_data.find(n => n.name === name);
                    if (found == null) {
                        editor_data.push({name: name, time: time});
                    } else {
                        found.time += time;
                    }
                }
            }

            editor_data.sort((s1, s2) => {
                return s2.time - s1.time;
            });

            let editor_name = [];
            let editor_time = [];
            let editor_color = [];

            for (let l = 0; l < editor_data.length; l++) {
                if (l >= 12) {
                    break;
                }
                if (editor_data[l].time < 60)
                    continue;
                editor_name.push(editor_data[l].name);
                editor_time.push(editor_data[l].time);
                const c = colors[editor_data[l].name];
                if (c == null) {
                    const r = Math.floor(Math.random() * 255);
                    const g = Math.floor(Math.random() * 255);
                    const b = Math.floor(Math.random() * 255);
                    editor_color.push('rgba(' + r + ', ' + g + ',' + b + ', 0.8)');
                    console.warn(editor_data[l].name + " doesn't have a color!");
                } else {
                    editor_color.push(c);
                }
            }

            const ctx = document.getElementById(element).getContext('2d');

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: editor_name,
                    datasets: [{
                        data: editor_time,
                        backgroundColor: editor_color
                    }],
                },
                options: {
                    tooltips: {
                        callbacks: {
                            label: function (tooltipItem, data) {
                                let label = data.labels[tooltipItem.index] || '';

                                if (label) {
                                    label += ': ';
                                }
                                label += getTimeString(editor_time[tooltipItem.index], 'seconds');
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
