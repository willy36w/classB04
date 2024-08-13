<?php
$order = $Order->find($_GET['id']);
?>
<div class="ct">訂單編號<span style='color:red'><?= $order['no']; ?></span>的詳細資料</div>

<style>
    input[type='text'] {
        background: #EFCA85;
        border: 0;
        padding: 0;
        font-size: 16px;
    }
</style>
<table class="all">
    <tr>
        <td class="tt ct">會員帳號</td>
        <td class="pp"><?= $order['acc'] ?></td>
    </tr>
    <tr>
        <td class="tt ct">姓名</td>
        <td class="pp"><input disabled readonly type="text" name="name" id="name" value="<?= $order['name'] ?>"></td>
    </tr>
    <tr>
        <td class="tt ct">電子信箱</td>
        <td class="pp"><input disabled readonly type="text" name="email" id="email" value="<?= $order['email'] ?>"></td>
    </tr>
    <tr>
        <td class="tt ct">聯絡地址</td>
        <td class="pp"><input disabled readonly type="text" name="addr" id="addr" value="<?= $order['addr'] ?>"></td>
    </tr>
    <tr>
        <td class="tt ct">聯絡電話</td>
        <td class="pp"><input disabled readonly type="text" name="tel" id="tel" value="<?= $order['tel'] ?>"></td>
    </tr>
</table>

<table class="all ct">
    <tr class="tt">
        <td>商品名稱</td>
        <td>編號</td>
        <td>數量</td>
        <td>單價</td>
        <td>小計</td>
    </tr>
    <?php
    $total = 0;
    $cart = unserialize($order['cart']);
    foreach ($cart as $id => $qt) {
        $goods = $Goods->find($id);
    ?>
        <tr class="pp">
            <td><?= $goods['name']; ?></td>
            <td><?= $goods['no']; ?></td>
            <td><?= $qt; ?></td>
            <td><?= $goods['price']; ?></td>
            <td><?= $goods['price']; ?></td>
        </tr>
    <?php
        $total = $total + ($goods['price'] * $qt);
    }
    ?>
</table>
<div class="tt ct all" style="padding: 10px 0;">總價:<?= $total; ?></div>
<div class="ct"><button onclick="location.href='?do=order'">返回</button></div>