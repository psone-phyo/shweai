

const chartFunction = {
    createHalfDoughnut({ ctx, percentage = 0, datasets, title, titleTextId, maintainAspectRatio = true }) {
        const newChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: datasets
            },
            options: {
                cutout: '65%',
                rotation: -90,
                circumference: 180,
                responsive: true,
                maintainAspectRatio: maintainAspectRatio,
                legend: {
                    display: false,
                },
                tooltips: {
                    enabled: false,
                },
                backgroundColor: 'green',
            },
            plugins: [{
                id: titleTextId ?? 'centerText',
                beforeDatasetsDraw(chart) {
                    if (title) {
                        const {
                            ctx
                        } = chart;
                        const dataPoint = chart.getDatasetMeta(0).data[0];
                        if (dataPoint) {
                            ctx.save();
                            ctx.font = 'bold 20px sans-serif';
                            ctx.fillStyle = '#183F35';
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'middle';
                            ctx.fillText(`${percentage} %`, dataPoint.x, dataPoint.y - 10);
                            ctx.font = 'bold 16px lovato';
                            ctx.fillText(title, dataPoint.x, dataPoint.y + 10);
                            ctx.restore();
                        }
                    }
                }
            }]
        });
        return newChart;
    },
    initDateRangePicker(className, start, end, max_date) {
        $(`.${className}`).daterangepicker({
            autoUpdateInput: true,
            "showDropdowns": true,
            "timePicker": true,
            "timePicker24Hour": true,
            locale: {
                format: 'YYYY-MM-DD HH:mm:ss'
            },
            maxDate: max_date,
            startDate: start,
            endDate: end,
            maxSpan: {
                days: 31
            },
            ranges: {
                'Today': [moment().startOf('days'), moment().endOf('days')],
                'Yesterday': [moment().subtract(1, 'days').startOf('days'), moment()
                    .subtract(1, 'days')
                    .endOf('days')
                ],
                'Last 7 Days': [moment().subtract(6, 'days').startOf('days'), moment()
                    .endOf('days')
                ],
                'Last 30 Days': [moment().subtract(29, 'days').startOf('days'), moment()
                    .endOf('days')
                ],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment()
                    .subtract(1,
                        'month').endOf('month')
                ]
            },
        }).attr('readOnly', 'true').css('cursor', 'pointer');

        $('.date_range').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm:ss') + ' - ' + picker.endDate.format(
                'YYYY-MM-DD HH:mm:ss'));
        });
    },
    createBarChart({ ctx, labels, datasets, maintainAspectRatio = true, showLegend = true }) {
        return new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: maintainAspectRatio,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: "white"
                        }
                    },
                    x: {
                        ticks: {
                            color: "white"
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: showLegend,
                        labels: {
                            color: "white",
                            boxWidth: 10,
                            boxHeight: 10
                        }
                    },
                    // zoom: {
                    //     zoom: {
                    //         wheel: { enabled: true },
                    //         pinch: { enabled: true },
                    //         drag: {
                    //             enabled: true,
                    //             modifierKey: 'ctrl', // Require Ctrl key
                    //             backgroundColor: 'rgba(0, 0, 255, 0.2)'
                    //         },
                    //         mode: 'xy',
                    //     },
                    //     pan: {
                    //         enabled: true,
                    //         mode: 'xy'
                    //     },
                    //     limits: {
                    //         x: { min: 'original', max: 1000 },  // Original x, max 1000
                    //         y: { min: 0, max: 'original' }     // Min 0, original y
                    //     }
                    // }
                }
            }
        });
    },
    createLineChart({ ctx, labels, datasets, maintainAspectRatio = true, showLegend = true }) {

        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: maintainAspectRatio,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: "white"
                        }
                    },
                    x: {
                        ticks: {
                            color: "white"
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: showLegend,
                        labels: {
                            color: 'white',
                            boxWidth: 10,
                            boxHeight: 10
                        }
                    }
                },
                backgroundColor: 'darkgreen', // Chart background color
                color: 'white' // Default text color
            }
        });
        return myChart;
    },
    createDoughnutChart({ ctx, datasets, labels, maintainAspectRatio = true }) {
        const newChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: maintainAspectRatio,
                layout: {
                    padding: 50
                },
                plugins: {
                    datalabels: {
                        color: '#fff',
                        anchor: (context) => { // Dynamic anchor
                            const angle = context.chart.getDatasetMeta(0).data[context.dataIndex].angle;
                            if (angle < Math.PI / 2 || angle > 3 * Math.PI / 2) {
                                return 'start'; // Left side
                            } else {
                                return 'end';   // Right side
                            }
                        },
                        align: (context) => {  // Dynamic align
                            const angle = context.chart.getDatasetMeta(0).data[context.dataIndex].angle;
                            if (angle < Math.PI / 2 || angle > 3 * Math.PI / 2) {
                                return 'start'; // Left align
                            } else {
                                return 'end';   // Right align
                            }
                        },
                        offset: 10,
                        display: 'auto',
                        formatter: (value, context) => {
                            const label = context.chart.data.labels[context.dataIndex];
                            const data = context.chart.data.datasets[context.datasetIndex].data;
                            function totalSum(total, amount) {
                                return total + amount;
                            }
                            const totalValue = data.reduce(totalSum, 0);
                            const percentageValue = (value / totalValue * 100).toFixed(1);
                            return label + ' ' + percentageValue + '%';
                        },
                        font: {
                            size: 10,
                        },
                        textAlign: 'center'
                    },
                    legend: {
                        display: false,
                    },
                },
                cutout: '0%',
            },
            plugins: [ChartDataLabels]
        });
        return newChart;
    },
}
