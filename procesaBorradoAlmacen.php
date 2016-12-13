<?php session_start();
include ("seguridad.php"); ?>
<!DOCTYPE html>
  <meta charset="utf-8">
  	<body>
		<?php
        	$nombreBorrar = $_POST['aBorra'];
        	include("conex.php");
		    $link = Conectarse();
		    $query = "delete from carga where NombreProyecto = '$nombreBorrar';";
		    mysqli_query($link,$query);

		    $query = "drop table $nombreBorrar";
		    mysqli_query($link,$query);

		    mysqli_close($link);

		    echo "<script language=Javascript> location.href=\"verExcel.php\"; </script>";
		?>

	</body>

</html>