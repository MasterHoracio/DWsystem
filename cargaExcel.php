<?php 
	if(isset($_POST['btn-carga'])){
		$nombreAchivo = $_FILES['file']['name'];
		$locArchivo = $_FILES['file']['tmp_name'];
		$tamArchivo = $_FILES['file']['size'];
		$tipoArchivo = $_FILES['file']['type'];

		$carpeta = "excel/";

		if($tipoArchivo != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){
			echo "<script> alert (\"Archivo no valido\"); </script>";
			echo "<script language=Javascript> location.href=\"subirbd.php\"; </script>";
		}else{
 			move_uploaded_file($locArchivo,$carpeta.$nombreAchivo);
 			echo "<script language=Javascript> location.href=\"confirmExcel.php?archivo=$nombreAchivo\"; </script>";//lo pasamos a verificar los datos
		}

	}
?>