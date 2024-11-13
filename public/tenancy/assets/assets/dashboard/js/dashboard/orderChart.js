/* line chart*/
var options = {
    series: [
        {
            name: "Cashier ",
            data: casierOrder
        },
        {
            name: "Online",
            data: onlineOrder
        }
    ],
    chart: {
        height: 350,
        type: 'line',
        dropShadow: {
            enabled: true,
            color: '#000',
            top: 18,
            left: 7,
            blur: 10,
            opacity: 0.2
        },
        toolbar: {
            show: false
        }
    },
    colors: ['#77B6EA', '#FF9F43'],
    dataLabels: {
        enabled: true,
    },
    stroke: {
        curve: 'smooth'
    },
    // title: {
    //     text: 'Average High & Low Temperature',
    //     align: 'left'
    // },
    grid: {
        borderColor: '#e7e7e7',
        row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
        },
    },
    markers: {
        size: 1
    },
    xaxis: {
        categories: date,
        title: {
            text: 'Days'
        }
    },
    // yaxis: {
    //   /*  title: {
    //         text: 'Temperature'
    //     },*/
    //     min: 5,
    //     max: 40
    // },
    legend: {
        position: 'top',
        horizontalAlign: 'right',
        floating: true,
        offsetY: -25,
        offsetX: -5
    }
};

var chart = new ApexCharts(document.querySelector("#orders_line"), options);
chart.render();

/* column chart revenue From Online And Cashier */
/* column chart for delivery*/
var options2 = {
    series: [{
        name: 'Total',
        data: totalRevenue
    }, {
        name: 'Online',
        data: onlineRevenue
    }, {
        name: 'Cahier',
        data: cashierRevenue
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
        categories: date ,
    },
    legend: {
        position: 'right',
        offsetY: 40
    },
    fill: {
        opacity: 1
    }
};
var chart2 = new ApexCharts(document.querySelector("#column_revenue"), options2);
chart2.render();
