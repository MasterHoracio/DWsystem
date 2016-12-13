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
              
              <h3 class="modal-title" id="myModalLabel"><center><font color="Black" >Recuperar contraseña</font></center></h3>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-xs-4">
              <center><img src="img/logo.jpg" width="190" ></center>
              </div>
                  <div class="col-xs-8">
                      <div class="well">
                            <form class="form-horizontal"  action='recupera.php' onsubmit="return validalog()" name="loging" method="post" >  
                              
    
                              <div class="form-group">
                                  <label for="username" class="control-label">Correo</label>
                                  <input type="text" class="form-control" id="correo" name="correo" value="" required="" title="porfavor coloque su correo" placeholder="ejemplo@gmail.com">
                                  <span class="help-block"></span>
                              </div>
                              
                              
                              <div class="checkbox">
                                  <label><Font color="red">
                                      <?php 
                                      if ($_POST)
                                        {
                                      echo "Mensaje enviado";}
                                      ?></font>
                                  </label>
                                  
                              </div>
                              <button type="submit" class="btn btn-success btn-block">Solicitar</button>
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
    var x = document.forms["loging"]["correo"].value;

    if (x == null || x == "") {
        alert("El COrreo debe ser llenado");
        document.loging.correo.focus();
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
    $correo=$_POST['correo'];
    
    $sql=mysqli_query($link,"select * from usuario where   correo= '$correo' ;"); 

  

    if ($row = mysqli_fetch_array($sql)) {
        

$to = $correo;
$subject = "RecuperarPASS";
$txt = "Tu contrase&ntilde;a es:".$row["pass"];
$headers = "From: gibran.reyes@hotmail.es" . "\r\n" ."CC:";
$message="Hola!!\t".$row["nombre_usuario"]."Tus datos para ingresar al sistema son: \nPassword:\t".$row["password"]."\n usuario:\t".$row["nombre_usuario"]
."\nmensaje enviado desde el sistema DWsystem";
mail($to,$subject,$message,$headers);
mail($to,$subject,$message,$headers);
    }


    

 }//cierra condicion de POST
 
?> 
</body>
</html>  