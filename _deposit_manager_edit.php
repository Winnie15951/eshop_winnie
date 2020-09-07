<?php
$page_title = '編輯管理員資料';
$page_name = 'data-edit';
require __DIR__ . '/parts/_db_connect_elivia.php';
require __DIR__ . '/parts/_html_header_manager.php';

$sid = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (empty($id)) {
    header('Location:_main_demo_manager.php');
    exit;
}

$sql = " SELECT * FROM eshop_manager WHERE id=$id ";
$row = $pdo->query($sql)->fetch();
if (empty($row)) {
    header('Location:_main_demo_manager.php');
    exit;
}


?>

<style>
    span.red-stars {
        color: red;
    }

    small.error-msg {
        color: red;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div id="infobar" class="alert alert-success" role="alert" style="display: none">
                A simple success alert—check it out!
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">編輯管理員資料</h5>

                    <form name="form1" onsubmit="checkForm(); return false;" novalidate>
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">

                        <div class="form-group">
                            <label for="name"><span class="red-stars">**</span>姓名</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <small class="form-text error-msg"></small>
                        </div>
                        <div class="form-group">
                            <label for="account"><span class="red-stars">**</span>帳號</label>
                            <input type="text" class="form-control" id="account" name="account">
                            <small class="form-text error-msg"></small>
                        </div>
                        <div class="form-group">
                            <label for="password"><span class="red-stars">**</span>密碼</label>
                            <input type="tel" class="form-control" id="password" name="password" pattern="09\d{2}-?\d{3}-?\d{3}">
                            <small class="form-text error-msg"></small>
                        </div>
                        <div class="form-group">
                            <label for="department"><span class="red-stars">**</span>部門</label>
                            <input type="text" class="form-control" id="department" name="department" required>
                            <small class="form-text error-msg"></small>
                        </div>

                        <div class="form-group">
                            <label for="birthday">生日</label>
                            <input type="date" class="form-control" id="birthday" name="birthday">
                        </div>
                        <div class="form-group">
                            <label for="phone_number"><span class="red-stars">**</span>電話</label>
                            <input type="tel" class="form-control" id="phone_number" name="phone_number" pattern="09\d{2}-?\d{3}-?\d{3}">
                            <small class="form-text error-msg"></small>
                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>






</div>
<?php include __DIR__ . '/parts/_scripts.php'; ?>
<script>
    const phone_number_pattern = /^09\d{2}-?\d{3}-?\d{3}$/;
    const $name = document.querySelector('#name');
    const $account = document.querySelector('#account');
    const $password = document.querySelector('#password');
    const $department = document.querySelector('#department');
    const $birthday = document.querySelector('#birthday');
    const $phone_number = document.querySelector('#phone_number');
    // const r_fields = [$name, $email, $mobile];
    const infobar = document.querySelector('#infobar');
    const submitBtn = document.querySelector('button[type=submit]');

    function checkForm() {
        let isPass = true;

        // r_fields.forEach(el=>{
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

        if ($account.value.length < 2) {
            isPass = false;
            $account.style.borderColor = 'red';
            $account.nextElementSibling.innerHTML = '請填寫帳號';
        }

        if ($password.value.length < 2) {
            isPass = false;
            $password.style.borderColor = 'red';
            $password.nextElementSibling.innerHTML = '請填寫密碼';
        }

        if ($department.value.length < 2) {
            isPass = false;
            $department.style.borderColor = 'red';
            $department.nextElementSibling.innerHTML = '請填寫所屬部門';
        }

        if (!phone_number_pattern.test($phone_number.value)) {
            isPass = false;
            $phone_number.style.borderColor = 'red';
            $phone_number.nextElementSibling.innerHTML = '請填寫正確的手機號碼';
        }

        if (isPass) {
            const fd = new FormData(document.form1);

            fetch('_deposit_manager_edit_api.php', {
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
                            location.href = '<?= $_SERVER['HTTP_REFERER'] ?? "eshop_manager.php" ?>';
                        }, 1000)

                    } else {
                        infobar.innerHTML = obj.error || '資料沒有修改';
                        infobar.className = "alert alert-danger";
                        submitBtn.style.display = 'block';
                    }
                    infobar.style.display = 'block';
                });

        } else {
            submitBtn.style.display = 'block';
        }
    }
</script>