CREATE TABLE IF NOT EXISTS `typecho_robots_logs`
(
    `lid`   int(10) NOT NULL,
    `bot`   varchar(16) DEFAULT NULL,
    `url`   varchar(64) DEFAULT NULL,
    `ip`    varchar(16) DEFAULT NULL,
    `ltime` int(10)     DEFAULT '0',
    PRIMARY KEY (`lid`)
);
CREATE TABLE IF NOT EXISTS "typecho_baidusubmit"
(
    "id"      int NOT NULL,
    "subject" varchar(255),
    "action"  varchar(255),
    "object"  varchar(255),
    "result"  varchar(255),
    "more"    text,
    "time"    bigint,
    PRIMARY KEY ("id")
)