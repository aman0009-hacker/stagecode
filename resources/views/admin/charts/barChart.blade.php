<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pie Chart Example</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins');

        * {
            font-family: 'Poppins', sans-serif;
        }

        #chart {
            width: 100%;
            margin: 75px auto !important;
            opacity: 0.9;
        }

        #timeline-chart .apexcharts-toolbar {
            opacity: 1;
            border: 0;
        }

        #chart .apexcharts-toolbar {
            top: -65px !important;
        }

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
    <!--Div that will hold the pie chart-->
    <form>
        @csrf
        <div id="chart"></div>
    </form>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {
            $.ajax({
                url: '/chartApproveStatus',
                type: 'POST',
                dataType: 'JSON',
                success: function (response) {
                    const data = response.data;
                    const error = response.data.length;

                    const graph = document.getElementById('chart');
                    if (error === 0) {
                        graph.style.display = 'none';
                    } else {
                        graph.style.display = 'block';

                        var options = {
                            series: data,
                            chart: {
                                width: 420,
                                type: 'pie',
                                toolbar: {
                                    show: true
                                }
                            },
                            labels: ['Approved', 'New', 'Rejected'],
                            legend: {
                                position: 'bottom' // Set the legend position to bottom
                            },
                            responsive: [{
                                breakpoint: 480,
                                options: {
                                    chart: {
                                        width: 200
                                    },
                                    legend: {
                                        position: 'bottom' // Set the legend position to bottom for smaller screens
                                    }
                                }
                            }]
                        };

                        var chart = new ApexCharts(document.querySelector("#chart"), options);
                        chart.render();
                    }
                }
            });
        });
    </script>
</body>

</html>