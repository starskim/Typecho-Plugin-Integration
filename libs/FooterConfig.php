<?php

require_once 'Services/ReturnTop.php';
require_once 'Services/ActivatePowerMode.php';
require_once 'Services/HoerMouse.php';

class footerConfig extends Services
{
    /**
     * 页脚输出相关代码
     *
     * @access public
     * @param unknown footer
     * @return unknown
     */
    public function footer()
    {
        $options = Helper::options();
        $config = $options->plugin('Integration');
        $PluginPath = $options->pluginUrl . '/Integration/assets/';
        echo '<script type="text/javascript" src="' . $PluginPath . 'js/Integration.js"></script>';
        ReturnTop::footer($config, $PluginPath);
        ActivatePowerMode::footer($config, $PluginPath);
        HoerMouse::footer($config, $PluginPath);
    }

    /**
     * 页脚输出相关代码
     *
     * @access public
     * @param unknown pfooter
     * @return unknown
     */
    public function pfooter()
    {
        $options = Helper::options();
        $config = $options->plugin('Integration');
        $PluginPath = $options->pluginUrl . '/Integration/assets/';
        ActivatePowerMode::pfooter($config, $PluginPath);
    }
}