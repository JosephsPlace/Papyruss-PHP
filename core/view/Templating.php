<?php

   class Templating {
      public function __construct($functions) {
         $this->functions = $functions;
      }
      
      public function addHelpers(&$view) {
         $view = preg_replace_callback('/({)({)((?:[a-zA-Z0-9_,->()s]*))(})(})/', function($match) {
            $func_exp = explode('->', $match[3]);
            $function = trim($func_exp[0]);
            $params = explode(',', trim($func_exp[1]));
            
            return call_user_func_array($this->functions[$function], $params);
         }, $view);
      }
      
      public function replaceVars(&$view, $variables) {
         $view = preg_replace_callback('/({)({)((?:[a-zA-Z]*))(})(})/',
                                      function($match) use ($variables){
                                         return $variables[$match[3]];
                                      }, $view);
      }
      
      public function parse($view, $variables) {
         $this->replaceVars($view, $variables);
         $this->addHelpers($view);
         
         return $view;
      }
   }