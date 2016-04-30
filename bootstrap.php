<?php
   require('config.php');
   require('functions.php');
   require('core/autoload/autoload.php');
   //print_r($pdo);
   //use app\controllers;
   //$autoloader = new Autoload();
   spl_autoload_register('Autoload::loadControllers');
   spl_autoload_register('Autoload::loadViews');
   spl_autoload_register('Autoload::loadRoutes');
   spl_autoload_register('Autoload::loadModels');
   spl_autoload_register('Autoload::loadDatabases');
   //echo $pdo;
//spl_autoload_register([$autoloader, 'load']);

//   $autoloader->register('viewloader', function(){
//      return require(BASEPATH.'/core/view/ViewLoader.php');
//   });
//
//   $autoloader->register('templating', function(){
//      return require(BASEPATH.'/core/view/Templating.php');
//   });
//
//   $autoloader->register('basecontroller', function(){
//      return require(BASEPATH.'/controllers/BaseController.php');
//   });
//
//   $autoloader->register('indexcontroller', function(){
//      return require(BASEPATH.'/controllers/IndexController.php');
//   });

   //$view = new View( new ViewLoader(BASEPATH.'/views/') );
   $router = new Router();

   //$view = new papyruss\core\view\View(
   //   new papyruss\core\view\ViewLoader(BASEPATH.'/views/')
   //);