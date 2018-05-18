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
                $resultset = $userModel->getRows("Select * from usuarios order by {$order} limit 100");
            }
            if($_REQUEST['filter'] == "1" && $filter != "") 
            {
                $resultset = $userModel->getRow("Select * from usuarios where username=?",$filter);
            }
            if($_REQUEST['filter'] == "2" && $filter != "")
            {
                $resultset = $userModel->getRows("Select * from usuarios where nombre like ? order by {$order} limit 100","%{$filter}%");
            }
            if($_REQUEST['filter'] == "3" && $filter != "")
            {
                $resultset = $userModel->getRows("Select * from usuarios where apellido like ? order by {$order} limit 100","%{$filter}%");
            }

            echo $resultset;      

        break;

        case 'getUser':
                $resultset = null;
                if(isset($_GET))
                {
                    $resultset = $userModel->getRow("Select username, dni, nombre, apellido, direccion, provincia, poblacion, codigo_postal, telefono, email, admin from usuarios where id=?",$_REQUEST['id']);
                    if($resultset != null)
                    {
                       echo $resultset;
                    } 
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
                $userModel->created_at = $_REQUEST["created_at"];
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

        case "updateUser":
        if(isset($_POST))
        {
            $userModel->setId($_REQUEST["id"]);
            $userModel->username = $_REQUEST["username"];
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
            $modificado = $userModel->modificar();

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

        case "deleteUser":
            if(isset($_REQUEST)){
                $userModel->setId($_REQUEST['id']);
                $borrado = $userModel->borrar();
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

        case 'changePassword':
            if(isset($_POST))
            {
                session_start();
                $username = $_SESSION['username'];
                $currentPassword = $_REQUEST['current_password'];
                $newPassword = $_REQUEST['new_password'];
                $confirmPassword = $_REQUEST['confirm_password'];

                //Verificacion de la contraseña actual.
                $resultset = $userModel->getRow('select * from usuarios where username=?', $username);
                if($resultset != null && $resultset)
                {
                    $resultObject = json_decode($resultset);
                    $password = $resultObject->password;
                    if($password == $currentPassword)
                    {
                        if($newPassword == $confirmPassword)
                        {
                            $userModel->username = $username;
                            $userModel->password = $newPassword;
                            $modificado = $userModel->cambiarPassword();
                            if(!is_null($modificado) && $modificado)
                            { 
                                echo json_encode(array("mensaje"=>"La contraseña ha sido cambiada con exito!","success"=>$modificado));
                            }
                            else
                            {
                                echo json_encode(array("mensaje"=>"Ha habido un error, no se ha podido actualizar la contraseña","success"=>false));
                            }
                        }
                        else
                        {
                            echo json_encode(array("mensaje"=>"La contraseña actual no coincide con el usuario","success"=>false));
                        }
                    }
                }
            }
        break;
    }
?>