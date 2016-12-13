 <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="admindwsystem.php" ><img src="img/logo.jpg" width="30" ></span></a>

    </div>
    <div>
      <ul class="nav navbar-nav">
        
        
        <li><a href="adminusuarios.php">Usuarios</a></li>

        

      </ul>
        <ul class="nav navbar-nav navbar-right">
        <li><a href="perfil.php"><span class="glyphicon glyphicon-user"></span> Perfil <?php  echo " ".$_SESSION['name'];?> </a></li>
        <li><a href="salir.php"><span class="glyphicon glyphicon-log-in"></span> Salir</a></li>      
      </ul>

    </div>
  </div>
</nav>

