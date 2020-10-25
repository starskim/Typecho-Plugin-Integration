<?php

class ReturnTop extends Services
{
    public function header($plugin)
    {
        // 获取配置信息
        $type = $plugin->ReturnTop;

        if ($type == 1) {
            echo "<link rel='stylesheet' type='text/css' href='" . INTEGRATION_STATIC_PATH . "css/top.css' />\n";
        } elseif ($type == 2) {
            echo "<link rel='stylesheet' type='text/css' href='" . INTEGRATION_STATIC_PATH . "css/szgotop.css' />\n";
        }
    }

    public function footer($plugin)
    {
        // 获取配置信息
        $type = $plugin->ReturnTop;

        if ($type == 1) {
            echo "<div id='updown'><div class='sidebar_wo' id='leimu'>\n
	        <img src='" . INTEGRATION_STATIC_PATH . "images/leimuA.png' alt='雷姆' onmouseover='this.src=" . INTEGRATION_STATIC_PATH . "images/leimuB.png' onmouseout='this.src=" . INTEGRATION_STATIC_PATH . "images/leimuA.png' id='audioBtn'>\n
	        </div>
	        <div class='sidebar_wo' id='lamu'>\n
	        <img src='" . INTEGRATION_STATIC_PATH . "images/lamuA.png' alt='雷姆' onmouseover='this.src=" . INTEGRATION_STATIC_PATH . "images/lamuB.png' onmouseout='this.src=" . INTEGRATION_STATIC_PATH . "images/lamuA.png' id='audioBtn'>\n
	        </div>\n";
        } elseif ($type == 2) {
            echo "<div class='back-to-top cd-top faa-float animated cd-is-visible' style='top: -900px;'></div>\n";
        }
    }
}