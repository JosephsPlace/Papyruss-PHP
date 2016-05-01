<?php
   $router->add('/papyruss-php/public/','IndexController@index');
   $router->add('/papyruss-php/public/index/{id}','IndexController@getTest');
   $router->add('/papyruss-php/public/register/','UserController@registerForm');
   $router->add('/papyruss-php/public/register/post/','UserController@registerPost');
