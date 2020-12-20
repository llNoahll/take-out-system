INSERT INTO `Manager` (`mid`, `login_name`, `login_pwd`, `nickname`, `permission`)
VALUES ('5fdea7e918cc6', '320180940752', '123456', 'M1', 1);

INSERT INTO `Shop` (`sid`, `login_name`, `login_pwd`, `shop_name`, `boss_name`, `phone`, `email`, `address`, `isrecommend`)
VALUES ('5fdea7f1202ba', '320180940750', '123456', '网和豆腐', '李华', '13646543128', 'test@lzu.edu.cn', '兰大', 0),
       ('5fdea80f62db9', '320180940753', '123456', '网和牛肉', '小红', '13642043128', 'test@lzu.edu.cn', '兰大', 0);

INSERT INTO `Customer` (`cid`, `login_name`, `login_pwd`, `pay_pwd`, `sex`, `age`, `qq`, `phone`, `nickname`, `realname`, `email`, `address`)
VALUES ('5fdea83ccd3d2', '320180940751', '123456', '666666', '男', 20, '354321384', '13656438496', 'C1', '李亮', 'test@lzu.edu.cn', '兰大'),
       ('5fdea8439c574', '320180940754', '123456', '666666', '女', 18, '354321385', '13656418806', 'C2', '福安', 'test@lzu.edu.cn', '兰大');

INSERT INTO `Order` (`oid`, `sid`, `cid`, `pay_time`, `accept_time`, `arrive_time`, `order_state`, `address`, `order_food`, `total_price`)
VALUES ('5fdebdd58b1e3', '5fdea7f1202ba', '5fdea8439c574', '2020-12-20 06:27:10', NULL, NULL, 'request', '兰大', '{"5fdebd669ee1d":1,"5fdebd763440a":2}', 32);

