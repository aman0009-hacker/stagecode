<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto);


        .apexcharts-zoomin-icon,
    .apexcharts-zoomout-icon,
    .apexcharts-zoom-icon.apexcharts-selected,
    .apexcharts-reset-icon,
    .apexcharts-pan-icon {
      display: none;
    }
    </style>
</head>

<body>
    <div id="chart100" mt-3></div>
    <div id="error_waveChart" style="text-align:center;"><img src="{{asset('images/error/empty1.png')}}" alt=""
            width="300"  style="margin: 142px 60px;"></div>
    <script>
        $(function() {
            $.ajax({
                url: '/totalOrdersAmount',
                type: 'GET',
                dataType: 'JSON',
                success: function(response)
                {
                    const error = response.data.length;
                    const graph = document.getElementById('chart100');
                    const errorContainer = document.getElementById('error_waveChart');
                    if (error === 0)
                    {
                        graph.style.display = 'none';
                        errorContainer.style.visibility = 'visible';
                    }
                    else
                    {
                        graph.style.display = 'block';
                        errorContainer.style.display = 'none';
                    const month=response.data.month;
                    const total =response.data.total;
                    var options = {
                        chart: {
                            height: 420,
                            type: 'area',
                            stacked: true,
                            events: {
                                selection: function(chart, e) {
                                    console.log(new Date(e.xaxis.min))
                                },
                                markerClick: function(a, b, c) {
                                    console.info(c);
                                    // alert(c.w.globals.seriesNames[c.seriesIndex])
                                }
                            },

                        },
                        colors: ['#008FFB', '#00E396', '#CED4DC'],
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'smooth'
                        },

                        series: [
                            {
                                name: "Total Amount",
                                data:total
                            },
                        ],
                        fill: {
                            type: 'gradient',
                            gradient: {
                                opacityFrom: 0.6,
                                opacityTo: 0.8,
                            }
                        },
                        legend: {
                            position: 'top',
                            horizontalAlign: 'left'
                        },
                        xaxis: {
                            categories:month
                        },
                        yaxis:[{

                            title: {
                                    text: "Amount",
                                    style: {
                                        colors: "008FFB"
                                    }
                        }
      }
                        ]
                    }
                    var chart = new ApexCharts(
                        document.querySelector("#chart100"),
                        options
                    );
                    chart.render();
                }
            }
            });
        });
    </script>
</body>

</html>
