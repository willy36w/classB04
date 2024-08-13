<h2 class="ct">填寫資料</h2>
<table class="all" style="margin:0 auto 0 auto;">
    <?php
    $mem = $Mem->find(['acc' => $_SESSION['Mem']]);

    ?>
    <tr>
        <td class="tt ct">登入帳號</td>
        <td class="pp"><?= $_SESSION['Mem']; ?></td>
    </tr>
    <tr>
        <td class="tt ct">姓名</td>
        <td class="pp"><input type="text" name="name" id="name" value="<?= $mem['name'] ?>"></td>
    </tr>
    <tr>
        <td class="tt ct">電子信箱</td>
        <td class="pp"><input type="text" name="email" id="email" value="<?= $mem['email'] ?>"></td>
    </tr>
    <tr>
        <td class="tt ct">聯絡地址</td>
        <td class="pp"><input type="text" name="addr" id="addr" value="<?= $mem['addr'] ?>"></td>
    </tr>
    <tr>
        <td class="tt ct">連絡電話</td>
        <td class="pp"><input type="text" name="tel" id="tel" value="<?= $mem['tel'] ?>"></td>
    </tr>
</table>
<table class="all ct" style="margin:-1px auto -1px auto;">
    <tr class="tt">
        <td>商品名稱</td>
        <td>編號</td>
        <td>數量</td>
        <td>單價</td>
        <td>小計</td>
    </tr>
    <?php
    $total = 0;
    foreach ($_SESSION['cart'] as $id => $qt) {
        $goods = $Goods->find($id);
    ?>
        <tr class="pp">
            <td><?= $goods['name']; ?></td>
            <td><?= $goods['no']; ?></td>
            <td><?= $qt; ?></td>
            <td><?= $goods['price']; ?></td>
            <td><?= $goods['price'] * $qt; ?></td>
        </tr>
    <?php
        $total = $total + ($goods['price'] * $qt);
    }
    ?>
</table>
<div class="tt ct all" style="margin: 2px auto 0px auto;padding:10px 0">總價<?= $total; ?></div>
<div class="ct">
    <button onclick="checkout()">確定送出</button>
    <button onclick="location.href='?do=buycart'">返回修改訂單</button>
</div>

<script>
    function checkout() {
        let data = {
            'name': $('#name').val(),
            'email': $('#email').val(),
            'addr': $('#addr').val(),
            'tel': $('#tel').val(),
            'total': <?= $total; ?>,
        }
        $.post('./api/checkout.php', data, function(res) {
            if (res == '1') {
                alert('訂購成功\n感謝您的選擇')
                location.href = 'index.php'
            } else {
                alert('訂購失敗\n請洽客服')
            }
        })
    }
</script>