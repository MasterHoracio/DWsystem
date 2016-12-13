  <?php   // Conex.php
     function Conectarse()
     {
        $host_name  = "localhost";
        $database   = "dwsystem";
        $user_name  = "admin";
        $password   = "1234";
          
        $link = mysqli_connect($host_name, $user_name, $password, $database);      

        if (mysqli_connect_errno()){
          echo "Error al conectar con servidor MySQL: " . mysqli_connect_error(); 
        }
      //grant all privileges on artsound.* to 'Admin'@'localhost' identified by 'soporte';
      // echo "conectado";
       return $link;

      }

  ?>
