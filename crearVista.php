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
      echo "<h3>Crear Vista</h3>";
      $user = $_SESSION['name'];
      include("conex.php");
      $link = Conectarse();
      $query = "select * from carga where nombre_Usuario = '$user';";
      $sql = mysqli_query($link,$query);
      if(mysqli_num_rows($sql) == 0 ){
        echo "<label class='control-label'><Font color='red'>No existen Almacenes</Font></label>";
      }else{
        echo"<form class='form-horizontal well' name='cVista' id='cVista' method='POST' action='crearVista.php'  enctype='multipart/form-data'>";
           echo "<table class='table table-striped'>";
            echo "<tbody>";
              echo "<tr>";
                echo "<td><h5 align='center'>Seleccione almacen: </h5></td>";
                echo "<td>";
                  echo"<select class='form-control' name='aSeleccionar' id='aBorra'>";
                        while ($row = mysqli_fetch_array($sql)) {
                          echo "<option>$row[0]</option>"; 
                        }
                  echo"</select>";
                echo "</td>";
                echo "<td>";
                  echo "<button type='submit' name='bnt-crearVista' class='btn btn-primary' >Seleccionar</button>";
                echo "</td>";
              echo "</tr>";
            echo "</tbody>";
           echo "</table>";
       
        echo "</form>";

        if(isset($_POST['bnt-crearVista'])){
          echo"<h4>Detalle de vista</h4>";
          $nAlmacen = $_POST['aSeleccionar'];
          $query = "show full columns from $nAlmacen;";
          $sql = mysqli_query($link,$query);

          echo"<form class='form-horizontal well' name='det1Vista' id='det1Vista' method='POST' action='crearVistaFields.php?almacen=$nAlmacen'  enctype='multipart/form-data'>";
           echo "<table class='table table-striped'>";
            echo "<thead>";
              echo "<tr>";
                echo "<th>Atributo</th>";
                echo "<th>Tipo</th>";
                echo "<th>Dimension</th>";
                echo "<th>Seleccionar</th>";
              echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
              while ($row = mysqli_fetch_array($sql)) {
                $atributoVista = $row[0];
                echo "<tr> <td>".$row[0]."</td> <td>".$row[1]."</td> <td>".$row[8]."</td>
                      <td><input class='messageCheckbox' type='checkbox' name='check_list[]' value='$atributoVista'></td></tr>"; 
              }
              echo "<tr><td></td><td></td><td></td><td><button type='button' onclick='validaCheck()' name='bnt-crearV' class='btn btn-primary'>Continuar</button></td></tr>";
            echo "</tbody>";
           echo "</table>";
       
          echo "</form>";
        }

      }
        mysqli_free_result($sql);
        mysqli_close($link);
    ?>
    
    
  </div>

  <script type="text/javascript">
    function validaCheck(){
      var x = document.forms["det1Vista"];
      var inputElements = document.getElementsByClassName('messageCheckbox');
      var acum = 0;
      for(var i=0; inputElements[i]; ++i){
            if(inputElements[i].checked){
                 acum++;
            }
      }
      if (acum != 0) {
            x.submit();
      } else{
        alert("Debe seleccionar un atributo");
      }
    }

  </script>


</body>
</html>