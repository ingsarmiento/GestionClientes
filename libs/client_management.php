<?php
    require('../model/cliente.php');

    $clientModel = new Cliente();
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
        
        case 'getClients':
            $resultset = null;
            if($_REQUEST['filter'] == "0")
            {
                $resultset = $clientModel->getRows("Select * from clientes order by {$order}");
            }
            if($_REQUEST['filter'] == "1" && $filter != "") 
            {
                $resultset = $clientModel->getRow("Select * from clientes where dni=?","{$filter}");
            }
            if($_REQUEST['filter'] == "2" && $filter != "")
            {
                $resultset = $clientModel->getRows("Select * from clientes where nombre like ? order by {$order}","%{$filter}%");
            }
            if($_REQUEST['filter'] == "3" && $filter != "")
            {
                $resultset = $clientModel->getRows("Select * from clientes where apellido like ? order by {$order}","%{$filter}%");
            }
            
            if($resultset != null)
            {
              echo $resultset;      
            }

        break;

        case 'getClient':
                $resulset = null;
                if(isset($_GET))
                {
                    $resultset = $userModel->getRow("Select dni, nombre, apellido, direccion, provincia, poblacion, codigo_postal, telefono, email from clientes where id=?",$_REQUEST['id']);
                    if($resultset != null)
                    {
                       echo $resultset;
                    } 
                }
        break;

        case "saveClient":
            if(isset($_REQUEST))
            {
                $clientModel->dni = $_REQUEST["dni"];
                $clientModel->nombre = $_REQUEST["nombre"];
                $clientModel->apellido = $_REQUEST["apellido"];
                $clientModel->direccion = $_REQUEST["direccion"];
                $clientModel->telefono = $_REQUEST["telefono"];
                $clientModel->email = $_REQUEST["email"];
                $clientModel->provincia = $_REQUEST["provincia"];
                $clientModel->poblacion = $_REQUEST["poblacion"];
                $clientModel->codigo_postal = $_REQUEST["codigo_postal"];
                //$clientModel->created_at = $_REQUEST["created_at"];
                $guardado = $clientModel->guardar();
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

        case "updateClient":
            if(isset($_POST))
            {
                $clientModel->setId($_REQUEST["id"]);
                $clientModel->dni = $_REQUEST["dni"];
                $clientModel->nombre = $_REQUEST["nombre"];
                $clientModel->apellido = $_REQUEST["apellido"];
                $clientModel->direccion = $_REQUEST["direccion"];
                $clientModel->telefono = $_REQUEST["telefono"];
                $clientModel->email = $_REQUEST["email"];
                $clientModel->provincia = $_REQUEST["provincia"];
                $clientModel->poblacion = $_REQUEST["poblacion"];
                $clientModel->codigo_postal = $_REQUEST["codigo_postal"];
                $modificado = $clientModel->modificar();
                if($modificado != null && $modificado)
                { 
                    echo json_encode(array("mensaje"=>"Los cambios han sido guardados correctamente","success"=>$modificado));
                }
                else if($modificado != null && $modificado)
                {
                    echo json_encode(array("mensaje"=>"Ha ocurrido un problema, no se han podido guardar los cambios!","success"=>$modificado));
                }
                else
                {
                    echo json_encode(array("mensaje"=>"No se ha podido establecer conexión con el servidor, intente nuevamente","success"=>$modificado));
                }
            }
        break;

        case "deleteClient":
            if(isset($_REQUEST)){
                $clientModel->setId($_REQUEST['id']);
                $borrado = $clientModel->borar();
                if($borrado != null && $borrado)
                { 
                    echo json_encode(array("mensaje"=>"El registro ha sido borrado de la base de datos","success"=>$borrado));
                }
                else if($borrado != null && $borrado)
                {
                    echo json_encode(array("mensaje"=>"Ha ocurrido un problema, no se han podido borrar el registro de la base de datos!","success"=>$borrado));
                }
                else
                {
                    echo json_encode(array("mensaje"=>"No se ha podido establecer conexión con el servidor, intente nuevamente","success"=>$borrado));
                }
            }
        break;
    }
?>