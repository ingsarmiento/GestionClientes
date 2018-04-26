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

    public function setId($id){
        $this->id = $id;
    }

    public function guardar()
    {
        $sql = "insert into usuarios(username, password, dni, nombre, apellido, direccion, telefono, email, admin)
        values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $params = array($this->username, $this->password, $this->dni, $this->nombre, $this->apellido, $this->direccion,
         $this->telefono, $this->email, $this->admin);
        return $this->insert($sql, $params);
    }

    public function modificar()
    {
        //Obtenemos los parametros proporcionados por el usuario.
        $params = array($this->username, $this->dni, $this->nombre, $this->apellido, $this->direccion, 
        $this->telefono, $this->email, $this->admin,$this->id);
        $sql = "Update usuarios set username=?, dni=?, nombre=?, apellido=?, direccion=?, telefono=?, 
        email=?, admin=? where id = ?";
        //Ejecutamos la actualizacion de los datos.
        return $this->update($sql,$params);
    }

    public function borrar($id)
    {
        return $this->delete($id);
    }

    /*public function getRows($sql, $params = ''){
        
        $resultset = $this->getRows($sql, $params); 

        $rows = "";
        if($resultset != []){
            foreach($resultset as $user){
                $rows .= '<tr>'
                .'<td>'. $user['nombre'] .'</td>'
                .'<td>'. $user['apellido'] .'</td>'
                .'<td>'. $user['direccion'] .'</td>'
                .'<td>'. $user['telefono'] .'</td>'
                .'<td>'. $user['username'] .'</td>'
                .'<td>'. $user['created_at'] .'</td>'
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