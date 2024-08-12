<?php include_once "base.php";

switch ($_GET['user']) {
    case 'admin':
        unset($_SESSION['Admin']);
        break;
    case 'mem':
        unset($_SESSION['Mem']);
        break;
}

to("../index.php");
