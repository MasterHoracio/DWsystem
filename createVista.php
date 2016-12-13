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
        $nombreAlmacen = $_GET['almacen'];
        if(isset($_POST['bnt-crearVista']) || isset($_POST['det2Vista'])){
          $query = $_POST['query'];
          $nombre = $_POST['nombreVista'];//nombre almacen
          $user = $_SESSION['name'];
          $fecha = date("Y-m-d");

          include("conex.php");
          $link = Conectarse();
          $tipodato = 0;

          $queryGenera = "insert into genera (NombreVista,nombre_usuario,Fecha) values('$nombre','$user','$fecha');";

          if(!mysqli_query($link,$queryGenera)){
            mysqli_close($link);
            echo "<script > location.href=\"javascript:history.back()\"; </script>";
            echo "<script> alert (\"Error al generar la Vista\"); </script>";
          }else{
            $queryVista = "CREATE VIEW $nombre AS SELECT ";
            $atributos = "";
            $wheres = "";
            $temp = 1;
            $temp2 = 1;
            $sql = mysqli_query($link,$query);

            /*foreach ($_POST as $key => $value)
              echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";*/

            while ($row = mysqli_fetch_array($sql)) {
              $atributo = $row[0];
              $string = $row[1];
              $dimension = $row[8];

              $opinf = $atributo."opinf";
              $opsup = $atributo."opsup";
              $inf = $atributo."inf";
              $sup = $atributo."sup";

              if( ($string[0] == 'v' || $string[0] == 'V') && ($string[1] == 'a' || $string[1] == 'A') ){
                $tipodato = 1;
              }else if( ($string[0] == 'd' || $string[0] == 'D') && ($string[1] == 'a' || $string[1] == 'A') ){
                $tipodato = 1;
              }else if( ($string[0] == 'y' || $string[0] == 'Y') && ($string[1] == 'e' || $string[1] == 'E') ){
                $tipodato = 1;
              }else{
                $tipodato = 0;
              }

              //logica atributos
              if($temp == 1){
                $temp = 0;
                $atributos.=$atributo." ";
              }else{
                $atributos.=", ".$atributo." ";
              }

              $Oinf = $_POST[$opinf];
              $Osup = $_POST[$opsup];
              $Inf = $_POST[$inf];
              $Sup = $_POST[$sup];

              $Operacioni = "";
              $Operacions = "";

              if($Oinf == "Menor que"){
                $Operacioni = "<";
              }else if($Oinf == "Mayor que"){
                $Operacioni = ">";
              }else if($Oinf == "Igual que"){
                $Operacioni = "=";
              }else if($Oinf == "Menor Igual que"){
                $Operacioni = "<=";
              }else{
                $Operacioni = ">=";
              }

              if($Osup == "Menor que"){
                $Operacions = "<";
              }else if($Osup == "Mayor que"){
                $Operacions = ">";
              }else if($Osup == "Igual que"){
                $Operacions = "=";
              }else if($Osup == "Menor Igual que"){
                $Operacions = "<=";
              }else{
                $Operacions = ">=";
              }

              if($Inf == "" && $Sup == ""){
                $wheres.= " ";
              }else if($Sup == ""){
                if($Inf != "todos"){
                  if($tipodato == 0){
                    if($temp2 == 1){
                      $wheres.= $atributo." ".$Operacioni." ".$Inf." ";
                      $temp2 = 0;
                    }else{
                      $wheres.= " and ".$atributo." ".$Operacioni." ".$Inf." ";
                    }
                  }else{
                    if($temp2 == 1){
                      $wheres.= $atributo." ".$Operacioni." "."'".$Inf."'"." ";
                      $temp2 = 0;
                    }else{
                      $wheres.= " and ".$atributo." ".$Operacioni." "."'".$Inf."'"." ";
                    }
                  }
                }
              }else{
                if($Inf != "todos" && $Sup != "todos"){
                  if($tipodato == 0){
                    if($temp2 == 1){
                      $wheres.= " ( ".$atributo." ".$Operacioni." ".$Inf." and ".$atributo." ".$Operacions." ".$Sup." ) ";
                      $temp2 = 0;
                    }else{
                      $wheres.= " and ( ".$atributo." ".$Operacioni." ".$Inf." and ".$atributo." ".$Operacions." ".$Sup." ) ";
                    }
                  }else{//con comilla
                    if($temp2 == 1){
                      $wheres.= " ( ".$atributo." ".$Operacioni." "."'".$Inf."'"." and ".$atributo." ".$Operacions." "."'".$Sup."'"." ) ";
                      $temp2 = 0;
                    }else{
                      $wheres.= " and ( ".$atributo." ".$Operacioni." "."'".$Inf."'"." and ".$atributo." ".$Operacions." "."'".$Sup."'"." ) ";
                    }
                  }
                }
              }

            }//while

            $queryVista.= $atributos." from $nombreAlmacen "." where ".$wheres.";";
            mysqli_query($link,$queryVista);
            //echo "$queryVista<br>";
            mysqli_close($link);

            echo "<script > location.href=\"verVista.php\"; </script>";
          }

        }//post btn
      }//get

    ?>
    
    
  </div>


</body>
</html>