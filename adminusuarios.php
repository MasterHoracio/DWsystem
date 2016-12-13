<?php session_start();
  include ("seguridad.php"); 
 include ("adminseguridad.php"); ?> 
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
  <?php include('adminmenu.php');?>
    
  <div class="container well">
    <?php 
      $user = $_SESSION['name'];
      include("conex.php");
      $link = Conectarse();
      $query = "select * from usuario where nombre_Usuario <> 'admin';";
      $sql = mysqli_query($link,$query);
      if(mysqli_num_rows($sql) == 0 ){
        echo "<label class='control-label'><Font color='red'>No hay usuarios registrados</Font></label>";
      }else{
        $numeroalmacenes = mysqli_num_rows($sql);
        echo"<h3>Cantidad de usuarios <small>($numeroalmacenes)</small></h3>";
        ?>
        <form class="form-horizontal well" name="eform" onsubmit="return borrarForm()" method="POST" action="adminborraruser.php" >    
<?php
        echo "<table class='table table-striped'>
              <thead>
                <tr>
                  <th>Usuario</th>
                  <th>Correo</th>
                  <th>Password</th>
                  <th>Seleccione</th>
                  <th>Ver</th>
                </tr>
              </thead>
              <tbody>";
               while($row = mysqli_fetch_array($sql)) {
    
    echo "<td>" . $row['nombre_usuario'] . "</td>";

    echo "<td>" . $row['correo'] . "</td>";
    echo "<td>" . $row['password'] . "</td>";
    echo "<td><input type='radio' name='id' checked='checked' value='$row[0]'></td> \n"; 

    ?>
    <td align='right' colspan='2'><a href="adminverproyectos.php?user=<?php echo $row['nombre_usuario']?> " class="btn btn-info btn-block">Proyecto(s)</a></td>
    <?php
    echo "</tr>";
    }
              
            echo "<tr> <td></td> <td></td> <td></td>
              <td>
                    <button type='submit' name='btn-mostrarAlmacen' class='btn btn-primary'>Borrar</button>
              </td> </tr>";
              echo "</form>";

        echo "</tbody>
              </table>";
      }
        mysqli_free_result($sql);
        mysqli_close($link);

    ?>
    
    </form>
  </div>

    <script>
function borrarForm() {
      var x = document.forms["eform"]["id"].value;

     if (confirm("Seguro que deseas Borrar ?")  ) { }
      else {
    alert("Cancelado")
      return false;
        } 
      
}
</script>

</body>
</html>