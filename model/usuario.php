<?php
require_once('../libs/database.php');
class Usuario extends Database
{
    private $id; 
    public $username, $password,$dni,$nombre, $apellido, $direccion, $telefono, $email, $admin, $created_at;
    private $updated_at, $deleted_at;

    public function __construct(){
        $table = "usuarios";
        parent::__construct($table);
    }

    public function getId()
    {
        return $this->id;
    }

    public function guardar()
    {
        $fields = 'username, password, dni, nombre, apellido, direccion, telefono, email, admin';
        $values = "'".$username."',"."'".$password."',"."'".$dni."',"."'".$nombre."',"."'".$apellido."',".
        "'".$direccion."',"."'".$telefono."',"."'".$email."',"."'".$admin."'";
        $this->insert($fields, $values);
    }

    public function modificar($id)
    {
        $fieldsAndValues = "username='".$username."',"."dni='".$dni."',"."nombre='".$nombre."',"."apellidos='".$apellido."',".
        "direccion='".$direccion."',"."telefono='".$telefono."',"."email='".$email."',"."admin='".$admin."'";
        $this->update($fieldsAndValues, $id);
    }

    public function borrar($id)
    {
        $this->delete($id);
    }

    /*public function getRows($resultset){
        
        $rows = "";
        if($resultset != []){
            foreach($resultset as $user){
                $rows .= '<tr>'
                .'<td>'. $user->nombre .'</td>'
                .'<td>'. $user->apellido .'</td>'
                .'<td>'. $user->direccion .'</td>'
                .'<td>'. $user->telefono .'</td>'
                .'<td>'. $user->username .'</td>'
                .'<td>'. $user->created_at .'</td>'
                .'<td><a href="libs/user_management.php?action=getUserDetails&id="'.$user->id.'> Detalles </a></td>'
                .'<td><a href="libs/user_management.php?action=editUser&id="'.$user->id.'> </a>Modificar</td>'
                .'<td><a href="libs/user_management.php?action=deleteUser&id="'.$user->id.'> </a>Borrar</td>'.
            '</tr>';
            }
        }

        return $rows;
    }*/
}
?>