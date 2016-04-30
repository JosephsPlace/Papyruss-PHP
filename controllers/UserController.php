<?php
   //namespace app\controllers;
   //use BaseController as BaseController;

   class UserController extends BaseController{
      
      public function registerForm() {
         $this->view->show('registerForm.php');
      }
      
      public function registerPost() {
         $user = new User();
         
         $errors = [];
         $username = $_POST['username'];
         $password = $_POST['password'];
         $confirm_password = $_POST['confirm_password'];
         
         if(!$user->nameExists($username)) {
            if ($password === $confirm_password) {
               $user->register($username, $password);
               $this->view->redirect('../../');
            } else {
               array_push($errors, 'Passwords did not match');
            }
         } else {
            array_push($errors, 'Username already exists');
         }
         //echo $_POST['username'];
         //die();
         
      }
   }