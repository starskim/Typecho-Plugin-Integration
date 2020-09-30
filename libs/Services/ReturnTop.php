<?php

class ReturnTop extends Services
{
    public function header($plugin)
    {
        // 获取配置信息
        $type = $plugin->ReturnTop;

        if ($type == 1) {
            echo '<link rel="stylesheet" type="text/css" href="' . Integration_STATIC_PATH . 'css/top.css" />';
        } elseif ($type == 2) {
            echo '<link rel="stylesheet" type="text/css" href="' . Integration_STATIC_PATH . 'css/szgotop.css" />';
        }
    }

    public function footer($plugin)
    {
        // 获取配置信息
        $type = $plugin->ReturnTop;

        if ($type == 1) {
            echo '<div id="updown"><div class="sidebar_wo" id="leimu">
	        <img src="' . Integration_STATIC_PATH . 'images/leimuA.png" alt="雷姆" onmouseover="this.src=\'' . Integration_STATIC_PATH . 'images/leimuB.png\'" onmouseout="this.src=\'' . Integration_STATIC_PATH . 'images/leimuA.png\'" id="audioBtn"></div>
	        <div class="sidebar_wo" id="lamu"><img src="' . Integration_STATIC_PATH . 'images/lamuA.png" alt="雷姆" onmouseover="this.src=\'' . Integration_STATIC_PATH . 'images/lamuB.png\'" onmouseout="this.src=\'' . Integration_STATIC_PATH . 'images/lamuA.png\'" id="audioBtn"></div>
	        <script type="text/javascript" src="' . Integration_STATIC_PATH . 'js/top.js"></script>';
        } elseif ($type == 2) {
            echo '<div class="back-to-top cd-top faa-float animated cd-is-visible" style="top: -900px;"></div>
            <script type="text/javascript" src="' . Integration_STATIC_PATH . 'js/szgotop.js"></script>';
        }
    }
}