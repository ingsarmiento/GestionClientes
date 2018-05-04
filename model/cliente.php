<?php
require_once('../libs/database.php');
class Cliente extends Database
{
    //Identificador del cliente
    private $id; 
    //Datos del cliente
    public $dni,$nombre, $apellido, $direccion, $telefono, $email,$provincia, $poblacion, $codigo_postal, $created_at;
    private $updated_at, $deleted_at;

    public function __construct(){
        $table = "clientes";
        parent::__construct($table);
    }

    /**
     * Este metodo obtiene el id del cliente. 
     * @return $id el id del cliente.
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Este metodo establece el id del cliente.
     * @param $id id del cliente.
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * Este metodo ejecuta el método de la clase padre Database 
     * que se encarga de insertar un cliente en la base de datos.  
     */
    public function guardar()
    {
        //Instrucción SQL
        $sql = "insert into clientes(dni, nombre, apellido, direccion, telefono, email, provincia, poblacion, codigo_postal)
        values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        //Obtenemos los parametros proporcionados por el usuario.
        $params = array($this->dni, $this->nombre, $this->apellido, $this->direccion,$this->telefono,
        $this->email,$this->provincia,$this->poblacion,$this->codigo_postal);
        return $this->insert($sql, $params);
    }
    /**
     * Este metodo ejecuta el método de la clase padre Database 
     * que se encarga de actualizar los datos un cliente en la base de datos.  
     */
    public function modificar()
    { 
        //Obtenemos los parametros proporcionados por el usuario.
        $params = array($this->dni, $this->nombre, $this->apellido, $this->direccion, 
        $this->telefono, $this->email, $this->provincia, $this->poblacion, $this->codigo_postal,$this->getId());
        //Instrucción SQL
        $sql = "Update clientes set dni=?, nombre=?, apellido=?, direccion=?, telefono=?, email=?, provincia=?,
        poblacion=?, codigo_postal=? where id =?";
        //Ejecutamos la actualizacion de los datos.
        return $this->update($sql,$params);
    }

    /**
     * Este metodo Ejecuta el metodo de la clase padre Database 
     * que se encarga de borrar un registro de la base de datos.
     */
    public function borrar($id)
    {
        $this->delete($id);
    }
}
?>