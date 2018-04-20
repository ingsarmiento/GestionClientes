<?php
    
    include('config.php');

//Esta clase define las operaciones sobre las base de datos
class Database {

        /*
        * Esta función verifica si la conecion ha tenido éxito.
        */
        private function isConnectionSuccesfully(){
            return !$db->connect_errno;
        }

        /**
         * Esta función devuelve los resultados de una consulta a una o más tablas. 
         * @param String $tables nombre de la tabla o conjunto de nombres de las tablas a consultar.
         * @param String $fields campo o conjunto de campos a consultar en la tabla, 
         * estos deben ir separados por (,) suvalor puede ser (*) si queremos consultar
         *  todos los campos de la tabla.
         * @param String $conditions criterios de consulta a la tabla.
         * @param String $orderBy campo o listado de campos por los que queremos ordenar
         *  el o los resultados de la consulta. 
         * @param int $limit parametro de tipo entero que nos permite decidir la cantidad de
         *  registros que queremos que se nos muestre.
         * @return $result un array que puede contener uno o mas registros.
         */
        public function select(String $tables, String $fields, String $conditions, String $orderBy, int $limit) {
            $sql ='SELECT  '.$fields.'FROM'.$tables;
            if(!empty($conditions))
            {
                $sql .=' WHERE '.$conditions;
            }
            if(!empty($orderBy))
            {
                $sql .=$orderBy;
            }
            if($limit > 0)
            {
                $sql .= ' limit '+ $limit;
            }
            if(isConnectionSuccesfully()){
                $result = $db->query($sql);
                return $result->fetch_all();
            }
            return null;
        }

        /**
         * Esta funcion ejecuta la insersión de un registro en una tabla.
         * @param String $table nombre de la tabla en la cual queremos insertar nuestro registro.
         * @param String $fields campo o conjunto de campos que queremos insertar en la tabla.
         * @param $values valor o conjunto de valores que queremos guardar en los campos de la tabla.
         * @param $result numero de filas insertadas.
         */
        public function insert(String $table, String $fields, String $values)
        {
            if(isConnectionSuccesfully()){
                $result = $db->query('INSERT INTO '.$table.'('.$fields.')'.'VALUES('.$values.')');
                return $result->affected_rows();
            }
           return 0;
        }

        /**
         * Esta función Actualiza un registro en la base de datos.
         * @param String $table nombre de la tabla donde queremos actualizar nuestro registro.
         * @param String $fieldsValues nombre del campo o nombres de conjunto de campos a actualizar
         * con sus respectivos valores.
         * @param int $id identificador del registro a actualizar.
         * @return $result numero de filas afectadas que en nuestro caso solo debe ser 1. 
         */
        public function update(String $table, String $fileldsValues, int $id)
        {
            if(isConnectionSuccesfully()){
                if($result = $db->query('UPDATE table '.$table.' SET '.$fieldsValues.')'.'WHERE id = '.$id)){
                    return $result->affected_rows();
                }
                return 0;
            }
           
        }

        /**
         * Esta funcion borra un registro de una tabla.
         * @param String $table nombre de la tabla de donde queremos borrar el registro.
         * @param int $id identificador del registro a borrar;
         */
        public function delete(String $table, int $id){
             if(isConnectionSuccesfully()){
                 if($result = $db->query('DELETE FROM TABLE '.$table.' WHERE id='.$id)){
                     return $result->affected_rows();
                 }
                 return 0;
             }
        }
}                                   
?>