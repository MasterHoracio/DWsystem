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
        $numeroV = mysqli_num_rows($sql);
        echo"<h3>Numero de vistas <small>($numeroV)</small></h3>";
        echo"<form class='form-horizontal well' name='mostrarVista' method='POST' action='mostrarVista.php'  enctype='multipart/form-data'>";

        echo "<table class='table table-striped'>
              <thead>
                <tr>
                  <th>Nombre de vista</th>
                  <th>Fecha</th>
                  <th>seleccionar</th>
                </tr>
              </thead>
              <tbody>";
              while ($row = mysqli_fetch_array($sql)) {
                echo "<tr><td>".$row[0]."</td><td>".$row[2]."</td><td><input type='radio' name='optVista' checked='checked' value='$row[0]'></td></tr> \n"; 
              }
              echo "<tr> <td></td> <td></td> 
              <td>
                    <button type='submit' name='btn-mostrarVista' class='btn btn-primary'>Mostrar</button>
              </td> </tr>";
              echo "</form>";

        echo "</tbody>
              </table>";
      }
        mysqli_free_result($sql);
        mysqli_close($link);

    ?>
    
    
  </div>


</body>
</html>