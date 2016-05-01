<?php
   /*
   *  Displays the view to the browser
   */
   class View {
      /*
      *  Construct the view
      *
      *  @params: $view_loader - instance of view loader class
      *           $engine - instance of templating engine implemented
      */
      public function __construct($view_loader, $engine){
         $this->view_loader = $view_loader;
         $this->engine = $engine;
      }

      /*
      *  Show the view in the browser
      *
      *  @params: $view_name - name of the view to be laoded
      *           $variables - variables that need to be parsed, defaulted to empty
      */
      public function show($view_name, $variables=[]){
         echo $this->engine->parse($this->view_loader->load($view_name),
                                   $variables
                                  );
      }

      /*
      *  Redirect to another URL
      *
      *  @params: $url - URL to redirect to
      */
      public function redirect($url) {
         header('Location: ' . $url);
      }
   }
