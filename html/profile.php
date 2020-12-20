<?php

header("Content-type:text/html; charset=utf-8");
// require_once('../user/user_fns.php');
require_once('../db/db_fns.php');
require_once('../user/class.php');
require_once('../user/Customer/customer_fns.php');
require_once('../user/Shop/shop_fns.php');
require_once('../user/Manager/manager_fns.php');
session_start();


echo "个人界面 <br>";

$customer = $_SESSION["user"];
echo var_dump($customer);


?>