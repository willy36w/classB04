<h2 class="ct">商品分類</h2>
<div class="ct">
    新增大分類 <input type="text" name="big" id="big"><button onclick="addType('big')">新增</button>
</div>
<div class="ct">
    新增中分類
    <select name="bigSelect" id="bigSelect"></select>
    <input type="text" name="mid" id="mid"><button onclick="addType('mid')">新增</button>
</div>

<table class="all">
    <?php
    $bigs = $Type->all(['big_id' => 0]);
    foreach ($bigs as $big) {
    ?>
        <tr class="tt">
            <td><?= $big['name']; ?></td>
            <td class='ct'>
                <button onclick="editType(<?= $big['id']; ?>,this)">修改</button>
                <button onclick="del('Type',<?= $big['id']; ?>)">刪除</button>
            </td>
        </tr>
        <?php
        if ($Type->count(['big_id' => $big['id']]) > 0) {
            $mids = $Type->all(['big_id' => $big['id']]);
            foreach ($mids as $mid) {
        ?>
                <tr class="pp ct">
                    <td><?= $mid['name']; ?></td>
                    <td>
                        <button onclick="editType(<?= $mid['id']; ?>,this)">修改</button>
                        <button onclick="del('Type',<?= $mid['id']; ?>)">刪除</button>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
    <?php
    }
    ?>

</table>


<h2 class="ct">商品管理</h2>
<div class="ct">
    <button onclick="location.href='?do=add_goods'">新增商品</button>
</div>

<table class="all">
    <tr class="tt ct">
        <td>編號</td>
        <td>商品名稱</td>
        <td>庫存量</td>
        <td>狀態</td>
        <td>操作</td>
    </tr>
    <?php
    $rows = $Goods->all();
    foreach ($rows as $row) {
    ?>
        <tr class="pp ct">
            <td><?= $row['no']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['stock']; ?></td>
            <td id="g<?= $row['id']; ?>"><?= ($row['sh'] == 1) ? "販售中" : "已下架"; ?></td>
            <td>
                <button onclick="location.href='?do=edit_goods&id=<?= $row['id']; ?>'">修改</button>
                <button onclick="del('Goods',<?= $row['id']; ?>)">刪除</button>
                <button onclick="sw('up',<?= $row['id']; ?>)">上架</button>
                <button onclick="sw('down',<?= $row['id']; ?>)">下架</button>
            </td>
        </tr>
    <?php
    }
    ?>
</table>



<script>
    getTypes();

    function sw(action, id) {
        $.post('api/sw.php', {
            id,
            action
        }, () => {
            //location.reload();
            switch (action) {
                case 'up':
                    $(`#g${id}`).html('販售中');
                    break;
                case 'down':
                    $(`#g${id}`).html('已下架');
                    break;
            }
        })
    }
</script>