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
        echo '<script type="text/javascript" src="' . Integration_STATIC_PATH . 'js/Integration.js"></script>';
        ReturnTop::footer($config);
        ActivatePowerMode::footer($config);
        HoerMouse::footer($config);
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
        ActivatePowerMode::pfooter($config);
    }
}