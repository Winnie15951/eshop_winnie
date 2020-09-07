<?php
require __DIR__ . '/_db_connect.php';

$perPage = 5;
$output = [
    'perPage' => $perPage,
    'totalRows' => 0,
    'totalPages' => 0,
    'page' => 0,
    'rows' => [],
];

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$t_sql = "SELECT COUNT(1) FROM `deposit_table`";
$output['totalRows'] = $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$output['totalPages'] = $totalPages = ceil($totalRows / $perPage);
//ceil() 函數向上捨入為最接近的整數。

if ($totalRows > 0) {
    if ($page < 1) $page = 1;
    if ($page > $totalPages) $page = $totalPages;
    $output['page'] = $page;

    $sql = sprintf("SELECT * FROM `deposit_table` ORDER BY sid DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    //sprintf() 函數把格式化的字符串寫入一個變量中。
    $stmt = $pdo->query($sql);
    $output['rows'] = $stmt->fetchAll();
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
