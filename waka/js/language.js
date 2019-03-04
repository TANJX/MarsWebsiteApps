/**
 * @requires moment
 * @requires $
 * @requires Chart
 */
function language_chart(user, element) {
    const colors = {
        "Batchfile": "#C1F12E",
        "C": "#555555",
        "C#": "#178600",
        "C++": "#f34b7d",
        "CoffeeScript": "#244776",
        "CSS": "#563d7c",
        "SCSS": "#db2700",
        "Dockerfile": "#0db7ed",
        "Go": "#375eab",
        "HTML": "#e34c26",
        "Java": "#b07219",
        "JavaScript": "#f1e05a",
        "JSON": "#40d47e",
        "Makefile": "#427819",
        "PHP": "#4F5D95",
        "Python": "#3572A5",
        "YAML": "#008000",
        "Markdown": "#a8a8a8",
        "Other": "#c5c5c5",
        "Jade": "#a86454"
    };

    $.ajax({
        url: "http://api.marstanjx.com:3000/waka/total/" + user + "/0", success: function (result) {

            let language_data = [];

            for (let i = 0; i < result.length; i++) {
                const lang_names = Object.keys(result[i]['languages']);
                for (let l = 0; l < lang_names.length; l++) {
                    const name = lang_names[l];
                    const time = result[i]['languages'][name];
                    const found = language_data.find(n => n.name === name);
                    if (found == null) {
                        language_data.push({name: name, time: time});
                    } else {
                        found.time += time;
                    }
                }
            }

            language_data.sort((s1, s2) => {
                return s2.time - s1.time;
            });

            let language_name = [];
            let language_time = [];
            let language_color = [];

            for (let l = 0; l < language_data.length; l++) {
                if (l >= 12) {
                    break;
                }
                if (language_data[l].time < 60)
                    continue;
                language_name.push(language_data[l].name);
                language_time.push(language_data[l].time);
                const c = colors[language_data[l].name];
                if (c == null) {
                    const r = Math.floor(Math.random() * 255);
                    const g = Math.floor(Math.random() * 255);
                    const b = Math.floor(Math.random() * 255);
                    language_color.push('rgba(' + r + ', ' + g + ',' + b + ', 0.8)');
                    console.warn(language_data[l].name + " doesn't have a color!");
                } else {
                    language_color.push(c);
                }
            }

            const ctx = document.getElementById(element).getContext('2d');

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: language_name,
                    datasets: [{
                        data: language_time,
                        backgroundColor: language_color
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
                                label += moment.duration(language_time[tooltipItem.index], 'seconds').humanize();
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

