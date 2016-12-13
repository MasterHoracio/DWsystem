<!DOCTYPE html>
<html>
  <head>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="scrip/jquery.min.js">
  <link rel="stylesheet" type="text/css" href="scrip/bootstrap.js">
<script src="scrips/jquery.min.js"></script>
<script src="scrips/bootstrap.min.js"></script>
<link rel="shortcut icon" href="img/upaep.ico"/>  
<title>Password</title>
  </head>
 
<body bgcolor="white">     
<div class="container">
<style type="text/css">


body {
      font: 400 15px Lato, sans-serif;
      line-height: 1.8;
      color: #818181;
            background-color: gray;
            background-size: 100%;
              
  }
</style>
  <div class="col-md-12"  >
      <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

    <div id="login-overlay" class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              
              <h3 class="modal-title" id="myModalLabel"><center><font color="Black" >Registro</font></center></h3>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-xs-4"><br><br>
              <center><img src="img/logo.jpg" width="190" ></center>
              </div>
                  <div class="col-xs-8">
                      <div class="well">
                            <form class="form-horizontal"  action='registro.php' onsubmit="return validalog()" name="loging" method="post" >  
                              
                              <div class="form-group">
                                  <label for="username" class="control-label">Usuario</label>
                                  <input type="text" class="form-control" id="usuario" name="usuario" value="" required="" title="porfavor coloque su correo" placeholder="Usuario007">
                                  <span class="help-block"></span>
                              </div>

    
                              <div class="form-group">
                                  <label for="username" class="control-label">Correo</label>
                                  <input type="text" class="form-control" id="correo" name="correo" value="" required="" title="porfavor coloque su correo" placeholder="ejemplo@gmail.com">
                                  <span class="help-block"></span>
                              </div>
                              
                              
                              <div class="form-group">
                                  <label for="username" class="control-label">Contraseña</label>
                                  <input type="password" class="form-control" id="pass" name="pass" value="" required="" title="porfavor coloque su correo" placeholder="*****">
                                  <span class="help-block"></span>
                              </div>
                              
                              <button type="submit" class="btn btn-success btn-block">Registrar</button>
                              <a href="index.php" class="btn btn-default btn-block">Regresar</a>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>


<script>
    function validalog() {
    var y = document.forms["loging"]["correo"].value;
    var z = document.forms["loging"]["pass"].value;
    var x = document.forms["loging"]["usuario"].value;

    if (x == null || x == "") {
        alert("El usuario debe ser llenado");
        document.loging.usuario.focus();
        return false;
    }


    if (y == null || y == "") {
        alert("El correo debe ser llenado");
        document.loging.correo.focus();
        return false;
    }
    if (z == null || z == "") {
        alert("El password debe ser llenado");
        document.loging.password.focus();
        return false;
    }
        //alert("Bienvenido:");
}

</script>
  <?php //codigo para enviar el correo
if ($_POST)
{
  
  include("conex.php");
    $link=Conectarse();
    $usuario=$_POST['usuario'];
    $correo=$_POST['correo'];
    $pass=$_POST['pass'];
        //correo='$correo'
    $buscar=mysqli_query($link, "select nombre_usuario from usuario where nombre_usuario='$usuario' " );

if ($row = mysqli_fetch_row($buscar)) 
  {
   $buscar = trim($row[0]);
   }                     
                     if ($buscar==$usuario) {
                    
                    
                    mysqli_close($link);  //Cierra la conexión
                    echo "<script> alert (\"Ya exite el usuario\"); </script>"; 
                    echo "<script > location.href=\"registro.php\"; </script>"; //funciona en local y en el host    
                      }

  $buscar2=mysqli_query($link, "select correo from usuario where correo='$correo' " );

if ($row = mysqli_fetch_row($buscar2)) 
  {
   $buscar2 = trim($row[0]);
   }                     
                     if ($buscar2==$correo) {
                    
                    
                    mysqli_close($link);  //Cierra la conexión
                    echo "<script> alert (\"Ya exite el correo\"); </script>"; 
                    echo "<script > location.href=\"registro.php\"; </script>"; //funciona en local y en el host    
                      }


  $sql=mysqli_query($link,"insert into  usuario values('$usuario','$correo','$pass' ) ;"); 

      $sql=mysqli_query($link,"select * from usuario where   correo= '$correo' ;"); 
echo "<script> alert (\"registro aceptado\"); </script>";
      if ($row = mysqli_fetch_array($sql)) {
        

      $to = $correo;
      $subject = "Registro";
      $txt = "Tu contrase&ntilde;a es:".$row["pass"];
      $headers = "From: gibran.reyes@hotmail.es" . "\r\n" ."CC:";
      $message="Hola!!\t".$row["nombre_usuario"]."Tus datos para ingresar al sistema son: \nPassword:\t".$row["password"]."\n usuario:\t".$row["nombre_usuario"]
        ."\nmensaje enviado desde el sistema DWsystem";
        mail($to,$subject,$message,$headers);
        
    echo "<script > location.href=\"index.php\"; </script>"; //funciona en local y en el host    
      }


    

 }//cierra condicion de POST
 
?> 
</body>
</html>  