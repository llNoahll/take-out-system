<?php

header("Content-type:text/html; charset=utf-8");
// require_once('../user/user_fns.php');
require_once('../db/db_fns.php');
require_once('../user/class.php');
require_once('../user/Customer/customer_fns.php');
require_once('../user/Shop/shop_fns.php');
require_once('../user/Manager/manager_fns.php');
session_start();


$login_name = $_POST["login_name"];
$login_pwd = $_POST["login_pwd"];

echo $login_name;
echo "<br>";
echo $login_name;
echo "<br>";

$customer = login_customer($login_name, $login_pwd);
if($customer == false) {
?>
    <a href = 'login.html'>
        登录失败！请检查您的账号和密码是否正确。
    </a>
<?php
} else {
    $_SESSION["user"] = $customer;

?>
    <a href = 'profile.php'>
        登录成功！跳转到个人页面。
    </a>
<?php

}


?>