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
    <div id="chart1"></div>
  </form>
  <script>
    $(function () {
  $.ajax({
      url:'/chartApproveStatus',
      type:'POST',
      dataType:'JSON',
      success:function(response)
      {
                var options = {
  chart: {
    height: 420,
    type: "bar",
    // stacked: false
  },
  dataLabels: {
    enabled: false
  },
  colors: ["#FF1654", "#247BA0","#247AA0"],
  series: [
    {
      name: "Approved",
      data: [response.data[0],0]
    },
    {
      name: "new",
      data: [response.data[1],0]
    },
    {
      name: "reject",
      data: [response.data[2],0]
    },
  ],
  stroke: {
    width: [6, 6],
    colors: ['transparent'],
  },
  plotOptions: {
    bar: {
      columnWidth: "20%"
    }
  },
  xaxis: {
    categories: []
  },
  yaxis: [
    {
      axisTicks: {
        show: true
      },
      axisBorder: {
        show: true,
        color: "#FF1654"
      },
      labels: {
        style: {
          colors: "#FF1654"
        }
      },
      title: {
        text: "Approved",
        style: {
          color: "#FF1654"
        }
      }
    },
    {
      opposite: true,
      axisTicks: {
        show: true
      },
      axisBorder: {
        show: true,
        color: "#247BA0"
      },
      labels: {
        style: {
          colors: "#247BA0"
        }
      },
      title: {
        text: "Series B",
        style: {
          color: "#247BA0"
        }
      }
    }
  ],
  tooltip: {
    shared: false,
    intersect: true,
    x: {
      show: false
    }
  },
  legend: {
    horizontalAlign: "left",
    offsetX: 40
  }
};
var chart = new ApexCharts(document.querySelector("#chart1"), options);
chart.render();
}
    });
});
  </script>
</body>

</html>