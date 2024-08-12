<?php

if (isset($_GET['id']) && isset($_GET['qt'])) {
    $_SESSION['cart'][$_GET['id']] = $_GET['qt'];
}

if (!isset($_SESSION['Mem'])) {
    to("?do=login");
    exit();
}


?>


<h2 class="ct"><?= $_SESSION['Mem']; ?>的購物車</h2>
<?php
if (!empty($_SESSION['cart'])) {
?>
    <!-- table.all>(tr.tt.ct>td*7)+(tr.pp.ct>td*7) -->
    <table class="all">
        <tr class="tt ct">
            <td>編號</td>
            <td>商品名稱</td>
            <td>數量</td>
            <td>庫存量</td>
            <td>單價</td>
            <td>小計</td>
            <td>刪除</td>
        </tr>
        <?php
        foreach ($_SESSION['cart'] as $id => $qt) {
            $goods = $Goods->find($id);
        ?>
            <tr class="pp ct">
                <td><?= $goods['no']; ?></td>
                <td><?= $goods['name']; ?></td>
                <td><?= $qt; ?></td>
                <td><?= $goods['stock']; ?></td>
                <td><?= $goods['price']; ?></td>
                <td><?= $goods['price'] * $qt; ?></td>
                <td style='cursor: pointer;'>
                    <img src="./icon/0415.jpg" onclick="location.href=' ./api/del_cart.php?id=<?= $goods['id']; ?>'">
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <div class="ct">
        <img src="./icon/0411.jpg" alt="" onclick="location.href='index.php'">
        <img src="./icon/0412.jpg" alt="" onclick="location.href='?do=checkout'">
    </div>
<?php

} else {
    echo "<h3 class='ct'>購物車是空的</h3>";
}

?>