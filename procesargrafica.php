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
  <?php include('menu.php'); ?>

  <div class="container well">
    <h3>Grafica</h3>

  <form class="form-horizontal" name="eform" onsubmit="return validateForm()" method="GET" action="grafica2.php" >
    
                <?php
              /*Conexion a la bd*/
              $user=$_SESSION['name'];
              include("conex.php");
              $link=Conectarse();
              $vista=  $_GET['vista'];
              $cons="select *  from genera where nombre_usuario='$user' ;";
              $sql=mysqli_query($link,$cons);
              $queryHead =mysqli_query($link,"desc $vista;");
              $queryHead2 =mysqli_query($link,"desc $vista;");
              
               ?>

         
   
          


        <div class="form-group">
<h3>Columnas</h3>
           <div class="col-xs-3">X
                <?php
        
              $cons="select *  from genera where nombre_usuario='$user' ;";
              $sql=mysqli_query($link,$cons);
               ?>

          <select name="x" class="form-control"  onchange="showUser(this.value)" >
          <option>Seleccione  </option>
          <?php
            while($lista=mysqli_fetch_array($queryHead))

            echo "<option  value='".$lista[0]."'>".$lista[0]."</option>"; 
            ?></select>    
          </div>

        <div class="col-xs-3">Y
          <select name="y" class="form-control"  onchange="showUser(this.value)" >
          <option>Seleccione  </option>
          <?php
            while($lista=mysqli_fetch_array($queryHead2))

            echo "<option  value='".$lista[0]."'>".$lista[0]."</option>"; 
            ?></select>    
          </div>

          </div>

<input type="hidden" name="vista" value="<?php echo $vista?>">

          <div class="col-xs-3">
                <button type="submit" class="form-control  btn-primary "   >Graficar</button>
          </div>
  </form>
  </div>



</body>
</html>