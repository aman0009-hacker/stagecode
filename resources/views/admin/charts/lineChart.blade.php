<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto);

      
    </style>
</head>

<body>
    <!--Div that will hold the pie chart-->
    {{-- <div id="chart_div"></div> --}}
    <form>
        @csrf
        <div id="chart1"></div>
        <div id="error_lineChart"><img src="{{ asset('images/error/empty1.png') }}" alt="" width="300"
                style="margin: 142px 80px; align-items: center"></div>
    </form>
    <script>
        $(function() {
            $.ajax({
                url: '/totalYards',
                type: 'GET',
                dataType: 'JSON',
                success: function(response) {
                    console.log(response.data);
                    const error = response.data.month.length;
                   const graph = document.getElementById('chart1');
                    const errorContainer = document.getElementById('error_lineChart');
                    if (error === 0)
                    {
                        graph.style.display = 'none';
                        errorContainer.style.visibility = 'visible';
                    }
                    else
                    {
                        const month = response.data.month;
                        const numberOf = response.data.numberOf;
                        graph.style.display = 'block';
                        errorContainer.style.display = 'none';
                        var options = {
                            chart: {
                                height: 420,
                                type: "bar",
                                // stacked: false
                            },
                            dataLabels: {
                                enabled: false
                            },
                            colors: ['#008FFB', '#00E396', '#FEB019', '#FF1654'],
                            series: [{
                                name: "Records",
                                data: numberOf
                            }],
                            stroke: {
                                width: [6, 6],
                                colors: ['transparent'],
                            },
                            plotOptions: {
                                bar: {
                                    columnWidth: "35%"
                                }
                            },
                            xaxis: {
                                categories: month
                            },
                            yaxis: [{
                                axisTicks: {
                                    show: true
                                },
                                axisBorder: {
                                    show: true,
                                    color: "#FEB019"
                                },
                                labels: {
                                    style: {
                                        colors: "#008FFB"
                                    }
                                },
                                title: {
                                    text: "Number of Records",
                                    style: {
                                        colors: "008FFB"
                                    }
                                }
                            }, ],
                            tooltip: {
                                shared: false,
                                intersect: true,
                                x: {
                                    show: false
                                }
                            },
                            legend: {
                                horizontalAlign: "left",
                                offsetX: 40
                            }
                        };
                        var chart = new ApexCharts(document.querySelector("#chart1"), options);
                        chart.render();
                    }
                }
            });
        });
    </script>
</body>

</html>
