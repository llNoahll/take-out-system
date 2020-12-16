<?php

function db_connect()
{
    // server, login_name, login_pwd, db_name
    try {
        $conn = new mysqli('localhost', 'lzu_takeout_system', 'password', 'take_out_db');
    } catch (Exception $ex) {
        die("数据库连接失败");
    }
    return $conn;
}

function db_result_to_array($result)
{
    $res_array = array();
    for($count=0, $row = $result->fetch_assoc();
        $row == false;
        $count++, $row = $result->fetch_assoc())
    {
        $res_array[$count] = $row;
    }

    return $res_result;
}


function phpval_to_sqlval($value)
{
    return $value;

    // if($value == true) {
    //     return 1;
    // } else if($value == false) {
    //     return 0;
    // } else if(is_array($value)) {
    //     return array_map("phpval_to_sqlval", $value);
    // } else {
    //     return value;
    // }
}

function sqlval_to_phpval($value)
{
    return $value;

    // if($value == 1) {
    //     return true;
    // } else if($value == 0) {
    //     return false;
    // } else if(is_array($value)) {
    //     return array_map("phpval_to_sqlval", $value);
    // } else {
    //     return value;
    // }
}

?>
