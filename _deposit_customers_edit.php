<?php
$page_title = '編輯管理員資料';
$page_name = 'data-edit';
require __DIR__ . '/parts/_db_connect_elivia.php';
require __DIR__ . '/parts/_html_header_manager.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (empty($id)) {
    header('Location:_main_demo_customers.php');
    exit;
}

$sql = " SELECT * FROM customers WHERE id=$id ";
$row = $pdo->query($sql)->fetch();
if (empty($row)) {
    header('Location:_main_demo_customers.php');
    exit;
}


?>
<div class="container-fluid">
    <div class="row no-gutters">
        <?php include __DIR__ . '/parts/_sidebar.php' ?>
    </div>
</div>

<style>
    span.red-stars {
        color: red;
    }

    small.error-msg {
        color: red;
    }
</style>
<div class="main col-sm-9 offset-sm-3 col-md-10 offset-md-2">
    <div class="container main-bg">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">主頁</a></li>
                <li class="breadcrumb-item"><a href="./eshop_customers.php">會員資料管理</a></li>
                <li class="breadcrumb-item active" aria-current="page">編輯會員</li>
            </ol>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div id="infobar" class="alert alert-success" role="alert" style="display: none">
                        A simple success alert—check it out!
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">編輯會員資料</h5>

                            <form name="form1" onsubmit="checkForm(); return false;" novalidate>
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">

                                <div class="form-group">
                                    <label for="name"><span class="red-stars">**</span>姓名</label>
                                    <input type="text" class="form-control" id="name" name="name" required value="<?= htmlentities($row['name']) ?>">
                                    <small class="form-text error-msg"></small>
                                </div>
                                <div class="form-group">
                                    <label for="gender"><span class="red-stars"></span>性別</label>
                                    <input type="text" class="form-control" id="gender" name="gender" required value="<?= htmlentities($row['gender']) ?>">
                                    <small class="form-text error-msg"></small>
                                </div>
                                <div class="form-group">
                                    <label for="birthday">生日</label>
                                    <input type="date" class="form-control" id="birthday" name="birthday" value="<?= htmlentities($row['birthday']) ?>">
                                </div>
                                <div class="form-group">
                                    <label for="age">年齡</label>
                                    <input type="text" class="form-control" id="age" name="age" value="<?= htmlentities($row['age']) ?>">
                                </div>
                                <div class="form-group">
                                    <label for="phone_number"><span class="red-stars">**</span>電話</label>
                                    <input type="tel" class="form-control" id="phone_number" name="phone_number" value="<?= htmlentities($row['phone_number']) ?>" pattern="09\d{2}-?\d{3}-?\d{3}">
                                    <small class="form-text error-msg"></small>
                                </div>
                                <div class="form-group">
                                    <label for="address"><span class="red-stars">**</span>地址</label>
                                    <input type="text" class="form-control" id="address" name="address" required value="<?= htmlentities($row['address']) ?>">
                                    <small class="form-text error-msg"></small>
                                </div>

                                <div class="form-group">
                            <label for="email"><span class="red-stars">**</span> email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="<?= htmlentities($row['email']) ?>">
                            <small class="form-text error-msg"></small>
                        </div>
                                <div class="form-group">
                                    <label for="password"><span class="red-stars">**</span>密碼</label>
                                    <input type="tel" class="form-control" id="password" name="password" value="<?= htmlentities($row['password']) ?>">
                                    <small class="form-text error-msg"></small>
                                </div>
                                
                                <div class="form-group">
                                    <label for="e_points"><span class="red-stars"></span>e_points</label>
                                    <input type="text" class="form-control" id="e_points" name="e_points" required value="<?= htmlentities($row['e_points']) ?>">
                                    <small class="form-text error-msg"></small>
                                </div>
                                
                                
                                <input type="hidden" name="creat_date" value="<?= $row['creat_date'] ?>">


                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>




</div>
<?php include __DIR__ . '/parts/_scripts.php'; ?>
<script>
    const phone_number_pattern = /^09\d{2}-?\d{3}-?\d{3}$/;
    const email_pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;

    const $name = document.querySelector('#name');
    const $gender = document.querySelector('#gender');
    const $birthday = document.querySelector('#birthday');
    const $age = document.querySelector('#age');
    const $phone_number = document.querySelector('#phone_number');
    const $address = document.querySelector('#address');
    const $email = document.querySelector('#email');
    const $password = document.querySelector('#password');
    const $e_points = document.querySelector('#e_points');
    
    
    
    // const r_fields = [$name , $account , $password , $department , $birthday , $phone_number ];
    const infobar = document.querySelector('#infobar');
    const submitBtn = document.querySelector('button[type=submit]');

    function checkForm() {
        let isPass = true;

        // r_fields.forEach(el => {
        //     el.style.borderColor = '#CCCCCC';
        //     el.nextElementSibling.innerHTML = '';
        // });
        submitBtn.style.display = 'none';
        // TODO: 檢查資料格式
        if ($name.value.length < 2) {
            isPass = false;
            $name.style.borderColor = 'red';
            $name.nextElementSibling.innerHTML = '請填寫正確的姓名';
        }
        if (!phone_number_pattern.test($phone_number.value)) {
            isPass = false;
            $phone_number.style.borderColor = 'red';
            $phone_number.nextElementSibling.innerHTML = '請填寫正確的手機號碼';
        }
        if ($address.value.length < 2) {
            isPass = false;
            $address.style.borderColor = 'red';
            $address.nextElementSibling.innerHTML = '請填寫詳細地址';
        }
        if(! email_pattern.test($email.value)) {
            isPass = false;
            $email.style.borderColor = 'red';
            $email.nextElementSibling.innerHTML = '請填寫正確格式的電子郵箱';
        }

        if ($password.value.length < 2) {
            isPass = false;
            $password.style.borderColor = 'red';
            $password.nextElementSibling.innerHTML = '請填寫密碼';
        }

        if (isPass) {
            const fd = new FormData(document.form1);

            fetch('_deposit_customers_edit_api.php', {
                    method: 'POST',
                    body: fd
                })
                .then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        infobar.innerHTML = '修改成功';
                        infobar.className = "alert alert-success";

                        setTimeout(() => {
                            location.href = '<?= $_SERVER['HTTP_REFERER'] ?? "_main_demo_customers.php" ?>';
                        }, 100)

                    } else {
                        infobar.innerHTML = obj.error || '資料沒有修改';
                        infobar.className = "alert alert-danger";
                        submitBtn.style.display = 'block';
                        setTimeout(() => {
                            location.href = '<?= $_SERVER['HTTP_REFERER'] ?? "_main_demo_customers.php" ?>';
                        }, 300)
                    }
                    infobar.style.display = 'block';
                });

        } else {
            submitBtn.style.display = 'block';
        }
    }
</script>