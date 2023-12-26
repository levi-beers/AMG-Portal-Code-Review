
as.dashboard.datasource3initChart = function () {
    var datasource3data = {
        labels: datasource3months,
        datasets: [
            {
                label: datasource3trans.chartLabel,
                backgroundColor: "transparent",
                borderColor: "#179970",
                pointBackgroundColor: "#179970",
                data: datasource3users
            }
        ]
    };

    var datasource3ctx = document.getElementById("datasource3Chart").getContext("2d");
    var datasource3myLineChart = new Chart(datasource3ctx, {
        type: 'line',
        data: datasource3data,
        options: {
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                    }
                }],
                yAxes: [{
                    gridLines: {
                        color: "#f6f6f6",
                        zeroLineColor: '#f6f6f6',
                        drawBorder: false
                    },
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {if (value % 1 === 0) {return value;}}
                    }
                }]
            },
            responsive: true,
            legend: {
                display: false
            },
            maintainAspectRatio: false,
            tooltips: {
                titleMarginBottom: 15,
                callbacks: {
                    label: function(tooltipItem, data) {
                        var value = tooltipItem.yLabel,
                            suffix = trans.new + " " + (value == 1 ? trans.user : trans.users);

                        return " " + value + " " + suffix;
                    }
                }
            }
        }
    })
};

$(document).ready(function () {
    as.dashboard.datasource3initChart();
});
