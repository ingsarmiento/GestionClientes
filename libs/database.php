<?php
    class Database {
    
        private $db;
        private $table;

        public function __construct($table)
        {
            //$conf = require_once('../config/config.php');
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
    
        public function findAll()
        {
            $resultset = null;
            if($this->isConnectionSuccess())
            {
                $query =  $this->db->query('select * from '.$this->table.' order by id desc'); 
                if($query)
                {
                   $resultset = $this->resultset($query);
                }
            }
            return $resultset;
        }

        public function findAllOrdered($order)
        {
            $query = $this->isConnectionSuccess() ? $this->db->query('select * from '.$this->table.'Order by '."'".$order."'") : false;
            return $this->resultset($query);
        }
        public function findById($id)
        {
            $query = $this->isConnectionSuccess() ? $this->db->query('select * from '.$this->table.' where id='."'".$id."'") : false;
            $result = $query? $query->fetch_object() : null;
            return $result;
        }
    
        public function findByCriteria($filter)
        {
            $query = $this->isConnectionSuccess() ? $this->db->query('select * from '.$this->table.' where '.$filter) : false;
            return $this->resultset($query);
        }

        public function findByCriteriaOrdered($filter, $order)
        {
            $query = $this->isConnectionSuccess() ? $this->db->query('select * from '.$this->table.' where '.$filter.'order by $order') : false;
            return $this->resultset($query);
        }

        public function findOne($filter)
        {
            $query = $this->isConnectionSuccess() ? $this->db->query('select * from '.$this->table.' where '.$filter) : false;
            $result = $query? $query->fetch_object() : null;
            return $result;
        }

        public function insert($fields, $values)
        {
            $query = $this->isConnectionSuccess() ? $this->db->query('insert into '.$this->table.' ('.$fields.') values('.$values.')') : false;
            //$num_rows = $query ? $query->insert_id : 0
            return;
        }
    
        public function update($fieldsAndValues, $id){
            $query = $this->isConnectionSuccess() ? $this->db->query('update '.$this->table.' set '.$fieldsAndValues.' where id='."'".$id."'") : false;
            return;
        }
    
        public function delete($id){
             $query = $this->isConnectionSuccess() ? $this->db->query('delete from '.$this->table.' where id='."'".$id."'") : false;
             return;
        }
    
        private function resultset($query)
        {
            $resultset[] = array();
            if($query) {
                while($row = $query->fetch_object()) 
                {
                    array_push($resultset,$row);
                }
            } 
            return $resultset;
        }

        public function getValue($val)
        {
            $res = $this->getRow();
            if($res != null)
            {
                return $res->$val;
            }
            else{
                return null;
            }
        }

        public function getRow()
        {
            $query = $this->isConnectionSuccess() ? $this->db->query('select * from usuarios where username="jsarmiento"') : false;
            $row = null;
            if($query){
                $row = $query->fetch_object();
            }
            return $row;
        }

        public function getRows()
        {

            $query = $this->isConnectionSuccess() ? $this->db->query('select * from usuarios order by id desc') : false;
            $result = [];
            if($query){
               $result = $query->fetch_all();
            }
            return $result;
        }
    }                                 
?>