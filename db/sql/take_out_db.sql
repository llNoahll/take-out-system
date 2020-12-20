SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


CREATE TABLE `Manager` (
  `mid` char(32) NOT NULL Primary Key,
  `login_name` varchar(40) NOT NULL,
  `login_pwd` varchar(40) NOT NULL,
  `nickname` varchar(40) NOT NULL,
  `permission` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Shop` (
  `sid` char(32) NOT NULL Primary Key,
  `login_name` varchar(40) NOT NULL,
  `login_pwd`  varchar(40) NOT NULL,
  `boss_name`  varchar(40) DEFAULT NULL,
  `shop_name`  varchar(40) DEFAULT NULL,
  `foods_msg` JSON DEFAULT NULL,
  `phone` char(11) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `isrecommend` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Customer` (
  `cid` char(32) NOT NULL Primary Key,
  `login_name` varchar(40) NOT NULL,
  `login_pwd` varchar(40) NOT NULL,
  `pay_pwd` char(6) DEFAULT NULL,
  `sex` char(1) DEFAULT NULL,
  `age` tinyint(4) DEFAULT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `phone` char(11) DEFAULT NULL,
  `nickname` varchar(30) DEFAULT NULL,
  `realname` varchar(30) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `Order` (
  `oid` char(32) NOT NULL Primary Key,
  `sid` char(32) NOT NULL,
  `cid` char(32) NOT NULL,
  `pay_time` datetime NOT NULL,
  `accept_time` datetime DEFAULT NULL,
  `arrive_time` datetime DEFAULT NULL,
  `order_state` char(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `order_food` JSON DEFAULT NULL,
  `total_price` float NOT NULL,

  foreign key (sid) REFERENCES Shop(sid),
  foreign key (cid) REFERENCES Customer(cid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
