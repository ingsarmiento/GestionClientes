<?php
    $request_uri = explode('?',$_SERVER['REQUEST_URI'],2);
    $accessDenied = 'No tiene permiso para entrar a esta página';
    switch($request_uri[0])
    {
        case '/':
            require 'views/home.php';
            break;
        case '/login':
            require 'views/login.php';
            break;
        case '/usuarios':
            //if(isset($_SESSION) && $_SESSION['loggedin'] && $_SESSION['admin']){
                require 'views/listar_usuarios.php';
            /*}else
            {
                echo $accessDenied;
            }*/
            break;
        case '/clientes':
            //if(isset($_SESSION) && $_SESSION['loggedin']){
                require 'views/listar_clientes.php';
            //}else
            //{
                //echo $accessDenied;
            //}
            break;
            default:
                header('HTTP/1.0 404 Not Found');
            require 'views/404.php';
            break;
    }
?>