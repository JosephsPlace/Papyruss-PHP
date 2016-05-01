<?php
   /*
   *  Loads all classes based. New function is required for each new filename
   *  structure.
   */
   class Autoload {

      /*
      *  Main load function, holds logic for requiring the classes
      *
      *  @params: $filename - name of the class's file
      *           $class_name - name of the class inside the file
      */
      static public function load($filename, $class_name) {
         if (file_exists($filename)) {
            require($filename);
            if (class_exists($class_name)) {
               return true;
            }
         }
         return false;
      }

      /*
      *  The functions that define the different folders for classes
      *
      *  @params: $class_name - name of the class to be autoloaded
      */
      public static function loadViews($class_name) {
         $filename = BASEPATH . '/core/view/' . $class_name . '.php';
         self::load($filename, $class_name);
      }

      public static function loadRoutes($class_name) {
         $filename = BASEPATH . '/core/router/' . $class_name . '.php';
         self::load($filename, $class_name);
      }

      public static function loadControllers($class_name) {
         $filename = BASEPATH . '/controllers/' . $class_name . '.php';
         self::load($filename, $class_name);
      }

      public static function loadModels($class_name) {
         $filename = BASEPATH . '/models/' . $class_name . '.php';
         self::load($filename, $class_name);
      }

      public static function loadDatabases($class_name) {
         $filename = BASEPATH . '/database/' . $class_name . '.php';
         self::load($filename, $class_name);
      }
   }
