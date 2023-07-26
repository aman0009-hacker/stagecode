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
  margin: 35px auto;
  padding: 0 30px !important;
  opacity: 0.9;
}

#timeline-chart .apexcharts-toolbar {
  opacity: 1;
  border: 0;
}

.apexcharts-zoomin-icon, .apexcharts-zoomout-icon,.apexcharts-zoom-icon.apexcharts-selected, .apexcharts-reset-icon,.apexcharts-pan-icon {
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
      url:'/chartApproveStatus',
      type:'POST',
      dataType:'JSON',
      success:function(response)
      {


        var options = {
        chart: {
            height: 420,
            type: "line",
        },
        series: [
            {
            name: "Approved",
            type: "column",
            data: [response.data[0]]
            },
            {
            name: "New",
            type: "column",
            data: [response.data[1]]
            },
            {
            name: " Rejected",
            type: "column",
            data: [response.data[2]]
            }
        ],
        stroke: {
            width: [0, 4],
            curve: 'smooth',
            width:10,
            colors: ['transparent'],
        },
        title: {
            text: "Active User"
        },
        xaxis: {

        },
        yaxis: [
            {
      title: {
          text: ""
        }
    },
    {
        opposite: true,
        title: {
            text: ""
      }
    }
        ]
        }


    var chart = new ApexCharts(document.querySelector("#chart"), options);

    chart.render();
    }
})
    });
    </script>
  </body>
</html>
