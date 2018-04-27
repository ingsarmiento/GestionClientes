<?php
    require('../model/usuario.php');

    $userModel = new Usuario();
    $filter = "";

    if(isset($_REQUEST['filtro'])){
        $filter = $_REQUEST['filtro'];
    }
    $order = "";
    if(isset($_REQUEST['order'])){
        $order = $_REQUEST['order'];
    }

    switch($_REQUEST['action']){
        
        case 'getUsers':
            $resultset = null;
            if($_REQUEST['filter'] == "0")
            {
                $resultset = $userModel->getRows("Select * from usuarios order by {$order}");
            }
            if($_REQUEST['filter'] == "1")
            {
                $resultset = $userModel->getRow("Select * from usuarios where username=?",$filter);
            }
            if($_REQUEST['filter'] == "2")
            {
                $resultset = $userModel->getRows("Select * from usuarios where nombre=? order by {$order}",$filter);
            }
            if($_REQUEST['filter'] == "3")
            {
                $resultset = $userModel->getRows("Select * from usuarios where apellido=? order by {$order}",$filter);
            }
            
            if($resultset != null)
            {
              echo $resultset;      
            }

        break;

        case "saveUser":
            if(isset($_POST)){
                $userModel->username = $_POST["username"];
                $userModel->password = $_POST["password"];
                $userModel->nombre = $_POST["nombre"];
                $userModel->apellido = $_POST["apellido"];
                $userModel->direccion = $_POST["direccion"];
                $userModel->telefono = $_POST["telefono"];
                $userModel->username = $_POST["email"];
                $userModel->username = $_POST["provincia"];
                $userModel->username = $_POST["poblacion"];
                $userModel->username = $_POST["codigo_postal"];
                $userModel->username = $_POST["admin"];
                $userModel->guardar();
            }
        break;

        case "editUser":
        if(isset($_POST))
        {
            $userModel->setId($_POST["id"]);
            $userModel->username = $_POST["username"];
            $userModel->password = $_POST["password"];
            $userModel->nombre = $_POST["nombre"];
            $userModel->apellido = $_POST["apellido"];
            $userModel->direccion = $_POST["direccion"];
            $userModel->telefono = $_POST["telefono"];
            $userModel->username = $_POST["email"];
            $userModel->username = $_POST["provincia"];
            $userModel->username = $_POST["poblacion"];
            $userModel->username = $_POST["codigo_postal"];
            $userModel->username = $_POST["admin"];
            $userModel->modificar();
        }
        break;

        case "deleteUser":
            if(isset($_POST)){
                $userModel->setId($_POST['id']);
            }
        break;
    }
?>