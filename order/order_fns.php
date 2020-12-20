<?php

require_once("../user/class.php");


function db_has_order($oid)
{
    $conn = db_connect();

    $query = "select *
              from `Order`
              where oid = '$oid';";
    $result = $conn->query($query);
    if ($result === false || $result->num_rows === 0) {
        return false;
    } else {
        return true;
    }
}

function db_get_order($oid)
{
    $conn = db_connect();

    $query = "select *
              from `Order`
              where oid = '$oid';";
    $result = $conn->query($query);
    if ($result === false || $result->num_rows === 0) {return false;}

    $row = $result->fetch_assoc();
    $row = array_map("sqlval_to_phpval", $row);


    $sid = $row["sid"];
    $cid = $row["cid"];
    $pay_time = $row["pay_time"];
    $accept_time = $row["accept_time"];
    $arrive_time = $row["arrive_time"];
    $order_state = $row["order_state"]; // request, accept, finish, cancel
    $address = $row["address"];
    $total_price = $row["total_price"];

    $order_food = json_decode($row["order_food"], true);
    if(get_magic_quotes_gpc()) {$order_food = stripslashes($order_food);}


    return ["oid" => $oid,
            "sid" => $sid,
            "cid" => $cid,
            "pay_time" => $pay_time,
            "accept_time" => $accept_time,
            "arrive_time" => $arrive_time,
            "order_state" => $order_state,
            "address" => $address,
            "order_food" => $order_food,
            "total_price" => $total_price];
}

function db_insert_order($order)
{
    $oid = $order["oid"];
    if(db_has_order($oid)) {return false;}

    $sid = $order["sid"];
    $cid = $order["cid"];
    $pay_time = $order["pay_time"];
    $accept_time = $order["accept_time"];
    $arrive_time = $order["arrive_time"];
    $order_state = $order["order_state"]; // request, accept, finish, cancel
    $address = $order["address"];
    $total_price = $order["total_price"];

    $order_food = addslashes(json_encode($order["order_food"]));


    $conn = db_connect();

    $query = "insert into Order (oid, sid, cid, pay_time, accept_time, arrive_time,
                                 order_state, address, order_food, total_price)
              values ('$oid', '$sid', '$cid',
                      '$pay_time', '$accept_time', '$arrive_time', '$order_state',
                      '$address', '$order_food', $total_price);";
    $result = $conn->query($query);
    if ($result === false) {
        return false;
    } else {
        return true;
    }
}

function db_update_order($order)
{
    $order = array_map("phpval_to_sqlval", $order);
    $oid = $order["oid"];
    $conn = db_connect();

    foreach($order as $key => $value)
    {
        if($key === "oid") {
            continue;
        } else if ($key === "order_food") {
            $value = addslashes(json_encode($value));
        }

        $query = "update Order set '$key' = '$value' where oid = '$oid';";
        $result = $conn->query($query);
        if ($result === false) {return false;}

    }

    return true;
}


function make_order($shop, $customer, $address, $order_food)
{
    $oid = md5(uniqid());
    $sid = $shop->get_sid();
    $cid = $customer->get_cid();
    $pay_time = date("Y-m-d H:i:s");
    $accept_time = NULL;
    $arrive_time = NULL;
    $order_state = "request";   // request, accept, finish, cancel.

    $total_price = 0;
    foreach($order_food as $fid => $fnum)
    {
        $food_msg = $shop->get_food_msg($fid);
        if($food_msg === false) {return false;}

        $total_price += $food_msg['price'];
    }


    $order = ["oid" => $oid,
              "sid" => $sid,
              "cid" => $cid,
              "pay_time" => $pay_time,
              "accept_time" => $accept_time,
              "arrive_time" => $arrive_time,
              "order_state" => $order_state,
              "address" => $address,
              "order_food" => $order_food,
              "total_price" => $total_price];
    db_insert_order($order);

    return $order;
}


function accept_order($shop, $order)
{
    if(($shop instanceof Shop)
       && ($shop->sid === $order["sid"]))
    {
        $order["accept_time"] = date("Y-m-d H:i:s");
        $order["order_state"] = "accept";
        return db_update_order($order);
    } else {
        return false;
    }
}

function finish_order($customer, $order)
{
    if(($customer instanceof Customer)
       && ($customer->cid === $order["cid"]))
    {
        $order["arrive_time"] = date("Y-m-d H:i:s");
        $order["order_state"] = "finish";
        return db_update_order($order);
    } else {
        return false;
    }
}

function cancel_order($obj, $order)
{
    if((($obj instanceof Customer) && ($obj->cid === $order["cid"]))
       || (($obj instanceof Shop) && ($obj->sid === $order["sid"])))
    {
        $order["order_state"] = "cancel";
        return db_update_order($order);
    } else {
        return false;
    }
}

?>