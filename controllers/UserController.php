<?php
   class UserController extends BaseController{

      public function registerForm() {
         $this->view->show('registerForm.php');
      }

      public function registerPost() {
         $user = new User();

         $params = [];
         $username = $_POST['username'];
         $password = $_POST['password'];
         $confirm_password = $_POST['confirm_password'];

         if(!$user->nameExists($username)) {
            if ($password === $confirm_password) {
               $user->register($username, $password);
               $this->view->redirect('../../../public/');
            } else {
               $params['error'] = 'Passwords did not match.';
            }
         } else {
            $params['error'] = 'Username already exists.';
         }
         if ($params) {
            $this->view->show('registerFormPost.php', $params);
         }
      }

      public function loginForm() {
         $this->view->show('loginForm.php');
      }

      public function loginPost() {
         $user = new User();

         $username = $_POST['username'];
         $password = $_POST['password'];

         if (!$user->login($username, $password)) {
            $params['error'] = 'Username and password did not match';
            $this->view->show('loginFormPost.php', $params);
         } else {
            $this->view->redirect('../../../public/about/');
         }
      }

      public function logout() {
         $user = new User();

         $user->logout();
         $this->view->redirect('../../public/');
      }
   }
