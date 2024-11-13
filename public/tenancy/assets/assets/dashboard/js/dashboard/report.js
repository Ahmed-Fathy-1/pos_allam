/* pie chart for orders [ online- cashier ] */
var options = {
    series: [orderPaid, orderRemain,orderUnPaid],
    chart: {
        width: 380,
        type: 'pie',
    },
    labels: ['Paid ', 'P.Paid','UnPaid'],
    colors: ["#26bf94", '#0d6efd',"#ea4710"],
    responsive: [{
        breakpoint: 480,
        options: {
            chart: {
                width: 200
            },
            legend: {
                position: 'bottom'
            }
        }
    }]
};

var chart = new ApexCharts(document.querySelector("#order_status"), options);
chart.render();

/* pie chart for orders [ online- cashier ] */
var options1 = {
    series: [{
        name: "Desktops",
        data: lineOrder
    }],
    chart: {
        height: 350,
        type: 'line',
        zoom: {
            enabled: false
        }
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'straight'
    },
    title: {
        text: 'Order',
        align: 'left'
    },
    grid: {
        row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
        },
    },
    xaxis: {
        categories: dates,
    }
};


var chart1 = new ApexCharts(document.querySelector("#order_count_line"), options1);
chart1.render();

/* column chart for */
var options2 = {
    series: [{
        name: 'Paid',
        data: paid
    }, {
        name: 'Remaining',
        data: remain
    }, {
        name: 'UnPaid',
        data: unPaid
    }],
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
    colors: ["#23b7e5", "#ea4710", "#f5b849", "#26bf94"],
    xaxis: {
        type: 'date',
        categories: dates ,
    },
    legend: {
        position: 'right',
        offsetY: 40
    },
    fill: {
        opacity: 1
    }
};

var chart2 = new ApexCharts(document.querySelector("#order_details"), options2);
chart2.render();


