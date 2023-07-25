<html>

<head>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto);

        body {
            font-family: Roboto, sans-serif;
        }

        #chart {
            max-width: 650px;
            /* margin-top: 40px!important; */
        }
        #chart100{
            margin-top: 40px;
        }

        #chart100 .apexcharts-toolbar {
        top: -50px!important;

}
    </style>
</head>


<body>


    <div id="chart100" mt-3></div>
    <div id="joker"><img src="{{asset('images/error/empty1.png')}}" alt="" width="400" style="margin: 80px 60px;"></div>

    <script>



        $(function() {
            $.ajax({
                url: '/totalOrdersAmount',
                type: 'GET',
                dataType: 'JSON',
                success: function(response)
                {
                    if(response.data === 'null')
                    {
                        var chart = new ApexCharts(
                        document.querySelector("#joker"),
                        options
                    );

                    chart.render();                    }else
                    {
                    const month=response.data.month;
                    const total =response.data.total;

                    var options = {
                        chart: {
                            height: 350,
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
