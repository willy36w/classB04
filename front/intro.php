<?php
$row = $Goods->find($_GET['id']);

?>
<style>
    .item * {
        box-sizing: border-box;
    }

    .item {
        display: flex;
        flex-wrap: wrap;
    }

    .img {
        width: 60%;
        padding: 5px;
        border: 1px solid white;
    }

    .img img {
        width: 100%;

    }

    .info {
        width: 40%;
        border: 1px solid white;
    }

    .info div {
        padding: 5px;
        min-height: 30px;
        border-bottom: 1px solid white;
    }

    .qt {
        width: 100%;
    }
</style>

<h2 class="ct"><?= $row['name']; ?></h2>

<div class="item">
    <div class="img pp">
        <img src="./images/<?= $row['img']; ?>" alt="">
    </div>
    <div class="info pp">
        <div>分類:<?= $Type->find($row['big'])['name']; ?>><?= $Type->find($row['mid'])['name']; ?></div>
        <div>編號:<?= $row['no']; ?></div>
        <div>價格:<?= $row['price']; ?></div>
        <div>詳細說明:<?= $row['intro']; ?></div>
        <div>庫存量:<?= $row['stock']; ?></div>
    </div>
    <div class="qt tt ct">
        購買數量:
        <input type="number" name="qt" id="qt" value='1'>
        <a href="javascript:buy(<?= $row['id']; ?>)">
            <img src="./icon/0402.jpg" alt="">
        </a>
    </div>
</div>
<div class="ct"><button onclick="location.href='index.php'">返回</button></div>

<script>
    function buy(id) {
        let qt = $('#qt').val();
        location.href = `?do=buycart&id=${id}&qt=${qt}`;
    }
</script>