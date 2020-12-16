<?php

// require_once("../../db/db_fns.php");
// require_once("../class.php");


function db_insert_customer($customer)
{
    $login_pwd = $customer->get_login_pwd();
    $pay_pwd = $customer->get_pay_pwd();
    $cid = $customer->get_cid();
    $sex = $customer->get_sex();
    $age = $customer->get_age();
    $qq = $customer->get_qq();
    $phone = $customer->get_phone();
    $nickname = $customer->get_nickname();
    $realname = $customer->get_realname();
    $address = $customer->get_address();
    $email = $customer->get_email();


    $conn = db_connect();

    $query = "insert into Customer (login_name, login_pwd, pay_pwd, cid,
                                    sex, age, qq, phone,
                                    nickname, realname, address, email)
              values ('$login_name', '$login_pwd', '$pay_pwd', '$cid',
                      '$sex', $age, '$qq', '$phone',
                      '$nickname', '$realname', '$address', '$email');";
    $result = $conn->query($query);
    if ($result == false) {
        return false;
    } else {
        return true;
    }
}

function signup_customer()
{
    $login_name = $_POST["login_name"];
    if(is_signup("Customer", $login_name)) {return false;}

    $login_pwd = $_POST["login_pwd"];
    $pay_pwd = $_POST["pay_pwd"];
    $sex = $_POST["sex"];
    $age = $_POST["age"];
    $qq = $_POST["qq"];
    $phone = $_POST["phone"];
    $nickname = $_POST["nickname"];
    $realname = $_POST["realname"];
    $address = $_POST["address"];
    $email = $_POST["email"];

    $cid = md5(uniqid());


    $new_customer = new Customer($login_name, $login_pwd,
                                 $cid, $pay_pwd, $sex, $age,
                                 $qq, $phone, $nickname, $realname, $address, $email);

    db_insert_customer($new_customer);

    return $new_customer;
}

function login_customer($login_name, $login_pwd)
{
    $row = get_user_row("Customer", $login_name, $login_pwd);
    if ($row == false) {return false;}


    $login_name = $row["login_name"];
    $login_pwd = $row["login_pwd"];
    $pay_pwd = $row["pay_pwd"];
    $cid = $row["cid"];
    $sex = $row["sex"];
    $age = $row["age"];
    $qq = $row["qq"];
    $phone = $row["phone"];
    $nickname = $row["nickname"];
    $realname = $row["realname"];
    $address = $row["address"];
    $email = $row["email"];


    $new_customer = new Customer($login_name, $login_pwd,
                                 $cid, $pay_pwd, $sex, $age,
                                 $qq, $phone, $nickname, $realname, $address, $email);

    return $new_customer;
}

?>