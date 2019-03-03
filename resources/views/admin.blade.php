@extends('layouts.app')

@section('content')
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var dataa = google.visualization.arrayToDataTable( <?php echo $pedidos ?>);
            var options = {
                title: 'Consumo mensal por categoria'
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(dataa, options);
        }


        google.charts.load('current', {'packages':['line']});
        google.charts.setOnLoadCallback(drawChart1);
        function drawChart1() {

            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Semana');
            data.addColumn('number', 'R$');
            data.addRows( <?php echo $semanas ?>);

            var options = {
                chart: {
                    title: 'Consumo semanal',
                    subtitle: 'R$'
                },
                width: 700,
                height: 400,
                axes: {
                    x: {
                        0: {side: 'top'}
                    }
                }
            };
            var chart = new google.charts.Line(document.getElementById('line_top_x'));
            chart.draw(data, google.charts.Line.convertOptions(options));
        }

    </script>
  </head>
  <body>
  <div class="col-md-8">
    <div class="col-md-16">
        <div id="piechart" style="width: 700px; height: 400px;"></div>
    </div>
    <div class="col-md-16">
        <div id="line_top_x"></div>
    </div>
  </div>
    
    
  </body>

@endsection