<?php
//vemos si el usuario y contraseña es váildo 
    session_start();

	$id = $_POST['id'];
    $clave = $_POST['pass'];
    $_SESSION['name'] = $id;
    include("conex.php");
    $link = Conectarse();
    $sql = mysqli_query($link,"select correo,nombre_usuario from usuario where (nombre_usuario ='$id'  and password = '$clave') ;"); 

    if(mysqli_num_rows($sql) == 0 ){
        echo "<script> alert (\"contraseña o usuario incorrectos\"); </script>"; 
        echo "<script language=Javascript> location.href=\"index.php?errorusuario=1\"; </script>"; //funciona en local y en el host
     }
// else{
    while ($row = mysqli_fetch_array($sql)) {
        //usuario y contraseña válidos 
        //defino una sesion y guardo datos 

        $_SESSION['correo'] = $row[0];
        $_SESSION['nombre_usuario'] = $row[1];
            
            //si no existe le mando otra vez a la portada 
        if ($_SESSION['nombre_usuario']=="admin") {
            
            echo "<script > location.href=\"admindwsystem.php\"; </script>"; //funciona en local y en el host    
        }

        echo "<script > location.href=\"dwsystem.php\"; </script>"; //funciona en local y en el host    
    }//while
//}//else
    mysqli_free_result($result);
    mysqli_close($link);  //Cierra la conexión
?>


 
