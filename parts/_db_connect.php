<?php
$db_host = 'localhost';
$db_name = 'eShop';
$db_user = 'sam';
$db_pass = 'admin';
// $db_charest = 'utf8';

$dsn = "mysql:host={$db_host};dbname={$db_name}";
// pdo 連線設定
$pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$db_charset}"
];

$pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);

define('WEB_ROOT', '/eShop-backend');

// if (!isset($_SESSION)) {
//     session_start();
// }
