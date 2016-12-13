<?php session_start();
include ("seguridad.php"); ?>
<!DOCTYPE html>
  <meta charset="utf-8">
  	<body>
		<?php
        	$nombreBorrar = $_POST['aBorra'];
        	include("conex.php");
		    $link = Conectarse();
		    $id=$_SESSION['nombre_usuario'] ;

		    $query = "delete from genera where NombreVista = '$nombreBorrar' and nombre_usuario='$id' ;";
		    mysqli_query($link,$query);

		    $query = "drop view $nombreBorrar";
		    mysqli_query($link,$query);

		    mysqli_close($link);
			echo "<script> alert (\"Borrado exitoso\"); </script>";
		    echo "<script language=Javascript> location.href=\"borrarvista.php\"; </script>";
		?>

	</body>

</html>