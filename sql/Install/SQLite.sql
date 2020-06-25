CREATE TABLE `typecho_robots_logs`
(
    `lid`   int(10) NOT NULL,
    `bot`   varchar(16) DEFAULT NULL,
    `url`   varchar(64) DEFAULT NULL,
    `ip`    varchar(16) DEFAULT NULL,
    `ltime` int(10)     DEFAULT '0',
    PRIMARY KEY (`lid`)
);
