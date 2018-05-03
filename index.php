<?php
    $request_uri = explode('?',$_SERVER['REQUEST_URI'],2);
    $accessDenied = 'No tiene permiso para entrar a esta página';
    switch($request_uri[0])
    {
        case '/':
            require 'home.php';
            break;

        case '/login':
            require 'login.php';
            break;
        case '/logout':
            require 'logout.php';
            break;

        case '/usuarios':
            //if(isset($_SESSION) && $_SESSION['loggedin'] && $_SESSION['admin']){
                require 'listar_usuarios.php';
            /*}else
            {
                echo $accessDenied;
            }*/
            break;

        case '/usuarios/guardar':
            //if(isset($_SESSION) && $_SESSION['loggedin'] && $_SESSION['admin']){
                require 'guardar_usuario.php';
            /*}else
            {
                echo $accessDenied;
            }*/
            break;

        case '/usuarios/cambiar_contrasenia':
            //if(isset($_SESSION) && $_SESSION['loggedin'] && $_SESSION['admin']){
                require 'change_password.php';
            /*}else
            {
                echo $accessDenied;
            }*/
            break;

        case '/clientes':
            //if(isset($_SESSION) && $_SESSION['loggedin']){
                require 'listar_clientes.php';
            //}else
            //{
                //echo $accessDenied;
            //}
            break;

            case '/clientes/guardar':
            //if(isset($_SESSION) && $_SESSION['loggedin'] && $_SESSION['admin']){
                require 'guardar_cliente.php';
            /*}else
            {
                echo $accessDenied;
            }*/
            break;
            default:
                header('HTTP/1.0 404 Not Found');
            require 'views/404.php';
            break;
    }
?>