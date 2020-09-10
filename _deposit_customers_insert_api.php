<?php
require __DIR__. '/parts/_db_connect_elivia.php';
// require __DIR__. '/_customers_required.php';
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


$sql = "INSERT INTO `customers`(
`name`, `gender`, `birthday`, `age`, `phone_number`, `address`, `email`, `password`, `e_points`,`creat_date`
 ) VALUES (?, ?, ?, ?, ?, ? , ? , SHA1(?) ,? ,NOW())";

$stmt = $pdo->prepare($sql);
$stmt->execute([
        $_POST['name'],
        $_POST['gender'],
        $_POST['birthday'],
        $_POST['age'],
        $_POST['phone_number'],
        $_POST['address'],
        $_POST['email'],
        $_POST['password'],
        $_POST['e_points']
]);

if($stmt->rowCount()){
    $output['success'] = true;
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);