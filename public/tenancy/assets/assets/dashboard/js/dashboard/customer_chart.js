(function () {
    "use strict";
    // column chart
    var options2 = {
        series: [{
            name: 'Total Orders',
            data: totalOrders
        }, {
            name: 'Paid',
            data: ordersPaid
        }, {
            name: 'Remaining',
            data: orderRemaining
        },{
            name: 'UnPaid',
            data: ordersUnPaid
        },],
        chart: {
            type: 'bar',
            height: 350,
            stacked: true,
            toolbar: {
                show: true
            },
            zoom: {
                enabled: true
            }
        },
        responsive: [{
            breakpoint: 480,
            options: {
                legend: {
                    position: 'bottom',
                    offsetX: -10,
                    offsetY: 0
                }
            }
        }],
        plotOptions: {
            bar: {
                horizontal: false,
                borderRadius: 10,
                borderRadiusApplication: 'end', // 'around', 'end'
                borderRadiusWhenStacked: 'last', // 'all', 'last'
                dataLabels: {
                    total: {
                        enabled: true,
                        style: {
                            fontSize: '13px',
                            fontWeight: 900
                        }
                    }
                }
            },
        },
        xaxis: {
            /*  type: 'datetime',*/
            categories: categories,
        },
        legend: {
            position: 'right',
            offsetY: 40
        },
        fill: {
            opacity: 1
        }
    };
    var chartcolumn = new ApexCharts(document.querySelector("#order_statically"), options2);
    chartcolumn.render()
})();
