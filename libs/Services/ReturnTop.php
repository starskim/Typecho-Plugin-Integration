<?php

class ReturnTop extends Services
{
    public function header($plugin, $Path)
    {
        // 获取配置信息
        $type = $plugin->ReturnTop;

        if ($type == 1) {
            echo '<link rel="stylesheet" type="text/css" href="' . $Path . 'css/top.css" />';
        } elseif ($type == 2) {
            echo '<link rel="stylesheet" type="text/css" href="' . $Path . 'css/szgotop.css" />';
        }
    }

    public function footer($plugin, $Path)
    {
        // 获取配置信息
        $type = $plugin->ReturnTop;

        if ($type == 1) {
            echo '<div id="updown"><div class="sidebar_wo" id="leimu">
	        <img src="' . $Path . 'images/leimuA.png" alt="雷姆" onmouseover="this.src=\'' . $Path . 'images/leimuB.png\'" onmouseout="this.src=\'' . $Path . 'images/leimuA.png\'" id="audioBtn"></div>
	        <div class="sidebar_wo" id="lamu"><img src="' . $Path . 'images/lamuA.png" alt="雷姆" onmouseover="this.src=\'' . $Path . 'images/lamuB.png\'" onmouseout="this.src=\'' . $Path . 'images/lamuA.png\'" id="audioBtn"></div>
	        <script type="text/javascript" src="' . $Path . 'js/top.js"></script>';
        } elseif ($type == 2) {
            echo '<div class="back-to-top cd-top faa-float animated cd-is-visible" style="top: -900px;"></div>
            <script type="text/javascript" src="' . $Path . 'js/szgotop.js"></script>';
        }
    }
}