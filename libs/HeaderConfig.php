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
     * @param unknown header
     * @return unknown
     */
    public function header()
    {
        self::init();
        $options = Helper::options();
        $config = $options->plugin('Integration');
        if (self::exist_value('RobotsPlus', $config->Console)) {
            RobotsPlus::header($config);
        }
        LocalConst::header($config);
        echo "<link rel='stylesheet' type='text/css' href='" . INTEGRATION_STATIC_PATH . "css/General.css' />\n";
        if (self::GetTheme() == 'handsome') {
            Handsomes::Pjax($config);
            echo "<link rel='stylesheet' type='text/css' href='" . INTEGRATION_STATIC_PATH . "css/handsome.css' />\n";
        }
        ReturnTop::header($config);

    }
}