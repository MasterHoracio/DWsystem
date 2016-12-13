<?php session_start();
include ("seguridad.php"); ?>
<!DOCTYPE html>
  <meta charset="utf-8">
  	<body>
		<?php
			if ( $_GET ){
		        $Archivo = $_GET['archivo'];
		        $nombre = $_POST['nombreDW'];//nombre almacen
		        $user = $_SESSION['name'];
		        $fecha = date("Y-m-d");
		        date_default_timezone_set('America/Mexico_City');
			    include 'Classes/PHPExcel/IOFactory.php';
			    $nombreArchivo = "excel/".$Archivo;


			    try {
			        $tipoArchivo = PHPExcel_IOFactory::identify($nombreArchivo);
			        $lector = PHPExcel_IOFactory::createReader($tipoArchivo);
			        $PHPExcel = $lector->load($nombreArchivo);
			    } catch (Exception $e) {
			        die('Error al cargar archivo"' . pathinfo($nombreArchivo, PATHINFO_BASENAME) 
			        . '": ' . $e->getMessage());
			    }

			    //atributos de hoja excel
			    $hoja = $PHPExcel->getSheet(0);
			    $nRenglones = $hoja->getHighestRow();
			    $nColumnas = $hoja->getHighestColumn();

		 		$board = array($nRenglones + 1 ,array($nColumnas + 1));

		 		$tipodato = array($nColumnas + 1);

		        $n = $_GET['n'];
		        $select = array($n + 1);
		        //salva las dimensiones
		        for($i = 1; $i <= $n; $i++){
		        	$select[$i] = $_POST[$i];;
		        }

		        for ($renglon = 1; $renglon <= $nRenglones; $renglon++) {
			        $columnas = $hoja->rangeToArray('A' . $renglon . ':' . $nColumnas . $renglon, NULL, TRUE, FALSE);
			        foreach($columnas[0] as $columna=>$valor){
			        	$board[$renglon][($columna+1)] = $valor;
			        }
			        $aux = $columna;
			    }

			    $aux += 1;

			    include("conex.php");
    			$link = Conectarse();
			    $query1 = "insert into carga (NombreProyecto,nombre_usuario,Fecha) values('$nombre','$user','$fecha');";

			    if(!mysqli_query($link,$query1)){
			    	mysqli_close($link);
			    	echo "<script > location.href=\"javascript:history.back()\"; </script>";
			    	echo "<script> alert (\"El almacen ya existe\"); </script>";
			    }else{
			    	//$link = Conectarse();
			    	//nombre tipo
	    			$atributos = " ";

				    for($columna = 1; $columna <= $aux; $columna++){
				    		if($columna + 1 <= $aux){
					    		$string = $board[1][$columna];
					    		$atributos.= $string." ";
					    		$string = $board[2][$columna];

					    		if( ($string[0] == 'v' || $string[0] == 'V') && ($string[1] == 'a' || $string[1] == 'A') ){
					    			$tipodato[$columna] = 1;
					    		}else if( ($string[0] == 'd' || $string[0] == 'D') && ($string[1] == 'a' || $string[1] == 'A') ){
					    			$tipodato[$columna] = 1;
					    		}else if( ($string[0] == 'y' || $string[0] == 'Y') && ($string[1] == 'e' || $string[1] == 'E') ){
					    			$tipodato[$columna] = 1;
					    		}else{
					    			$tipodato[$columna] = 0;
					    		}

					    		$atributos.= $string." ";
					    		$string = $select[$columna];
					    		$atributos.= "comment "."'".$string."'"." , ";
				    		}else{
				    			$string = $board[1][$columna];
					    		$atributos.= $string." ";
					    		$string = $board[2][$columna];

					    		if( ($string[0] == 'v' || $string[0] == 'V') && ($string[1] == 'a' || $string[1] == 'A') ){
					    			$tipodato[$columna] = 1;
					    		}else if( ($string[0] == 'd' || $string[0] == 'D') && ($string[1] == 'a' || $string[1] == 'A') ){
					    			$tipodato[$columna] = 1;
					    		}else if( ($string[0] == 'y' || $string[0] == 'Y') && ($string[1] == 'e' || $string[1] == 'E') ){
					    			$tipodato[$columna] = 1;
					    		}else{
					    			$tipodato[$columna] = 0;
					    		}

					    		$atributos.= $string." ";
					    		$string = $select[$columna];
					    		$atributos.= "comment "."'".$string."'"." ";
				    		}

				    }

				    $stringtest = "";

				    $query = "CREATE TABLE ".$nombre." (".$atributos.");";

				    //echo "<script> alert (\"$query\"); </script>";
				    $sql = mysqli_query($link,$query);


				    //se insertan los registros
				    for ($renglon = 3; $renglon <= $nRenglones; $renglon++){
				    	$query = "insert into $nombre ";

				    	$desctable  = "(";
				    	for($columna = 1; $columna <= $aux; $columna++){
				    		$string = $board[1][$columna];
				    		if($columna + 1 <= $aux)
				    			$desctable.= $string.",";
				    		else
				    			$desctable.= $string.")";
				    	}
				    	$query.= $desctable." VALUES";
				    	//aqui van las comillas
				    	$valuestable = "(";
				    	for($columna = 1; $columna <= $aux; $columna++){
				    		if($tipodato[$columna] == 1){
				    			$string = "'".$board[$renglon][$columna]."'";
				    		}else{
				    			$string = $board[$renglon][$columna];
				    		}
				    		if($columna + 1 <= $aux)
				    			$valuestable.= $string.",";
				    		else
				    			$valuestable.= $string.")";
				    	}

				    	$query.= $valuestable.";";
				    	//echo "<script> alert (\"$query\"); </script>";
				    	$sql = mysqli_query($link,$query);
				    }


				    //mysqli_free_result($sql);
	    			mysqli_close($link);
			    	echo "<script > location.href=\"verExcel.php\"; </script>";
			    }
		        
		    }
		?>

	</body>

</html>