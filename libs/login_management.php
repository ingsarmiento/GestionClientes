<?php
require('../model/usuario.php');

//verificamos que la petición post contiene parametros.
if(isset($_POST)){
    //Recuperamos el email y la contraseña enviado en la peticion post.
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Modelo usuario
    $userModel = new Usuario();

    //Verificando si el usuario existe en la base de datos.
   $user = json_decode($userModel->getrow("Select * from usuarios where email=? ","{$email}"));
    //Verificando si el usuario introdujo la contraseña correcta.
    if($user != null && $password == $user->password){
        //Iniciamos la Sesión.
        session_start();
        //echo $user->nombre.' '.$user->apellido;
        //Establecemos los valores de la sesión con los que vamos a trabajar.
        $_SESSION = array();
        $_SESSION['nombre'] = $user->nombre;
        $_SESSION['loggedin'] = true;
        $_SESSION['admin'] = $user->admin;
        $_SESSION['start'] = time();
        //$_SESSION['expire'] = ;
        //Llamamos a nuestra pagina home.
        //include('../views/home.php');
        //var_dump($user);
        header('Location: http://localhost:8080');
    }else
    {
        echo 'El usuario o la contraseña no son validos';
    }
}


?>