<?php
   /*
   *  The base model
   */
   class Model {
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
         $stmt = $this->pdo->prepare($this->query);

         for ($i = 0; $i < sizeof($this->values); $i++) {
            $stmt->bindParam(($this->bind_values[$i]),  $this->values[$i]);
         }
         $stmt->execute();
      }

      public function get() {


         $stmt = $this->pdo->prepare($this->query);
         if(!empty($this->bind_values)) {
            for ($i = 0; $i < sizeof($this->values); $i++) {
               $stmt->bindParam(($this->bind_values[$i]),  $this->values[$i]);
            }
         }

         $stmt->execute();

         $results = $stmt->fetch();

         return $results;
      }

      public function insert($columns, $values) {
         $values = explode(',', $values);
         for ($j = 0; $j < sizeof($values); $j++) {
            $this->bind_values[$j] = ':'.$j;
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

         return $this;
      }
   }
