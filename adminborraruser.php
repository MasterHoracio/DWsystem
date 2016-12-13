
<?php 
     include("conex.php");
     $link=Conectarse(); 
     $id=$_POST["id"];

                        $sql = "delete from carga  WHERE nombre_usuario ='$id' ;";
                        
                        $borrar=mysqli_query($link," select *from usuario  where nombre_usuario= '$id' ;"); 
      if (mysqli_query($link, $sql)) {
      	$sql = "delete from usuario  WHERE nombre_usuario ='$id' ;";
		mysqli_query($link, $sql);                 
        while($row = mysqli_fetch_array($sql)) {



      $to = $row['correo'];
      $subject = "Baja";
      $txt = "Tu contrase&ntilde;a es:".$row["pass"];
      $headers = "From: gibran_reyes@hotmail.es" . "\r\n" ."CC:";
      $message="Hola!!\t".$row['nombre_usuario']." ud ha sido dado de baja\t"
      "\nmensaje enviado desde el sistema DWsystem";
        mail($to,$subject,$message,$headers);

}







    echo "<script> alert (\"Se ha Borrado Correctamente el usuario:\  ". $nom."\"); </script>";
    echo "<script > location.href=\"adminusuarios.php\"; </script>"; //funciona en local y en el host    


} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
    echo "<script> alert (\"Hubo un error:\"); </script>";
    echo "<script > location.href=\"admindwsystem.php\"; </script>"; //funciona en local y en el host    
}


?> 