<?php

include('../libs/database.php');

class User {

    public $tableName = 'usuarios';
    protected $id_usuario;
    public $username;
    public $password;
    public $nombre;
    public $apellido;
    public $direccion;
    public $telefono;
    public $email;
    public $is_admin;
    protected $created_at;
    protected $update_at;
    protected $deleted_at;

    public function __costruct(){

    }

    public function __costruct1($username, $password,$nombre,$nombre,$apellido,$direccion,$telefono,$email,$is_admin){
        $this->username = $username;
        $this->password = $password;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->is_admin = $is_admin;
    }

    public function findUser()
    {
        
    }

}
?>