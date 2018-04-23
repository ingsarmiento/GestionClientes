<?php
    session_start();
    include('database.php');
    $db = new Database();
    $query = null;
    $conditions = null;
    $order = $_REQUEST['order'];
    switch($_REQUEST['action']){
        case 'getUsers':
            if($_REQUEST['filter'] == "0"){
                $query = $db->select("usuarios","*","",$order,0);
            }
            if($query){
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
            }
        break;
    }
?>