<?php session_start();
include ("seguridad.php"); ?> 
<!DOCTYPE html>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="scrips/jquery.min.js">
  <link rel="stylesheet" type="text/css" href="scrips/bootstrap.js">
  <script src="scrips/jquery.min.js"></script>
  <script src="scrips/bootstrap.min.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
  <link rel="shortcut icon" href="img/icono.ico"/>  
<head>
  <title>DWsystem</title>
</head>
  <style type="text/css">
  
  </style>
<body >
  <?php include('menu.php');?>
    
  <div class="container well" id="container" style="min-width: 310px; height: 400px; margin: 0 auto">
   
                <?php
              /*Conexion a la bd*/
              $user=$_SESSION['name'];
              include("conex.php");
              $link=Conectarse();
              $vista=  $_GET['vista'];
              $y=  $_GET['y'];
              $x=  $_GET['x'];
               
              
              
              $sql = mysqli_query($link,"select $x,$y  from $vista ;");
echo "select $x,$y  from $vista ;";
              ?>
    
<TABLE  id='datatable' class='table table-striped' >
    
    <thead>
        <tr>
            
            <th><?php echo $x?></th>
            <th><?php echo $y?></th>
        </tr>
    </thead>

    <tbody>
    <?PHP
//where id_act='$id'
   while($row = mysqli_fetch_array($sql)) {
    echo "<tr>";
    echo "<td>" . $row[0] . "</td>";
    echo "<td>" . $row[1] . "</td>";
    echo "</tr>";
}
   ?>  
   </tbody>
   </Table>
  </div>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>    
<script type="text/javascript">
  $(function () {
    Highcharts.chart('container', {
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'line'
        },
        title: {
            text: '<?php echo $vista;?>'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: ' <?php echo $y;?> '
            }
        },
        xAxis: {
            allowDecimals: false,
            title: {
               text: ' <?php echo $x;?> '
            }
        },
          legend: {
            enabled: false
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' ' + this.point.name.toLowerCase();
            }
        }
    });
});


</script>


</body>
</html>

