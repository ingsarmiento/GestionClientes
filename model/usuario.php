<?php
require_once('../libs/database.php');
class Usuario extends Database
{
    private $id; 
    public $username, $password,$dni,$nombre, $apellido, $direccion, $provincia, $poblacion, $codigo_postal, $telefono, $email, $admin, $created_at;
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
        $sql = "insert into usuarios(username, password, dni, nombre, apellido, direccion, provincia, poblacion, codigo_postal, telefono, email, admin)
        values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $params = array($this->username, $this->password, $this->dni, $this->nombre, $this->apellido, $this->direccion,
        $this->provincia, $this->poblacion, $this->codigo_postal, $this->telefono, $this->email, $this->admin);
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
}
?>