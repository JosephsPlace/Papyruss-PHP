<?php
   //namespace com\papyruss\controllers;

   class BaseController {
      
      public function __construct() {
         $helpers = [
            'sum' => function($x, $y) {
               return $x + $y;
            }
         ];
         
         $this->view = new View( new ViewLoader(BASEPATH.'/views/'), new Templating($helpers));
      }
      
      //print_r($pdo);
   }
