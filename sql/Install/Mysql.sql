CREATE TABLE IF NOT EXISTS `typecho_robots_logs`
(
    `lid`   int(10) unsigned NOT NULL auto_increment,
    `bot`   varchar(16)      default NULL,
    `url`   varchar(64)      default NULL,
    `ip`    varchar(16)      default NULL,
    `ltime` int(10) unsigned default '0',
    PRIMARY KEY (`lid`)
) DEFAULT CHARACTER SET {charset};