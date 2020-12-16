<?php

require_once("../user/class.php");


function make_order($sid, $cid, $address, $food_msg, $total_price)
{
    return ["oid" => md5(uniqid()),
            "sid" => $sid,
            "cid" => $cid,
            "pay_time" => date("Y-m-d"),
            "accept_time" => false,
            "arrive_time" => false,
            "order_state" => "request", // request, accept, finish, cancel
            "address" => $address,
            "food_msg" => $food_msg,
            "total_price" => $total_price];
}


function accept_order($shop, $order)
{
    if(($shop instanceof Shop)
       && ($shop->sid == $order["sid"]))
    {
        $order["accept_time"] = date("Y-m-d");
        $order["order_state"] = "accept";
        return true;
    } else {
        return false;
    }
}

function finish_order($customer, $order)
{
    if(($customer instanceof Customer)
       && ($customer->cid == $order["cid"]))
    {
        $order["arrive_time"] = date("Y-m-d");
        $order["order_state"] = "finish";
        return true;
    } else {
        return false;
    }
}

function cancel_order($obj, $order)
{
    if((($obj instanceof Customer) && ($obj->cid == $order["cid"]))
       || (($obj instanceof Shop) && ($obj->sid == $order["sid"])))
    {
        $order["order_state"] = "cancel";
        return true;
    } else {
        return false;
    }
}

?>