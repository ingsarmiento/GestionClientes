<?php
    class Database {
    
        private $db;
        private $table;

        public function __construct($table)
        {
            $this->db = new mysqli('localhost','root','','pruebadb');
            mysqli_set_charset($this->db,"utf8");
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
                call_user_func_array(array($query, 'bind_param'), $this->bindParameters($params));
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
                call_user_func_array(array($query, 'bind_param'), $this->bindParameters($params));
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
                $query->bind_param('i',$id);
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
                        if(is_array($params))
                        {
                            call_user_func_array(array($query, 'bind_param'), $this->bindParameters($params));
                        }//Si se trata de un solo valor se enlaza dicho parametro.
                        else
                        {
                             $query->bind_param($this->valueType($params),$params);
                        }
                    }
                     $query->execute(); 
                     $res = $query->get_result();
                     if($res){
                        $result = $res->fetch_object();
                     }
                    
                }
                return json_encode($result,JSON_UNESCAPED_UNICODE);
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
                            call_user_func_array(array($query, 'bind_param'), $this->bindParameters($params));
                        }//Si se trata de un solo valor se enlaza dicho parametro.
                        else
                        {
                             $query->bind_param($this->valueType($params),$params);
                        }
                    }
                     $query->execute(); 
                     $res = $query->get_result();
                     while($row = $res->fetch_object()){
                        array_push($result, $row);
                     }
                }
                return json_encode($result,JSON_UNESCAPED_UNICODE);
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

        private function bindParameters($params)
        {
            $s = '';
            $a_params = array();
            $n = count($params);
            foreach($params as $p){
                $s .= $this->valueType($p);
            }
                            
            $a_params[] = & $s;
            for($i = 0; $i < $n; $i++ ){
                $a_params[] = & $params[$i];
            }

            return $a_params;
        }
    }                                 
?>