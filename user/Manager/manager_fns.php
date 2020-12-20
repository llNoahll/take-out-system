<?php

// require_once("../../db/db_fns.php");
// require_once("../class.php");


function db_insert_manager($manager)
{
    if(($manager instanceof Manager) === false) {return false;}

    $login_name = $manager->get_login_name();
    if(db_is_signup("Manager", $login_name)) {return false;}

    $login_pwd = $manager->get_login_pwd();
    $mid = $manager->get_mid();
    $nickname = $manager->get_nickname();
    $permission = $manager->get_permission();


    $conn = db_connect();

    $query = "insert into Manager (login_name, login_pwd, mid,
                                   nickname, permission)
              values ('$login_name', '$login_pwd', '$mid',
                      '$nickname', '$permission');";
    $result = $conn->query($query);
    if ($result === false) {
        return false;
    } else {
        return true;
    }
}

function signup_manager()
{
    $login_name = $_POST["login_name"];
    if(db_is_signup("Manager", $login_name)) {return false;}

    $login_pwd = $_POST["login_pwd"];
    $nickname = $_POST["nickname"];
    $permission = $_POST["permission"];

    $mid = md5(uniqid());


    $new_manager = new Manager($login_name, $login_pwd,
                               $mid, $nickname, $permission);

    db_insert_manager($new_manager);

    return $new_manager;
}

function login_manager($login_name, $login_pwd)
{
    $row = db_get_user_row("Manager", $login_name, $login_pwd);
    if ($row === false) {return false;}


    $login_name = $row["login_name"];
    $login_pwd = $row["login_pwd"];
    $mid = $row["mid"];
    $nickname = $row["nickname"];
    $permission = $row["permission"];


    $new_manager = new Manager($login_name, $login_pwd,
                               $mid, $nickname, $permission);

    return $new_manager;
}

?>