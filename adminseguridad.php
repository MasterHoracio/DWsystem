<?php 
if ($_SESSION['nombre_usuario']!="admin") {
            
            echo "<script> alert (\"Acceso Denegado\"); </script>";
        echo "<script language=Javascript> location.href=\"index.php\"; </script>";
        }
        ?>