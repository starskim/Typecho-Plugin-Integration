<?php

require_once 'Services/ReturnTop.php';
require_once 'Services/ActivatePowerMode.php';
require_once 'Services/HoerMouse.php';

class footerConfig
{
    /**
     * 页脚输出相关代码
     *
     * @access public
     * @param unknown footer
     * @return unknown
     */
    public static function footer()
    {
        $options = Helper::options();
        $config = $options->plugin('Integration');
        $PluginPath = $options->pluginUrl . '/Integration/assets/';
        ReturnTop::footer($config, $PluginPath);
        ActivatePowerMode::footer($config, $PluginPath);
        HoerMouse::footer($config,$PluginPath);
    }
}