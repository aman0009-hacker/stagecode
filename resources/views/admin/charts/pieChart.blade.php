<html>
  <head>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.28.0/dist/apexcharts.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.28.0/dist/extensions/apexcharts.min.js"></script> --}}
  <style>
    @import url(https://fonts.googleapis.com/css?family=Roboto);



body {
  font-family: Roboto, sans-serif;
}

#chart123 {
    min-height: 249.7px;
    margin: 80px;
    margin-top: 50px!important;
}
#chart123 .apexcharts-canvas .apexcharts-svg
{
    margin: auto !important;
    display: block !important;
}
#chart123 .apexcharts-canvas {

    width: 550px!important;
}
#chart123 .apexcharts-toolbar {
    top: -60px!important;
    margin-right: -45px!important;

}


  </style>
  </head>


  <body>
    <!--Div that will hold the pie chart-->
    {{-- <div id="chart_div"></div> --}}
    <form>
        @csrf
        <div id="chart123"></div>
    </form>


    <script>
                $(function() {
            $.ajax({
                url: '/totalOrdersCount',
                type: 'GET',
                dataType: 'JSON',
                success: function(response)
                {
                    const month= response.data.month;
                    const numberOf=  response.data.numberOf;

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
    });
});
    </script>
  </body>
</html>
