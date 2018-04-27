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
        </li>
            
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
              <a class="dropdown-item"><?php //if(isset($_SESSION)) echo $_SESSION['nombre']; ?></a>
              <a class="dropdown-item" role="divider"></a>
              <a class="dropdown-item" href="#">Cambiar contraseña</a>
              <a class="dropdown-item" href="../views/logout.php">Cerrar Sesión</a>
            </div>
        </li>

    </ul>
       
</div>