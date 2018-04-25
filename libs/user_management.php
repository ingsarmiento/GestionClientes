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
            if($_REQUEST['filter'] == "0"){
                $resultset = $userModel->findAllOrdered($order);
                if($resultset != [])
                {
                    //var_dump($resultset);
                    //echo ' exito ';
                    //echo $userModel->getRows($resultset);
                }
            }
            if($_REQUEST['filter'] == "1"){
                $query = $db->select("usuarios","*",' usuario = '."'".$filter."'",'',0);
            }
            if($_REQUEST['filter'] == "2"){
                $query = $db->select("usuarios","*",' nombre = '."'".$filter."'",$order,0);
            }
            if($_REQUEST['filter'] == "3"){
                $query = $db->select("usuarios","*",' apellido = '."'".$filter."'",$order,0);
            }
            
            /*if($query){
                while($user = $query->fetch_object())
                {
                    echo '<tr>'
                            .'<td>'. $user->nombre .'</td>'
                            .'<td>'. $user->apellido .'</td>'
                            .'<td>'. $user->direccion .'</td>'
                            .'<td>'. $user->telefono .'</td>'
                            .'<td>'. $user->username .'</td>'
                            .'<td>'. $user->created_at .'</td>'
                            .'<td><i class="fas fa-search"><a href="libs/user_management.php?action=getUserDetails&id="'.$user->id_usuario.'> </a></i></td>'
                            .'<td><i class="fas fa-edit"><a href="libs/user_management.php?action=editUser&id="'.$user->id_usuario.'> </a></i></td>'
                            .'<td><i class="fas fa-trash-alt"><a href="libs/user_management.php?action=deleteUser&id="'.$user->id_usuario.'> </a></i></td>'.
                        '</tr>';
                }
            }*/
        break;
    }
?>