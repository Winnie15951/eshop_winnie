<?php
$db_host = '122.116.38.12';
$db_name = 'eshop';
$db_user = 'elivia';
$db_pass = 'elivia_sql';
// $db_charest = 'utf8';

$dsn = "mysql:host={$db_host};dbname={$db_name}";

$pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
];

$pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);

define('WEB_ROOT', '/eShop-backend');

if(!isset($_SESSION)){
    session_start();
}
