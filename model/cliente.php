<?php
require_once('/libs/database.php');
class Cliente extends Database
{
    private $id; 
    public $dni,$nombre, $apellido, $direccion, $telefono, $email, $created_at;
    private $updated_at, $deleted_at;

    public function __construct(){
        $table = "usuarios";
        parent::__construct($table);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function guardar()
    {
        $fields = 'dni, nombre, apellido, direccion, telefono, email, admin';
        $values = "'".$dni."',"."'".$nombre."',"."'".$apellido."',"."'".$direccion."',".
        "'".$telefono."',"."'".$email."'";
        $this->insert($fields, $values);
    }

    public function modificar($id)
    {
        $fieldsAndValues = "dni='".$dni."',"."nombre='".$nombre."',"."apellidos='".$apellido."',".
        "direccion='".$direccion."',"."telefono='".$telefono."',"."email='".$email."'";
        $this->update($fieldsAndValues, $id);
    }

    public function borrar($id)
    {
        $this->delete($id);
    }
}
?>