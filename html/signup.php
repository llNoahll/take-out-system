<?php

header("Content-type:text/html; charset=utf-8");
// require_once('../user/user_fns.php');
require_once('../db/db_fns.php');
require_once('../user/class.php');
require_once('../user/Customer/customer_fns.php');
require_once('../user/Shop/shop_fns.php');
require_once('../user/Manager/manager_fns.php');
session_start();

echo "开始注册 <br>";

$customer = signup_customer($login_name, $login_pwd);
if($customer == false) {
?>
    <a href = 'signup.html'>
        注册失败！请确认您输入的账号已存在。
    </a>
<?php
} else {
    $_SESSION["user"] = $customer;

?>
    <a href = 'profile.php'>
    注册成功！跳转到个人页面。
    </a>
<?php

}

?>