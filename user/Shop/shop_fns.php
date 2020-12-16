<?php

require_once("../../db/db_fns.php");
require_once("../class.php");


function db_insert_shop($shop)
{
    $isrecommend = $shop->isrecommend;

    $login_name = $shop->get_login_name();
    $login_pwd = $shop->get_login_pwd();
    $sid = $shop->get_sid();
    $boss_name = $shop->get_boss_name();
    $shop_name = $shop->get_shop_name();
    // $orders = $shop->get_orders();
    $phone = $shop->get_phone();
    $email = $shop->get_email();
    $address = $shop->get_address();


    $conn = db_connect();

    $query = "insert into Shop (login_name, login_pwd,
                                sid, boss_name, shop_name,
                                phone, email, address,
                                isrecommend)
              values ('$login_name', '$login_pwd',
                      '$sid', '$boss_name', '$shop_name',
                      '$phone', '$email', '$address',
                      '$isrecommend');";
    $result = $conn->query($query);
    if ($result == false) {
        return false;
    } else {
        return true;
    }
}

function signup_shop()
{
    $login_name = $_POST["login_name"];
    if(is_signup("Shop", $login_name)) {return false;}


    $login_pwd = $_POST["login_pwd"];
    $boss_name = $_POST["boss_name"];
    $shop_name = $_POST["shop_name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $address = $_POST["address"];

    $sid = md5(uniqid());


    $new_shop = new Shop($login_name, $login_pwd,
                         $sid, $boss_name, $shop_name, array(),
                         $phone, $email, $address,
                         0);

    db_insert_shop($new_shop);

    return $new_shop;
}

function login_shop($login_name, $login_pwd)
{
    $row = get_user_row("Shop", $login_name, $login_pwd);
    if ($row == false) {return false;}

    $login_name = $row["login_name"];
    $login_pwd = $row["login_pwd"];
    $sid = $row["sid"];
    $boss_name = $row["boss_name"];
    $shop_name = $row["shop_name"];
    // $orders = $row["orders"];
    $phone = $row["phone"];
    $email = $row["email"];
    $address = $row["address"];
    $isrecommend = $row["isrecommend"];


    $new_shop = new Shop($login_name, $login_pwd,
                         $sid, $boss_name, $shop_name,
                         $phone, $email, $address,
                         $isrecommend);

    return $new_shop;
}

?>