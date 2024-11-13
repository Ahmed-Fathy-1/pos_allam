(function () {
    "use strict";
    /* basic line chart */
    var options = {
        series: [{
            name: "Purchase Due",
            data: chartPrice,
        }],
        chart: {
            height: 320,
            type: 'line',
            zoom: {
                enabled: false
            }
        },
        colors: ['#ea4710'],
        dataLabels: {
            enabled: true
        },
        legend: {
            show: true,
            position: 'bottom',
            // offsetY: 40
        },
        stroke: {
            curve: 'straight',
            width: 3,
        },
        grid: {
            borderColor: '#f2f5f7',
        },
        title: {
            text: 'Total Purchase Due',
            align: 'left',
            style: {
                fontSize: '13px',
                fontWeight: 'bold',
                color: '#8c9097'
            },
        },

        xaxis: {
            categories:date,
            labels: {
                show: true,
                style: {
                    colors: "#8c9097",
                    fontSize: '11px',
                    fontWeight: 600,
                    cssClass: 'apexcharts-xaxis-label',
                },
            }
        },
        yaxis: {
            labels: {
                show: true,
                style: {
                    colors: "#8c9097",
                    fontSize: '11px',
                    fontWeight: 600,
                    cssClass: 'apexcharts-yaxis-label',
                },
            }
        }
    };
    var chart1 = new ApexCharts(document.querySelector("#column-basic"), options);
    chart1.render();
})();

(function () {
    "use strict";
    /* basic line chart */
    var options = {
        series: [{
            name: "newPrice",
            data: priceLogs,
        }],
        chart: {
            height: 320,
            type: 'line',
            zoom: {
                enabled: false
            }
        },
        colors: ['#ea4710'],
        dataLabels: {
            enabled: true
        },
        legend: {
            show: true,
            position: 'bottom',
            // offsetY: 40
        },
        stroke: {
            curve: 'straight',
            width: 3,
        },
        grid: {
            borderColor: '#f2f5f7',
        },
        title: {
            text: 'new Price',
            align: 'left',
            style: {
                fontSize: '13px',
                fontWeight: 'bold',
                color: '#8c9097'
            },
        },

        xaxis: {
            categories:lineDate,
            labels: {
                show: true,
                style: {
                    colors: "#8c9097",
                    fontSize: '11px',
                    fontWeight: 600,
                    cssClass: 'apexcharts-xaxis-label',
                },
            }
        },
        yaxis: {
            labels: {
                show: true,
                style: {
                    colors: "#8c9097",
                    fontSize: '11px',
                    fontWeight: 600,
                    cssClass: 'apexcharts-yaxis-label',
                },
            }
        }
    };
    var chart2 = new ApexCharts(document.querySelector("#line-chart"), options);
    chart2.render();
})();

