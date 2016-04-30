<?php
   class View {

      public function __construct($viewLoader, $engine){
         $this->viewLoader = $viewLoader;
         $this->engine = $engine;
      }
      
      public function show($viewName, $variables=[]){
         echo $this->engine->parse($this->viewLoader->load($viewName),
                                   $variables
                                  );
      }
      
      public function redirect($url) {
         header('Location: ' . $url); 
      }
   }
