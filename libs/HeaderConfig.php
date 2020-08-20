<?php

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
        ReturnTop::header($config, $PluginPath);

    }
}