<?php
   session_start();

   define('BASEPATH', __DIR__);

   define("DB_PDODRIVER", "mysql");
   define("DB_HOST", "localhost");
   define("DB_NAME", "papyruss");
   define("DB_USER", "root");
   define("DB_PASS", "");
//   $pdo = 'sdfsd';
////   global $pdo;
////
//   try {
//      //$pdo = new PDO(DB_PDODRIVER .':host='. DB_HOST .';dbname='. DB_NAME .'', DB_USER, DB_PASS);
//      echo 'success';
//   } catch (Exception $e) {
//      echo 'Connection failed: ' . $e->getMessage();
//   }