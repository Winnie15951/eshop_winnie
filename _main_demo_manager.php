<?php
$page_title = '管理員列表';
$page_name = 'manager-list';
// require __DIR__. '/parts/__connect_db.php';

$perPage = 5; // 每頁有幾筆資料

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$t_sql = "SELECT COUNT(1) FROM `eshop_manager`";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
// die('~~~'); //exit; // 結束程式
$totalPages = ceil($totalRows / $perPage);

$rows = [];
if ($totalRows > 0) {
    if ($page < 1) {
        header('Location: data-list.php');
        exit;
    }
    if ($page > $totalPages) {
        header('Location: data-list.php?page=' . $totalPages);
        exit;
    };

    $sql = sprintf("SELECT * FROM `eshop_manager` ORDER BY id DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll();
}
# 正規表示式
// https://developer.mozilla.org/zh-TW/docs/Web/JavaScript/Guide/Regular_Expressions
?>
<div class="main col-sm-9 offset-sm-3 col-md-10 offset-md-2">
    <div class="container main-bg">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">e_shop</a></li>
                <li class="breadcrumb-item"><a href="#">管理員</a></li>
                <li class="breadcrumb-item active" aria-current="page">管理員列表</li>
            </ol>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li>
                            <a href="./_deposit_manager_insert.php"><i class="fas fa-user-plus plus"></i></a>
                            <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $page - 1 ?>">
                                    <i class="fas fa-arrow-circle-left"></i>
                                </a>
                            </li>
                            <?php for ($i = $page - 3; $i <= $page + 3; $i++) :
                                if ($i < 1) continue;
                                if ($i > $totalPages) break;
                            ?>
                                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $page + 1 ?>">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>

                </div>
            </div>



            <table class="table table-striped">
                <!-- `id`, `name`, `email`, `mobile`, `birthday`, `address`, `created_at` -->
                <thead>
                    <tr>
                        
                        <th scope="col">ID</th>
                        <th scope="col">姓名</th>
                        <th scope="col">帳號</th>
                        <th scope="col">密碼</th>
                        <th scope="col">部門</th>
                        <th scope="col">生日</th>
                        <th scope="col">電話</th>
                        <th scope="col">加入時間</th>
                        
                        <th scope="col"><i class="fas fa-edit"></i></th>

                        <!-- <?php if (isset($_SESSION['esop_manager'])) : ?>
                            
                        <?php endif; ?> -->
                        <th scope="col"><i class="fas fa-trash-alt"></i></th>
                        <!-- <?php if (isset($_SESSION['eshop_manager'])) : ?>

                            <?php endif; ?> -->
                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            
                            <td><?= $r['id'] ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['account'] ?></td>
                            <td><?= (strlen($r['password']) > 10)?substr($r['password'],0,5) . "..." :$r['password']  ?></td>
                            <td><?= $r['department'] ?></td>
                            <td><?= $r['birthday'] ?></td>
                            <td><?= $r['phone_number'] ?></td>
                            <td><?= $r['creat_date'] ?></td>
                            <td><a href="./_deposit_manager_edit.php?id=<?= $r['id'] ?>"><i class="fas fa-edit"></i></a></td>
                            <!-- <?php if (isset($_SESSION['eshop_manager'])) : ?>
                                
                                <?php endif; ?> -->
                            <td><a href="./_deposit_manager_delete_api.php?id=<?= $r['id'] ?>" onclick="ifDel(event)" data-id="<?= $r['id'] ?>">
                                        <i class="fas fa-trash-alt"></i>
                                    </a></td>

                            <!-- <?php if (isset($_SESSION['eshop_manager'])) : ?>
                                
                            <?php endif; ?> -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<?php include __DIR__ . './parts/_scripts.php'; ?>
<script>
    function ifDel(event) {
        const a = event.currentTarget;
        console.log(event.target, event.currentTarget);
        const id = a.getAttribute('data-id');
        if (!confirm(`是否要刪除編號為 ${id} 的資料?`)) {
            event.preventDefault(); // 取消連往 href 的設定
        }
        else{
            location.href = '/eshop_manager.php'
        }
    }
</script>