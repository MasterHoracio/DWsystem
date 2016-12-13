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
  <?php 


            if ($_SESSION['nombre_usuario']=="admin") {
          include ("adminmenu.php");
        }
        elseif ($_SESSION['nombre_usuario']!="admin") {
            include ("menu.php");
        }

 ?>
    
     
 
  

<!--Conenedor!-->
    
<?php   // borrro datos
     include("conex.php");
     $link=Conectarse();
     
     $id=$_SESSION['nombre_usuario'];
     
    $sql=mysqli_query($link," select * from usuario  where nombre_usuario='$id' ");

if ($row = mysqli_fetch_row($sql)) 
  {
   $nom = trim($row[0]);
   $correo = trim($row[1]);
   $pass = trim($row[2]);
   
  }

?>


    <div class="container well" id='muestra' >

    <form class="form-horizontal" name="crearcat" onsubmit="return checa()" method="POST"  action="#"  >
        <div class="form-group" >
            <div class="col-xs-9" >
            <div class="page-header">
            <h1>Perfil  <span class="glyphicon glyphicon-user"></span></h1>
            </div></div>
        </div>
        
        <div class="form-group">
        
            <div class="col-xs-3">
                Nombre:<input type="text" disabled class="form-control" placeholder="Nombre" maxlength="30" name="nombre"  title="Nombre" value="<?php echo $nom;?>" >
            </div>
            
            
            <div class="col-xs-3">
               Password:<input type="password" class="form-control" placeholder="Password" maxlength="30" name="pass"  title="" value="<?php echo $pass;?>">
            </div>
            
         
            
        </div>
        
        <div class="form-group">
           
            <div class="col-xs-6">
                Correo:<input type="text" class="form-control" name="correo"  maxlenght="20"  placeholder="ejemplo@algo.com"  title="mete un correo ejemplo: juan@hotmail.com" value="<?php echo $correo;?>">
            </div>  
            
        </div>


            
      

      <div class="form-group">
            <div class="col-xs-4 ">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            
    </div>
    </form>
    
    </div>    
    

<!--coloco un pie de pagina class="embed-responsive-item" !-->

<?php //codigo para enviar el correo  //<div class="col-xs-4 pull-right">
if ($_POST) {
  # code...

     $nom =$_POST['nombre'];
     $pass =$_POST['pass'];
     $correo =$_POST['correo'];

   $sql=mysqli_query($link," update usuario set  password='$pass',correo='$correo' where nombre_usuario= '$id' ;"); 

$_SESSION['nombre'] =  $nom;
      $to = $correo;
      $subject = "Datos actualizados";
      $txt = "Tu contrase&ntilde;a es:".$row["pass"];
      $headers = "From: gibran.reyes@hotmail.es" . "\r\n" ."CC:";
      $message="Hola!!\t".$nom."Tus datos para ingresar al sistema son: \nPassword:\t".$row["pass"]."\n usuario:\t".$row["nom"]
        ."\nmensaje enviado desde el sistema DWsystem";
        mail($to,$subject,$message,$headers);

echo "<script> alert (\"Perfil actualizado \"); </script>"; 
echo "<script > location.href=\"dwsystem.php\"; </script>";     

} 
 
?> 


</body>
</html>
