<!DOCTYPE html>
<html>

<head>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins');

    * {
      font-family: 'Poppins', sans-serif;
    }

    #chart {
      width: 100%;
      margin: 0 auto;
      opacity: 0.9;
    }

    .apexcharts-toolbar {
      opacity: 1;
      border: 0;
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
    $(function() {
      $.ajax({
        url: '/chartApproveStatus',
        type: 'POST',
        dataType: 'JSON',
        success: function(response) {
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
                width: '100%',
                type: 'pie',
                toolbar: {
                  show: true
                }
              },
              labels: ['Approved', 'New', 'Rejected'],
              legend: {
                position: 'bottom'
              },
              responsive: [{
                breakpoint: 480,
                options: {
                  chart: {
                    width: '100%'
                  },
                  legend: {
                    position: 'bottom'
                  }
                }
              }]
            };
            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
          }
        }
      })
    });
  </script>
</body>

</html>