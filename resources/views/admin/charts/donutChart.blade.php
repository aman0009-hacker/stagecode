<html>
  <head>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <style>
    @import url(https://fonts.googleapis.com/css?family=Roboto);

body {
  font-family: Roboto, sans-serif;
}
.box-body{
    display: block;
    height: 454px;
}

#chart {
  margin: 0 auto;
}

#chart56 .apexcharts-toolbar {
    top: -50px!important;
    right: 3px!important;
}
#chart56 .apexcharts-canvas {
    position: relative;
    user-select: none;
    width: 600px!important;
}

  </style>
  </head>


  <body>

    <form>
        @csrf
        <div id="chart56" style="margin:61px;"></div>
        <div id="error_donutChart"><img src="{{asset('images/error/empty1.png')}}" alt="" width="400" style="margin: 80px 60px;"></div>

        </form>
    <script>
    $(function() {
            $.ajax({
                url: '/totalUsers',
                type: 'GET',
                dataType: 'JSON',
                success: function(response)
                {
                    const error = response.data.length;
                    const graph = document.getElementById('chart56');

                    const errorContainer = document.getElementById('error_donutChart');
                    if (error === 0)
                    {
                        graph.style.display = 'none';
                        errorContainer.style.visibility = 'visible';
                    }
                    else
                    {
                        graph.style.display = 'block';
                        errorContainer.style.visibility = 'hidden';

                    const month= response.data.month;
                    const numberOf=  response.data.numberOf;

    var options = {
    chart: {
    width: 450,
    height: 420,
    type: "donut",
    toolbar: {
            show: true
          }
  },
  colors: ['#008FFB', '#00E396', '#FEB019', '#FF1654'],
  dataLabels: {
     enabled: true
  },
  series: numberOf,
  labels: month,
  tooltip: {
    enabled: true,
  },
  legend: {
    show: false
  },
  legend: {
    horizontalAlign: "left",
    offsetX: -12
  }
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
