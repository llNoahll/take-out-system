<?php

// require_once("../db/db_fns.php");


class User
{
    protected $login_name;
    protected $login_pwd;

    public function __construct($login_name, $login_pwd)
    {

        $this->login_name = $login_name;
        $this->login_pwd = $login_pwd;
    }

    public function get_login_name() {return $this->login_name;}
    public function get_login_pwd() {return $this->login_pwd;}

    public function set_login_pwd($new_pwd) {$this->login_pwd = $new_pwd;}
}

function db_is_signup($table_name, $login_name)
{
    $conn = db_connect();

    $query = "select *
              from `$table_name`
              where login_name = '$login_name';";
    $result = $conn->query($query);
    if ($result === false || $result->num_rows === 0) {
        return false;
    } else {
        return true;
    }
}

function db_get_user_row($table_name, $login_name, $login_pwd)
{
    $conn = db_connect();

    $query = "select *
              from `$table_name`
              where login_name = '$login_name' and login_pwd = '$login_pwd';";
    $result = $conn->query($query);
    if ($result === false || $result->num_rows === 0) {
        return false;
    } else {
        $row = $result->fetch_assoc();
        return array_map("sqlval_to_phpval", $row);
    }
}


class Customer extends User
{
    private $pay_pwd;
    private $cid;
    private $sex;
    private $age;
    private $qq;
    private $phone;
    private $nickname;
    private $realname;
    private $address;
    private $email;

    public function __construct($login_name, $login_pwd,
                                $cid, $pay_pwd, $sex, $age,
                                $qq, $phone, $nickname, $realname, $address, $email)
    {
        $this->login_name = $login_name;
        $this->login_pwd = $login_pwd;

        $this->cid = $cid;
        $this->pay_pwd = $pay_pwd;
        $this->sex = $sex;
        $this->age = $age;
        $this->qq = $qq;
        $this->phone = $phone;
        $this->nickname = $nickname;
        $this->realname = $realname;
        $this->address = $address;
        $this->email = $email;
    }


    public function db_update_value($key, $value)
    {
        if($key === "login_name" || $key === "cid") {return false;}
        $value = phpval_to_sqlval($value);

        $conn = db_connect();

        $query = "update Customer set '$key' = '$value' where cid = '$this->cid';";
        $result = $conn->query($query);
        if ($result === false) {
            return false;
        } else {
            return true;
        }
    }

    public function set_login_pwd($new_login_pwd)
    {
        if (db_update_value("login_pwd", $new_pwd) === false) {
            return false;
        } else {
            $this->login_pwd = $new_pwd;
            return true;
        }
    }

    public function set_pay_pwd($new_pay_pwd)
    {
        if (db_update_value("pay_pwd", $new_pay_pwd) === false) {
            return false;
        } else {
            $this->pay_pwd = $new_pay_pwd;
            return true;
        }
    }

    public function set_sex($new_sex)
    {
        if (db_update_value("sex", $sex) === false) {
            return false;
        } else {
            $this->sex = $new_sex;
            return true;
        }
    }

    public function set_age($new_age)
    {
        if (db_update_value("age", $new_age) === false) {
            return false;
        } else {
            $this->age = $new_age;
            return true;
        }
    }

    public function set_qq($new_qq)
    {
        if (db_update_value("qq", $new_qq) === false) {
            return false;
        } else {
            $this->qq = $new_qq;
            return true;
        }
    }

    public function set_phone($new_phone)
    {
        if (db_update_value("phone", $new_phone) === false) {
            return false;
        } else {
            $this->phone = $new_phone;
            return true;
        }
    }

    public function set_nickname($new_nickname)
    {
        if (db_update_value("nickname", $new_nickname) === false) {
            return false;
        } else {
            $this->nickname = $new_nickname;
            return true;
        }
    }

    public function set_realname($new_realname)
    {
        if (db_update_value("realname", $new_realname) === false) {
            return false;
        } else {
            $this->realname = $new_realname;
            return true;
        }
    }

    public function set_address($new_address)
    {
        if (db_update_value("address", $new_addres) === false) {
            return false;
        } else {
            $this->address = $new_adress;
            return true;
        }
    }

    public function set_email($new_email)
    {
        if (db_update_value("email", $new_email) === false) {
            return false;
        } else {
            $this->email = $new_email;
            return true;
        }
    }


    public function get_login_name() {return $this->login_name;}
    public function get_login_pwd() {return $this->login_pwd;}
    public function get_cid() {return $this->cid;}
    public function get_pay_pwd() {return $this->pay_pwd;}
    public function get_sex() {return $this->sex;}
    public function get_age() {return $this->age;}
    public function get_qq() {return $this->qq;}
    public function get_phone() {return $this->phone;}
    public function get_nickname() {return $this->nickname;}
    public function get_realname() {return $this->realname;}
    public function get_address() {return $this->address;}
    public function get_email() {return $this->email;}
}

class Shop extends User
{
    public $isrecommend;
    private $sid;
    private $boss_name;
    private $shop_name;
    private $foods_msg;
    private $phone;
    private $email;
    private $address;

    public function __construct($login_name, $login_pwd,
                                $sid, $boss_name, $shop_name,
                                $phone, $email, $address,
                                $isrecommend)
    {
        $this->isrecommend = $isrecommend;

        $this->login_name = $login_name;
        $this->login_pwd = $login_pwd;
        $this->sid = $sid;
        $this->boss_name = $boss_name;
        $this->shop_name = $shop_name;
        $this->foods_msg = $foods_msg;
        $this->phone = $phone;
        $this->email = $email;
        $this->address = $address;
    }



    public function db_update_value($key, $value)
    {
        if($key === "login_name" || $key === "cid") {return false;}
        $value = phpval_to_sqlval($value);

        $conn = db_connect();

        $query = "update Shop set '$key' = '$value' where sid = '$this->sid';";
        $result = $conn->query($query);
        if ($result === false) {
            return false;
        } else {
            return true;
        }
    }

    public function set_login_pwd($new_pwd)
    {
        if (db_update_value("login_pwd", $new_pwd) === false) {
            return false;
        } else {
            $this->login_pwd = $new_pwd;
            return true;
        }
    }

    public function set_boss_name($new_boss_name)
    {
        if (db_update_value("boss_name", $new_boss_name) === false) {
            return false;
        } else {
            $this->boss_name = $new_boss_name;
            return true;
        }
    }

    public function set_shop_name($new_shop_name)
    {
        if (db_update_value("shop_name", $new_shop_name) === false) {
            return false;
        } else {
            $this->shop_name = $new_shop_name;
            return true;
        }
    }

    public function set_foods_msg($new_foods_msg)
    {
        if (db_update_value("foods_msg", addslashes(json_encode($new_foods_msg))) === false) {
            return false;
        } else {
            $this->shop_name = $new_shop_name;
            return true;
        }
    }

    public function set_phone($new_phone)
    {
        if (db_update_value("phone", $new_phone) === false) {
            return false;
        } else {
            $this->phone = $new_phone;
            return true;
        }
    }

    public function set_email($new_email)
    {
        if (db_update_value("email", $new_email) === false) {
            return false;
        } else {
            $this->email = $new_email;
            return true;
        }
    }

    public function set_address($new_address)
    {
        if (db_update_value("address", $new_address) === false) {
            return false;
        } else {
            $this->address = $new_address;
            return true;
        }
    }


    public function get_login_name() {return $this->login_name;}
    public function get_login_pwd() {return $this->login_pwd;}
    public function get_sid() {return $this->sid;}
    public function get_boss_name() {return $this->boss_name;}
    public function get_shop_name() {return $this->shop_name;}
    public function get_foods_msg() {return $this->foods_msg;}
    public function get_phone() {return $this->phone;}
    public function get_email() {return $this->email;}
    public function get_address() {return $this->address;}

    public function get_food_msg($id)
    {
        foreach($foods_msg as $fid => $food_msg) {
            if($id === $fid) {return $food_msg;}
        }
        return false;
    }


    public function add_food($fname, $price, $brief, $img_path)
    {
        $fid = md5(uniqid());
        $this->foods_msg[$fid] = ["fid" => $fid,
                                  "fname" => $fname,
                                  "price" => $price,
                                  "brief" => $brief,
                                  "img_path" => $img_path];
        $this->set_foods_msg($this->foods_msg);
    }

}

class Manager extends User
{
    private $mid;
    private $nickname;
    private $permission;

    public function __construct($login_name, $login_pwd,
                                $mid, $nickname, $permission)
    {
        $this->login_name = $login_name;
        $this->login_pwd = $login_pwd;

        $this->mid = $mid;
        $this->nickname = $nickname;
        $this->permission = $permission;
    }


    public function db_update_value($key, $value)
    {
        if($key === "login_name" || $key === "mid") {return false;}
        $value = phpval_to_sqlval($value);

        $conn = db_connect();

        $query = "update Manager set '$key' = '$value' where mid = '$this->mid';";
        $result = $conn->query($query);
        if ($result === false) {
            return false;
        } else {
            return true;
        }
    }

    public function set_login_pwd($new_login_pwd)
    {
        if (db_update_value("login_pwd", $new_pwd) === false) {
            return false;
        } else {
            $this->login_pwd = $new_pwd;
            return true;
        }
    }

    public function set_nickname($new_nickname)
    {
        if (db_update_value("nickname", $new_nickname) === false) {
            return false;
        } else {
            $this->login_nickname = $new_nickname;
            return true;
        }
    }


    public function get_login_name() {return $this->login_name;}
    public function get_login_pwd() {return $this->login_pwd;}
    public function get_mid() {return $this->mid;}
    public function get_nickname() {return $this->nickname;}
    public function get_permission() {return $this->permission;}
}


?>
