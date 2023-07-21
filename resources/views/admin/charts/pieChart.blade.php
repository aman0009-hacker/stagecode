<html>

<head>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <style>
    @import url(https://fonts.googleapis.com/css?family=Roboto);

    body {
      font-family: Roboto, sans-serif;
    }

    #chart123 {
      min-height: 249.7px;
      margin: 80px;
    }
  </style>
</head>

<body>
  <form>
    @csrf
    <div id="chart123"></div>
  </form>
  <script>
    var series = [23, 44, 3, 21, 3, 1, 2]
      let labels = [
        'Team A',
        'Team B',
        'Team C',
        'Team D',
        'Team E',
        'Team F',
        'Team G'
      ]
      let newSeries = []
      let newLabels = []
      let grouped = 0
      series.forEach((s, i) => {
        if (s < 10) {
          grouped += s
        }
        if (s >= 10) {
          newSeries.push(s)
          newLabels.push(labels[i])
        }
      })
      if (grouped > 0) {
        newSeries.push(grouped)
        newLabels.push('Others')
      }
      var options = {
        series: newSeries,
        chart: {
          width: 380,
          type: 'pie'
        },
        colors: ['#008FFB', '#00E396', '#FEB019', '#ccc'],
        labels: newLabels
      }
      var chart = new ApexCharts(document.querySelector('#chart123'), options)
      chart.render()
  </script>
</body>

</html>