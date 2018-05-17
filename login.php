<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../assets/img/favicon.ico">

    <title>Loging de Acceso a Gestion de clientes</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/signin.css" rel="stylesheet">
  </head>
  <body class="">

    <div class="container">
      <div class="row col-sm-12">
        <div class="col-sm-6 offset-3 border border-info bg-info">
          <form class="px-4 py-3 text-center" action='libs/login_management.php' Method='POST'>
            <fieldset>
              <img class="mb-2 col-sm-10" src="/assets/img/logo.jpg" alt="">
              <h1 class="h3 mb-3 font-weight-normal">Iniciar Sesión</h1>
              <div class="form-group">
                <label for="inputEmail" class="sr-only">Email</label>
                <div class="col-sm-10 offset-1">
                  <input type="email" id="inputEmail" name="email" class="form-control" placeholder="example@email.com" required autofocus>
                </div>
                
              </div>
            
              <div class="form-group">
                <label for="inputPassword" class="sr-only">Contraseña</label>
                <div class="col-sm-10 offset-1">
                  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                </div>
              </div>
            
              <!--div class="checkbox mb-3">
                <label>
                  <input type="checkbox" value="remember-me"> Recordar Usuario
                </label>
              </div-->
              <div class="col-sm-3 offset-8">
                <button class="btn btn-lg btn-primary btn-block" id="btnLogin">Entrar</button>
              </div>
            </fieldset>
          </form>

        </div>
      </div>
    </div>
    
        <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>