<?php
require __DIR__. '/parts/_db_connect_elivia.php';
// require __DIR__. '/parts/__admin_required.php';
header('Content-Type: application/json');

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => ''
];

// TODO: 檢查資料格式
// email_pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
// mobile_pattern = /^09\d{2}-?\d{3}-?\d{3}$/;

if(empty($_POST['id'])){
    $output['code'] = 405;
    $output['error'] = '沒有 id';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

if(mb_strlen($_POST['name'])<2){
    $output['code'] = 410;
    $output['error'] = '姓名長度要大於 2';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

if(! preg_match('/^09\d{2}-?\d{3}-?\d{3}$/', $_POST['phone_number'])){
    $output['code'] = 420;
    $output['error'] = '手機號碼格式錯誤';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}


$sql = "UPDATE `eshop_manager` SET 
    `name`=?,
    `account`=?,
    `password`=SHA1(?),
    `department`=?,
    `birthday`=?,
    `phone_number`=?,
    `creat_date`=? 
    WHERE `id`=?";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['name'],
    $_POST['account'],
    $_POST['password'],
    $_POST['department'],
    $_POST['birthday'],
    $_POST['phone_number'],
    $_POST['creat_date'],
    $_POST['id']

]);

if($stmt->rowCount()){
    $output['success'] = true;
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);