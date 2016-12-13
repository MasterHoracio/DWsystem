<?php
session_start(); 
session_destroy(); 
//unset($_SESSION);   //NO USAR unset($_SESSION) ya que esto deshabilita el registro de las variables a través del array superglobal


  echo "<script> alert (\"Gracias por tu acceso\"); </script>"; //
  echo "<script language=Javascript> location.href=\"index.php\"; </script>"; //redirecciono funciona tanto en local como en el host
  ?>
