<?php
require __DIR__ . '/parts/_db_connect_elivia.php';
// require __DIR__. 'eShop-backend/parts/_db_connect_elivia.php';
// require __DIR__. '/_manager_required.php';
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'eShop-backend/_main_demo_manager.php';

if(empty($_GET['id'])){
    header('Location: '. $referer);
    exit;
}
$id = intval($_GET['id']) ?? 0;

$pdo->query("DELETE FROM eshop_manager WHERE id=$id ");
header('Location: '. $referer);

// if(!isset($_SESSION)){
//     session_start();
// }
