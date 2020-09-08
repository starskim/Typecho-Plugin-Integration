<?php

require_once 'Services/RobotsPlus.php';
require_once 'Services/ReturnTop.php';

class headerConfig
{
    /**
     * 页头输出相关代码
     *
     * @access public
     * @param unknown header
     * @return unknown
     */
    public static function header()
    {
        $options = Helper::options();
        $config = $options->plugin('Integration');
        $PluginPath = $options->pluginUrl . '/Integration/assets/';
        RobotsPlus::header($config);
        ReturnTop::header($config, $PluginPath);

    }
}