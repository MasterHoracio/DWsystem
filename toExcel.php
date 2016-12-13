<!DOCTYPE html>
  <meta charset="utf-8">
  	<body>
		<?php 

		    if ( $_GET ){
		        $Archivo = $_GET['archivo']; 
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



			    for ($renglon = 1; $renglon <= $nRenglones; $renglon++) {
			        $columnas = $hoja->rangeToArray('A' . $renglon . ':' . $nColumnas . $renglon, NULL, TRUE, FALSE);
			        foreach($columnas[0] as $columna=>$valor){
			        	$board[$renglon][($columna+1)] = $valor;
			        }
			        $aux = $columna;
			    }

			    $aux += 1;

			    echo "<table class='table table-striped'>
			    		<thead>
					      <tr>
					        <th>Atributo</th>
					        <th>Tipo</th>
					        <th>Dimension</th>
					      </tr>
					    </thead>
					    <tbody>";

			    	echo"<form class='form-horizontal well' name='cargaArchivo' method='POST' action='toCreateTable.php?archivo=$Archivo&n=$aux'  enctype='multipart/form-data'>";

			    	for($columna = 1; $columna <= $aux; $columna++){
			    		echo "<tr>";
			    		$string = $board[1][$columna];
			    		echo "<td> $string </td>";
			    		$string = $board[2][$columna];
			    		echo "<td> $string </td>";
			    		echo "<td> 
			    					<select class='form-control' name='$columna' id='$columna'>
			    						<option>otro</option>
									  	<option>tiempo</option>
									  	<option>espacio</option>
									</select>
			    			  </td>";
			    		echo "</tr>";
			    	}

			    		echo"<tr>";
			    			echo"<td><label class='control-labe'>Nombre de Almacen</label></td>";
			    			echo"<td><input type='text' class='form-control' id='nombreDW' name='nombreDW' value='' required='' title='Ingresa el nombre del alamacen' placeholder='Almacen de Datos'></td>";
			    			echo"<td>
			    				<div class='col-xs-8'>
				                  <button type='submit' name='btn-carga' class='btn btn-primary'>Crear</button>
				              </div>
			    			</td>";
			    		echo"</tr>";

			    	echo "</form>";

			    echo "	</tbody>
			    		</table>";

		     }
		?>

	</body>

</html>