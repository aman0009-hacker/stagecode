

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto);
        #error_pieChart {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
    </style>
</head>

<body>
    <!--Div that will hold the pie chart-->
  
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
