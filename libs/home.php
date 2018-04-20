<!-- Custom styles for this template -->
<link href="../assets/css/jumbotron.css" rel="stylesheet">
<main role="main">
      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Bienvenido <? if(isset($_SESSION)) echo $_SESSION['nombre'] ?></h1>
          
          <?php
            if(isset($_SESSION) && $_SESSION['admin'])
            {
                echo '<p>Este es el panel de control que te permitirá gestionar clientes y usuarios</p>';
            }else
            {
                echo '<p>Este es el panel de control que te permitirá gestionar clientes</p>';
            }
          ?>
          <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>
        </div>
      </div>
</main>