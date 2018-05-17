<?php
//Header Section 
include('libs/header.php');
?>
<!-- Custom styles for this template -->
<link href="../assets/css/jumbotron.css" rel="stylesheet">
<main role="main">
      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          
          <?php
            if(isset($_SESSION))
            {  
              if(isset($_SESSION['nombre']))
              {
                echo '<h1 class="display-3">Bienvenido '.$_SESSION['nombre'].'</h1>';
              }
              
              if(isset($_SESSION['admin']) && $_SESSION['admin'])
              {
                  echo '<p>Este es el panel de control que te permitirá gestionar clientes y usuarios</p>';
              }
              else
              {
                  echo '<p>Este es el panel de control que te permitirá gestionar clientes</p>';
              }

              echo '<p><a class="btn btn-primary btn-lg" href="/logout" role="button"> Salir </a></p>';

            }
            else
            {
              echo '<p><a class="btn btn-primary btn-lg" href="/login" role="button"> Iniciar sessión </a></p>';
            }
          ?>
          
        </div>
      </div>
</main>

<?php
//Footer Section
include('libs/footer.php');
?>