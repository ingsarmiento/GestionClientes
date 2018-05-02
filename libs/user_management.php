<?php
    require('../model/usuario.php');

    $userModel = new Usuario();
    $filter = "";

    if(isset($_REQUEST['value']))
    {
        $filter = $_REQUEST['value'];
    }
    $order = "";
    if(isset($_REQUEST['order']))
    {
        $order = $_REQUEST['order'];
    }

    switch($_REQUEST['action']){
        
        case 'getUsers':
            $resultset = null;
            if($_REQUEST['filter'] == "0")
            {
                $resultset = $userModel->getRows("Select * from usuarios order by {$order}");
            }
            if($_REQUEST['filter'] == "1" && $filter != "") 
            {
                $resultset = $userModel->getRow("Select * from usuarios where username=?",$filter);
            }
            if($_REQUEST['filter'] == "2" && $filter != "")
            {
                $resultset = $userModel->getRows("Select * from usuarios where nombre like ? order by {$order}","%{$filter}%");
            }
            if($_REQUEST['filter'] == "3" && $filter != "")
            {
                $resultset = $userModel->getRows("Select * from usuarios where apellido like ? order by {$order}","%{$filter}%");
            }
            
            if($resultset != null)
            {
              echo $resultset;      
            }

        break;

        case "saveUser":
            if(isset($_REQUEST))
            {
                $userModel->username = $_REQUEST["username"];
                $userModel->password = $_REQUEST["password"];
                $userModel->dni = $_REQUEST["dni"];
                $userModel->nombre = $_REQUEST["nombre"];
                $userModel->apellido = $_REQUEST["apellido"];
                $userModel->direccion = $_REQUEST["direccion"];
                $userModel->telefono = $_REQUEST["telefono"];
                $userModel->email = $_REQUEST["email"];
                $userModel->provincia = $_REQUEST["provincia"];
                $userModel->poblacion = $_REQUEST["poblacion"];
                $userModel->codigo_postal = $_REQUEST["codigo_postal"];
                $userModel->admin = $_REQUEST["admin"];
                $guardado = $userModel->guardar();
                if($guardado != null && $guardado)
                { 
                    echo json_encode(array("mensaje"=>"Los datos han sido guardados correctamente","success"=>$guardado));
                }
                else if($guardado != null && $guardado)
                {
                    echo json_encode(array("mensaje"=>"Ha ocurrido un problema, no se han podido guardar los datos!","success"=>$guardado));
                }
                else
                {
                    echo json_encode(array("mensaje"=>"No se ha podido establecer conexión con el servidor, intente nuevamente","success"=>$guardado));
                }
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