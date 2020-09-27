<?php

class RobotsPlus extends Services
{

    /**
     * 页头输出相关代码
     *
     * @access public
     * @param unknown header
     * @return unknown
     */
    public function header($plugin)
    {
        $bot = NULL;
        $botlist = $plugin->botlist;
        if (sizeof($botlist) > 0) {
            @ $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
            foreach ($botlist as $value) {
                if (strpos($useragent, $value) !== false) {
                    $bot = $value;
                }
            }
            if ($bot !== NULL) {
                $request = new Typecho_Request;
                $ip = $request->getIp();
                $url = $_SERVER['REQUEST_URI'];
                if ($ip == NULL) {
                    $ip = 'UnKnow';
                }
                $options = Helper::options();
                $timeStamp = $options->gmtTime;
                $offset = $options->timezone - $options->serverTimezone;
                $gtime = $timeStamp + $offset;
                $db = Typecho_Db::get();
                $rows = array(
                    'bot' => $bot,
                    'url' => $url,
                    'ip' => $ip,
                    'ltime' => $gtime,
                );
                $db->query($db->insert('table.robots_logs')->rows($rows));
            }
        }
    }
}