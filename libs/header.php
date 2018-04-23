    <?php
    if(isset($_SESSION)){
      $now = time();
      if($now = $_SESSION['expire'])
      {
        session_unset();
        session_destroy();
        header("Localhost:http://localhost:3000/login");
      }
    }
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

  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="/">Gestion Clientes</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">Inicio <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Clientes</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="/clientes">Listar Clientes</a>
              <a class="dropdown-item" href="#">Nuevo Cliente</a>
            </div>
            
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Usuario</a>
            <div class="dropdown-menu" aria-labelledby="dropdown02">
              <a class="dropdown-item" href="/usuarios">Listar Usuarios</a>
              <a class="dropdown-item" href="#">Nuevo Usuario</a>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav"> 
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">opciones de Usuario</a>
            <div class="dropdown-menu" aria-labelledby="dropdown03">
              <a class="dropdown-item"><?php if(isset($_SESSION)) echo $_SESSION['nombre']; ?></a>
              <a class="dropdown-item" role="divider"></a>
              <a class="dropdown-item" href="#">Cambiar contraseña</a>
              <a class="dropdown-item" href="../views/logout.php">Cerrar Sesión</a>
            </div>
          </li>
        </ul>
       
      </div>
    </nav>

