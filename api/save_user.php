<?php include_once "base.php";

if (!isset($_POST['id'])) {
    $_POST['regdate'] = date("Y-m-d");
}
$Mem->save($_POST);

if (isset($_POST['id'])) {
    to("../admin.php?do=mem");
}
