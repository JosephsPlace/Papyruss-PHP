<?php
   $router->add('/papyruss-php/public/','IndexController@index');

   $router->add('/papyruss-php/public/about/','IndexController@about');

   $router->add('/papyruss-php/public/register/','UserController@registerForm');
   $router->add('/papyruss-php/public/register/post/','UserController@registerPost');

   $router->add('/papyruss-php/public/login/','UserController@loginForm');
   $router->add('/papyruss-php/public/login/post/','UserController@loginPost');

   $router->add('/papyruss-php/public/logout/','UserController@logout');
