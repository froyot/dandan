DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `title` char(255) NOT NULL,
  `content` text NOT NULL,
  `create_by` int(11) NOT NULL COMMENT '创建人id',
  `others` char(255) DEFAULT NULL COMMENT 'other info',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='内容表';

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
    `id` int(11) PRIMARY KEY AUTO_INCREMENT,
    `create_at` TIMESTAMP NOT NULL,
    `update_at` TIMESTAMP,
    `name` varchar(30) comment '用户名' NOT NULL,
    `password` varchar(40) NOT NULL,
    `token` varchar(40) DEFAULT NULL,
    `last_login_time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `last_login_ip` varbinary(4) comment 'last user login ip' DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '用户以及管理员表';


DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
`user_id`  int(11) NULL ,
`role`  enum('admin','editor','user') NULL DEFAULT 'user' ,
UNIQUE INDEX `user_id` (`user_id`)
) ENGINE=InnoDB CHARSET=utf8 comment '用户角色表';


DROP TABLE IF EXISTS `params`;
CREATE TABLE `params` (
`id` int(11) PRIMARY KEY AUTO_INCREMENT,
`name` char(20) NOT NULL,
`type` enum('cat','tag'),
`create_by` int(11) NOT NULL,
`create_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB CHARSET=utf8 comment '文章属性';

DROP TABLE IF EXISTS `relation`;
CREATE TABLE `relation` (
`content_id` int(11) ,
`params_id` int(11),
PRIMARY KEY (`content_id`,`params_id`)
) ENGINE=InnoDB CHARSET=utf8 comment '文章属性关联表';



