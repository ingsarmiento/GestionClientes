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
        $start = time() + 60000;
        $expire = $start + 60000;
        $_SESSION = Array("username" => $user->username, "nombre" => $user->nombre, "admin" =>$user->admin,
                           "loggedin" => true, "start" => $start, "expire" => $expire);
        header("Location:http://localhost:8181/");
    }
    else
    {
        session_start();
        //session_unset();
        //session_destroy();
        echo "El usuario o la contraseña no son validos";
    }
}
?>