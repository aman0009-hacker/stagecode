<script>
    window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer", {
        axisY :{
    
            suffix: "mn"
        },
        toolTip: {
            shared: "true"
        },
        legend:{
            cursor:"pointer",
            itemclick : toggleDataSeries
        },
        data: [{
            type: "spline",
            visible: false,
            showInLegend: true,
            yValueFormatString: "##.00mn",
            name: "Season 1",
            dataPoints: [
                { label: "Ep. 1", y: 2.22 },
                { label: "Ep. 2", y: 2.20 },
                { label: "Ep. 3", y: 2.44 },
                { label: "Ep. 4", y: 2.45 },
                { label: "Ep. 5", y: 2.58 },
                { label: "Ep. 6", y: 2.44 },
                { label: "Ep. 7", y: 2.40 },
                { label: "Ep. 8", y: 2.72 },
                { label: "Ep. 9", y: 2.66 },
                { label: "Ep. 10", y: 3.04 }
            ]
        },
        {
            type: "spline", 
            showInLegend: true,
            visible: false,
            yValueFormatString: "##.00mn",
            name: "Season 2",
            dataPoints: [
                { label: "Ep. 1", y: 3.86 },
                { label: "Ep. 2", y: 3.76 },
                { label: "Ep. 3", y: 3.77 },
                { label: "Ep. 4", y: 3.65 },
                { label: "Ep. 5", y: 3.90 },
                { label: "Ep. 6", y: 3.88 },
                { label: "Ep. 7", y: 3.69 },
                { label: "Ep. 8", y: 3.86 },
                { label: "Ep. 9", y: 3.38 },
                { label: "Ep. 10", y: 4.20 }
            ]
        },
        {
            type: "spline",
            visible: false,
            showInLegend: true,
            yValueFormatString: "##.00mn",
            name: "Season 3",
            dataPoints: [
                { label: "Ep. 1", y: 4.37 },
                { label: "Ep. 2", y: 4.27 },
                { label: "Ep. 3", y: 4.72 },
                { label: "Ep. 4", y: 4.87 },
                { label: "Ep. 5", y: 5.35 },
                { label: "Ep. 6", y: 5.50 },
                { label: "Ep. 7", y: 4.84 },
                { label: "Ep. 8", y: 4.13 },
                { label: "Ep. 9", y: 5.22 },
                { label: "Ep. 10", y: 5.39 }
            ]
        },
        {
            type: "spline",
              visible: false,
            showInLegend: true,
            yValueFormatString: "##.00mn",
            name: "Season 4",
            dataPoints: [
                { label: "Ep. 1", y: 6.64 },
                { label: "Ep. 2", y: 6.31 },
                { label: "Ep. 3", y: 6.59 },
                { label: "Ep. 4", y: 6.95 },
                { label: "Ep. 5", y: 7.16 },
                { label: "Ep. 6", y: 6.40 },
                { label: "Ep. 7", y: 7.20 },
                { label: "Ep. 8", y: 7.17 },
                { label: "Ep. 9", y: 6.95 },
                { label: "Ep. 10", y: 7.09 }
            ]
        },
        {
            type: "spline", 
            showInLegend: true,
            yValueFormatString: "##.00mn",
            name: "Season 5",
            dataPoints: [
                { label: "Ep. 1", y: 8 },
                { label: "Ep. 2", y: 6.81 },
                { label: "Ep. 3", y: 6.71 },
                { label: "Ep. 4", y: 6.82 },
                { label: "Ep. 5", y: 6.56 },
                { label: "Ep. 6", y: 6.24 },
                { label: "Ep. 7", y: 5.40 },
                { label: "Ep. 8", y: 7.01 },
                { label: "Ep. 9", y: 7.14 },
                { label: "Ep. 10", y: 8.11 }
            ]
        },
        {
            type: "spline", 
            showInLegend: true,
            yValueFormatString: "##.00mn",
            name: "Season 6",
            dataPoints: [
                { label: "Ep. 1", y: 7.94 },
                { label: "Ep. 2", y: 7.29 },
                { label: "Ep. 3", y: 7.28 },
                { label: "Ep. 4", y: 7.82 },
                { label: "Ep. 5", y: 7.89 },
                { label: "Ep. 6", y: 6.71 },
                { label: "Ep. 7", y: 7.80 },
                { label: "Ep. 8", y: 7.60 },
                { label: "Ep. 9", y: 7.66 },
                { label: "Ep. 10", y: 8.89 }
            ]
        },
        {
            type: "spline", 
            showInLegend: true,
            yValueFormatString: "##.00mn",
            name: "Season 7",
            dataPoints: [
                { label: "Ep. 1", y: 10.11 },
                { label: "Ep. 2", y: 9.27 },
                { label: "Ep. 3", y: 9.25 },
                { label: "Ep. 4", y: 10.17 },
                { label: "Ep. 5", y: 10.72 },
                { label: "Ep. 6", y: 10.24 },
                { label: "Ep. 7", y: 12.07 }
            ]
        },
              {
            type: "spline", 
            showInLegend: true,
            yValueFormatString: "##.00mn",
            name: "Season 8",
            dataPoints: [
                { label: "Ep. 1", y: 11.76 },
                { label: "Ep. 2", y: 10.29 },
                { label: "Ep. 3", y: 12.02 },
                { label: "Ep. 4", y: 11.80 },
                { label: "Ep. 5", y: 12.48 },
                { label: "Ep. 6", y: 13.61 }
            ]
        }]
    });
    chart.render();
    function toggleDataSeries(e) {
        if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible ){
            e.dataSeries.visible = false;
        } else {
            e.dataSeries.visible = true;
        }
        chart.render();
    }
    var chart = new CanvasJS.Chart("chartsaleContainer", {
        axisY :{
    
            suffix: "mn"
        },
        toolTip: {
            shared: "true"
        },
        legend:{
            cursor:"pointer",
            itemclick : toggleDataSeries
        },
        data: [{
            type: "spline",
            visible: false,
            showInLegend: true,
            yValueFormatString: "##.00mn",
            name: "Season 1",
            dataPoints: [
                { label: "Ep. 1", y: 2.22 },
                { label: "Ep. 2", y: 2.20 },
                { label: "Ep. 3", y: 2.44 },
                { label: "Ep. 4", y: 2.45 },
                { label: "Ep. 5", y: 2.58 },
                { label: "Ep. 6", y: 2.44 },
                { label: "Ep. 7", y: 2.40 },
                { label: "Ep. 8", y: 2.72 },
                { label: "Ep. 9", y: 2.66 },
                { label: "Ep. 10", y: 3.04 }
            ]
        },
        {
            type: "spline", 
            showInLegend: true,
            visible: false,
            yValueFormatString: "##.00mn",
            name: "Season 2",
            dataPoints: [
                { label: "Ep. 1", y: 3.86 },
                { label: "Ep. 2", y: 3.76 },
                { label: "Ep. 3", y: 3.77 },
                { label: "Ep. 4", y: 3.65 },
                { label: "Ep. 5", y: 3.90 },
                { label: "Ep. 6", y: 3.88 },
                { label: "Ep. 7", y: 3.69 },
                { label: "Ep. 8", y: 3.86 },
                { label: "Ep. 9", y: 3.38 },
                { label: "Ep. 10", y: 4.20 }
            ]
        },
        {
            type: "spline",
            visible: false,
            showInLegend: true,
            yValueFormatString: "##.00mn",
            name: "Season 3",
            dataPoints: [
                { label: "Ep. 1", y: 4.37 },
                { label: "Ep. 2", y: 4.27 },
                { label: "Ep. 3", y: 4.72 },
                { label: "Ep. 4", y: 4.87 },
                { label: "Ep. 5", y: 5.35 },
                { label: "Ep. 6", y: 5.50 },
                { label: "Ep. 7", y: 4.84 },
                { label: "Ep. 8", y: 4.13 },
                { label: "Ep. 9", y: 5.22 },
                { label: "Ep. 10", y: 5.39 }
            ]
        },
        {
            type: "spline",
              visible: false,
            showInLegend: true,
            yValueFormatString: "##.00mn",
            name: "Season 4",
            dataPoints: [
                { label: "Ep. 1", y: 6.64 },
                { label: "Ep. 2", y: 6.31 },
                { label: "Ep. 3", y: 6.59 },
                { label: "Ep. 4", y: 6.95 },
                { label: "Ep. 5", y: 7.16 },
                { label: "Ep. 6", y: 6.40 },
                { label: "Ep. 7", y: 7.20 },
                { label: "Ep. 8", y: 7.17 },
                { label: "Ep. 9", y: 6.95 },
                { label: "Ep. 10", y: 7.09 }
            ]
        },
        {
            type: "spline", 
            showInLegend: true,
            yValueFormatString: "##.00mn",
            name: "Season 5",
            dataPoints: [
                { label: "Ep. 1", y: 8 },
                { label: "Ep. 2", y: 6.81 },
                { label: "Ep. 3", y: 6.71 },
                { label: "Ep. 4", y: 6.82 },
                { label: "Ep. 5", y: 6.56 },
                { label: "Ep. 6", y: 6.24 },
                { label: "Ep. 7", y: 5.40 },
                { label: "Ep. 8", y: 7.01 },
                { label: "Ep. 9", y: 7.14 },
                { label: "Ep. 10", y: 8.11 }
            ]
        },
        {
            type: "spline", 
            showInLegend: true,
            yValueFormatString: "##.00mn",
            name: "Season 6",
            dataPoints: [
                { label: "Ep. 1", y: 7.94 },
                { label: "Ep. 2", y: 7.29 },
                { label: "Ep. 3", y: 7.28 },
                { label: "Ep. 4", y: 7.82 },
                { label: "Ep. 5", y: 7.89 },
                { label: "Ep. 6", y: 6.71 },
                { label: "Ep. 7", y: 7.80 },
                { label: "Ep. 8", y: 7.60 },
                { label: "Ep. 9", y: 7.66 },
                { label: "Ep. 10", y: 8.89 }
            ]
        },
        {
            type: "spline", 
            showInLegend: true,
            yValueFormatString: "##.00mn",
            name: "Season 7",
            dataPoints: [
                { label: "Ep. 1", y: 10.11 },
                { label: "Ep. 2", y: 9.27 },
                { label: "Ep. 3", y: 9.25 },
                { label: "Ep. 4", y: 10.17 },
                { label: "Ep. 5", y: 10.72 },
                { label: "Ep. 6", y: 10.24 },
                { label: "Ep. 7", y: 12.07 }
            ]
        },
              {
            type: "spline", 
            showInLegend: true,
            yValueFormatString: "##.00mn",
            name: "Season 8",
            dataPoints: [
                { label: "Ep. 1", y: 11.76 },
                { label: "Ep. 2", y: 10.29 },
                { label: "Ep. 3", y: 12.02 },
                { label: "Ep. 4", y: 11.80 },
                { label: "Ep. 5", y: 12.48 },
                { label: "Ep. 6", y: 13.61 }
            ]
        }]
    });
    chart.render();
    
    function toggleDataSeries(e) {
        if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible ){
            e.dataSeries.visible = false;
        } else {
            e.dataSeries.visible = true;
        }
        chart.render();
    }
    var data = [
        {
            "originator": "Punjab",
            "balance": 38.6,
            "fake" : 400.21
        },
        {
            "originator": "Madhya Pardesh",
            "balance": 22.5,
            "fake" : 322.99
        },
        {
            "originator": "Maharasthra",
            "balance": 30.8,
             "fake" : 642
        },
        {
            "originator": "others",
            "balance": 8.1,
            "fake" : 200
        }
    ];
    function type (d) {
                d.balance = +d.balance;
                return d;
    }
    
    function swapRealData (data) {
    
                for (i = 0; i < data.length; i++) {
                    data[i].fake = data[i].balance;
                }
    
                return data;
    }
    data = data.slice(0, 9);
                var width = 450,
                    height = 300,
                    radius = Math.min(width, height) / 2,
                    that = this,
                    w = 200,
                    h = 50,
                    colorObj = [];
                var color = d3.scale.category20();
                var arc = d3.svg.arc().outerRadius(radius - 10).innerRadius(radius - 70);
                var pie = d3.layout.pie().sort(d3.descending).value(function (d) {
                    return d.fake;
                });
                var svg = d3.select("body").select(".viz-portfolio-total-value").append("svg").attr("width", width).attr("height", height).append("g").attr("transform", "translate(" + 150 + "," + height / 2 + ")");
                var g = svg.selectAll(".arc").data(pie(data)).enter().append("g").attr("class", "arc");
                g.append("path").attr("d", arc).style("fill", function (d) {
                    return color(d.data.originator);
                }).each(function (d) {
                    this._current = d;
                }); // store the initial values;
                var legend = svg.append("g").attr("class", "legend").attr("height", 100).attr("width", 180).attr('transform', 'translate(25,-100)');
                var legendRect = legend.selectAll('rect').data(data);
                legendRect.enter().append("rect").attr("x", w - 65).attr("width", 10).attr("height", 10);
                legendRect.attr("y", function (d, i) {
                    return i * 20;
                }).style("fill", function (d) {
                    return color(d.originator);
                });
                var legendText = legend.selectAll('text').data(data);
                legendText.enter().append("text").attr("x", w - 52);
                legendText.attr("y", function (d, i) {
    
                    return i * 20 + 9;
    
                }).text(function (d) {
    
                    var formatted_name;
    
                    formatted_name = d.originator;
    
                    return formatted_name + '.  ' + ' - $' + d.balance;
                });
                window.setTimeout(redrawChart, 500);
                function arcTween(a) {
                    var i = d3.interpolate(this._current, a);
                    this._current = i(0);
                    return function (t) {
                        return arc(i(t));
                    };
                }
                function redrawChart() {
                    //Convert "fake" value to real value then animate updated chart 
                    that.swapRealData(data);
                    svg.selectAll("path").data(pie(data)).transition().duration(2000).attrTween("d", arcTween);
                    svg.selectAll(".arc").data(pie(data));
                    //Delay 
                    window.setTimeout(function () {
                        g.append("text").attr("transform", function (d) {
                            return "translate(" + arc.centroid(d) + ")";
                    });
                    }, 1800);
                }
    }
    let a=document.getElementById('user_name').innerHTML;
    
    let userName=a.charAt(0).toUpperCase()+a.slice(1);
    
    $('#user_name').html(userName);
    
      </script>
      <!-- jQuery -->
      <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
      <!-- jQuery UI 1.11.4 -->
      <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
      <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
      <script>
        $.widget.bridge('uibutton', $.ui.button)
      </script>
      <!-- Bootstrap 4 -->
      <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
      <!-- ChartJS -->
      <script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
      <!-- JQVMap -->
      <script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
      <script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
      <script src="{{asset('dist/js/adminlte.js')}}"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="{{asset('dist/js/demo.js')}}"></script>
      <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
      <script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
      <!--  For Charts -->
      <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
      <script src="cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script src="https://d3js.org/d3.v3.min.js"></script>