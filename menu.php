 <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="dwsystem.php" ><img src="img/logo.jpg" width="30" ></span></a>

    </div>
    <div>
      <ul class="nav navbar-nav">
        
        
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Proyecto<span class="caret"></span></a>
            <ul class="dropdown-menu">
            <li><a href="subirbd.php">Subir Excel</a></li>
            <li><a href="verExcel.php">Ver</a></li>
            <li><a href="borrarAlmacen.php">Borrar</a></li>
            
          </ul>
        </li>


        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Vista<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="crearVista.php">Alta</a></li>
            <li><a href="verVista.php">Ver</a></li>
            <li><a href="borrarvista.php">Borrar</a></li>
          </ul>
        </li>
      
        <li><a href="grafica.php">Grafica</a></li>

        <li><a href="tutorial.docx">Manual <span class="glyphicon glyphicon-question-sign"></span></a></li>

      </ul>
        <ul class="nav navbar-nav navbar-right">
        <li><a href="perfil.php"><span class="glyphicon glyphicon-user"></span> Perfil <?php  echo " ".$_SESSION['name'];?> </a></li>
        <li><a href="salir.php"><span class="glyphicon glyphicon-log-in"></span> Salir</a></li>      
      </ul>

    </div>
  </div>
</nav>

