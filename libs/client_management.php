<?php
    require('../model/cliente.php');

    $userModel = new Cliente();
    $filter = "";

    if(isset($_REQUEST['filtro'])){
        $filter = $_REQUEST['filtro'];
    }
    $order = "";
    if(isset($_REQUEST['order'])){
        $order = $_REQUEST['order'];
    }

    switch($_REQUEST['action']){
        
        case 'getClients':
            $resultset = null;
            if($_REQUEST['filter'] == "0")
            {
                $resultset = $userModel->getRows("Select * from clientes order by {$order}");
            }
            if($_REQUEST['filter'] == "1")
            {
                $resultset = $userModel->getRow("Select * from clientes where dni=?",$filter);
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
                $userModel->nombre = $_POST["nombre"];
                $userModel->apellido = $_POST["apellido"];
                $userModel->direccion = $_POST["direccion"];
                $userModel->telefono = $_POST["telefono"];
                $userModel->username = $_POST["email"];
                $userModel->username = $_POST["provincia"];
                $userModel->username = $_POST["poblacion"];
                $userModel->username = $_POST["codigo_postal"];
                $userModel->guardar();
            }
        break;

        case "editUser":
        if(isset($_POST))
        {
            $userModel->setId($_POST["id"]);
            $userModel->nombre = $_POST["nombre"];
            $userModel->apellido = $_POST["apellido"];
            $userModel->direccion = $_POST["direccion"];
            $userModel->telefono = $_POST["telefono"];
            $userModel->username = $_POST["email"];
            $userModel->username = $_POST["provincia"];
            $userModel->username = $_POST["poblacion"];
            $userModel->username = $_POST["codigo_postal"];
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