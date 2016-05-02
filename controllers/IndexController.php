<?php
   class IndexController extends BaseController{

      public function index(){
         $this->view->show('test.php');
      }

      public function about(){
         if(isset($_SESSION['user_session'])) {
            $user['id'] = $_SESSION['user_session'];
         } else {
            $user['id'] = 'Not signed in';
         }
         $this->view->show('about.php', $user);
      }

      public function getTest($id) {
         $conn = new User();
         print_r($conn->select('id,name')->where('id', '1')->get());

         $id['username'] = 'test';
         $this->view->show('about.php', $id);
      }
   }
