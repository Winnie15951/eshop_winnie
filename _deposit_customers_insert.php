<?php
$page_title = '新增會員資料';
$page_name = 'customers-insert';
require __DIR__ . '/parts/_db_connect_elivia.php';
// require __DIR__ . '/_customers_required.php';
?>
<?php require __DIR__ . '/parts/_html_header_manager.php'; ?>
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
                <li class="breadcrumb-item active" aria-current="page">新增管理員</li>
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
                            <h5 class="card-title">新增會員資料</h5>

                            <form name="form1" onsubmit="checkForm(); return false;" novalidate>
                                <div class="form-group">
                                    <label for="name"><span class="red-stars">**</span>姓名</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                    <small class="form-text error-msg"></small>
                                </div>
                                <div class="form-group">
                                    <label for="gender"><span class="red-stars"></span>性別</label>
                                    <input type="text" class="form-control" id="gender" name="gender" required>
                                    <small class="form-text error-msg"></small>
                                </div>
                                <div class="form-group">
                                    <label for="birthday">生日</label>
                                    <input type="date" class="form-control" id="birthday" name="birthday">
                                </div>
                                <div class="form-group">
                                    <label for="age"><span class="red-stars"></span>年齡</label>
                                    <input type="text" class="form-control" id="age" name="age" required>
                                    <small class="form-text error-msg"></small>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number"><span class="red-stars">**</span>電話</label>
                                    <input type="tel" class="form-control" id="phone_number" name="phone_number" pattern="09\d{2}-?\d{3}-?\d{3}">
                                    <small class="form-text error-msg"></small>
                                </div>
                                <div class="form-group">
                                    <label for="address">address</label>
                                    <textarea class="form-control" name="address" id="address" cols="30" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="email"><span class="red-stars">**</span> email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                    <small class="form-text error-msg"></small>
                                </div>

                                <div class="form-group">
                                    <label for="password"><span class="red-stars">**</span>密碼</label>
                                    <input type="tel" class="form-control" id="password" name="password">
                                    <small class="form-text error-msg"></small>
                                </div>
                                <div class="form-group">
                                    <label for="e_points"><span class="red-stars"></span>e_points</label>
                                    <input type="text" class="form-control" id="e_points" name="e_points" required>
                                    <small class="form-text error-msg"></small>
                                </div>

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

            fetch('_deposit_customers_insert_api.php', {
                    method: 'POST',
                    body: fd
                })
                .then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        infobar.innerHTML = '新增成功';
                        infobar.className = "alert alert-success";
                        if (infobar.classList.contains('alert-danger')) {
                            infobar.classList.replace('alert-danger', 'alert-success')
                        }
                        setTimeout(() => {
                            location.href = 'eshop_customers.php';
                        }, 100)
                    } else {
                        infobar.innerHTML = obj.error || '新增失敗';
                        infobar.className = "alert alert-danger";
                        // if(infobar.classList.contains('alert-success')){
                        //     infobar.classList.replace('alert-success', 'alert-danger')
                        // }
                        submitBtn.style.display = 'block';
                    }
                    infobar.style.display = 'block';
                });

        } else {
            submitBtn.style.display = 'block';
        }
    }
</script>