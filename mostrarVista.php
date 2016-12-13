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
    
  <div class="container well">
    <?php 
      if(isset($_POST['btn-mostrarVista'])){
        if(isset($_POST['optVista'])){
          $value = $_POST['optVista'];
          include("conex.php");
          $link = Conectarse();
          $query = "select * from $value;";
          $queryHead = "desc $value;";
          $queryCol = "SELECT count(*) FROM information_schema.columns WHERE table_name = '$value'";
          $sql3 = mysqli_query($link,$queryCol);
          $sql2 = mysqli_query($link,$queryHead);
          $sql = mysqli_query($link,$query);

          $row = mysqli_fetch_array($sql3);
          $colu = $row[0];

          echo "<h3>Nombre de la vista: <small>$value</small></h3>";
          echo"<form class='form-horizontal well' name='mostrarVista' method='POST' action='verVista.php'  enctype='multipart/form-data'>";

          echo "<table class='table table-striped'>
                <thead>
                  <tr>";
                    while ($row = mysqli_fetch_array($sql2)) {
                      echo "<td>".$row[0]."</td>";
                    }
          echo "
                  </tr>
                </thead>
                <tbody>";
                  
                  while ($row = mysqli_fetch_array($sql)) {
                    echo" <tr>";
                      for($i = 0; $i < $colu; $i++){
                        echo "<td>".$row[$i]."</td>";
                      }
                    echo" </tr>";
                  }

                  echo"<tr>";
                    for($index = 1; $index <= $colu; $index++){
                      if($index + 1 <= $colu){
                        echo "<td></td>";
                      }else{
                        echo "<td><button type='button' name='btn-mostrarAlmacen' onclick='history.go(-1);'' class='btn btn-primary'>Regresar</button></td>";
                      }
                    }
                  echo "</tr>";
                  
                echo "</form>";

          echo "</tbody>
                </table>";
          mysqli_free_result($sql);
          mysqli_free_result($sql2);
          mysqli_free_result($sql3);
          mysqli_close($link);
        }
      }

    ?>
    
    
  </div>


</body>
</html>