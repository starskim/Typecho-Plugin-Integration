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
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public function footer()
    {
        $options = Helper::options();
        $config = $options->plugin('Integration');
        echo "<script src='https://cdn.bootcdn.net/ajax/libs/layer/3.1.1/layer.min.js'></script>\n";
        echo "<script type='text/javascript' src='https://pv.sohu.com/cityjson?ie=utf-8'></script>\n";
        echo sprintf("<script type='text/javascript' src='%sjs/Integration.js'></script>\n", INTEGRATION_STATIC_PATH);
        echo sprintf("<script type='text/javascript' src='%sjs/General.js'></script>\n", INTEGRATION_STATIC_PATH);
        if (self::GetTheme() == 'handsome') {
            echo sprintf("<script type='text/javascript' src='%sjs/handsome.js'></script>\n", INTEGRATION_STATIC_PATH);
        }
        self::DynamicBackground($config);
        (new ReturnTop)->footer($config);
        (new ActivatePowerMode)->footer($config);
        (new HoerMouse)->footer($config);
    }

    public function DynamicBackground($config)
    {
        $type = $config->DynamicBackground;
        if ($type != 'none') {
            echo sprintf("<script type='text/javascript' src='%sjs/bg/%s'></script>\n", INTEGRATION_STATIC_PATH, $type);

        }

    }
}