<?php

class Model {
   //protected $pdo;
   protected $pdo;
   protected $table;
   protected $query;
   protected $values = [];
   protected $bind_values = [];
   
   public function __construct() { 
      try {
         $this->pdo = new PDO(DB_PDODRIVER .':host='. DB_HOST .';dbname='. DB_NAME .'', DB_USER, DB_PASS);;
      } catch (Exception $e) {
         echo 'Connection failed: ' . $e->getMessage();
      }
   }
   
   public function connect() {
      try {
         $this->pdo = new PDO(DB_PDODRIVER .':host='. DB_HOST .';dbname='. DB_NAME .'', DB_USER, DB_PASS);
      } catch (Exception $e) {
         echo 'Connection failed: ' . $e->getMessage();
      }
   }
   
   public function disconnect() {
      $this->pdo = null;
   }
   
   public function set() {
      //echo $this->query;
      $stmt = $this->pdo->prepare($this->query);
      //print_r($stmt);
      //dd($this->values);
      for ($i = 0; $i < sizeof($this->values); $i++) {
         $stmt->bindParam(($this->bind_values[$i]),  $this->values[$i]);
         //echo $this->bind_values[$i] . ' ' . $this->values[$i] . '<br>';
      }
      //die();
      $stmt->execute();
   }
   
   public function get() {
      //dd($this->db_conn);
      $stmt = $this->pdo->prepare($this->query);
      //dd($this->bind_values);
      if(!empty($this->bind_values)) { //echo 'here';
         for ($i = 0; $i < sizeof($this->values); $i++) {
            $stmt->bindParam(($this->bind_values[$i]),  $this->values[$i]);
            //echo $this->bind_values[$i] . ' ' . $this->values[$i] . '//';
         }
      }
      
      $stmt->execute();
      
      $results = $stmt->fetchAll();
      //print_r($results);
      //echo $this->query;
      //dd($results);
      //echo $this->query;
      //print_r($results);
      
      return $results;
   }
   
   public function insert($columns, $values) {
      $values = explode(',', $values);
//      foreach($values as $value) {
//         array_push($this->bind_values, ':' . $value);
//      }
      for ($j = 0; $j < sizeof($values); $j++) {
         //array_push($this->bind_values, ':' . $j);
         $this->bind_values[$j] = ':'.$j;
         //echo $this->bind_values[$j] . ' - first <br>';
      }
      
      $values_list = implode(',', $this->bind_values);
      $this->query = 'INSERT INTO ' . $this->table . '(' . $columns . ') VALUES (' . $values_list . ')';
      $this->values = $values;
      
      return $this;
   }
   
   public function select($columns) {
      $this->query = 'SELECT ' . $columns . ' FROM ' . $this->table;
      
      return $this;
   }
   
   public function where($column, $value, $operator = '=') {
      switch ($operator) {
         case '<':
         case '>':
         case '!=':
         case '<=':
         case '>=':
            $operator = $operator;
            break;
         default:
            $operator = '=';
      }
      
      $this->query = $this->query . ' WHERE ' . $column . $operator .':'.$value;
      array_push($this->bind_values, ':' . $value);
      array_push($this->values, $value);
      //echo $this->query;
      
      return $this;
   }
}