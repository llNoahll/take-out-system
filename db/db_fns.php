<?php

function db_connect()
{
    // server, login_name, login_pwd, db_name
    $result = new mysqli('localhost', 'lzu_takeout_system', 'password', 'takeout_system');
    if ($result == false) {
        return false;
    } else {
        return $result;
    }
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

?>

