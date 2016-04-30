<?php
//   class Autoload {
//      private $autoloadable = [];
//      
//      public function register($name, $loader = false) {
//         try {
//            if (is_callable($loader) || $loader == false) {
//               $this->autoloadable[$name] = $loader;
//               return;
//            } else {
//               throw new Exception('Invalid loader');
//            }
//         } catch (Exception $e) {
//            echo 'ERROR: ' . $e->getMessage();
//         }
//      }
//      
//      public function load($name) {
//         try {
//            $name = strtolower($name);
//            $path = BASEPATH . '/core/' . $name . '/' . $name . '.php';
//
//            if (!empty($this->autoloadable[$name])) {
//               return $this->autoloadable[$name]($name);
//            }
//            if (file_exists($path)) {
//               return require($path);
//            }
//               throw new Exception($name.' is not loaded or registred for autoloading');
//         } catch(Exception $e) {
//            echo 'ERROR: ' . $e->getMessage();
//         }
//      }
//   }

class Autoload {
   static public function loadViews($className) {
      $filename = BASEPATH . '/core/view/' . $className . '.php';
      //echo $filename.'<br>';
      if (file_exists($filename)) {
         require($filename);
         if (class_exists($className)) {
            return true;
         }
      }
      return false;
   }
   
   static public function loadRoutes($className) {
      $filename = BASEPATH . '/core/router/' . $className . '.php';
      //echo $filename.'<br>';
      if (file_exists($filename)) {
         require($filename);
         if (class_exists($className)) {
            return true;
         }
      }
      return false;
   }
   
   static public function loadControllers($className) {
      $filename = BASEPATH . '/controllers/' . $className . '.php';
      //echo $filename.'<br>';
      if (file_exists($filename)) {
         require($filename);
         if (class_exists($className)) {
            return true;
         }
      }
      return false;
   }
   
   static public function loadModels($className) {
      $filename = BASEPATH . '/models/' . $className . '.php';
      //echo $filename.'<br>';
      if (file_exists($filename)) {
         require($filename);
         if (class_exists($className)) {
            return true;
         }
      }
      return false;
   }
   
   static public function loadDatabases($className) {
      $filename = BASEPATH . '/database/' . $className . '.php';
      //echo $filename.'<br>';
      if (file_exists($filename)) {
         require($filename);
         if (class_exists($className)) {
            return true;
         }
      }
      return false;
   }
   
//   static public function loadCore($className) {
//      $filename = BASEPATH . '/core/' . $className . '/' . $className . '.php';
//      //echo $filename;
//      if (file_exists($filename)) {
//         require($filename);
//         if (class_exists($className)) {
//            return true;
//         }
//      }
//      return false;
//   }
}