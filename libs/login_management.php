<?php

include('database.php');
$email = $_POST['email'];
$password = $_POST['password'];
$db = new Database();

//Cheking user
$query = $db->select("usuarios","*","email='".$email."'","",0);
if($query)
{
    $user = $query->fetch_object();
    //Checking password.
    if($user->password == $password)
    {
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['nombre'] = $user->nombre;
        $_SESSION['start'] = time();
        $_SESSION['expire'] = $_SESSION['start'] + (10*60);
        header("Location:http://localhost:3000/");
        
    }
    else
    {
       echo 'El usuario o la contraseña no son validos';
    }
}
else{
    echo 'Usuario no encontrado';    
}
?>