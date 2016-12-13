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
      $user = $_SESSION['name'];
      include("conex.php");
      $link = Conectarse();
      $query = "select * from genera where nombre_Usuario = '$user';";
      $sql = mysqli_query($link,$query);
      if(mysqli_num_rows($sql) == 0 ){
        echo "<label class='control-label'><Font color='red'>No existen Vistas</Font></label>";
      }else{
        $numeroalmacenes = mysqli_num_rows($sql);
        echo"<h3>Numero de Vistas <small>($numeroalmacenes)</small></h3>";
        echo"<form class='form-horizontal well' name='bAlmacen' id='bAlmacen' method='POST' action='borarvistare.php'  enctype='multipart/form-data'>";
           echo "<table class='table table-striped'>";
            echo "<tbody>";
              echo "<tr>";
                echo "<td><h5 align='center'>Seleccione Vista: </h5></td>";
                echo "<td>";
                  echo"<select class='form-control' name='aBorra' id='aBorra'>";
                        while ($row = mysqli_fetch_array($sql)) {
                          echo "<option>$row[0]</option>"; 
                        }
                  echo"</select>";
                echo "</td>";
                echo "<td>";
                  echo "<button type='button' name='btn-borrarAlmacen' onclick='confirmBorrado()' class='btn btn-primary' >Borrar</button>";
                echo "</td>";
              echo "</tr>";
            echo "</tbody>";
           echo "</table>";
       
        echo "</form>";

      }
        mysqli_free_result($sql);
        mysqli_close($link);
    ?>
    
    
  </div>
  <script type="text/javascript">
    function confirmBorrado() {
      var form = document.getElementById("bAlmacen");
      var select = document.getElementById("aBorra");
      var r = confirm("¿Desea borrar la vista " + select.value + "?");
        if (r == true) {
            form.submit();
        } 
    }
  </script>

</body>
</html>