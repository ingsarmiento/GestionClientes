    <?php
    /*if(isset($_SESSION)){
      $now = time();
      if($now = $_SESSION['expire'])
      {
        session_unset();
        session_destroy();
        header("Localhost:http://localhost:3000/login");
      }
    }*/
    ?>
    
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../assets/img/favicon.ico">

    <title>Gestion de clientes</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="../assets/css/fontawesome.min.css" rel="stylesheet">

    <link href="../assets/css/app.css" rel="stylesheet">

  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="/">Gestion Clientes</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <?php 
        //if(isset($_SESSION)){
          include('nav_elements.php');
        //}
      ?>
    </nav>

    <!-- Modal -->
<div class="modal fade" id="guardarUsuario" tabindex="-1" role="dialog" aria-labelledby="guardarUsuarioTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="guardarUsuarioLongTitle">Nuevo Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group mx-3 mb-2">
                        <input type="text" class="form-control" id="username" placeholder="Usuario">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="password" class="form-control" id="password" placeholder="Contraseña">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" id="dni" placeholder="DNI">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" id="apellido" placeholder="Apellido">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" id="dirección" placeholder="Dirección">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="text" class="form-control" id="telefono" placeholder="Télefono">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                    <div class="form-check mx-sm-3 mb-2">
                        <input type="checkbox" class="form-check-input" id="admin">
                        <label for="admin" class="form-check-label">Administrador</label>
                    </div>
                    <!--div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <input type="text" class="form-control" id="message-text">
                    </div-->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Guardar Usuario</button>
            </div>
        </div>
    </div>
</div>
