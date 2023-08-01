<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto);

        #chart56 .apexcharts-toolbar {
            /* top: -45px !important; */
            right: 45px !important;
        }
    </style>
</head>

<body>
    <div id="chart56"></div>
    <div id="error_donutChart"><img src="{{ asset('images/error/empty1.png') }}" alt="" width="300"
            style="margin: 70px 20px;"></div>
    <script>
        $(function() {
            $.ajax({
                url: '/totalUsers',
                type: 'GET',
                dataType: 'JSON',
                success: function(response) {
                    const error = response.data.length;
                    const graph = document.getElementById('chart56');
                    const errorContainer = document.getElementById('error_donutChart');
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
                                type: 'donut',
                                toolbar: {
                                    show: true
                                },

                            },
                            dataLabels: {
                                enabled: true,
                                style: {
                                    fontSize: '10px',
                                }
                            },
                            labels: month,
                            options: {
                                dataLabels: {
                                    enabled: false,

                                }
                            },
                            legend: {
                                position: 'bottom'
                            },
                            responsive: [{
                                breakpoint: 480,
                                options: {
                                    chart: {
                                        width: '100%'
                                    },
                                    dataLabels: {
                                        enabled: true,

                                    }

                                }
                            }],
                        };
                        var chart = new ApexCharts(document.querySelector("#chart56"), options);
                        chart.render();
                    }
                }
            });
        });
    </script>
</body>

</html>
