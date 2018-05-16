<?php
require('../model/usuario.php');

//verificamos que la petición post contiene parametros.
if(isset($_POST))
{

    //Recuperamos el email y la contraseña enviado en la peticion post.
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Modelo usuario
    $userModel = new Usuario();

    //Verificando si el usuario existe en la base de datos.
   $user = json_decode($userModel->getrow("Select * from usuarios where email=? ",$email));
    //Verificando si el usuario introdujo la contraseña correcta.
    if($user != null && $password == $user->password)
    {
        session_start();
        $_SESSION['username'] = $user->username;
        $_SESSION['nombre'] = $user->nombre;
        $_SESSION['admin'] = $user->admin;
        $_SESSION['loggedin'] = true;

        echo 'autorizado';
    }
    else
    {
        $response = Array("data"=>"Sin resultado", "message"=>"El usuario o la contraseña no son validos");
        echo json_encode($response);
    }
}
?>