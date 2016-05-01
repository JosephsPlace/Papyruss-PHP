<?php
   class IndexController extends BaseController{

      public function index(){
         $this->view->show('test.php');
      }

      public function getTest($id) {
         $conn = new User();
         print_r($conn->select('id,name')->where('id', '1')->get());

         $id['username'] = 'test';
         $this->view->show('about.php', $id);
      }
   }
