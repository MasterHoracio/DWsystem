<?php session_start();
include ("seguridad.php"); ?> 
<!DOCTYPE html>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="scrips/jquery.min.js">
  <link rel="stylesheet" type="text/css" href="scrips/bootstrap.js">
  <script src="scrips/jquery.min.js"></script>
  <script src="scrips/bootstrap.min.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
  <link rel="shortcut icon" href="img/icono.ico"/>  
<head>
  <title>DWsystem</title>
</head>
  <style type="text/css">
  
  </style>
<body >
  <?php include('menu.php');?>
    
  <div class="container well">
    <?php 
      if ( $_GET ){
        echo"<h4>Personalizar vista</h4>";
        $nombreAlmacen = $_GET['almacen'];
        if(isset($_POST['bnt-crearV']) || isset($_POST['check_list'])){

          include("conex.php");
          $link = Conectarse();

          $opciones = $_POST['check_list'];

          $query = "show full columns from $nombreAlmacen where ";
          $field = "";
          $aux = 1;

          foreach($_POST['check_list'] as $check) {
            if($aux == 1){
              $aux = 0;
              $field.= " Field = '$check' ";
            }else{
              $field.= " or Field = '$check' ";
            }
          }

          $query.= $field.";";

          $sql = mysqli_query($link,$query);

          echo"<form class='form-horizontal well' name='det2Vista' id='det2Vista' method='POST' action='createVista.php?almacen=$nombreAlmacen'  enctype='multipart/form-data'>";
           echo "<table class='table table-striped'>";

            echo "<tbody>";
              while ($row = mysqli_fetch_array($sql)) {

                $atributoV = $row[0];
                $dimensionV = $row[8];

                if($dimensionV == "tiempo"){

                  $opinf = $atributoV."opinf";
                  $opsup = $atributoV."opsup";
                  $inf = $atributoV."inf";
                  $sup = $atributoV."sup";

                  echo "<tr> <td>".$atributoV."</td> <td>".$dimensionV."</td>
                  <td><select class='form-control' name='$opinf' id='$opinf'>
                      <option>Menor que</option>
                      <option>Mayor que</option>
                      <option>Igual que</option>
                      <option>Menor Igual que</option>
                      <option>Mayor Igual que</option>
                      </select>
                  </td>  
                  <td><input type='text' class='form-control' id='$inf' name='$inf' value='' title='Ingresa la fecha inferior' placeholder='fecha inferior'></td> 
                  <td><select class='form-control' name='$opsup' id='$opsup'>
                      <option>Menor que</option>
                      <option>Mayor que</option>
                      <option>Igual que</option>
                      <option>Menor Igual que</option>
                      <option>Mayor Igual que</option>
                      </select>
                  </td>  
                  <td><input type='text' class='form-control' id='$sup' name='$sup' value=''  title='Ingresa la fecha superior' placeholder='fecha superior'></td></tr>";
                }else if($dimensionV == "espacio"){//pendiente
                  $query2 = "select $atributoV from $nombreAlmacen group by $atributoV;";
                  $sql2 = mysqli_query($link,$query2);

                  $opinf = $atributoV."opinf";
                  $opsup = $atributoV."opsup";
                  $inf = $atributoV."inf";
                  $sup = $atributoV."sup";

                  echo "<tr> <td>".$atributoV."</td> <td>".$dimensionV."</td>
                  <td><select class='form-control' name='$opinf' id='$opinf'>
                      <option>Menor que</option>
                      <option>Mayor que</option>
                      <option>Igual que</option>
                      <option>Menor Igual que</option>
                      <option>Mayor Igual que</option>
                      </select>
                  </td>  
                  <td>";
                  echo"  <select class='form-control' name='$inf' id='$inf'>
                      <option>todos</option>";
                      while ($row2 = mysqli_fetch_array($sql2)) {
                        $tmp = $row2[0];
                        echo "<option>$tmp</option>";
                      }
                    echo"
                    </select>
                  </td> ";
                    $sql2 = mysqli_query($link,$query2);
                  echo "<td><select class='form-control' name='$opsup' id='$opsup'>
                      <option>Menor que</option>
                      <option>Mayor que</option>
                      <option>Igual que</option>
                      <option>Menor Igual que</option>
                      <option>Mayor Igual que</option>
                      </select>
                  </td>  
                  <td>
                    <select class='form-control' name='$sup' id='$sup'>
                      <option>todos</option>";
                      while ($row2 = mysqli_fetch_array($sql2)) {
                        $tmp = $row2[0];
                        echo "<option>$tmp</option>";
                      }
                    echo"
                    </select>
                  </td>
                </tr>";
                }else{
                  $opinf = $atributoV."opinf";
                  $opsup = $atributoV."opsup";
                  $inf = $atributoV."inf";
                  $sup = $atributoV."sup";

                  echo "<tr> <td>".$atributoV."</td> <td>".$dimensionV."</td>
                  <td><select class='form-control' name='$opinf' id='$opinf'>
                      <option>Menor que</option>
                      <option>Mayor que</option>
                      <option>Igual que</option>
                      <option>Menor Igual que</option>
                      <option>Mayor Igual que</option>
                      <option>Sum()</option>
                      <option>Avg()</option>
                      <option>Min()</option>
                      <option>Max()</option>
                      </select>
                  </td>  
                  <td><input type='text' class='form-control' id='$inf' name='$inf' value='' title='Ingresa la cantidad inferior' placeholder='cantidad inferior'></td> 
                  <td><select class='form-control' name='$opsup' id='$opsup'>
                      <option>Menor que</option>
                      <option>Mayor que</option>
                      <option>Igual que</option>
                      <option>Menor Igual que</option>
                      <option>Mayor Igual que</option>
                      <option>Sum()</option>
                      <option>Avg()</option>
                      <option>Min()</option>
                      <option>Max()</option>
                      </select>
                  </td>  
                  <td><input type='text' class='form-control' id='$sup' name='$sup' value=''  title='Ingresa la cantidad superior' placeholder='cantidad superior'></td></tr>";
                }
              }//fin while
              echo" <tr>
                    <td></td> <td></td> <td></td> 
                    <td><input type='text' id='query' name='query' value=\"$query\"  style='display: none;' /></td>
                    <td><input type='text' class='form-control' id='nombreVista' required='' name='nombreVista' value=''  title='Ingresa el nombre de la vista' placeholder='Nombre de la vista'></td>
                    <td><button type='submit' name='bnt-crearVista' class='btn btn-primary' > Crear </button></td>
                    </tr>";
            echo "</tbody>";

            echo "</table>";
       
          echo "</form>";

          
        }
      }

      mysqli_close($link);
    ?>
    
    
  </div>


</body>
</html>