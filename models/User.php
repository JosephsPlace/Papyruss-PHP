<?php

   class User extends Model {
      protected $table = 'users';
      
      public function register($username, $password) {
         try {
            $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
            $password = hash('sha512', $password . $random_salt);
            
            $this->insert('username,password,salt', $username . ',' . $password . ',' . $random_salt)->set();
            
         } catch (Exception $e) {
            echo $e->getMessage();
         }
      }
      
      public function login() {
         
      }
      
      public function isLoggedIn() {
         
      }
      
      public function logout() {
         session_destroy();
         unset($_SESSION['user_session']);
         return true;
      }
      
      public function nameExists($username) {
         if($this->select('username')->where('username', $username)->get()) {
            return true;
         } else {
            return false;
         }
                  
      }
   }