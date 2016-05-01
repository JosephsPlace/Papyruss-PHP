<?php
   require('config.php');
   require('functions.php');
   require('core/autoload/autoload.php');

   // Autoload all necessary classes
   spl_autoload_register('Autoload::loadControllers');
   spl_autoload_register('Autoload::loadViews');
   spl_autoload_register('Autoload::loadRoutes');
   spl_autoload_register('Autoload::loadModels');
   spl_autoload_register('Autoload::loadDatabases');

   $router = new Router();
