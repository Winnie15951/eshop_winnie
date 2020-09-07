<?php $page_title = '管理人員名單'; ?>
<?php include __DIR__ . '/parts/_html_header_manager.php' ?>
<?php require __DIR__.'/parts/_db_connect_elivia.php';?>

    <div class="container-fluid">
        <div class="row no-gutters">
            <?php include __DIR__ . '/parts/_sidebar.php' ?>
            <?php include __DIR__ . '/_main_demo_manager.php' ?>
        </div>
    </div>

<?php include __DIR__ . '/parts/_scripts.php' ?>