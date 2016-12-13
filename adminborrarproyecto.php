
<?php 
     include("conex.php");
     $link=Conectarse(); 
     $user=$_GET["user"];
     $fecha=$_GET["fecha"];
     $proy=$_GET["proyecto"];

                        $sql = "delete from carga  WHERE  NombreProyecto='$proy' and nombre_usuario='$user' and Fecha='$fecha';";
                        

      if (mysqli_query($link, $sql)) {
      	            // $sql = "delete from genera  WHERE  NombreProyecto='$proy' and nombre_usuario='$user' and Fecha='$fecha';";
                    //mysqli_query($link, $sql);
    
    echo "<script> alert (\"Se ha Borrado Correctamente el proyecto \"); </script>";
    echo "<script > location.href=\"adminusuarios.php\"; </script>"; //funciona en local y en el host    


} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
    echo "<script> alert (\"Hubo un error " . $sql . " \"); </script>";
    echo "<script > location.href=\"admindwsystem.php\"; </script>"; //funciona en local y en el host    
}


?> 