<?php
    
    include('config.php');

//Esta clase define las operaciones sobre las base de datos
class Database extends mysqli{

    private static $instance = null;

    //Connection Variables
    private $host = DB_HOST;
    private $username = USERNAME;
    private $password = PASSWORD;
    private $dbName = DB_NAME;

    //This method must be static, and must return an instance of the object if the object
    //does not already exist.
    public static function getInstance() {
        if (!self::$instance instanceof self) {
                self::$instance = new self;
        }
            return self::$instance;
    }

    // The clone and wakeup methods prevents external instantiation of copies of the Singleton class,
    // thus eliminating the possibility of duplicate objects.
    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
    public function __wakeup() {
        trigger_error('Deserializing is not allowed.', E_USER_ERROR);
    }

    public function __construct()
    {
        parent::__construct($this->host,$this->username,$this->password,$this->dbName);
        if(mysqli_connect_error())
        {
            exit('Error de conexión: ('.mysqli_connect_errno.') '.mysqli_connect_error);
        }
        parent::set_charset('utf-8');
    }

    /*
    * Esta función verifica si la conexión ha tenido éxito.
    */
    private function isConnectionSuccesfully(){
        return !$this->connect_errno;
    }

    /**
     * Esta función devuelve los resultados de una consulta a una o más tablas. 
     * @param string $tables nombre de la tabla o conjunto de nombres de las tablas a consultar.
     * @param string $fields campo o conjunto de campos a consultar en la tabla, 
     * estos deben ir separados por (,) suvalor puede ser (*) si queremos consultar
     *  todos los campos de la tabla.
     * @param string $conditions criterios de consulta a la tabla.
     * @param string $orderBy campo o listado de campos por los que queremos ordenar
     *  el o los resultados de la consulta. 
     * @param int $limit parametro de tipo entero que nos permite decidir la cantidad de
     *  registros que queremos que se nos muestre.
     * @return $result un array que puede contener uno o mas registros.
     */
    public function select(string $tables, string $fields, string $conditions, string $orderBy, int $limit) {

        $sql ='SELECT  '.$fields.' FROM '.$tables;
        $sql .= !empty($conditions)? ' WHERE '.$conditions : '';
        $sql .= !empty($orderBy)? $orderBy : '';
        $sql .= $limit > 0? ' limit '+ $limit : '';
        $result = null;
        $result = $this->isConnectionSuccesfully()? $this->query($sql) : false;
        return $result;
    }

        /**
         * Esta funcion ejecuta la insersión de un registro en una tabla.
         * @param string $table nombre de la tabla en la cual queremos insertar nuestro registro.
         * @param string $fields campo o conjunto de campos que queremos insertar en la tabla.
         * @param $values valor o conjunto de valores que queremos guardar en los campos de la tabla.
         * @param $result numero de filas insertadas.
         */
        public function insert(string $table, string $fields, string $values)
        {
            $result = $this->isConnectionSuccesfully()? $this->query('INSERT INTO '.$table.'('.$fields.')'.'VALUES('.$values.')') : false;
            $result ? $result->affected_rows(): 0;
        }

        /**
         * Esta función Actualiza un registro en la base de datos.
         * @param string $table nombre de la tabla donde queremos actualizar nuestro registro.
         * @param string $fieldsValues nombre del campo o nombres de conjunto de campos a actualizar
         * con sus respectivos valores.
         * @param int $id identificador del registro a actualizar.
         * @return $result numero de filas afectadas que en nuestro caso solo debe ser 1. 
         */
        public function update(string $table, string $fileldsValues, int $id)
        {
            $result = $this->isConnectionSuccesfully() ? $this->query('UPDATE table '.$table.' SET '.$fieldsValues.')'.'WHERE id = '.$id) : false;
            return $result ? $result->affected_rows(): 0;
        }

        /**
         * Esta funcion borra un registro de una tabla.
         * @param string $table nombre de la tabla de donde queremos borrar el registro.
         * @param int $id identificador del registro a borrar;
         */
        public function delete(string $table, int $id){
            $result = $this->isConnectionSuccesfully()? $this->query('DELETE FROM TABLE '.$table.' WHERE id='.$id): false;
            return $result ? $result->affected_rows(): 0;
        }
}                                   
?>