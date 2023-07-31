{{-- <html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto);

        body {
            font-family: Roboto, sans-serif;
        }

        #chart123 {
            min-height: 249.7px;

            margin-top: 50px !important;
        }

        #chart123 .apexcharts-toolbar {
            top: -40px !important;

            margin-right: -45px !important;
        }

        #error_pieChart {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
    </style>
</head>

<body>

    <div id="chart123"></div>
    <div id="error_pieChart"><img src="{{ asset('images/error/empty1.png') }}" alt="" width="400"></div>
    <script>
        $(function() {
            $.ajax({
                    url: '/totalOrdersCount',
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(response) {
                        const error = response.data.length;
                        const graph = document.getElementById('chart123');
                        const errorContainer = document.getElementById('error_pieChart');
                        if (error === 0)
                        {
                            graph.style.display = 'none';
                            errorContainer.style.visibility = 'visible';
                        }
                        else {
                            graph.style.display = 'block';
                            errorContainer.style.visibility = 'hidden';
                        const month = response.data.month;
                        const numberOf = response.data.numberOf;
                        var series = numberOf
                        let labels = month
                        let newSeries = []
                        let newLabels = []
                        let grouped = 0
                        series.forEach((s, i) => {
                            if (s < 2) {
                                grouped += s
                            }
                            if (s >= 0) {
                                newSeries.push(s)
                                newLabels.push(labels[i])
                            }
                        })
                        var options = {
                            series: newSeries,
                            chart: {
                                width: 500,
                                type: 'pie',
                                toolbar: {
                                    show: true
                                }

                            },
                            colors: ['#008FFB', '#00E396', '#FEB019', '#ccc'],
                            labels: newLabels
                        }
                        var chart = new ApexCharts(document.querySelector('#chart123'), options)
                        chart.render()
                    }
                }
            });
        });
    </script>
</body>

</html> --}}



<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.28.0/dist/apexcharts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.28.0/dist/extensions/apexcharts.min.js"></script> --}}
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto);


        #error_pieChart {
            display: flex;
            justify-content: center;
            margin: 70px 20px;
            align-items: center;
            height: 100%;
        }
    </style>
</head>

<body>
    <!--Div that will hold the pie chart-->
    {{-- <div id="chart_div"></div> --}}
    <div id="chart123"></div>
    <div id="error_pieChart"><img src="{{ asset('images/error/empty1.png') }}" alt="" width="300"></div>
    <script>
        $(function() {
            $.ajax({
                url: '/totalOrdersCount',
                type: 'GET',
                dataType: 'JSON',
                success: function(response) {
                    const error = response.data.length;
                    const graph = document.getElementById('chart123');
                    const errorContainer = document.getElementById('error_pieChart');
                    if (error === 0) {
                        graph.style.display = 'none';
                        errorContainer.style.visibility = 'visible';
                    } else {
                        graph.style.display = 'block';
                        errorContainer.style.display = 'none';
                        const month = response.data.month;
                        const numberOf = response.data.numberOf;

                        var options = {
                            series: numberOf,
                            chart: {
                                width: '100%',
                                type: 'pie',
                                toolbar: {
                                    show: true
                                }
                            },
                            labels: month,
                            legend: {
                                position: 'bottom'
                            },
                            responsive: [{
                                breakpoint: 480,
                                options: {
                                    chart: {
                                        width: '100%'
                                    }
                                }
                            }]
                        };
                        var chart = new ApexCharts(document.querySelector("#chart123"), options);
                        chart.render();
                    }
                }
            });
        });
    </script>
</body>

</html>
