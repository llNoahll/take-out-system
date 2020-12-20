<?php

header("Content-type:text/html; charset=utf-8");
// require_once('../user/user_fns.php');
require_once('./db/db_fns.php');
require_once('./user/class.php');
require_once('./user/Customer/customer_fns.php');
require_once('./user/Shop/shop_fns.php');
require_once('./user/Manager/manager_fns.php');
session_start();

echo "开始测试<br>";

try {
    $conn = new mysqli('localhost', 'root', 'pwd', 'take_out_db');
    echo "数据库连接成功<br>";

    $table_name = "Customer";
    $login_name = "noah";
    $login_pwd = "noah";

    $query = "select *
              from $table_name
              where login_name = '$login_name' and login_pwd = '$login_pwd';";
    echo $query;


    $result = $conn->query($query);
    echo $result->num_rows;

    echo "<br>测试结束<br>";
} catch (Exception $ex) {
    die("数据库连接失败");
}

$fid1 = "5fdebd669ee1d";
$fid2 = "5fdebd763440a";
$fid3 = "5fdebd7bd1986";


$food_msg1 = ["fid" => $fid1,
              "fname" => "麻婆豆腐",
              "price" => 32,
              "brief" => "好吃的麻婆豆腐",
              "img_path" => "./food1.png"];
$food_msg2 = ["fid" => $fid2,
              "fname" => "青椒豆干",
              "price" => 22,
              "brief" => "好吃",
              "img_path" => "./food2.png"];
$food_msg3 = ["fid" => $fid3,
              "fname" => "宫保鸡丁",
              "price" => 22,
              "brief" => "不好吃",
              "img_path" => "./food3.png"];

$food_msgs = [$fid1 => $food_msg1,
              $fid2 => $food_msg2,
              $fid3 => $food_msg3];
print_r($food_msgs);
echo "<br>";


$oid1 = "5fdebdd58b1e3";
$order1 = ["oid" => $oid1,
           "sid" => "5fdea7f1202ba",
           "cid" => "5fdea8439c574",
           "pay_time" => date("Y-m-d H:i:s"),
           "accept_time" => NULL,
           "arrive_time" => NULL,
           "order_state" => "request", // request, accept, finish, cancel
           "address" => "兰大",
           "order_food" => [$fid1 => 1, $fid2 =>2],
           "total_price" => 32];
print_r($order1);
echo "<br>";
echo json_encode($order1);
echo "<br>";
print_r(json_decode(json_encode($order1), true));


?>