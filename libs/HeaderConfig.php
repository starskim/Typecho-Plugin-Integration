<?php

require_once 'Services/Handsomes.php';
require_once 'Services/LocalConst.php';
require_once 'Services/RobotsPlus.php';
require_once 'Services/ReturnTop.php';

class headerConfig extends Services
{
    /**
     * 页头输出相关代码
     *
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public function header()
    {
        self::init();
        $options = Helper::options();
        $config = $options->plugin('Integration');
        if (self::exist_value('RobotsPlus', $config->Console)) {
            (new RobotsPlus)->header($config);
        }
        (new LocalConst)->header($config);
        echo "<link rel='stylesheet' type='text/css' href='" . INTEGRATION_STATIC_PATH . "css/General.css' />\n";
        if (self::GetTheme() == 'handsome') {
            (new Handsomes)->Pjax($config);
            echo "<link rel='stylesheet' type='text/css' href='" . INTEGRATION_STATIC_PATH . "css/handsome.css' />\n";
        }
        (new ReturnTop)->header($config);

    }
}