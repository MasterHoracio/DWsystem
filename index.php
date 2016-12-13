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
    <link rel="shortcut icon" href="img/icono.ico"/>  
    <title>Login</title>
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
        background-image: url('img/plantillas/fondo.jpg');
  }      
</style>

  <div class="col-md-12"  >
      <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

    <div id="login-overlay" class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              
              <h3 class="modal-title" id="myModalLabel"><center><font color="Black" >Loggin</font></center></h3>
          </div>
          <div class="modal-body">
              <div class="row">
              <div class="col-xs-4"><br><br>
              <center><img src="img/logo.jpg" width="190" ></center>
              </div>
                  <div class="col-xs-8">
                      <div class="well">
                            <form class="form-horizontal"  action='control.php' onsubmit="return validalog()" name="loging" method="post" >  
                              
                              <?php 
                                if ( $_GET ) 
                                    { 
                                      if ($_GET['errorusuario']==1)
                                      {?> 
                                       
                                       <label for="username" class="control-label"><Font color="red">Datos incorrectos </Font></label>
                                      <?php }
                                } 
                                      else
                                      {?> 
                                    
                                       
                                      <?php }
                                     ?>
    
                              <div class="form-group">
                                  <label for="username" class="control-label">Usuario:</label>
                                  <input type="text" class="form-control" id="id" name="id" value="" required="" title="ingrese su username" placeholder="usuario">
                                  <span class="help-block"></span>
                              </div>
                              <div class="form-group">
                                  <label for="password" class="control-label">Password:</label>
                                  <input type="password" class="form-control" id="pass" name="pass" value="" required="" title="ingrese su password" placeholder="contraseña">
                                  <span class="help-block"></span>
                              </div>
                              
                              <button type="submit" class="btn btn-success btn-block">Entrar</button>
                              <br><a href="recupera.php" class="btn btn-default ">Olvide mi password</a>             <a href="registro.php" class="btn btn-default">Registrarse</a>
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
    var x = document.forms["loging"]["pass"].value;
    var y = document.forms["loging"]["id"].value;
    

    if (y == null || y == "") {
        alert("El usuario debe ser llenado");
        document.loging.id.focus();
        return false;
    }

    if (x == null || x == "") {
        alert("El password debe ser llenado");
        document.loging.pass.focus();
        return false;
    }
        //alert("Bienvenido:");
}
</script>
  
</body>
</html>  