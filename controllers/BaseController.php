<?php
   class BaseController {

      public function __construct() {
         $helpers = [
            'sum' => function($x, $y) {
               return $x + $y;
            },
            'array' => function($x) {
               $str = implode(",", $x);

               return $x;
            }
         ];

         $this->view = new View( new ViewLoader(BASEPATH.'/views/'), new Templating($helpers));
      }
   }
