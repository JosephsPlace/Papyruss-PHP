<?php
   class ViewLoader{
      public function __construct($path){
         $this->path = $path;
      }
      public function load($viewName){
         $path = $this->path.$viewName;
         //echo $path;
         try {
            if( file_exists($path) ){
               return file_get_contents($path);
            }
            throw new Exception("View does not exist: ".$viewName);
         } catch (Exception $e) {
            echo $e->getMessage();
         }
      }
   }