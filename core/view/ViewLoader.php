<?php
   /*
   *  Loads the view
   */
   class ViewLoader{
      /*
      *  Construct the view loader
      *
      *  @params: $path - file path of the vuew to be loaded
      */
      public function __construct($path){
         $this->path = $path;
      }

      /*
      *  Load the view
      *
      *  @params: $view_name - name of the vuew to be loaded
      */
      public function load($view_name){
         $path = $this->path.$view_name;
         try {
            if( file_exists($path) ){
               return file_get_contents($path);
            }
            throw new Exception("View does not exist: ".$view_name);
         } catch (Exception $e) {
            echo $e->getMessage();
         }
      }
   }
