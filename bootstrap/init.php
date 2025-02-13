<?php

session_start();

include "constants.php";
include "config.php";
include BASE_PATH . "bootstrap/config.php";
include BASE_PATH . "vendor/autoload.php";
include BASE_PATH . "libs/helpers.php";
include BASE_PATH . "libs/lib-tasks.php";
include BASE_PATH . "libs/lib-auth.php";


$dsn = "mysql:dbname={$database_config['db']};host={$database_config['host']}";

try {
    
    $pdo = new PDO($dsn, $database_config['user'], $database_config['pass']);
} catch (PDOException $e) {
    diePage('Connection failed: ' . $e->getMessage());
}

// echo "Connection to database is Ok!";
