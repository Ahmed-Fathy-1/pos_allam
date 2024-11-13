(function () {
    "use strict";

    /* basic line chart */
    var options = {
        series: [{
            name: "Orders",
            data: orders,
        }],
        chart: {
            height: 320,
            type: 'line',
            zoom: {
                enabled: false
            }
        },
        colors: ['#FF9F43'],
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
            text: 'Number Orders Took',
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
    var chart = new ApexCharts(document.querySelector("#customer_order"), options);
    chart.render();
})();
