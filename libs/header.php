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
    <link href="../assets/css/fontawesome-all.min.css" rel="stylesheet">

    <link href="../assets/css/app.css" rel="stylesheet">

     <script type="text/javascript" src="../assets/js/jquery.simplePagination.js"></script>
     <script type="text/javascript" src="../assets/css/simplePagination.css"></script>

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