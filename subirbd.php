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
    
    <form class="form-horizontal well" name="cargaArchivo"  onsubmit="return validaArchivo()" method="POST" action="cargaExcel.php"  enctype="multipart/form-data">
      <div class="form-group">
              <div class="col-xs-5 ">Archivo Excel
                  <input type="file" name="file" id="file" class="form-control" required>          
              </div>

              <div class="col-xs-8 "><br>
                  <button type="submit" name="btn-carga" class="btn btn-primary">Cargar</button>
              </div>
      </div>
    </form>
    
  </div>

  <script>
    function validaArchivo() {
      var x = document.getElementById("file").value;

      if (x == null || x == "") {
          alert("No se ha adjuntado ningun archivo");
          document.cargaArchivo.file.focus();
          return false;
      }
    }
  </script>

</body>
</html>