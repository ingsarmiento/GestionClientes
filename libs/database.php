<?php
    class Database {
    
        private $db;
        private $table;
        private $resultset;
        public function __construct($table)
        {
            $this->db = new mysqli('localhost','root','root','pruebadb');
            $this->table = (string) $table;
        }
    
        public function isConnectionSuccess()
        {
            if(!$this->db->connect_error){
                return true;
            }
            return false;
        }

        public function insert($sql, $params)
        {
            if($this->isConnectionSuccess())
            {
                $query = $this->db->prepare($sql);
                foreach($params as $p)
                {
                    $query->bind_param($this->valueType($p),$p);
                }
                $query->execute();
                if($query)
                {
                    return $query->affected_rows();
                }
                else
                {
                    return 0;
                }
            }
            else
           {
                return null;
           }
        }
    
        public function update($sql, $params)
        {
            if($this->isConnectionSuccess())
            {
                $query = $this->db->prepare($sql);
                foreach($params as $p)
                {
                    $query->bind_param($this->valueType($p),$p);
                }
                $query->execute();
                if($query)
                {
                    return $query->affected_rows();
                }
                else
                {
                    return 0;
                }
            }
            else
           {
                return null;
           }
        }
    
        public function delete($id)
        {
            if($this->isConnectionSuccess()){
                $query = $this->db->prepare("delete from {$this->table} where id=?");
                $query->bind_param('i',(int)$id);
                $query->execute();
                if($query){
                    return (int) $query->affected_rows();
                }
                else
                {
                    return 0;
                }
            }
            else
            {
                return null;
            }
        }

        public function getCount()
        {  
            $row = null;
            if($this->isConnectionSuccess()){
                $query = $this->db->query("select count(*) c from {$this->table}");
                if($query)
                {
                    $row = $query->fetch_assoc();
                }
            }
            return (int)$row['c'];
        }

        public function getRow($sql, $params = '')
        {
            if($this->isConnectionSuccess())
            {
                //Esta variable almacena los resultados obtenidos.
                $result = [];
                $query = $this->db->stmt_init();
                if($query->prepare($sql))
                {
                    //Verificamos que se haya introducido algun criterio de selección;
                    if($params != '')
                    {
                        //Si pasamos un conjunto de valores se recorre el array y se enlaza cada parametro con la consulta. 
                        if(is_array($params)){
                            $s = '';
                            foreach($params as $p){
                                $s .= $this->valueType($p);
                            }
                            echo $s;
                            $query->bind_params($s, $p); //Revisar este apartado
                        }//Si se trata de un solo valor se enlaza dicho parametro.
                        else
                        {
                             $query->bind_param($this->valueType($params),$params);
                        }
                    }
                     $query->execute(); 
                     $res = $query->get_result();
                     $result = $res->fetch_assoc();
                }
                return $result;
            }
            else
            {
                return null;
            }
        }

        public function getRows($sql, $params = '')
        {
            if($this->isConnectionSuccess())
            {
                //Esta variable almacena los resultados obtenidos.
                $result = [];
                $query = $this->db->stmt_init();
                if($query->prepare($sql))
                {
                    //Verificamos que se haya introducido algun criterio de selección;
                    if($params != '')
                    {
                        //Si pasamos un conjunto de valores se recorre el array y se enlaza cada parametro con la consulta. 
                        if(is_array($params)){
                            foreach($params as $p){
                                $query->bind_param($this->valueType($p),$p);
                            }
                        }//Si se trata de un solo valor se enlaza dicho parametro.
                        else
                        {
                             $query->bind_param($this->valueType($params),$params);
                        }
                    }
                     $query->execute(); 
                     $res = $query->get_result();
                     while($row = $res->fetch_assoc()){
                        array_push($result, $row);
                     }
                }
                return $result;
            }
            else
            {
                return null;
            }
        }

        private function valueType($value)
        {
            $result = gettype($value);
            switch($result){
                case 'string':
                    return 's';
                    break;
                case 'integer':
                    return 'i';
                    break;
                case 'double':
                    return 'd';
                    break;
                case 'object':
                    return 'o';
                    break;
                case 'boolean':
                    return 'b';
                    break;
                case 'null':
                    return 'n';
                    break;
                case 'array':
                    return 'a';
                    break;
                case 'resource':
                    return 'r';
                    break;
            }
        }
    }                                 
?>