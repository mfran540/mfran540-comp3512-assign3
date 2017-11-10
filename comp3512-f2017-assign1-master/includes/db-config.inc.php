<?php
// This replaces the config.php file. Essentially this sets up the connection to the database and includes all the ".class" files to each page.
// Coppied this from Lab 6 with small edits.
// set error reporting on to help with debugging
error_reporting(E_ALL);
ini_set('display_errors','1');

$ip = '127.0.0.1';

// you may need to change these for your own environment
define('DBCONNECTION', "mysql:host=$ip;dbname=book;charset=utf8mb4;");
define('DBUSER', 'testuser');
define('DBPASS', 'mypassword');

// auto load all classes so we don't have to explicitly include them
    spl_autoload_register(function ($class) {
        $file = 'lib/' . $class . '.class.php';
        if (file_exists($file))
        include $file;
    });


// connect to the database
$connection = DatabaseHelper::createConnectionInfo(array(DBCONNECTION, DBUSER, DBPASS));
?>