/* pie chart for orders [ online- cashier ] */
var options = {
    series: [paidOrders, orderRemain ,unPaidOrder],
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

var chart = new ApexCharts(document.querySelector("#order_cashier_online"), options);
chart.render();

/* column chart for delivery*/
var options2 = {
    series: [{
        name: 'Total Orders',
        data: totalOrder
    }, {
        name: 'Pending',
        data: deliverPending
    }, {
        name: 'InTransit',
        data: deliverInTransit
    }, {
        name: 'Delivered',
        data: deliveryDelivered
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

var chart2 = new ApexCharts(document.querySelector("#delivery_status"), options2);
chart2.render();


