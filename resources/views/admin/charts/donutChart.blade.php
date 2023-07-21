<html>

<head>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <style>
    @import url(https://fonts.googleapis.com/css?family=Roboto);

    body {
      font-family: Roboto, sans-serif;
    }

    .box-body {
      display: block;
      height: 454px;
    }

    #chart {
      margin: 0 auto;
    }
  </style>
</head>

<body>
  <form>
    @csrf
    <div id="chart56" style="margin:61px;"></div>
  </form>
  <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function () {
  $.ajax({
      url:'/chartApproveStatus',
      type:'POST',
      dataType:'JSON',
      success:function(response)
      {
       var options = {
  chart: {
    width: 450,
    height: 420,
    type: "donut"
  },
  colors: ["#1ab7ea", "#0084ff", "#39539E", "#0077B5"],
  dataLabels: {
     enabled: false
  },
  series: [response.data[0],response.data[1],response.data[2]],
  labels: ['Approved', 'New', 'Rejected'],
  tooltip: {
    enabled: true,
    y: {
      formatter: function(val) {
        return val + ".00" + " Rs"
      },
      title: {
        formatter: function (seriesName) {
          return ''
        }
      }
    }
  },
  legend: {
    show: false
  },
  tooltip: {
    shared: false,
    intersect: true,
    x: {
      show: false
    }
  },
  legend: {
    horizontalAlign: "left",
    offsetX: -12
  }
};
var chart = new ApexCharts(document.querySelector("#chart56"), options);
chart.render();
      }
    });
});
  </script>
</body>

</html>