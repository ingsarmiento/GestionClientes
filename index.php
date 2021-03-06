<?php
    $request_uri = explode('?',$_SERVER['REQUEST_URI'],2);
    $accessDenied = 'No tiene permiso para entrar a esta página'; 
    session_start();
    /*if(isset($_SESSION['cosas']))
        $_SESSION['cosas'] = $_SESSION['cosas'] +1;
    else
        $_SESSION['cosas'] = 0;
    */
    switch($request_uri[0])
    {
        case '/':
              if(isset($_SESSION) && $_SESSION['loggedin'])
              {
                header("Location:http://localhost:8181/home.php");
              }
              else
              {
                header("Location:http://localhost:8181/login.php");
              }
            break;

        case '/login':
            header("Location:http://localhost:8181/login.php");
            break;
        case '/logout':
            header("Location:http://localhost:8181/logout.php");
            break;

        case '/usuarios':
            
            if(isset($_SESSION) && $_SESSION['loggedin'] && $_SESSION['admin']){
                header("Location:http://localhost:8181/listar_usuarios.php");
            }
            else
            {
                header("Location:http://localhost:8181/access_denied.php");
            }
            break;

        case '/usuarios/guardar':
            
            if(isset($_SESSION) && $_SESSION['loggedin'] && $_SESSION['admin'])
            {
                header("Location:http://localhost:8181/guardar_usuario.php");
            }
            else
            {
                header("Location:http://localhost:8181/access_denied.php");
            }
            break;

        case '/usuarios/change_password':
           
            if(isset($_SESSION) && $_SESSION['loggedin'])
            {
                header("Location:http://localhost:8181/change_password.php");
            }
            else
            {
                header("Location:http://localhost:8181/access_denied.php");
            }
            break;

        case '/clientes':
            if(isset($_SESSION) && $_SESSION['loggedin'])
            {
                header("Location:http://localhost:8181/listar_clientes.php");
            }
            else
            {
                header("Location:http://localhost:8181/access_denied.php");
            }
            break;

        case '/clientes/guardar':
            if(isset($_SESSION) && $_SESSION['loggedin'])
            {
                header("Location:http://localhost:8181/guardar_cliente.php");
            }
            else
            {
                header("Location:http://localhost:8181/access_denied.php");
            }
            break;

            default:
                header('HTTP/1.0 404 Not Found');
                header("Location:404.php");
            break;
    }
?>