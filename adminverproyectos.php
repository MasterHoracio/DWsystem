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
  <?php include('adminmenu.php'); ?>

  
  <div class="container well">
    <?php 

    include("conex.php");
     $link=Conectarse(); 
    $user=  $_GET['user']; 
  $sql=mysqli_query($link,"select * from carga where nombre_Usuario = '$user';"); 
  $sup=mysqli_query($link," select count(*) from carga nombre_Usuario = '$user';");


  if(mysqli_num_rows($sql)==0 ){
echo "<script> alert (\"el usuario:".$user." no tiene proyecto(s)\"); </script>";//una puta alerta hahaha
echo "<script language=Javascript> history.go(-1); </script>";  //redirecciono funciona tanto en local como en el host
die();
} ?>   
<TABLE  class="table table-striped " >
    
    <h3>Almacenes de: <?php echo $user?> </h3>
    <TR>
      <TD >Nombre del Proyecto</TD>
      <TD>Fecha</font></TD>
      <TD>..</font></TD>
    </TR>
   
    <?PHP
    
   while($row = mysqli_fetch_array($sql)) {
    
      echo "<tr >";
    echo "<td>" . $row['NombreProyecto'] . "</td>";
    echo "<td>" . $row['Fecha'] . "</td>";
    ?>
    <td align='center' ><a href="adminborrarproyecto.php?user=<?php echo $row['nombre_usuario']?>&proyecto=<?php echo $row['NombreProyecto']?>&fecha=<?php echo $row['Fecha']?>" class="btn btn-info ">Borrar Proyecto</a></td>
    <?php
    echo "</tr>";
}
      ?>

   </Table>
<a href="adminusuarios.php " >Regresar   <span class='glyphicon glyphicon-circle-arrow-left'></a>                


    
  </div>


</body>
</html>