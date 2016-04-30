<?php
   $router->add('/framework/public/','IndexController@index');
   $router->add('/framework/public/index/{id}','IndexController@getTest');
   $router->add('/framework/public/register/','UserController@registerForm');
   $router->add('/framework/public/register/post/','UserController@registerPost');
