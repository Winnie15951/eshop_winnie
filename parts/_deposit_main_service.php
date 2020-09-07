<div class="main col-sm-9 offset-sm-3 col-md-10 offset-md-2">
    <div class="container main-bg">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="width: 100%">
                <li class="breadcrumb-item"><a href="#">主頁</a></li>
                <li class="breadcrumb-item"><a href="#">商家加值服務</a></li>
                <li class="breadcrumb-item active" aria-current="page">店舖活動資訊</li>
            </ol>
        </nav>
        <div class="row order-check">
            <div class="col-6">
                <form>
                    <div class="form-group">
                        <label for="formGroupExampleInput">訂單編號</label>
                        <input type="text" class="form-control" id="formGroupExampleInput">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">店家名稱</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2">
                    </div>
                </form>
            </div>
            <div class="col-6">
                <label for="date-start">起始時間</label>
                <input type="date" class="form-control" id="date date-start" name="date" style="margin-bottom: 1rem">
                <label for="date-end">結束時間</label>
                <input type="date" class="form-control" id="date date-end" name="date" style="margin-bottom: 1rem">

            </div>
        </div>
        <?php
        $page_name = 'deposit_data_list';
        require __DIR__ . '/_db_connect.php';
        ?>
        <div class="row">
            <div class="col d-flex justify-content-end">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">

                    </ul>
                </nav>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr style="text-align: center;">
                        <th scope="col">序號</th>
                        <th scope="col">店鋪</th>
                        <th scope="col">訂單編號</th>
                        <th scope="col">廣告名稱</th>
                        <th scope="col">預算</th>
                        <th scope="col">總成本</th>
                        <th scope="col">投放率(%)</th>
                        <th scope="col">起始時間</th>
                        <th scope="col">結束時間</th>
                        <th scope="col">活動天數</th>
                        <th scope="col">修改</th>
                        <th scope="col">刪除</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include __DIR__ . '/_scripts.php'; ?>
<script>
    const tbody = document.querySelector('tbody');

    let pageData;

    const hashHandler = function() {

    }

    const pageItemTpl = (o) => {

        return `<li class="page-item ${o.active}">
                    <a class="page-link" href="#${o.page}">${o.page}</a>
                </li>`
    }

    const tableRowTpl = (o) => {

        return `
        <tr style="text-align: center;">
            <td>${o.sid}</td>
            <td>${o.name}</td>
            <td>${o.order_number}</td>
            <td>${o.ads_name}</td>
            <td>${o.budget}</td>
            <td>${o.total_cost}</td>
            <td>${o.average_cost}</td>
            <td>${o.start_date}</td>
            <td>${o.end_date}</td>
            <td>${o.duration_days}</td>
            <td>
                <a href="">
                    <i class="fas fa-edit"></i>
                </a>
            </td>
            <td>
                <a href="">
                    <i class="fas fa-trash-alt my-trash-i"></i>
                    
                </a>
            </td>
        </tr>
        `
    };

    function getData(page = 1) {
        fetch('parts/_deposit_data_list_api.php?page=' + page)
            .then(r => r.json())
            .then(obj => {
                console.log(obj);
                pageData = obj;
                let str = ''
                for (let i of obj.rows) {
                    str += tableRowTpl(i);
                    console.log(obj.rows)
                }
                tbody.innerHTML = str;

                str = '';
                for (let i = obj.page - 3; i <= obj.page + 3; i++) {
                    if (i < 1) continue;
                    if (i > obj.totalPages) continue;
                    const o = {
                        page: i,
                        active: ''
                    }
                    if (obj.page === i) {
                        o.active = 'active';
                    }
                    str += pageItemTpl(o);
                }
                document.querySelector('.pagination').innerHTML = str;
            })
    }
    getData()
</script>