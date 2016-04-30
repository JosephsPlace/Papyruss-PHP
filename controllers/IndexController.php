<?php
   //namespace app\controllers;
   //use BaseController as BaseController;

   class IndexController extends BaseController{
      //public $db;
      
      public function index(){
         $this->view->show('test.php');
      }
      
      public function getTest($id) {
         //echo 'test: '. $this->db;
         $conn = new User();
         //$conn->connect();
         //$conn->insert('id,name', '1,phil')->set();
         print_r($conn->select('id,name')->where('id', '1')->get());
         
         //print_r($conn);
         //$conn->disconnect();
         $id['username'] = 'test';
         $this->view->show('about.php', $id);
      }
   }