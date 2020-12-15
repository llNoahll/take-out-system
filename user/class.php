<?php

require_once("../db/db_fns.php");


class Shop
{
    private $login_name = "";
    private $login_pwd = "";
    private $id = "";
    private $boss_name = "";
    private $orders;
    private $phone;
    private $email;
    private $address;

    public function __construct($login_name, $login_pwd,
                                $id, $boss_name, $orders,
                                $phone, $email, $address)
    {

        $this->login_name = $login_name;
        $this->login_pwd = $login_pwd;
        $this->id = $id;
        $this->boss_name = $boss_name;
        $this->orders = $orders;
        $this->phone = $phone;
        $this->email = $email;
        $this->address = $address;
    }

}

function make_shop($login_name, $login_pwd)
{
    $conn = db_connect();

    $query = "select *
              from shop
              where login_name = '$login_name' and login_pwd = '$login_pwd';";
    $result = $conn->query($query);
    if ($result == false || $result->num_rows == 0) {return false;}
    $row = $result->fetch_assoc();


    $login_name = $row["login_name"];
    $login_pwd = $row["login_pwd"];
    $id = $row["id"];
    $boss_name = $row["boss_name"];
    $orders = $row["orders"];
    $phone = $row["phone"];
    $email = $row["email"];
    $address = $row["address"];


    $new_shop = new Shop($login_name, $login_pwd,
                         $id, $boss_name, $orders,
                         $phone, $email, $address);

    return $new_shop;
}

?>
