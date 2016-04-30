<?php
   class Router{
      private $routes = [];
      private $notFound;
      public function __construct(){
         $this->notFound = function($url){
            echo "404 - $url was not found!";
         };
      }
      public function add($url, $action){
         //$url = '/^' . str_replace('/', '\/', $url) . '$/';
         $this->routes[$url] = $action;
      }
      public function setNotFound($action){
         $this->notFound = $action;
      }
      public function dispatch(){
         //print_r($this->routes);
         //echo '<br>';
         //die();
           foreach ($this->routes as $url => $action) {
              /*
              check url and $_S is equal when the {} are ignored
              saving where is was skipped
              */
              
              //$params = '';
              
              $params = $this->parseRoute($url, $_SERVER['REQUEST_URI']);
              
              /*if ($params) {
                  print_r($params);
                 die();
              }
              echo '<br>';
              die();*/
              
               //if( $url == $_SERVER['REQUEST_URI'] ){
              if ($params) {
//                  if (preg_match($url, $_SERVER['REQUEST_URI'], $params)) {
//			         array_shift($params);
//				     return call_user_func_array($action, array_values($params));
//			      }
                  if(is_callable($action)) return $action();

                  $actionArr = explode('@', $action);
                  $controller = $actionArr[0];
                  $method = $actionArr[1];
                  return (new $controller)->$method($params);
            }
            if( $url == $_SERVER['REQUEST_URI'] ){
               if(is_callable($action)) return $action();

               $actionArr = explode('@', $action);
               $controller = $actionArr[0];
               //echo $controller;
               //die();
               $method = $actionArr[1];
               return (new $controller)->$method($params);   
            }
         }
         call_user_func_array($this->notFound,[$_SERVER['REQUEST_URI']]);
      }
      
      public function parseRoute($url, $curr_uri) {
         $route_exp = explode('/', $url);
         $url_exp = explode('/', $curr_uri);
         $params = '';
         //print_r($curr_uri_exp);
         
         foreach($url_exp as $index=>$value) {
            if (!empty($value))
            {
               if (substr( $route_exp[$index], 0, 1 ) === "{") {
                  $params[str_replace(['{', '}'], '', $route_exp[$index])] = $value;
               }
               else if ($value != $route_exp[$index])
               return false;
            }
         }
         return $params;
      }
   }
