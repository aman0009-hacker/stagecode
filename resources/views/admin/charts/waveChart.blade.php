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
      /* margin: 35px auto; */
    }
  </style>
</head>

<body>
  <form>
    @csrf
    <div id="chart100" mt-3></div>
    <script>
      var options = {
      chart: {
        height: 350,
        type: 'area',
        stacked: true,
        events: {
          selection: function(chart, e) {
            console.log(new Date(e.xaxis.min) )
          },
          markerClick: function(a, b, c) {
            console.info(c);
            alert(c.w.globals.seriesNames[c.seriesIndex])
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
      series: [{
          name: 'South',
          data: generateDayWiseTimeSeries(new Date('11 Feb 2017 GMT').getTime(), 20, {
            min: 10,
            max: 60
          })
        },
        {
          name: 'North',
          data: generateDayWiseTimeSeries(new Date('11 Feb 2017 GMT').getTime(), 20, {
            min: 10,
            max: 20
          })
        },
        {
          name: 'Central',
          data: generateDayWiseTimeSeries(new Date('11 Feb 2017 GMT').getTime(), 20, {
            min: 10,
            max: 15
          })
        }
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
        type: 'datetime'
      },
    }
    var chart = new ApexCharts(
      document.querySelector("#chart100"),
      options
    );
    chart.render();
    function generateDayWiseTimeSeries(baseval, count, yrange) {
      var i = 0;
      var series = [];
      while (i < count) {
        var x = baseval;
        var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
       series.push([x, y]);
        baseval += 86400000;
        i++;
      }
      return series;
    }
    </script>
</body>

</html>