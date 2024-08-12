<?php include_once "base.php";

$goods = $Goods->find($_POST['id']);
switch ($_POST['action']) {
    case "up":
        $goods['sh'] = 1;
        break;
    case "down":
        $goods['sh'] = 0;
        break;
}

$Goods->save($goods);
