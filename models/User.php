<?php
   /*
   *  The model for the user functions
   */
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

      public function login($username, $password) {
         $user = $this->select('*')->where('username', $username)->get();
         if($user) {
            $password = hash('sha512', $password . $user['salt']);
               if($password === $user['password']) {
                  $_SESSION['user_session'] = $user['id'];
                  return true;
               }
         } else {
            return false;
         }
      }

      public function isLoggedIn() {
         if(isset($_SESSION['user_session'])) {
            return true;
         }
      }

      public function getUser($id) {
         $user = $this->select('*')->where('username', $username)->get();

         return $user;
      }

      public function logout() {
         session_destroy();
         unset($_SESSION['user_session']);
      }

   protected function nameExists($username) {
      if($this->select('username')->where('username', $username)->get()) {
         return true;
      } else {
         return false;
      }

   }
}
