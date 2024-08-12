<?php
include_once "base.php";

unset($_SESSION['cart'][$_GET['id']]);

to("../index.php?do=buycart");
