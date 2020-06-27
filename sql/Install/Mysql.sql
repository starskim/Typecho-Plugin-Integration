CREATE TABLE IF NOT EXISTS `typecho_robots_logs`
(
    `lid`   int(10) unsigned NOT NULL auto_increment,
    `bot`   varchar(16)      default NULL,
    `url`   varchar(64)      default NULL,
    `ip`    varchar(16)      default NULL,
    `ltime` int(10) unsigned default '0',
    PRIMARY KEY (`lid`)
) DEFAULT CHARACTER SET {charset};
CREATE TABLE IF NOT EXISTS `typecho_baidusubmit`
(
    `id`      int unsigned NOT NULL auto_increment,
    `subject` varchar(255) COMMENT '主体',
    `action`  varchar(255) COMMENT '动作',
    `object`  varchar(255) COMMENT '对象',
    `result`  varchar(255) COMMENT '结果',
    `more`    text COMMENT '更多信息',
    `time`    bigint COMMENT '时间',
    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET {charset};
