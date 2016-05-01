<?php
   /*
   *  Routing function for better display of URLs
   */
   class Router{
      private $routes = [];
      private $notFound;

      /*
      *  Triggers when the URL entered is not in $routes array
      */
      public function __construct(){
         $this->notFound = function($url){
            echo $url . ' was not found!';
         };
      }

      /*
      *  Adds URL fromt he routes.php file to the $routes array
      *
      *  @params: $url - name of the URL
      *           $action - controller to call upon execution
      */
      public function add($url, $action){
         $this->routes[$url] = $action;
      }

      /*
      *  Only called if the URL entered is not in $routes array
      */
      public function setNotFound($action){
         $this->notFound = $action;
      }

      /*
      *  Checks if the entered URL is in $routes array and if so,
      *  loads the correct controller
      */
      public function dispatch(){

           foreach ($this->routes as $url => $action) {

              $params = self::parseRoute($url, $_SERVER['REQUEST_URI']);

            // If there are URL parameters or if the url entered is in $routes
              if ($params || $url === $_SERVER['REQUEST_URI']) {
                  if(is_callable($action)) return $action();
                  
                  //Separate  the url and the controller name
                  $action = explode('@', $action);
                  $controller = $action[0];
                  $method = $action[1];

                  return (new $controller)->$method($params);
            }
         }
         call_user_func_array($this->notFound,[$_SERVER['REQUEST_URI']]);
      }

      /*
      *  Takes the URL from the $routes array and checks to see if there are
      *  any parameters sent in the URL
      *
      *  @params: $url - url from the $routes array
      *           $current_uri - the URI entered in the address bar
      */
      public static function parseRoute($url, $current_uri) {
         $route_exp = explode('/', $url);
         $url_exp = explode('/', $current_uri);
         $params = '';

         foreach($url_exp as $index => $value) {
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
